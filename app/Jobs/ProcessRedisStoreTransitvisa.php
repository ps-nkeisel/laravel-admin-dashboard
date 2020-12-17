<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Transitvisa;
use App\Models\Language;
use Carbon\Carbon;

class ProcessRedisStoreTransitvisa implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $transitvisas;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($transitvisas)
    {
        $this->transitvisas = $transitvisas;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        cacheTransitvisasIntoRedisStore($this->transitvisas);
    }
}
