<?php

namespace App\Http\Livewire\Ecommerce;

use Darryldecode\Cart\Facades\CartFacade as Cart;
use Livewire\Component;
use Modules\Item\Dao\Facades\ProductFacades;
use Modules\Item\Dao\Facades\WishlistFacades;
use Modules\Item\Dao\Models\ProductDetail;
use Plugin\Helper;

class ProductLivewire extends Component
{
    public $data;
    public $love = false;
    public $live_notes;
    public $live_product;

    public $unic_id;
    public $color_id;
    public $size_id;
    public $variant_id;
    public $product_id;
    public $branch_id;

    public $color_temp;
    public $size_temp;
    public $variant_temp;
    public $product_temp;
    public $branch_temp;

    public $color_name;
    public $size_name;
    public $variant_name;
    public $product_name;
    public $branch_name;

    public $branch_address;
    public $branch_location;
    public $branch_province;
    public $branch_city;
    public $branch_area;

    public $product_slug;
    public $product_image;
    public $product_weight;

    public $price;
    public $mask_price;
    public $qty = 1;

    public $data_variant;
    public $data_color;
    public $data_size;
    public $data_branch;

    public $notes;
    public $option = 'Please Select Option';

    public function mount($slug)
    {
        $this->data = ProductFacades::slugRepository($slug);
        $this->product_id = $this->data->item_product_id;
        $this->product_name = $this->data->item_product_name;

        $this->checkWishlist($this->product_id);

        $matrix = ProductFacades::getProductVariant($this->product_id);

        $data_var = $matrix->whereNotNull('item_detail_variant_name');
        if ($data_var->isNotEmpty()) {
            $this->data_variant = $data_var;
        }

        $data_col = $matrix->whereNotNull('item_detail_color_name');
        if ($data_col->isNotEmpty()) {
            $this->data_color = $data_col;
        }

        $data_siz = $matrix->whereNotNull('item_detail_size_name');
        if ($data_siz->isNotEmpty()) {
            $this->data_size = $data_siz;
        }

        $data_brc = $matrix->whereNotNull('item_detail_branch_name');
        if ($data_brc->isNotEmpty()) {
            $this->data_branch = $data_brc;
        }

    }

    public function render()
    {
        $this->updatePrice();
        return View(Helper::setViewLivewire(__CLASS__));
    }

    public function updatePrice()
    {
        $detail = $this->data->detail;
        if ($detail->count() == 0) {
            
            $this->price = $this->data->item_product_price ?? 0;
            $this->mask_price = $this->data->item_product_price ? Helper::createRupiah($this->data->item_product_price) : $this->option;
            $this->unic_id = $this->data->item_product_id ?? null;

        } else {
            
            $query = ProductDetail::where('item_detail_product_id', $this->product_id);
            $query->where('item_detail_branch_id', $this->branch_id);
            $query->where('item_detail_color_id', $this->color_id);
            $query->where('item_detail_size_id', $this->size_id);
            $query->where('item_detail_variant_id', $this->variant_id);

            $item = $query->first();

            $this->price = $item->item_detail_price ?? 0;
            $this->mask_price = isset($item->item_detail_price) ? Helper::createRupiah($item->item_detail_price) : $this->option;
            $this->unic_id = $item->item_detail_id ?? null;

            $this->color_name = $item->item_detail_color_name ?? null;
            $this->size_name = $item->item_detail_size_name ?? null;
            $this->variant_name = $item->item_detail_variant_name ?? null;
            $this->branch_name = $item->item_detail_branch_name ?? null;

            $this->branch_address = $item->item_detail_branch_address ?? null;
            $this->branch_location = $item->item_detail_branch_location ?? null;
            $this->branch_province = $item->item_detail_branch_province_id ?? null;
            $this->branch_city = $item->item_detail_branch_city_id ?? null;
            $this->branch_area = $item->item_detail_branch_area_id ?? null;
        }

        $this->product_name = $this->data->item_product_name ?? null;
        $this->product_image = $this->data->item_product_image ?? null;
        $this->product_slug = $this->data->item_product_slug ?? null;
        $this->product_weight = $this->data->item_product_weight ?? null;

        if ($this->qty <= 1) {
            $this->qty = 1;
        }
    }

    public function checkWishlist($product_id)
    {
        $check = false;
        if (auth()->check()) {

            $check = WishlistFacades::isLoveProduct($product_id);
        }

        if ($check) {
            $this->love = true;
            return $check;
        }

        $this->love = false;
        return false;
    }

    public function actionWishlist($product_id)
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
        $this->data = ProductFacades::showRepository($product_id);
    }

    public function updateQty($id, $sign, $qty = 1)
    {
        if (Cart::getContent()->contains('id', $id)) {
            $formula = $sign ? array('quantity' => +$qty) : array('quantity' => -$qty);
            Cart::update($id, $formula);
            $this->emit('updateCart');
        }
    }

    public function actionPlus()
    {
        $this->qty++;
        $this->updateQty($this->unic_id, 1);
    }

    public function actionMinus()
    {
        if ($this->qty <= 1) {
            $this->qty = 1;
        } else {
            $this->qty--;
        }

        $this->updateQty($this->unic_id, 0);
    }

    public function actionCart()
    {
        $rules = [
            'qty' => 'required|integer|min:1',
            'product_id' => 'required',
            'price' => 'required|integer|min:1',
        ];

        if ($this->data_variant) {
            $rules = array_merge($rules, [
                'variant_id' => 'required|not_in:none',
            ]);
        }
        if ($this->data_color) {
            $rules = array_merge($rules, [
                'color_id' => 'required|not_in:none',
            ]);
        }
        if ($this->data_size) {
            $rules = array_merge($rules, [
                'size_id' => 'required|not_in:none',
            ]);
        }
        if ($this->data_branch) {
            $rules = array_merge($rules, [
                'branch_id' => 'required|not_in:none',
            ]);
        }

        $message = [
            'min' => $this->option,
            'required' => 'The :attribute field is required.',
        ];

        $this->validate($rules, $message);
        $attributes = [
            'color_id' => $this->color_id,
            'size_id' => $this->size_id,
            'variant_id' => $this->variant_id,
            'color_name' => $this->color_name,
            'size_name' => $this->size_name,
            'variant_name' => $this->variant_name,
            'branch_id' => $this->branch_id,
            'branch_name' => $this->branch_name,
            'branch_address' => $this->branch_address,
            'branch_province' => $this->branch_province,
            'branch_city' => $this->branch_city,
            'branch_area' => $this->branch_area,
            'product_id' => $this->product_id,
            'product_name' => $this->product_name,
            'product_image' => $this->product_image,
            'product_slug' => $this->product_slug,
            'product_weight' => $this->product_weight,
            'notes' => $this->notes,
        ];

        if (Cart::getContent()->contains('id', $this->unic_id)) {
            Cart::update($this->unic_id, array(
                'quantity' => +$this->qty, // so if the current product has a quantity of 4, another 2 will be added so this will result to 6
            ));
        } else {
            Cart::add($this->unic_id, $this->product_name, $this->price, $this->qty, $attributes);
        }

        $this->emit('updateCart');
    }
}
