<?php

namespace App\Http\Controllers\User\Profile;

use App\DTO\TaskDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\TaskRequest;
use App\Models\Category;
use App\Models\Location;
use App\Models\SubCategory;
use App\Models\Task;
use App\Services\TaskService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TaskController extends Controller
{
        public function __construct(protected TaskService $service ){}
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $page = request()->page ?? 1;
        $perPage = 5;

        $data = $this->service->list();

        $data = $data->paginate($perPage);

        return Inertia::render('Profile/TaskList',[
            "tasks" => $data,
            "locale" => app()->getLocale()
        ]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
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
     * Store a newly created resource in storage.
     */
    public function store(TaskRequest $request)

    {
        // dd(app()->getLocale());
        // dd($request->all());
        $categories = Category::with(['translation','sub_categories.translation'])->get();
        $location = Location::with('translation')->get();

        $data = $this->service->createTask(TaskDTO::fromRequestDto($request));

        // return  Inertia::render('Profile/Task',[
        //     'message' =>  __('messages.the_operation_was_successful'),
        //     'categories'=>$categories,
        //     'locations'=>$location,
        //     'locale'=>app()->getLocale()


        // ]);
        $data = $this->service->list();

        // dd( $data);
                return Inertia::render('Profile/TaskList',[
                    "tasks" => $data,
                    "locale" => app()->getLocale()
                ]);



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
        $sub_category = SubCategory::find($data->sub_category_id);

        $task_category = Category::where('id', $sub_category->category_id)->with('translation','sub_categories.translation')->get();
        $files=[];


            if(count($data['files'])>0){

                foreach($data['files'] as $key=> $file ){
                    $files[$key]['id'] = $file->id;
                    $files[$key]['name'] = $file->name;
                    $files[$key]['path'] = asset('storage/' . $file->path);

                }
            }

        // dd($files);

        return Inertia::render('Profile/TaskEdit',[
            'categories' => $categories,
            'locations' => $location,
            'task' => $data,
            'task_category_id' =>$sub_category->category_id,
            'task_category' => $task_category,
            'files' => $files,
            'locale' => app()->getLocale()
        ]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TaskRequest $request, $lang,string $id)
    {
        // dd($request->all(),$lang, $id);

        $data=$this->service->updateTask(TaskDTO::fromRequestDto($request),$id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
