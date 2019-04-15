<?php

namespace App\Notifications;

use App\User;
use App\Certificate;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

use Illuminate\Notifications\Messages\NexmoMessage;

class CertificateExpiring extends Notification
{
    use Queueable;

    public $certificate;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Certificate $certificate)
    {
        //

        $this->certificate = $certificate; 
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'nexmo'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('Alert: Certificate ' . $this->certificate->label . ' to expire in ' . $this->certificate->expires_within)
                    ->greeting('Dear ' . $this->certificate->user->name)
                    ->line('Your certificate ' . $this->certificate->label . ' will expire in ' . $this->certificate->expires_within . '.')
                    ->line('Thank you for using our application!');
    }

    public function toNexmo($notifiable)
    {

        return (new NexmoMessage)
                    ->content('SeaOrganizer Alert: Your certificate ' . $this->certificate->label . ' is expiring ' . $this->certificate->expires_within . '.');
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
