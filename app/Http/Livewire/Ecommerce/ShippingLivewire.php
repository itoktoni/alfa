<?php

namespace App\Http\Livewire\Ecommerce;

use Darryldecode\Cart\Facades\CartFacade;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Plugin\Helper;
use Ixudra\Curl\Facades\Curl;

class ShippingLivewire extends Component
{
    public $courier;
    public $data_courier;
    public $branch;
    public $cart;
    public $data_shipping;

    public function mount($branch)
    {
        $this->branch = $branch;
    }

    public function render()
    {
        Cache::add('data_courier', DB::table('rajaongkir_courier')->where('rajaongkir_courier_active', 1)->get());
        $this->data_courier = Cache::get('data_courier');
        // if (isset($this->courier)) {
        //     session()->put('courier', $this->courier);
        // }
        // $this->courier = session()->has('courier') ? session('courier') : '';
        $this->cart = session('checkout')[$this->branch] ?? [];

        if($this->courier){
            $this->data_shipping = $this->getPrice(session('area'),$this->cart[0]->branch_area,$this->courier, $this->cart->sum('weight'));
        }

        $this->emit('updateCheckout');

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
}
