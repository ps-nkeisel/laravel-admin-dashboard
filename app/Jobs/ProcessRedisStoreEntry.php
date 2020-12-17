<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Cache;
use App\Models\Entry;
use App\Models\Language;
use Carbon\Carbon;

class ProcessRedisStoreEntry implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $entries;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($entries)
    {
        $this->entries = $entries;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        cacheEntriesIntoRedisStore($this->entries);
    }
}
