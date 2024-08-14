<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ReservationNotification extends Notification
{
    use Queueable;

    public $reservation, $pdf;

    /**
     * Create a new notification instance.
     */
    public function __construct($reservation, $pdf)
    {
        $this->reservation = $reservation;
        $this->pdf = $pdf;
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
        ->subject('Your reservation for ' . $this->reservation->eventPrice->event->title . ' has been created successfully')
        ->view('emails.reservation', [
            'reservation' => $this->reservation,
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
            'message' => 'Your reservation has been created successfully',
            'details' => 'Your reservation to ' . $this->reservation->eventPrice->event->title . ' has been created successfully. Dont forget to be at '. $this->reservation->eventPrice->event->location . ' by ' . $this->reservation->eventPrice->event->start_date . ' . Use this Location if you are lost: ' . $this->reservation->eventPrice->event->google_map_url . ' . We are looking forward to seeing you there.',
            'file' => url($this->pdf),
        ];
    }
}
