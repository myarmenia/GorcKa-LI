<?php
namespace App\Services\Specialist;

use App\Interfaces\Specialist\SpecialistInterface;
use App\Models\ExecutorInfo;
use App\Models\SubCategory;




class SpecialistService
{
    public function __construct(protected SpecialistInterface $specialistRepository)
    {
    }

    public function getAll()
    {

        // $specialist = $this->specialistRepository->getAll()->activeUser->groupBy('user_id');
        // $specialist = ExecutorInfo::with('activeUser')->whereHas('activeUser')
        //     ->selectRaw('user_id, GROUP_CONCAT(sub_category_id) as sub_category_ids')
        //     ->groupBy('user_id')
        //     ->get()
        //     ->map(function ($item) {
        //         $item->sub_category_ids = explode(',', $item->sub_category_ids);
        //         return $item;
        //     });
// // dd(ExecutorInfo::with('sub_category')->get());
//         $specialist = ExecutorInfo::with(['activeUser.location.translation', 'sub_category.translation'])
//             ->select('user_id')
//             ->groupBy('user_id')
//             ->get()
//             ->map(function ($item) {
//                 // Загрузка и подготовка данных для sub_category
//                 $item->sub_categories = $item->sub_category
//                     ? [
//                         'id' => $item->sub_category->id,
//                         'name' => $item->sub_category->translation->name ?? null, // Перевод категории
//                     ]
//                     : null;

//                 unset($item->sub_category); // Удаляем оригинальную связь, если она была

//                 return $item;
//             });


        $specialist = ExecutorInfo::selectRaw('user_id, GROUP_CONCAT(sub_category_id) as sub_category_ids')
            // ->with(['activeUser.location.translation', 'sub_category.translation']) // Подключаем связи
            ->groupBy('user_id')
            ->get()
            ->filter(function ($item) {
                // Проверяем, что у элемента есть activeUser
                return $item->activeUser !== null;
            })
            ->map(function ($item) {
                // Извлекаем данные для activeUser.location.translation и добавляем их в результат
                $item->location_translation = $item->activeUser->location->translation->name ?? null;

                // Извлекаем имя пользователя и добавляем его в результат
                $item->user_name = $item->activeUser->name ?? null; // Предположим, что имя пользователя в поле name

                // Получаем список sub_category_id из строки, разделенной запятыми
                $subCategoryIds = explode(',', $item->sub_category_ids);

                // Загрузка всех sub_category, которые относятся к текущему user_id
                $item->sub_categories = SubCategory::whereIn('id', $subCategoryIds)
                    ->with('translation') // Загружаем перевод категорий
                    ->get()
                    ->map(function ($subCategory) {
                    return [
                        'id' => $subCategory->id,
                        'name' => $subCategory->translation->name ?? null, // Перевод категории
                    ];
                });

                // Убираем поле sub_category_ids, так как оно не нужно в результате
                unset($item->sub_category_ids);

                return $item;
            });



        dd($specialist);

        return $specialist;
    }


}
