<?php
namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;


trait FilterTrait {

    public function scopeFilter($builder, $filters = [])
    {

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
        $translationFilterFields = $this->translationFilterFields;


        foreach ($filters as $field => $value) {

            if(isset($boolFilterFields) && in_array($field, $boolFilterFields) && $value != null) {
                $builder->where($field, (bool)$value);
                continue;
            }

            if(isset($likeFilterFields) && in_array($field, $likeFilterFields)) {
                $builder->where($tableName. '.' . $field, 'LIKE', "%$value%");
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

            if(request()->type == 'subscription' || request()->type == 'standart'){
                $relationModel = request()->type == 'subscription' ? 'subscription_tickets' : 'standart_tickets';
                $builder->whereHas($relationModel, function ($query) use ($filters) {
                    $query->where('status', 1);
                });
            }

            if (isset ($relationFilter) && $this->getKeyFromValue($field, $relationFilter)) {
                $relationModel  = $this->getKeyFromValue($field, $relationFilter);

                    $builder->whereHas($relationModel, function ($query) use ($filters) {
                        $query->filter($filters);
                    });

            }

            if (isset($defaultFields) && in_array($field, $defaultFields)) {

                if (is_array($value)) {
                    $builder->whereIn($field, $value);
                } else {

                    $builder->where($field, $value);
                }
            }


        }

        return $builder;

    }

    public function getKeyFromValue($needle, $haystack)
    {
        $collection = new Collection($haystack);

        return $collection->search(function ($values) use ($needle) {
            return in_array($needle, $values);
        });
    }


}
