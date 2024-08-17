<?php

namespace App\Notifications\EventPlanner;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CreateSpeakerNotification extends Notification
{
    use Queueable;

    public $speaker, $event_planner;

    /**
     * Create a new notification instance.
     */
    public function __construct($speaker, $event_planner)
    {
        $this->speaker = $speaker;
        $this->event_planner = $event_planner;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('The speaker account of ' . $this->speaker->username . ' has been created')
            ->view('emails.event_planner.create_speaker', [
                'speaker' => $this->speaker,
                'event_planner' => $this->event_planner,
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
            'message' => 'The speaker account has been created successfully',
            'details' => 'The speaker account of ' . $this->speaker->username . ' has been created successfully. Ask the speaker to login to the platform to complete the registration process.',
        ];
    }
}
