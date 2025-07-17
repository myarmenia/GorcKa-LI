<?php

namespace App\Repositories\Category;

use App\Interfaces\Category\CategoryInterface;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;

class CategoryRepository implements CategoryInterface
{
    protected Model $model;

    public function __construct(Category $model)
    {
        $this->model = $model;
    }
    public function allWithTaskCount()
    {
        $categories = $this->model->with('translation')
            ->withCount([
                'sub_categories as tasks_count' => function ($query) {
                    $query->join('tasks', 'tasks.sub_category_id', '=', 'sub_categories.id')
                        ->where('tasks.status', 'active')
                        ->selectRaw('count(tasks.id)');
                }
            ])
            ->orderByDesc('tasks_count')
            ->get();

            return $categories;
    }
}
