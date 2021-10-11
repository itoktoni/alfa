<?php

namespace App\Http\Livewire\Ecommerce;

use Livewire\Component;
use Modules\Item\Dao\Repositories\TagRepository;
use Plugin\Helper;

class Tag extends Component
{
    public $key;
    public $value;
    public $flag = false;

    public function render()
    {
        return View(Helper::setViewFrontend('_partial_'.Helper::getClassLower(__CLASS__)));
    }

    public function mount($key, $value){

        if(session()->has('tag') && session()->get('tag') && array_key_exists($key, session()->get('tag'))){
            $this->flag = true;
        }
    }

    public function actionTag($key, $value){

        // session()->flush();
        if(session()->has('tag')){
            
            $data = session()->get('tag');
            $collection = collect($data);

            if($collection->contains($key)){
                $data = $collection->except($key);
                $this->flag = false;
            }
            else{

                if($data){

                    $data = $collection->merge([$key => $key]);
                }
                else{

                    $data = collect([$key => $key]);
                }

                $this->flag = true;
            }

            session(['tag' => $data->toArray()]);
        }
        else{
            session(['tag' => [$key => $key]]);
            $this->flag = true;
        }

        $this->emit('EventFiltersTag');

    }      

}