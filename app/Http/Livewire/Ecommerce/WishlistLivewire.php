<?php

namespace App\Http\Livewire\Ecommerce;

use Livewire\Component;
use Modules\Item\Dao\Facades\WishlistFacades;
use Plugin\Helper;

class WishlistLivewire extends Component
{
    public $love = false;
    public $product_id;

    public function mount($product_id)
    {

        $check = $this->checkWishlist($product_id);
        if ($check) {
            $this->love = true;
        }
        $this->product_id = $product_id;
    }

    public function render()
    {
        return View(Helper::setViewLivewire(__CLASS__));
    }

    public function checkWishlist($product_id)
    {
        $check = WishlistFacades::isLoveProduct($product_id);

        if ($check) {
            $this->love = true;
            return $check;
        }

        $this->love = false;
        return false;
    }

    public function doAction($product_id)
    {
        $check = $this->checkWishlist($product_id);
        if ($check) {
            $check->delete();
            $this->love = false;
        } else {
            WishlistFacades::insert([
                'item_wishlist_item_product_id' => $product_id,
                'item_wishlist_user_id' => auth()->user()->id,
            ]);
            $this->love = true;
        }
    }

    public function actionWishlist($product_id)
    {
        $this->doAction($product_id);
    }
}
