<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

use App\User;

class FriendHasBeenInvited extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */

    public $friend;
    public $inviter;

    public function __construct(User $inviter, $friend)
    {
        $this->friend = $friend;
        $this->inviter = $inviter;
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
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject($this->inviter->name . ' invited you to SeaOrganizer!')
                    ->greeting('Hello ' . $this->friend->name . '!')
                    ->line('Your friend ' . $this->inviter->name . ' has invited you to join SeaOrganizer, a certificate managenent for seafarers.')
                    ->action('Join now!', url('/invitation/' . $this->inviter->invite_code))
                    ->line('When you sign up, you will get a special 2-month off discount! And even better, your friend will get the same discount too! 0/')
                    ->line('Thank you');
    }
}
