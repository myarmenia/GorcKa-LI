<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\VerifyEmail;
use App\Models\Location;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Inertia\Inertia;
use Inertia\Response;
use Mail;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): Response
    {
        $locations = Location::with([
            'translations' => function ($query) {
                $query->where('lang_id', 1);
            }
        ])->get();
        // dd($locations);
        return Inertia::render('Auth/Register',  ['locations' => $locations]);
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|lowercase|email|max:255|unique:' . User::class,
            'phone' => 'required|regex:/^\+?[1-9]\d{1,14}$/',
             'agree_terms' => 'accepted',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->assignRole('user');

        // event(new Registered($user));
        Mail::to($user->email)->send(new VerifyEmail($user));

        Auth::login($user);

        return redirect(route('dashboard', ['locale' => app()->getLocale()], absolute: false));
        // return redirect()->route('welcome');

    }
}
