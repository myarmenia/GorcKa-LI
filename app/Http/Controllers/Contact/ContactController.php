<?php

namespace App\Http\Controllers\Contact;

use App\DTO\Contact\ContactDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\ContactRequest;
use App\Services\Contact\ContactService;
use Illuminate\Http\Request;
use Inertia\Inertia;



class ContactController extends Controller
{
    public function __construct(protected ContactService $service){}
    public function index(){

        return Inertia::render('Contact/Index', [ "locale" => app()->getLocale()]);
    }

    public function store(ContactRequest $request){

        $this->service->store(ContactDTO::fromRequestDto($request));

        return response()->json([
                'message' => __('validation_messages.your_letter_has_been_sent_successfully'),
            ], 200);

    }
}

