<?php

namespace App\Http\Livewire\Ecommerce;

use App\Dao\Facades\BranchFacades;
use Artesaos\SEOTools\Facades\SEOTools;
use Livewire\Component;
use Livewire\WithPagination;
use Modules\Item\Dao\Facades\CategoryFacades;
use Modules\Item\Dao\Facades\ProductFacades;
use Modules\Item\Dao\Facades\WishlistFacades;
use Modules\Item\Dao\Models\ProductDetail;
use Modules\Item\Dao\Repositories\BrandRepository;
use Modules\Item\Dao\Repositories\CategoryRepository;
use Modules\Item\Dao\Repositories\ColorRepository;
use Modules\Item\Dao\Repositories\SizeRepository;
use Modules\Item\Dao\Repositories\TagRepository;
use Modules\Item\Dao\Repositories\VariantRepository;
use Modules\Rajaongkir\Dao\Repositories\ProvinceRepository;
use Plugin\Helper;

class ShopLivewire extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    // public $data_product = [];

    public $search;
    public $sort;
    public $murah;
    protected $queryString = ['murah' => ['except' => '']];

    public $data_tag = [];
    public $data_color = [];
    public $data_size = [];
    public $data_variant = [];
    public $data_category = [];
    public $data_brand = [];
    public $data_province = [];
    public $data_wishlist = [];

    // public $session_category = [];
    public $session_color = [];
    public $session_size = [];
    public $session_brand = [];
    public $session_province = [];
    public $session_variant = [];
    public $session_tag = [];

    public function mount()
    {
        $this->fill(request()->only('murah'));
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updateProduct()
    {
        $detail = new ProductDetail();
        $query = ProductFacades::dataRepository()->leftJoin($detail->getTable(), 'item_detail_product_id', ProductFacades::getKeyName());

        if (session()->has('tag') && session()->get('tag')) {
            foreach (session()->get('tag') as $tag) {
                $query->orWhereRaw('json_contains(item_product_item_tag_json, \'["' . $tag . '"]\')');
            }
        }

        if (session()->has('color') && session()->get('color')) {
            foreach (session()->get('color') as $color) {
                $query->orWhere('item_detail_color_id', ltrim($color, 'c'));
            }
        }

        if (session()->has('size') && session()->get('size')) {
            foreach (session()->get('size') as $size) {
                $query->orWhere('item_detail_size_id', $size);
            }
        }

        if (session()->has('variant') && session()->get('variant')) {
            foreach (session()->get('variant') as $variant) {
                $query->orWhere('item_detail_variant_id', $variant);
            }
        }

        if (session()->has('brand') && session()->get('brand')) {
            foreach (session()->get('brand') as $brand) {
                $query->orWhere('item_product_item_brand_id', ltrim($brand, 'c'));
            }
        }

        if (session()->has('list_province') && session()->get('list_province')) {
            $query->join(BranchFacades::getTable(), BranchFacades::getKeyName(), 'item_detail_branch_id');
            foreach (session()->get('list_province') as $province) {
                $query->orWhere('branch_rajaongkir_province_id', ltrim($province, 'c'));
            }
        }

        if (!empty($this->search)) {
            $query->where('item_product_name', 'like', "%$this->search%");
        }

        if (!empty($this->murah)) {
            $query->where('item_category_slug', $this->murah);
        }

        $query->groupBy('item_product_id');

        if (!empty($this->sort)) {
            if ($this->sort == 'popular') {

                $query->orderByDesc('item_product_counter');
            } else if ($this->sort == 'seller') {

                $query->orderByDesc('item_product_sold');
            } else if ($this->sort == 'date') {

                $query->orderByDesc('item_product_created_at');
            } else if ($this->sort == 'low') {

                $query->orderBy('item_product_price');
            } else if ($this->sort == 'high') {

                $query->orderByDesc('item_product_price');
            } else {

                $query->orderByDesc('item_product_id');
            }
        }

        return $this->data_product = $query->paginate(config('website.pagination'));
    }

    public function render()
    {
        $pro = new ProvinceRepository();
        $this->data_tag = Helper::shareTag((new TagRepository()), 'item_tag_slug');
        $this->data_category = Helper::createOption(new CategoryRepository(), false, true);
        $this->data_size = Helper::createOption(new SizeRepository(), false);
        $this->data_brand = Helper::createOption(new BrandRepository(), false);
        $this->data_province = $pro->getProvinceSeller()->get()->pluck('rajaongkir_province_name', 'rajaongkir_province_id');
        $this->data_color = Helper::createOption(new ColorRepository(), false);
        $this->data_variant = Helper::createOption(new VariantRepository(), false, true);

        if (auth()->check()) {

            $this->data_wishlist = WishlistFacades::getUserRepository();
        }

        if (session()->has('color')) {
            $this->session_color = session()->get('color');
        }
        if (session()->has('size')) {
            $this->session_size = session()->get('size');
        }
        if (session()->has('variant')) {
            $this->session_variant = session()->get('variant');
        }
        if (session()->has('tag')) {
            $this->session_tag = session()->get('tag');
        }
        if (session()->has('list_province')) {
            $this->session_province = session()->get('list_province');
        }
        if (session()->has('brand')) {
            $this->session_brand = session()->get('brand');
        }

        $this->updateProduct();

        return View(Helper::setViewLivewire(__CLASS__), [
            'data_product' => $this->updateProduct(),
        ]);
    }

    public function actionCategory($slug)
    {
        if ($slug == 'reset') {
            $this->murah = null;
        } else {
            $this->murah = $slug;
        }
        $this->updateProduct();
    }

    public function actionClean()
    {
        session()->forget('category');
        session()->forget('color');
        session()->forget('tag');
        session()->forget('size');
        session()->forget('brand');
        session()->forget('list_province');
        $this->session_tag = [];
        $this->session_color = [];
        $this->session_brand = [];
        $this->session_size = [];
        $this->session_province = [];

        $this->search = null;
        $this->murah = null;
        $this->resetPage();
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

    public function actionTag($key)
    {
        if ($key == 'reset') {
            session()->forget('tag');
            $this->session_size = [];
        } else {
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

        }
        $this->updateProduct();
    }

    public function actionColor($key)
    {
        if ($key == 'reset') {
            session()->forget('color');
        } else {
            $key = 'c' . $key;
            if (session()->has('color')) {

                $data = session()->get('color');
                $collection = collect($data);
                if ($collection->contains($key)) {
                    $data = $collection->forget($key);
                } else {

                    if ($data) {

                        $data = $collection->merge([$key => $key]);
                    } else {

                        $data = collect([$key => $key]);
                    }
                }

                session(['color' => $data->toArray()]);
            } else {
                session(['color' => [$key => $key]]);
            }

            $this->session_color = session()->get('color');

        }
        $this->updateProduct();
    }

    public function actionBrand($key)
    {
        if ($key == 'reset') {
            session()->forget('brand');
        } else {
            $key = 'c' . $key;
            if (session()->has('brand')) {

                $data = session()->get('brand');
                $collection = collect($data);
                if ($collection->contains($key)) {
                    $data = $collection->forget($key);
                } else {

                    if ($data) {

                        $data = $collection->merge([$key => $key]);
                    } else {

                        $data = collect([$key => $key]);
                    }
                }

                session(['brand' => $data->toArray()]);
            } else {
                session(['brand' => [$key => $key]]);
            }

            $this->session_brand = session()->get('brand');
        }
        $this->updateProduct();
    }

    public function actionProvince($key)
    {
        if ($key == 'reset') {
            session()->forget('list_province');
        } else {
            $key = 'c' . $key;
            if (session()->has('list_province')) {

                $data = session()->get('list_province');
                $collection = collect($data);
                if ($collection->contains($key)) {
                    $data = $collection->forget($key);
                } else {

                    if ($data) {

                        $data = $collection->merge([$key => $key]);
                    } else {

                        $data = collect([$key => $key]);
                    }
                }

                session(['list_province' => $data->toArray()]);
            } else {
                session(['list_province' => [$key => $key]]);
            }

            $this->session_province = session()->get('list_province');
        }
        $this->updateProduct();
    }

    public function actionSize($key)
    {
        if ($key == 'reset') {
            session()->forget('size');
        } else {
            if (session()->has('size')) {

                $data = session()->get('size');
                $collection = collect($data);
                if ($collection->contains($key)) {
                    $data = $collection->forget($key);
                } else {

                    if ($data) {

                        $data = $collection->merge([$key => $key]);
                    } else {

                        $data = collect([$key => $key]);
                    }
                }

                session(['size' => $data->toArray()]);
            } else {
                session(['size' => [$key => $key]]);
            }

            $this->session_size = session()->get('size');
        }
        $this->updateProduct();
    }
}
