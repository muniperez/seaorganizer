<?php

namespace App\Listeners;

use App\Events\CertificateFileModified;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use Illuminate\Support\Facades\Storage;

class DeleteOldCertificateFile
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
     * @param  CertificateFileModified  $event
     * @return void
     */
    public function handle(CertificateFileModified $event)
    {
        // 1 - Delete the old file, if it exists
        $file = $event->oldFile;

        if($file && Storage::exists($file))   {
            Storage::delete($file);
        }
    }
}
