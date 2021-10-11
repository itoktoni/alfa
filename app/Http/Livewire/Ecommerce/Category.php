<?php

namespace App\Http\Livewire\Ecommerce;

use Livewire\Component;
use Plugin\Helper;

class Category extends Component
{
    public $category_id;
    public $category_name;
    public $flag = false;

    public function render()
    {
        return View(Helper::setViewFrontend('_partial_'.Helper::getClassLower(__CLASS__)));
    }

    public function mount($category_id , $category_name){

        $this->category_id = $category_id;
        $this->category_name = $category_name;

        if(session()->has('category') && array_key_exists($category_id, session()->get('category'))){
            $this->flag = true;
        }
    }

    public function actionCategory($id){
        
        $this->flag = false;
        
        if(session()->has('category')){
            session()->put('category', [$id => $id]);
            $this->flag = true;
        }
        else{

            session(['category' => [$id => $id]]);
            $this->flag = true;
        }

        $this->emit('EventFiltersCategory');
    }
}
