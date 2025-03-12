<?php
namespace App\Services;

use App\Models\Category;
use App\Models\CategoryTranslation;
use App\Models\SubCategoryTranslation;


class CategoryWithSubCategoryFilterService
{

    public static function filter(string $value)
    {
        $query_category = CategoryTranslation::where('name', 'like', "%{$value}%");
        $query_sub_category = SubCategoryTranslation::where('name', 'like', "%{$value}%");

        $search_lang = (clone $query_category)->value('lang');

        if($search_lang == null){
            $search_lang = (clone $query_sub_category)->value('lang');
        }

        $category_ids_from_cat = $query_category->pluck('category_id')->toArray();


        $category_ids_from_subcat = $query_sub_category
            ->with('sub_category') // Предварительно загружаем связь sub_category
            ->get()
            ->pluck('sub_category.category_id')->toArray();

        $cotegory_ids = array_unique(array_merge($category_ids_from_cat, $category_ids_from_subcat));


        $category = Category::whereIn('id', $cotegory_ids)
            ->with([
                'item_translations' => function ($query) use ($search_lang) {
                    $query->where('lang', $search_lang);
                }
            ])
            ->get();


        $result = $category->map(function ($category) {
            // Ищем перевод, в котором поле name удовлетворяет условию
            $matchedTranslation = $category->item_translations->first();

            return [
                'id' => $category->id,
                'name' => $matchedTranslation ? $matchedTranslation->name : null,
            ];
        });


        return $result;
    }


}
