<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Visa;
use App\Models\Language;
use Carbon\Carbon;

class ProcessRedisStoreVisa implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $visas;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($visas)
    {
        $this->visas = $visas;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        cacheVisasIntoRedisStore($this->visas);
    }
}
