<?php

namespace App\Http\Livewire\Ecommerce;

use App\Dao\Facades\BranchFacades;
use Darryldecode\Cart\Facades\CartFacade;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Ixudra\Curl\Facades\Curl;
use Livewire\Component;
use Modules\Finance\Dao\Models\Bank;
use Modules\Sales\Dao\Facades\OrderDetailFacades;
use Modules\Sales\Dao\Facades\OrderFacades;
use Modules\Sales\Dao\Facades\OrderGroupFacades;
use Plugin\Helper;

class CheckoutLivewire extends Component
{
    public $notes;
    public $area;
    public $email;
    public $name;
    public $address;
    public $phone;
    public $order_id;
    public $order_total;
    public $order_ongkir;

    public $price = [];
    public $checkout = [];

    public $total;
    public $ongkir;

    public $completed;

    public $data_courier;
    public $data_bank;

    protected $listeners = [
        'updateCart',
        'setOngkir',
    ];

    public function updateCart()
    {

    }

    public function setOngkir($data)
    {
        $id = $data['branch'] . '_area_' . session('area') . '_weight_' . $data['weight'];
        $this->price[$id] = $data;
        session()->put('price_' . $id, $data);
    }

    public function render()
    {
        if (isset($this->notes)) {
            session()->put('notes', $this->notes);
        }

        $this->notes = session()->has('notes') ? session('notes') : null;
        $this->area = session()->has('area') ? session('area') : null;
        $this->name = session()->has('name') ? session('name') : null;
        $this->address = session()->has('address') ? session('address') : null;
        $this->phone = session()->has('phone') ? session('phone') : null;
        $this->email = session()->has('email') ? session('email') : null;

        Cache::add('data_courier', DB::table('rajaongkir_courier')->where('rajaongkir_courier_active', 1)->get());
        $this->data_courier = Cache::get('data_courier');

        $this->data_bank = Bank::all();

        $grouped = CartFacade::getContent()->mapToGroups(function ($item) {
            $attributes = $item->attributes;
            $weight = $item->quantity * $attributes->product_weight;
            $data = [
                'id' => $item->id,
                'qty' => $item->quantity,
                'price' => $item->price,
                'weight' => $weight > 700 ? $weight : 700,
                'total' => $item->getPriceSum(),
            ];

            $merge = array_merge($data, $attributes->toArray());

            return [
                $attributes['branch_id'] => $merge,
            ];
        })->map(function ($map) {

            $total_weight = $map->sum('weight');
            $total_value = $map->sum('total');

            foreach ($map as $branch) {
                $data['branch_id'] = $branch['branch_id'];
                $data['branch_name'] = $branch['branch_name'];
                $data['branch_province'] = $branch['branch_province'];
                $data['branch_city'] = $branch['branch_city'];
                $data['branch_area'] = $branch['branch_area'];
                $data['branch_weight'] = $total_weight;
                $data['branch_item'][$branch['id']] = (Object) $branch;

                $key_ongkir = 'price_' . $data['branch_id'] . '_area_' . session('area') . '_weight_' . $total_weight;
                $grand_total = $total_value;

                if (Session::has($key_ongkir)) {

                    $value_ongkir = Session::get($key_ongkir);
                    $price_ongkir = $value_ongkir['price'];

                    $data['branch_courier'] = $value_ongkir;
                    $data['branch_ongkir'] = $price_ongkir;
                    $grand_total = $total_value + $price_ongkir;
                }

                $data['branch_subtotal'] = $total_value;
                $data['branch_total'] = $grand_total;
            }

            return (Object) $data;
        });

        $this->ongkir = $grouped->sum('branch_ongkir');

        // CartFacade::removeCartCondition('Ongkir');

        // $condition = new CartCondition(array(
        //     'name' => 'Ongkir',
        //     'type' => 'ongkir',
        //     'target' => 'total', // this condition will be applied to cart's subtotal when getSubTotal() is called.
        //     'value' => $this->ongkir,
        //     'order' => 1,
        // ));

        $this->total = CartFacade::getTotal() + $this->ongkir;
        Session::put('checkout', $grouped->sortKeys());
        $this->checkout = Session::get('checkout');
        // dd($this->checkout);

        return View(Helper::setViewLivewire(__CLASS__));
    }

    public function getPrice($from, $to, $courier, $weight)
    {
        $response = Curl::to("http://pro.rajaongkir.com/api/cost")->withData([
            'origin' => $from,
            'originType' => 'subdistrict',
            'destination' => $to,
            'destinationType' => 'subdistrict',
            'weight' => $weight,
            'courier' => $courier,
        ])->withHeaders([
            'key' => env('RAJAONGKIR_APIKEY'),
        ])->post();

        $parse = json_decode($response, true);
        $items = false;
        if (isset($parse)) {
            $data = $parse['rajaongkir'];
            if ($data['status']['code'] == '200') {
                $items = array();
                foreach ($data['results'][0]['costs'] as $value) {
                    $items[] = [
                        'courier_code' => $courier,
                        'courier_name' => $data['results'][0]['name'],
                        'courier_service' => $value['service'],
                        'courier_desc' => $value['description'],
                        'courier_etd' => $value['cost'][0]['etd'],
                        'courier_price' => $value['cost'][0]['value'],
                        'courier_mask' => Helper::createRupiah($value['cost'][0]['value']),
                    ];
                }
            }
        }

        return $items;
    }

    public function createOrder()
    {
        $rules = [

            'ongkir' => 'required|numeric|min:1',
            'total' => 'required|numeric|min:1',
            'name' => 'required',
            'address' => 'required',
            'area' => 'required',
            'phone' => 'required',
            'checkout.*.branch_ongkir' => 'required',
        ];

        $this->validate($rules, [
            'checkout.*.branch_ongkir.required' => 'Please Select Courier in Red line',
            'phone.required' => 'Please input phone number in Cart',
            'name.required' => 'Please input name in Cart',
            'address.required' => 'Please input address in Cart',
            'area.required' => 'Please input Shipping area in Cart',
            'ongkir.min' => 'Please Input Shipping area',
        ], [
            'checkout.*.branch_ongkir' => 'Please Select Courier',
        ]);


        $this->completed = true;

        DB::beginTransaction();
        $autonumber_group = Helper::autoNumber(OrderGroupFacades::getTable(), OrderGroupFacades::getKeyName(), 'GO' . date('Ym'), config('website.autonumber'));

        $group['sales_group_id'] = $autonumber_group;
        $group['sales_group_status'] = 1;
        $group['sales_group_order_date'] = date('Y-d-d H:i:s');
        $group['sales_group_from_name'] = $this->name;
        $group['sales_group_from_phone'] = $this->phone;
        $group['sales_group_from_email'] = $this->email;
        $group['sales_group_from_address'] = $this->address;
        $group['sales_group_from_area'] = $this->area;
        $group['sales_group_notes_user'] = $this->notes;

        $sub_total = CartFacade::getSubTotal();
        $grand_total = CartFacade::getTotal();
        $discount_value = 0;
        $discount_name = $discount_code = '';

        if ($disc = CartFacade::getConditions()->first()) {
            $discount_value = $disc->getValue();
            $discount_code = $disc->getAttributes()['code'] ?? '';
            $discount_name = $disc->getAttributes()['name'] ?? '';
        }

        $group['sales_group_discount_name'] = $discount_name;
        $group['sales_group_discount_value'] = abs($discount_value);

        $group['sales_group_sum_product'] = $sub_total;
        $group['sales_group_sum_discount'] = abs($discount_value);
        $group['sales_group_sum_ongkir'] = $this->ongkir;
        $group['sales_group_sum_total'] = $grand_total + $this->ongkir;

        if (auth()->check()) {

            $group['sales_group_core_user_id'] = auth()->user()->id;
        }

        $check_group = OrderGroupFacades::saveRepository($group);
        if (isset($check_group['status']) && $check_group['status']) {

            foreach (session('checkout') as $sales) {

                $autonumber_order = Helper::autoNumber(OrderFacades::getTable(), OrderFacades::getKeyName(), 'SO' . date('Ym'), config('website.autonumber'));

                $order['sales_order_id'] = $autonumber_order;
                $order['sales_order_group_id'] = $autonumber_order;
                $order['sales_order_status'] = 1;
                $order['sales_order_order_date'] = date('Y-d-d H:i:s');

                $branch = BranchFacades::find($sales->branch_id);
                $order['sales_order_from_id'] = $branch->branch_id;
                $order['sales_order_from_name'] = $branch->branch_name;
                $order['sales_order_from_phone'] = $branch->branch_phone;
                $order['sales_order_from_email'] = $branch->branch_email;
                $order['sales_order_from_address'] = $branch->branch_address;
                $order['sales_order_from_area'] = $branch->branch_rajaongkir_area_id;

                $order['sales_order_to_name'] = $this->name;
                $order['sales_order_to_phone'] = $this->phone;
                $order['sales_order_to_email'] = $this->email;
                $order['sales_order_to_address'] = $this->address;
                $order['sales_order_to_area'] = $this->area;

                $order['sales_order_courier_code'] = $sales->branch_courier['code'] ?? '';
                $order['sales_order_courier_service'] = $sales->branch_courier['service'] ?? '';

                $order['sales_order_sum_weight'] = $sales->branch_weight;
                $order['sales_order_sum_ongkir'] = $sales->branch_courier['price'] ?? '';
                $order['sales_order_sum_product'] = $sales->branch_subtotal;
                $order['sales_order_sum_total'] = $sales->branch_total;

                $check_order = OrderFacades::saveRepository($order);

                if (isset($check_order['status']) && $check_order['status']) {

                    foreach ($sales->branch_item as $item) {

                        $product['sales_order_detail_group_id'] = $autonumber_group;
                        $product['sales_order_detail_order_id'] = $autonumber_order;

                        $product['sales_order_detail_notes'] = $item->notes;

                        $name = $item->product_name;

                        if (!empty($item->color_id)) {
                            $name = $name . ' ' . $item->color_name;
                        }
                        if (!empty($item->size_id)) {
                            $name = $name . ' ' . $item->size_name;
                        }
                        if (!empty($item->variant_id)) {
                            $name = $name . ' ' . $item->variant_name;
                        }

                        $product['sales_order_detail_item_product_id'] = $item->product_id;
                        $product['sales_order_detail_item_product_description'] = $name;
                        $product['sales_order_detail_item_product_weight'] = $item->product_weight;

                        $product['sales_order_detail_qty'] = $item->qty;
                        $product['sales_order_detail_price'] = $item->price;
                        $product['sales_order_detail_total'] = $item->total;

                        $product['sales_order_detail_color_id'] = $item->color_id;
                        $product['sales_order_detail_color_name'] = $item->color_name;

                        $product['sales_order_detail_size_id'] = $item->size_id;
                        $product['sales_order_detail_size_name'] = $item->size_name;

                        $product['sales_order_detail_variant_id'] = $item->variant_id;
                        $product['sales_order_detail_variant_name'] = $item->variant_name;

                        $check_item = OrderDetailFacades::saveRepository($product);
                        if (isset($check_item['status']) && $check_item['status']) {
    
                            DB::commit();
                            
                        } else {
                            DB::rollBack();
                            $this->completed = false;
                        }
                    }
                } else {
                    DB::rollBack();
                    $this->completed = false;
                }
            }

            
        } else {
            DB::rollBack();
            $this->completed = false;
        }

        if($this->completed){
            
            Session::forget('checkout');
            CartFacade::clear();
            CartFacade::clearCartConditions();

            $this->order_id = $autonumber_group;
            $this->order_total = $check_group['data']->sales_group_sum_total;
            $this->order_ongkir = $check_group['data']->sales_group_sum_ongkir;
        }
    }

}
