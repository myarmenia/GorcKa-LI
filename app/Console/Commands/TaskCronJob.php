<?php

namespace App\Console\Commands;

use App\Models\ExecutorSlSubCategory;
use App\Models\Task;
use App\Models\User;
use App\Services\TaskService;
use App\Services\User\Email\NewJobMailerService;
use App\Services\User\Notify\NotificationCreator;
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
    public function __construct(
        protected TaskService $service,
        protected NotificationCreator $notificationCreator,
        protected NewJobMailerService $newJobMailerService
    ) {
        parent::__construct(); // <--- обязательно добавь это!
    }
    public function handle()
    {

        $yesterday = Carbon::yesterday()->toDateString();
        // dd($yesterday);

        $tasks =Task::whereDate('created_at', $yesterday)->get();

        // Шаг 2: Получаем sub_category_id из этих задач
        $subCategoryIds = $tasks->pluck('sub_category_id')->toArray();

       // Шаг 3: Получаем всех исполнителей по этим подкатегориям
        $executors = ExecutorSlSubCategory::whereIn('sub_category_id',$subCategoryIds)
                    ->pluck('user_id')
                    ->unique()
                    ->toArray();
        // dd($executors);
        // Шаг 4: Получаем user_id авторов этих задач
        $taskUserIds = $tasks->pluck('user_id')->unique()->toArray();
        // dd($executors, $taskUserIds);
        // Шаг 5: Исключаем из исполнителей тех, кто уже автор задачи
         $finalUserIds = array_diff($executors, $taskUserIds);
        //  dd($executors, $taskUserIds, $finalUserIds);
         // Шаг 6: Отправляем уведомление пользователям
         $usersToNotify = User::whereIn('id', $finalUserIds)->get();

        // $usersToNotify =User::where('id',3)->get();
        //  dd($usersToNotify);
        foreach($usersToNotify as $user){

            foreach($tasks as $task){
                $this->notificationCreator->create($user,'new_job',$task->id);
            }

            $this->newJobMailerService->sendEmail($user,$tasks);

        }
    }
}

