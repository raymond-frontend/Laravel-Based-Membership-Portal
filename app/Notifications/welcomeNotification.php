<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class welcomeNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        $this->user = $user;
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
                    ->subject('welcome')
                    ->line(
                    'Dear Esteemed Mediator, 
                    Greetings from the Institute of Chartered Mediators and Conciliators. 

                    Thank you for signing up. Please complete all fields honestly and upload your profile photo. Your profile will be visible to all visitors to the ICMC website under the drop down “ICMC Directory of Members.”

                    It is important that you keep your Membership ID handy as this will enable you log into your profile at all times. 

                    Please note that failure to pay your annual membership dues will amount to your profile being disabled. You will no longer be able to log in and edit your profile, and it will no longer be visible on the ICMC website. 

                    For further inquiries, kindly contact the ICMC Secretariat (info@icmcng.org)

                    Thank you. '
                    );
               
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
