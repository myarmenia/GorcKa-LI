<?php
namespace App\Services\Contact;

use App\Interfaces\Contact\ContactInterface;
use Illuminate\Support\Arr;


 class ContactService {



    public function __construct( protected ContactInterface $contactRepository){

    }
    public function list($data){

        if(!empty($data['category_id'])){
          $data['sub_category_id'] = !empty($data['sub_category_id']) ? $data['sub_category_id'] : null;

        }

        if (!empty($data['category_id'])) {
            $data['sub_category_id'] = SubCategory::where('category_id', $data['category_id'])
                ->pluck('id')
                ->toArray();

        }
         $data['title'] = $data['name'] ?? null;
         $data['description'] = $data['name'] ?? null;
        //  dd($data);
        $query = $this->model->where('user_id', auth()->id())
                 ->with('files', 'location.translation','sub_category','sub_category.category')
                 ->filter($data)->orderBy('id', 'desc');
                //  dd($query->get());

        return  $query;


    }
    public function store($dto){


        $contact = $this->contactRepository->store($dto);
        return true;

    }



 }
