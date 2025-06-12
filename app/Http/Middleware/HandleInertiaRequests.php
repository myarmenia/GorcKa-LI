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
        $file = lang_path($lang . '/' . $name . ".json");
        $formFile = lang_path($lang . '/form' . ".json");
        $navbarFile = lang_path($lang . '/navbar' . ".json");
        $user = Auth::user();


        $firebaseConfigForJsPath = env('FIREBASE_CREDENTIALS_FOR_JS');

        // Чтение конфигурации Firebase из JSON файла
        $firebaseConfigForJsConfig = json_decode(File::get($firebaseConfigForJsPath), true);
        $firebaseVapIdKey = env('FIREBASE_VAPIDKEY');


        return [
            ...parent::share($request),
            'firebaseConfig' => $firebaseConfigForJsConfig,
            'firebaseVapIdKey' => $firebaseVapIdKey,
            'auth' => [
                // 'user' => $request->user(),
                'user' => $user ? [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'roles' => $user->roles,
                    'avatar' => $user->avatar,
                    'point' => $user->point,
                    'verified' => $user->email_verified_at,
                    'unread_notification_count' => $user->notifications()->unread()->count(),
                    'unread_messages_count' => $user->messages()->unread()->count(),

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
