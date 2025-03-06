<?php

namespace App\Http\Controllers\User\Profile;

use App\DTO\TaskDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\TaskRequest;
use App\Models\Category;
use App\Models\Location;
use App\Models\SubCategory;
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

        $data = $this->service->list();

// dd( $data);
        return Inertia::render('Profile/TaskList',[
            "tasks" => $data,
            "locale" => app()->getLocale()
        ]);


        // dd($data);



    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::with(['translation','sub_categories.translation'])->get();
        $location = Location::with('translation')->get();



        return  Inertia::render('Profile/Task',[
            'categories'=>$categories,
            'locations'=>$location,
            'locale'=>app()->getLocale()


        ]);
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
    public function edit($lang, $id)

    {

        $categories = Category::with(['translation','sub_categories.translation'])->get();
        $location = Location::with('translation')->get();

        $data = $this->service->edit($id);
        // dd($data->sub_category_id );
        $sub_category = SubCategory::find($data->sub_category_id);
        // dd( $sub_category->category_id);
        $task_category = Category::where('id', $sub_category->category_id)->with('translation','sub_categories.translation')->get();
// dd($task_category);
        return Inertia::render('Profile/TaskEdit',[
            'categories' => $categories,
            'locations' => $location,
            'task' => $data,
            'task_category_id' =>$sub_category->category_id,
            'task_category' => $task_category,
            'locale' => app()->getLocale()
        ]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $lang,string $id)
    {
        dd($request->all(), $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
