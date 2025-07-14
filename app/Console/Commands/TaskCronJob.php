<?php

namespace App\Console\Commands;

use App\Models\Task;
use Illuminate\Console\Command;
use Carbon\Carbon;

class TaskCronJob extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:task-cron-job';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {

        $yesterday = Carbon::yesterday()->toDateString();

        $tasks = Task::with('user')->whereDate('created_at', $yesterday)->get();
         \Log::info($tasks);
        \Log::info($yesterday);
    }
}

