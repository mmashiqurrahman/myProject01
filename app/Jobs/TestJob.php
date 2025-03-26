<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class TestJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $pause;
    /**
     * Create a new job instance.
     */
    public function __construct($pause)
    {
        $this->pause = $pause;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Log::info("Log for TestJob started. ".$this->pause);
        sleep($this->pause);
        Log::info("First iteration complete. ".$this->pause);
        sleep($this->pause);
        Log::info("Second iteration complete. ".$this->pause);
        sleep($this->pause);
        Log::info("Third iteration complete. ".$this->pause);
        sleep($this->pause);
        Log::info("Fourth iteration complete. ".$this->pause);
        sleep($this->pause);
        Log::info("Final iteration complete. ".$this->pause);
    }
}
