<?php

namespace App\Http\Middleware;

use App;
use Auth;
use File;
use Illuminate\Http\Request;
use Inertia\Middleware;
use Closure;
use Inertia\Inertia;
class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    // protected $rootView = 'app';

    public function rootView(Request $request): string
    {
        return $request->is('admin*') ? 'admin' : 'app';
    }

    /**
     * Determine the current asset version.
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        $lang = in_array(request()->segment(1), ['am', 'ru', 'en']) ? request()->segment(1) : 'am';
        $name = request()->route()->getName();
        $file = lang_path($lang . '/'. $name . ".json" );
        $formFile = lang_path($lang . '/form' . ".json" );
        $navbarFile = lang_path($lang . '/navbar' . ".json");

        return [
            ...parent::share($request),
            'auth' => [
                // 'user' => $request->user(),
                'user' => Auth::user() ? [
                    'id' => Auth::user()->id,
                    'name' => Auth::user()->name,
                    'email' => Auth::user()->email,
                    'roles' => Auth::user()->roles
                ] : null,
            ],
            // 'translations' => File::exists($file) ? File::json($file) : []
            'translations' => [
                'form' => File::exists($formFile) ? File::json($formFile) : [],
                'page' => File::exists($file) ? File::json($file) : [],
                'navbar' => File::exists($navbarFile) ? File::json($navbarFile) : []
            ],
            'err' => function () use ($request) {
                return $request->session()->get('errors')
                    ? $request->session()->get('errors')->getBag('default')->toArray()
                    : (object) [];
            },
        ];
    }
}
