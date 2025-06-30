<?php

namespace App\Console\Commands;

use App\Models\Task;
use App\Models\User;
use App\Services\User\Notify\NotificationService;
use Carbon\Carbon;
use Illuminate\Console\Command;

class UpdateOverdueTasks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tasks:update-status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update Task status';

    public function __construct(protected NotificationService $notificationService)
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */

    public function handle()
    {
        $today = now()->startOfDay();


        $expiredTasks = Task::with('user') // подгружаем user
            ->where('status', 'active')
            ->whereDate('end_date', '<', $today)
            ->get();


        foreach ($expiredTasks as $task) {
            if ($task->user) {
                $this->notificationService->notify($task->user, 'job_expired', $task);
            }

            $task->status = 'expired';
            $task->save();

            $this->info("Обновлено задач: Task - $task->id - expired");

        }


        // Обновляем in_process -> done
        $doneTasks = Task::with('user') // подгружаем user
            ->where('status', 'in_process')
            ->whereDate('end_date', '<', $today)
            ->get();

        foreach ($doneTasks as $d_task) {
            if ($d_task->user) {
                $executor = User::whereId($d_task->executor_id)->first();
                $this->notificationService->notify($d_task->user, 'job_done', $d_task, 1);
                $this->notificationService->notify($executor, 'job_done', $d_task, 1);

            }

            $d_task->status = 'done';
            $d_task->save();

            $this->info("Обновлено задач: Task - $d_task->id - done");

        }


        $this->info("Обновлено задач: 0");
    }
}
