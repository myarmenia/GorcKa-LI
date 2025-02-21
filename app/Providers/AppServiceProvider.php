<?php

namespace App\Providers;

use App\Interfaces\Auth\RegisterInterface;
use App\Interfaces\BaseInterface;
use App\Interfaces\Task\TaskInterface;
use App\Mail\CustomResetPasswordToMail;
use App\Repositories\Auth\RegisterRepository;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;
use Illuminate\Auth\Notifications\VerifyEmail;
use App\Mail\VerifyEmail as CustomVerifyEmail;
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

        $this->app->bind(BaseInterface::class, RegisterRepository::class);
        $this->app->bind(TaskInterface::class, TaskRepository::class);


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
    }
}
