<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class ResetApproveAssets extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cron:reset-approve-assets';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reset data approve Assets';

    /**
     * Execute the console command.
     */
    public function handle()
    {
      Log::info('Job reset Approve assets is running');
    }
}
