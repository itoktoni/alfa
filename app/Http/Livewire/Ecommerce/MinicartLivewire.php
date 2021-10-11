<?php

namespace App\Http\Livewire\Ecommerce;

use Livewire\Component;
use Plugin\Helper;
use Darryldecode\Cart\Facades\CartFacade as Cart;

class MinicartLivewire extends Component
{
    protected $listeners = ['updateCart'];
    public function updateCart(){

    }

    public function render()
    {
        return View(Helper::setViewLivewire(__CLASS__));
    }

    public function actionDelete($product_id){

        if (Cart::getContent()->contains('id', $product_id)) {
            Cart::remove($product_id);
        }

        $this->emit('updateCart');
    }
}
