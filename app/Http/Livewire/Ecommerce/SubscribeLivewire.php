<?php

namespace App\Http\Livewire\Ecommerce;

use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Modules\Marketing\Dao\Models\Subscribe;
use Plugin\Helper;

class SubscribeLivewire extends Component
{
    public $phone;
    public $success = false;

    protected $rules = [
        'phone' => 'required|min:8',
    ];

    public function submit()
    {
        $data = $this->validate([
            'phone' => 'required'
        ]);

        Subscribe::create([
            'marketing_subscribe_phone' => $this->phone 
        ]);

        $this->success = true;

        $this->reset(['phone']);
    }

    public function render()
    {
        return View(Helper::setViewLivewire(__CLASS__));
    }
}
