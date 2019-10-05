<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class DuesNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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
                    ->success()
                    ->line('
                    Dear Esteemed Mediator,
                    Greetings from the Institute of Chartered Mediators and Conciliators. 

                    Please, this is a reminder to pay your annual membership dues. Failure to pay your annual membership dues will amount to your profile being disabled. You will no longer be able to log in and edit your profile, and it will no longer be visible on the ICMC website.

                    The membership dues for each cadre are as follows:
                    Associate Member: N6,000
                    Member: N10,000
                    Fellow: N20,000

                    Payment should please be made into the following account:
                    Account name: ICMC Membership Dues Collection
                    Bank name: Zenith bank
                    Account number: 1015308125

                    Thank you 
                    ');

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
