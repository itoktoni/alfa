<?php

namespace App\Http\Livewire\Ecommerce;

use Livewire\Component;
use Modules\Item\Dao\Facades\WishlistFacades;
use Plugin\Helper;

class Wishlist extends Component
{
    public $flag = false;
    public $product_id;

    public function mount($product_id)
    {
        $check = WishlistFacades::isLoveProduct($product_id);
        if($check){
            $this->flag = true;
        }
        $this->product_id = $product_id;
    }

    public function render()
    {
        return View(Helper::setViewFrontend('_partial_'.Helper::getClassLower(__CLASS__)));
    }

    public function action($product_id)
    {
        $check = WishlistFacades::isLoveProduct($product_id);
        if($check){
            $check->delete();
            $this->flag = false;
        }
        else{
            WishlistFacades::insert([
                'item_wishlist_item_product_id' => $product_id,
                'item_wishlist_user_id' => auth()->user()->id
            ]);
            $this->flag = true;
        }

    }

}