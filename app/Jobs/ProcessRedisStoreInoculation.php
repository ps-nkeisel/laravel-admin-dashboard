<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Inoculation;
use App\Models\Language;
use Carbon\Carbon;

class ProcessRedisStoreInoculation implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $inoculations;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($inoculations)
    {
        $this->inoculations = $inoculations;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        cacheInoculationsIntoRedisStore($this->inoculations);
    }
}
