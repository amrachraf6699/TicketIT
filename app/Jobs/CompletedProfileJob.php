<?php

namespace App\Jobs;

use App\Traits\GeneratePDF;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CompletedProfileJob implements ShouldQueue
{
    use Queueable;

    use GeneratePDF;

    public $user;

    /**
     * Create a new job instance.
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $ticket = $this->SpeakersTicket($this->user);

        $this->user->speaker()->update(['ticket_id'=>$ticket]);
    }
}
