<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Inertia\Inertia;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Session;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {

//         $locale = $request->route('locale'); // Получаем язык из URL
//         if (!in_array($locale, ['en', 'ru', 'am'])) {
//             $locale = Session::get('locale', config('app.locale')); // Берем из сессии, если нет в URL
//         }

//        // Устанавливаем локаль
//        App::setLocale($locale);
//        session(['locale' => $locale]);
// dd(session()->get('locale'));
//         Inertia::share('locale', $locale);
        // Определяем локаль из маршрута или берём стандартную из конфига
        $locale = $request->route('locale', config('app.locale'));

        // Устанавливаем локаль приложения
        App::setLocale($locale);

        // Передаём локаль во все Inertia-запросы
        Inertia::share([
            'locale' => $locale
        ]);


        return $next($request);
    }


}
