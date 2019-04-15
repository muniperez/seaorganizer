<?php

namespace App\Listeners;

use App\Events\CertificateDeleted;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use Illuminate\Support\Facades\Storage;

class DeleteCertificate
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  CertificateDeleted  $event
     * @return void
     */
    public function handle(CertificateDeleted $event)
    {
        // 1 - Delete the file, if it exists
        $file = $event->certificate->file;

        if($file && Storage::exists($file))   {
            Storage::delete($file);
        }
        

        // 2 - Delete the model

        $event->certificate->delete();
    }
}
