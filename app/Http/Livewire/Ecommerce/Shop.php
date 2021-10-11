<?php

namespace App\Http\Livewire\Ecommerce;

use Livewire\Component;
use Modules\Item\Dao\Facades\ProductFacades;
use Modules\Item\Dao\Facades\WishlistFacades;
use Modules\Item\Dao\Repositories\CategoryRepository;
use Modules\Item\Dao\Repositories\SubCategoryRepository;
use Modules\Item\Dao\Repositories\TagRepository;
use Plugin\Helper;

class Shop extends Component
{
    public $data_product = [];
    public $data_tag = [];
    public $data_sub_category = [];
    public $data_category = [];
    public $data_wishlist = [];
    public $session_category = [];
    public $session_sub_category = [];
    public $session_tag = [];

    public function updateProduct()
    {
        $query = ProductFacades::dataRepository();
        if (session()->has('tag') && session()->get('tag')) {
            foreach (session()->get('tag') as $tag) {
                $query->orWhereRaw('json_contains(item_product_item_tag_json, \'["' . $tag . '"]\')');
            }
        }

        if (session()->has('category')) {
            $query->where('item_product_item_category_id', array_keys(session()->get('category')));
        }

        if (session()->has('sub_category')) {
            $query->where('item_product_item_sub_category_id', array_keys(session()->get('sub_category')));
        }

        $this->data_product = $query->get();
    }

    public function render()
    {
        $this->data_tag = Helper::shareTag((new TagRepository()), 'item_tag_slug');
        $this->data_category = Helper::createOption(new CategoryRepository(), false, true);
        $this->data_sub_category = Helper::createOption(new SubCategoryRepository(), false, true);

        if(auth()->check()){

            $this->data_wishlist = WishlistFacades::getUserRepository();
        }

        if (session()->has('category')) {
            $this->session_category = session()->get('category');
        }
        if (session()->has('sub_category')) {
            $this->session_sub_category = session()->get('sub_category');
        }
        if (session()->has('tag')) {
            $this->session_tag = session()->get('tag');
        }

        $this->updateProduct();

        return View(Helper::setViewFrontend('_partial_' . Helper::getClassLower(__CLASS__)));
    }

    public function actionCategory($id)
    {
        session(['category' => [$id => $id]]);
        $this->updateProduct();
    }

    public function actionSubCategory($id)
    {
        session(['sub_category' => [$id => $id]]);
        $this->updateProduct();
    }

    public function actionClean(){
        session()->forget('category');
        session()->forget('tag');
        $this->session_category = [];
        $this->session_tag = [];
        $this->updateProduct();
    }

    public function actionWishlist($id)
    {
        $check = WishlistFacades::isLoveProduct($id);
        if ($check) {
            $check->delete();
        } else {
            WishlistFacades::insert([
                'item_wishlist_item_product_id' => $id,
                'item_wishlist_user_id' => auth()->user()->id,
            ]);
        }

        $this->updateProduct();
    }

    public function actionTag($key, $value)
    {
        if (session()->has('tag')) {

            $data = session()->get('tag');
            $collection = collect($data);

            if ($collection->contains($key)) {
                $data = $collection->except($key);
            } else {

                if ($data) {

                    $data = $collection->merge([$key => $key]);
                } else {

                    $data = collect([$key => $key]);
                }
            }

            session(['tag' => $data->toArray()]);
        } else {
            session(['tag' => [$key => $key]]);
        }

        $this->updateProduct();
    }
}
