<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

use App\Coupon;

class FriendJoinedWithInvite extends Notification
{
    use Queueable;

    public $coupon;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Coupon $coupon)
    {
        $this->coupon = $coupon;
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
        $amount = ($this->coupon->amount)/100;

        return (new MailMessage)
                    ->subject('You just got 2 months free thanks to a friend!')
                    ->line('Good news! A friend just signed up with your invite code and you both got 2 months free!')
                    ->line('This coupon and any others that you might have will be discounted on your next billing, so you will save a total of $' . $amount . '!')
                    ->line('0/ yay');
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
