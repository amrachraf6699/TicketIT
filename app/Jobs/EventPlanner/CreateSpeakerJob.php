<?php

namespace App\Jobs\EventPlanner;

use App\Notifications\EventPlanner\CreateSpeakerNotification;
use App\Notifications\Speaker\JoinNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CreateSpeakerJob implements ShouldQueue
{
    use Queueable;

    public $speaker, $event_planner;

    /**
     * Create a new job instance.
     */
    public function __construct($speaker, $event_planner)
    {
        $this->event_planner = $event_planner;
        $this->speaker = $speaker;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // Notify the event planner
        $this->event_planner->user->notify(new CreateSpeakerNotification($this->speaker, $this->event_planner));

        // Notify the speaker
        $this->speaker->notify(new JoinNotification($this->speaker, $this->event_planner));
    }
}
