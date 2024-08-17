<?php

namespace App\Notifications\Speaker;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class JoinNotification extends Notification
{
    use Queueable;

    public $speaker , $event_planner;

    /**
     * Create a new notification instance.
     */
    public function __construct($speaker,$event_planner)
    {
        $this->event_planner = $event_planner;
        $this->speaker = $speaker;
    }
    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail','database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
        ->subject('Welcome to our platform')
        ->view('emails.speaker.join',[
            'speaker' => $this->speaker,
            'event_planner' => $this->event_planner
        ]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'message' => 'Welcome to our platform',
            'details' => 'Welcome to our platform. You have been added as a speaker by ' . $this->event_planner->username . '. Please complete the registration process and finalize your account customization.'
        ];
    }
}
