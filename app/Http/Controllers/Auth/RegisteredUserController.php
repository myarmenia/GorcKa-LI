<?php

namespace App\Http\Controllers\Auth;

use App\DTO\Auth\RegisterDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Services\Auth\RegisterService;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class RegisteredUserController extends Controller
{
    public function __construct(protected RegisterService $registerService) {}

    /**
     * Display the registration view.
     */
    public function create(): Response
    {
        $locations = $this->registerService->create();
        // dd($locations);
        return Inertia::render('Auth/Register',  ['locations' => $locations]);
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(RegisterRequest $request): RedirectResponse
    {

        $user = $this->registerService->store(RegisterDTO::fromRegisterDTO($request->all()));


        return $user ?
            redirect(route('dashboard', ['locale' => app()->getLocale()], absolute: false)) :
            redirect(route('welcome', ['locale' => app()->getLocale()], absolute: false));

    }
}
