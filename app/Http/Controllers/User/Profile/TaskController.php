<?php

namespace App\Http\Controllers\User\Profile;

use App\DTO\TaskDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\TaskRequest;
use App\Models\Category;
use App\Models\Location;
use App\Services\TaskService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TaskController extends Controller
{
        public function __construct(protected TaskService $service ){}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {


        $categories = Category::with(['translation','sub_categories.translation'])->get();
        $location = Location::with('translation')->get();
        // dd($location);


        return  Inertia::render('Profile/Task',[
            'categories'=>$categories,
            'locations'=>$location,
            'locale'=>app()->getLocale()


        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TaskRequest $request)

    {
        // dd($request->all());

        $data=$this->service->createTask(TaskDTO::fromRequestDto($request));

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
