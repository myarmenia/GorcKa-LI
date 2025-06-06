<?php

namespace App\Http\Controllers\User\Profile;

use App\DTO\User\UserDTO;
use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Category;
use App\Services\User\ProfileService;
use Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Redirect;

class UserProfileController extends Controller
{
    public function __construct(
        protected ProfileService $profileService
    ){

    }
    public function index(Request $request){

        $locations = Helper::getLocations();
        $langs = Helper::getLanguages();
        $categories = Helper::getCategoriesWithSubCategories();
        $socialMedias = Helper::socialMedias();

        $user = $this->profileService->getUser();

        return Inertia::render('Profile/ProfileAccount/ProfilePage', [
            'locations' => $locations,
            'langs' => $langs,
            'categories' => $categories,
            'socialMedias' => $socialMedias,
            'user' => $user,
        ]);

    }



    public function update(ProfileUpdateRequest $request): RedirectResponse
    {


        // $request->user()->fill($request->validated());

        $user = $this->profileService->update(UserDTO::fromUserDTO($request));


        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        // dd(22);
        // $request->user()->save();

        return Redirect::route('user.profile.update', app()->getLocale());
    }





}
