<?php

namespace App\Console\Commands;

use App\Models\AssetExamine;
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
      $today = date('Y-m-d');
      Log::info('Job reset Approve assets is running at '.$today);
      $count = AssetExamine::where('created_at', '<', $today)
                ->where('deleted_at', '=', 0)
                ->update(['deleted_at' => 1]);
      Log::info('Job reset Approve assets is end updated '.$count.' records');
    }
}
