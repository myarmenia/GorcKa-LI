<?php
namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;


trait FilterTrait {

    public function scopeFilter($builder, $filters = [])
    {
        // dd($filters);

        $lang = app()->getLocale() ?? "am";

        if(!$filters) {
                return $builder;
        }

        $tableName = $this->getTable();
        $defaultFields = $this->defaultFields;
        $relationFilter = $this->relationFilter;
        $filterDateRangeFields = $this->filterDateRangeFields;
        $boolFilterFields = $this->boolFilterFields;
        $likeFilterFields = $this->likeFilterFields;
        $anyLikeFilterFields = $this->anyLikeFilterFields;
        $translationFilterFields = $this->translationFilterFields;

// dd($filters);
        foreach ($filters as $field => $value) {

            if(isset($boolFilterFields) && in_array($field, $boolFilterFields) && $value != null) {
                $builder->where($field, (bool)$value);
                continue;
            }

            if(isset($likeFilterFields) && in_array($field, $likeFilterFields)) {
                $builder->where($tableName. '.' . $field, 'LIKE', "%$value%");
            }

            if (isset($anyLikeFilterFields) && in_array($field, $anyLikeFilterFields)) {
                $builder->where(function ($query) use ($tableName, $filters, $anyLikeFilterFields) {
                    foreach ($anyLikeFilterFields as $field) {
                        if (isset($filters[$field]) && $filters[$field] !== null) {
                            $query->orWhere($tableName . '.' . $field, 'LIKE', '%' . $filters[$field] . '%');
                        }
                    }
                });
            }

            if ($field == "from_created_at" && $value != null) {

                $builder->whereDate('created_at', '>=', $value);

            }
            if ($field == "to_created_at" && $value != null) {

                $builder->whereDate('created_at', '<=', $value);

            }

            if ($translationFilterFields  && in_array($field, $translationFilterFields)) {

                $name = "item_translations";
                $search_name = "name";
                $action = "LIKE";
                $data = '%' . $value . '%';

                $builder->whereHas($name, function ($query) use ($action, $data, $search_name, $lang) {
                    $query->where($search_name, $action, $data);
                    $query->where('lang', $lang);

                });

            }

            if (isset ($filterDateRangeFields)) {

                if ($field == "start_date") {
                    $builder->where('end_date', '>=', $value);

                }
                if ($field == "end_date") {
                    $builder->where('start_date', '<=', $value);

                }
            }


            // dump($field, $relationFilter);
            if (!empty($relationFilter)) {
                // dd("relationFilter");

                $relationModel  = $this->getKeyFromValue($field, $relationFilter);

                if ($relationModel !== false) {

                    $builder->whereHas($relationModel, fn($query) => $query->filter($filters));
                }

            }

            if (isset($defaultFields) && in_array($field, $defaultFields)) {
// dd("defaultFields");
                if (is_array($value)) {
                    $builder->whereIn($field, $value);
                } else {

                    $builder->where("$tableName.$field", $value);    // $tableName.$field  nra hamar e, vor join-nerov sharunakutyan depqum xndir e talsi qani-vor location_id ka mi qni tablum ev petq e nshel, vor tabli masin e xosqy
                }
            }


        }

        return $builder;

    }

    public function getKeyFromValue($needle, $haystack)
    {
        // $collection = new Collection($haystack);

        // return $collection->search(function ($values) use ($needle) {
        //     return in_array($needle, $values);
        // });

        return collect($haystack)->search(fn($values) => in_array($needle, $values));
    }


}
