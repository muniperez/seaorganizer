<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Validator;

use App\User;
use App\Certificate;
use App\Flag;

use App\Events\CertificateDeleted;
use App\Events\CertificateFileModified;

class CertificateController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('certificates.index');
    }

    public function json()
    {
        $certificates = auth()->user()->certificates()->with('flag')->upcoming()->get();

        return response()->json($certificates);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view('certificates.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */ 

    public function store(Request $request)
    {
        $this->validate(request(), [
                'label' => 'required|min:3|max:150',
                'expiration' => 'required|min:10|max:27'
            ]);


        // User
        $user = auth()->user();

        // Initiate a Carbon instance
        $expiration = new Carbon(request('expiration'));

        // Initiate a new Certificate
            $certificate = new Certificate();
            
            $certificate->expiration = $expiration;
            $certificate->label = request('label');

        // Associate with user
            $user->certificates()->save($certificate);

        // Flag
            if($request->input('flag')) {
                
                $flag = new Flag();

                $flag->country_id = $request->input('flag.country_id');
                $flag->user_id = $user->id;

                // Associate with certificate
                $certificate->flag()->save($flag);

                // Associate with user
                $flag->user()->associate($user);
            }

        if($request->ajax())    {
            
            return response(Certificate::with('flag')->find($certificate->id)->toJson());
        }
        else {

            request()->session()->flash('message', 'Certificate added!');

            return redirect('/certificates/' . $certificate->id);
        }
    }

    // public function storeFromApi()
    // {
    //     if(request('label') && request('expiration')) {

    //         // Initiate a Carbon instance
    //         $expiration = new Carbon(request('expiration'));

    //         // Expiration date
    //             // Initiate a new Certificate
    //             $certificate = new Certificate();
    //             $certificate->expiration = $expiration;

    //         // Label
    //             $certificate->label = request('label');
            
    //         // User
    //             $certificate->user = auth()->id();

    //         // Save
    //             $certificate->save();

            

    //         // Return new certificate
    //         return response(Certificate::find($certificate->id)->toJson());
    //     }
    //     else {

    //         return response(['success' => false]);
    //     }
    // }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Certificate $certificate)
    {
        $certificate->load('flag');

        if(request()->ajax())    {
            
            return response($certificate->toJson());
        }
        else {

            return view('certificates.show', compact('certificate'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Certificate $certificate)
    {
        //
        $certificate->load('flag');

        return view('certificates.edit', compact('certificate'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    public function update(Request $request, Certificate $certificate)
    {
        //  Validate

        $this->validate($request, [
                'label' => 'required|min:3|max:150',
                'expiration' => 'required|min:10|max:27',
                'issued' => 'nullable|min:10|max:27',
                //'file' => 'nullable|mimes:pdf',
            ]);


        // Check expiration date

        $expiration = request('expiration');

            if($expiration)    {

                $certificate->expiration = new Carbon($expiration);
            }

        // Check date of issue
        $issued = request('issued');
        
            if($issued) {
                $issued = new Carbon($issued);
                $certificate->issued = $issued;
            }

        // Additional information

            $certificate->label = request('label');
            $certificate->issuer = request('issuer');
            $certificate->remarks = request('remarks');

        // If a file is provided
        // if(request('file')) {

        //     // Upload file
        //     $path = $request->file('file')->store('certificates');

        //     if($path) {

        //         // Dispatch an event with the old file name to delete it if it exists
        //         event(new CertificateFileModified($certificate->file));

        //         $certificate->file = $path;
        //     }
        // }

        // Updates the information
        $certificate->save();

        // Flag
            
            if(request('newFlag')) {

                Log::debug('Has new flag');

                $user = auth()->user();

                if(!$certificate->flag->id) {

                    $flag = new Flag();
                    $certificate->flag()->save($flag);
                    $flag->user()->associate($user);
                }
                else {

                    $flag = $certificate->flag;
                }

                $flag->country_id = $request->input('newFlag.country_id');

                // Associate with certificate
                $flag->save();
            }

        if(request()->ajax())   {

            return response()->json(['error' => false, 'certificate' => $certificate, 'flag' => @$flag]);
        }

        // Send flash message
        request()->session()->flash('message', 'Certificate updated!');

        return redirect('/certificates');
    }

    public function updateFile(Request $request, Certificate $certificate)
    {
        //  Validate

        if(request()->ajax())   {

            $validator = Validator::make($request->all(), [
                
                'file' => 'required|pdf64:pdf'
            ]);
            
            if ($validator->fails()) {
                
                return response()->json(['errors'=>$validator->errors()]);

            } else {
                
                $encodedFile = explode(',', $request->get('file'))[1];
                $fileContents = base64_decode($encodedFile);
                $fileName = str_random(40) . '.pdf';
                $path = 'certificates/' . $fileName;
                
                Storage::put($path, $fileContents);
            }
        }
        else {

            $this->validate(request(), [
                'file' => 'required|mimes:pdf',
            ]);

            // Upload file
            $path = $request->file('file')->store('certificates');
        }

        if($path) {

            // Dispatch an event with the old file name to delete it if it exists
            event(new CertificateFileModified($certificate->file));

            $certificate->file = $path;

            // Updates the information
            $certificate->update();

            if(request()->ajax())   {

            return response()->json(['error'=>false, 'file' => $path]);
        }

            // Send flash message
            request()->session()->flash('message', 'Certificate uploaded!');

            return redirect('/certificates/' . $certificate->id);
        }
        else {

            abort(500, 'Something went wrong with the upload');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    public function promptDestroy(Certificate $certificate)    {
        //
        return view('certificates.delete', compact('certificate'));
    }

    public function destroy(Certificate $certificate)
    {
        //
        event(new CertificateDeleted($certificate));

        return redirect()->route('dashboard')->with('message', 'Certificate has been deleted');
    }

    public function destroyFile(Certificate $certificate)   {

        // Emit event to delete the file
        event(new CertificateFileModified($certificate->file));

        // Update the records
        $certificate->file = null;
        $certificate->save();

        $message = 'File deleted';

        if(request()->ajax())   {

            return response()->json(['error' => false, 'message' => $message]);
        }

        return back()->with('message', $message);

    }

    public function archive(Certificate $certificate)
    {
        

    }

    public function getFile(Certificate $certificate)   {

        if(!$certificate->file)  {

            return redirect()->route('dashboard')->with('error', "'Certificate doesn't have any file");
        }

        return response()->redirectTo($certificate->fileUrl());
    }
}
