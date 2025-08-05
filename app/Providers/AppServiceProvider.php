<?php

namespace App\Providers;

use App\Interfaces\Applicant\ApplicantInterface;
use App\Interfaces\Auth\RegisterInterface;
use App\Interfaces\BaseInterface;
use App\Interfaces\Category\CategoryInterface;
use App\Interfaces\Chat\ChatInterface;
use App\Interfaces\Chat\MessageInterface;
use App\Interfaces\Chat\RoomInterface;
use App\Interfaces\Comment\CommentInterface;
use App\Interfaces\Contact\ContactInterface;
use App\Interfaces\Job\JobInterface;
use App\Interfaces\Notification\NotificationInterface;
use App\Interfaces\Specialist\SpecialistDetailsInterface;
use App\Interfaces\Specialist\SpecialistInterface;
use App\Interfaces\Specialist\TopSpecialistInterface;
use App\Interfaces\Task\TaskInterface;
use App\Interfaces\User\UserInterface;
use App\Mail\CustomResetPasswordToMail;
use App\Models\Message;
use App\Models\Task;
use App\Observers\MessageObserver;
use App\Observers\TaskObserver;
use App\Repositories\Applicant\ApplicantRepositry;
use App\Repositories\Auth\RegisterRepository;
use App\Repositories\Category\CategoryRepository;
use App\Repositories\Chat\ChatRepository;
use App\Repositories\Chat\MessageRepository;
use App\Repositories\Chat\RoomRepositry;
use App\Repositories\Job\JobRepository;
use App\Repositories\Notification\NotificationRepository;
use App\Repositories\Specialist\SpecialistRepository;
use App\Repositories\User\UserRepository;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;
use Illuminate\Auth\Notifications\VerifyEmail;
use App\Mail\VerifyEmail as CustomVerifyEmail;
use App\Repositories\Comment\CommentRepository;
use App\Repositories\Contact\ContactRepository;
use App\Repositories\Specialist\SpecialistDetailsRepository;
use App\Repositories\Specialist\TopSpecialistRepository;
use App\Repositories\Task\TaskRepository;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;
use Illuminate\Translation\FileLoader;
use Illuminate\Translation\Translator;
use Illuminate\Support\Facades\App;
use Illuminate\Filesystem\Filesystem;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $loader = new FileLoader(new Filesystem(), base_path('lang'));
        $translator = new Translator($loader, App::getLocale());

        App::instance('translator', $translator);

        $this->app->bind(RegisterInterface::class, RegisterRepository::class);
        $this->app->bind(SpecialistInterface::class, SpecialistRepository::class);
        $this->app->bind(TaskInterface::class, TaskRepository::class);
        $this->app->bind(CategoryInterface::class, CategoryRepository::class);
        $this->app->bind(JobInterface::class, JobRepository::class);
        $this->app->bind(ApplicantInterface::class, ApplicantRepositry::class);
        $this->app->bind(NotificationInterface::class, NotificationRepository::class);
        $this->app->bind(RoomInterface::class, RoomRepositry::class);
        $this->app->bind(MessageInterface::class, MessageRepository::class);
        $this->app->bind(UserInterface::class, UserRepository::class);
        $this->app->bind(ChatInterface::class, ChatRepository::class);
        $this->app->bind(CommentInterface::class, CommentRepository::class);
        $this->app->bind(SpecialistDetailsInterface::class,SpecialistDetailsRepository::class);
        $this->app->bind(ContactInterface::class,ContactRepository::class);
        $this->app->bind(TopSpecialistInterface::class,TopSpecialistRepository::class);

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Vite::prefetch(concurrency: 3);

        VerifyEmail::toMailUsing(function ($notifiable, $url) {
            return new CustomVerifyEmail($notifiable);
        });

        ResetPassword::toMailUsing(function ($notifiable, $token) {
            return new CustomResetPasswordToMail($token, $notifiable->email);
        });

        Inertia::share([
            'locale' => fn() => Session::get('locale', config('app.locale')),
        ]);

        Message::observe(MessageObserver::class);
        Task::observe(TaskObserver::class);


    }
}
