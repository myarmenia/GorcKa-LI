<?php
namespace App\Services\Specialist;

use App\Interfaces\Specialist\SpecialistInterface;
use App\Models\Category;
use App\Models\ExecutorInfo;
use App\Models\SubCategory;
use App\Traits\FilterTrait;
use Storage;




class SpecialistService
{
    use FilterTrait;
    public function __construct(protected SpecialistInterface $specialistRepository, protected ExecutorInfo $executorInfo)
    {
    }

    public function getAll()
    {
        return $this->exequtorResultFilter(ExecutorInfo::query());
    }



    public function filterSpecialists($data){
        $data['status'] = 1;
        $data['sub_category_id'] = isset($data['category_id']) ? SubCategory::where('category_id', $data['category_id'])->pluck('id')->toArray() : null;


        $data = array_filter($data, function ($value) {
            return $value !== null && $value !== 'null';
        });


        $filter= $this->executorInfo->filter($data);

        return $this->exequtorResultFilter($filter);
    }



    public function exequtorResultFilter($query){

        return $query->selectRaw('user_id, GROUP_CONCAT(sub_category_id) as sub_category_ids')
            // ->with(['activeUser.location.translation', 'sub_category.translation']) // Подключаем связи
            ->groupBy('user_id')
            ->get()
            ->filter(function ($item) {
                // Проверяем, что у элемента есть activeUser
                return $item->activeUser !== null;
            })
            ->map(function ($item) {
                // Извлекаем данные для activeUser.location.translation и добавляем их в результат
                $item->location = $item->activeUser->location->translation->name ?? null;

                // Извлекаем имя пользователя и добавляем его в результат
                $item->user_name = $item->activeUser->name ?? null; // Предположим, что имя пользователя в поле name

                $item->avater = $item->activeUser->avatar
                    ? asset('storage/' . ltrim($item->activeUser->avatar))
                    // ? Storage::path($item->activeUser->avatar)
                    : '/assets/user/images/avatar.png';

                // Получаем список sub_category_id из строки, разделенной запятыми
                $subCategoryIds = explode(',', $item->sub_category_ids);

                // Загрузка всех sub_category, которые относятся к текущему user_id
                $item->sub_categories = SubCategory::whereIn('id', $subCategoryIds)
                    ->with(['translation', 'category']) // Загружаем перевод категорий
                    ->get()
                    ->map(function ($subCategory) {
                    return [
                        'id' => $subCategory->id,
                        'name' => $subCategory->translation->name ?? null, // Перевод категории
                        'color' => $subCategory->category->color
                    ];
                });

                // Убираем поле sub_category_ids, так как оно не нужно в результате
                unset($item->sub_category_ids);

                return $item;
            });

    }


}
