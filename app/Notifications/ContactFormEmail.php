<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;

class ContactFormEmail extends Notification
{
    //use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */

    protected $request; 

    public function __construct($request)
    {
        //
        $this->request = $request;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Mail\Mailable;
     */
    public function toMail($notifiable)
    {
        $mailable = (new Mailable)->from($request->email);

        return $mailable
                    ->line('We got a new e-mail from <b>'
                        . $this->request->name 
                        . '</b> (' 
                        . $this->request->email 
                        . ')')

                    ->line($this->request->message);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
