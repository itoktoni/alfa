<?php

namespace App\Http\Livewire\Ecommerce;

use Darryldecode\Cart\CartCondition;
use Darryldecode\Cart\Facades\CartFacade as Cart;
use Darryldecode\Cart\Facades\CartFacade;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Modules\Marketing\Dao\Facades\PromoFacades;
use Modules\Rajaongkir\Dao\Models\Area;
use Modules\Rajaongkir\Dao\Models\City;
use Modules\Rajaongkir\Dao\Models\Province;
use Plugin\Helper;
use Ixudra\Curl\Facades\Curl;

class CartLivewire extends Component
{
    public $unic_id;
    public $qty;
    public $coupon;
    public $live_notes;
    public $live_product;

    public $data_province;
    public $data_city;
    public $data_area;
    public $data_courier;
    public $data_shipping;

    public $name;
    public $address;
    public $email;
    public $phone;
    public $province;
    public $city;
    public $area;
    public $notes;

    public $courier;
    public $weight;

    protected $listeners = ['updateCart'];
    public function updateCart()
    {
        Session::forget('checkout');
    }

    public function render()
    {
        if (isset($this->name)) {
            session()->put('name', $this->name);
        }
        if (isset($this->address)) {
            session()->put('address', $this->address);
        }
        if (isset($this->phone)) {
            session()->put('phone', $this->phone);
        }
        if (isset($this->email)) {
            session()->put('email', $this->email);
        }
        if (isset($this->notes)) {
            session()->put('notes', $this->notes);
        }
        if (isset($this->province)) {
            session()->put('province', $this->province);
        }
        if (isset($this->city)) {
            session()->put('city', $this->city);
        }
        if (isset($this->area)) {
            session()->put('area', $this->area);
        }
        if (isset($this->courier)) {
            session()->put('courier', $this->courier);
        }

        $this->name = session()->has('name') ? session('name') : '';
        $this->address = session()->has('address') ? session('address') : '';
        $this->phone = session()->has('phone') ? session('phone') : '';
        $this->email = session()->has('email') ? session('email') : '';
        $this->notes = session()->has('notes') ? session('notes') : '';
        $this->city = session()->has('city') ? session('city') : '';
        $this->area = session()->has('area') ? session('area') : '';

        $this->province = session()->has('province') ? session('province') : '';
        $this->city = session()->has('city') ? session('city') : '';
        $this->area = session()->has('area') ? session('area') : '';

        if (!Cache::has('data_province')) {
            Cache::put('data_province', Province::all());
        }

        $this->data_province = Cache::get('data_province');
        $this->data_city = City::where('rajaongkir_city_province_id', $this->province)->get();
        $this->data_area = Area::where('rajaongkir_area_city_id', $this->city)->get();

        if (!empty($this->live_notes && $this->live_product)) {
            if (Cart::getContent()->contains('id', $this->live_product)) {

                $item = Cart::get($this->live_product)->attributes->toArray();
                unset($item['notes']);
                $attribute = array_merge($item, ['notes' => $this->live_notes]);
                Cart::update($this->live_product, ['attributes' => $attribute]);
                $this->updateTotal();
                $this->emit('updateCart');
            }
        }

        if (Cart::getSubTotal() == '0.0') {
            $this->removeCoupon();
        }

        return view(Helper::setViewLivewire(__CLASS__))->with([

        ]);
    }

    public function updateQty($id, $sign, $qty = 1)
    {
        if (Cart::getContent()->contains('id', $id)) {
            if ($sign == 'set') {
                $cart = Cart::get($id);
                $formula = ['quantity' => $qty - $cart->quantity];
            } else {
                $formula = $sign ? array('quantity' => +$qty) : array('quantity' => -$qty);
            }

            Cart::update($id, $formula);
            $this->updateTotal();
            $this->emit('updateCart');
        }
    }

    public function setQty($id, $qty)
    {
        $this->updateQty($id, 'set', $qty);
    }

    public function actionDelete($product_id)
    {
        if (Cart::getContent()->contains('id', $product_id)) {
            Cart::remove($product_id);

            if (Cart::getTotalQuantity() == 0) {
                $this->removeCoupon();
            }
        }
        $this->emit('updateCart');
    }

    public function actionPlus($id)
    {
        $this->updateQty($id, 1);
    }

    public function actionMinus($id)
    {
        $qty = Cart::getContent()->get($id)->quantity;
        if ($qty >= 2) {
            $this->updateQty($id, 0);
        }
    }

    public function removeCoupon()
    {
        $promo = Cart::getConditions()->first();
        if ($promo) {
            Cart::removeCartCondition($promo->getName());
        }

        $this->emit('updateCart');
    }

    public function updateCoupon()
    {
        if (!empty($this->coupon)) {

            $rules = [
                'coupon' => 'required|exists:marketing_promo,marketing_promo_code',
            ];

            $this->validate($rules, ['exists' => 'Voucher Not Valid !']);
            $this->updateTotal();
        }
    }

    public function updateTotal()
    {
        $code = Cart::getConditions()->first() ? Cart::getConditions()->first()->gettype() : false;
        if (!empty($this->coupon)) {
            $code = $this->coupon;
        }
        $data = PromoFacades::codeRepository(strtoupper($code));
        if ($data) {
            $value = Cart::getSubTotal();
            $matrix = $data->marketing_promo_matrix;
            if ($matrix) {

                $string = str_replace('@value', $value, $matrix);
                $total = $value;

                try {
                    $total = Helper::calculate($string);
                } catch (\Throwable $th) {
                    $total = $value;
                }

                $promo = Cart::getConditions()->first();
                if ($promo) {
                    Cart::removeCartCondition($promo->getName());
                }
                $condition = new CartCondition(array(
                    'name' => $data->marketing_promo_name,
                    'type' => $data->marketing_promo_code,
                    'target' => 'total', // this condition will be applied to cart's subtotal when getSubTotal() is called.
                    'value' => -$total,
                    'order' => 1,
                    'attributes' => array( // attributes field is optional
                        'name' => $data->marketing_promo_name,
                        'code' => $data->marketing_promo_code,
                        'discount' => $total,
                        'matrix' => $data->marketing_promo_matrix,
                    ),
                ));

                Cart::condition($condition);
            }
        }

        $this->emit('updateCart');
    }

}
