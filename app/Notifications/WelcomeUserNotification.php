<?php

namespace App\Notifications;

use App\Traits\SendSMS;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\VonageMessage;
use Illuminate\Notifications\Notification;

class WelcomeUserNotification extends Notification
{
    use Queueable, SendSMS;

    public $user;

    /**
     * Create a new notification instance.
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database','vonage'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'subject' => 'Welcome to our application',
            'message' => 'Welcome, ' . $this->user->name . ' to our application. We are happy to have you here. Feel free to explore our application and let us know if you have any questions.'
        ];
    }

    public function toVonage(object $notifiable): VonageMessage
    {
    return (new VonageMessage)
        ->content('Welcome, ' . $this->user->name . 'to '. env('APP_NAME') . '. We are happy to have you here. Feel free to explore our application and let us know if you have any questions.');
    }
}
