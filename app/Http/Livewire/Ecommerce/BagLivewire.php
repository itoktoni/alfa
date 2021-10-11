<?php

namespace App\Http\Livewire\Ecommerce;

use Darryldecode\Cart\Facades\CartFacade as Cart;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Plugin\Helper;

class BagLivewire extends Component
{
    protected $listeners = ['updateCart'];
    public function updateCart()
    {

    }

    public function render()
    {
        return View(Helper::setViewLivewire(__CLASS__));
    }

    public function actionDelete($product_id){

        if (Cart::getContent()->contains('id', $product_id)) {
            Cart::remove($product_id);

            if (Cart::getTotalQuantity() == 0) {

                $promo = Cart::getConditions()->first();
                if ($promo) {
                    Cart::removeCartCondition($promo->getName());
                }
            }
        }

        $this->emit('updateCart');
    }
}
