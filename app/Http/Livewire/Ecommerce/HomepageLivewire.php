<?php

namespace App\Http\Livewire\Ecommerce;

use Artesaos\SEOTools\Facades\SEOTools;
use Livewire\Component;
use Modules\Item\Dao\Facades\ProductFacades;
use Modules\Item\Dao\Facades\WishlistFacades;
use Modules\Item\Dao\Repositories\CategoryRepository;
use Modules\Item\Dao\Repositories\ProductRepository;
use Modules\Marketing\Dao\Repositories\PageRepository;
use Modules\Marketing\Dao\Repositories\PromoRepository;
use Modules\Marketing\Dao\Repositories\SliderRepository;
use Modules\Marketing\Dao\Repositories\SosmedRepository;
use Plugin\Helper;

class HomepageLivewire extends Component
{
    public $gsosmed;
    public $gcategory;
    public $gproduct;
    public $gpage;
    public $sliders;
    public $promos;
    public $categories;
    public $best_sellers;
    public $data_wishlist = [];

    // protected $listeners = ['updateLove'];
    // public function updateLove(){

    //     $best_sellers = ProductFacades::getBestSeller()->get();
    //     $this->best_sellers = $best_sellers;
    // }
    
    public function render()
    {
        return View(Helper::setViewLivewire(__CLASS__));
    }

    public function mount($slug){

        $data_product = new ProductRepository();
        $product = $data_product->slugRepository($slug);
        $product_id = $product->item_product_id;

        // $product->item_product_counter = $product->item_product_counter + 1;
        // $product->save();
        $product_image = $data_product->getImageDetail($product->item_product_id) ?? [];
        $variants = $data_product->variant($product->item_product_id) ?? [];
        SEOTools::setTitle($product->item_product_name.' by '.$product->branch_name);
        SEOTools::setDescription($product->item_product_page_seo);
        SEOTools::opengraph()->setUrl(route('product', ['slug' => $product->item_product_slug]));
        SEOTools::opengraph()->addProperty('type', 'articles');
        SEOTools::jsonLd()->addImage(Helper::files('product/'.$product->item_product_image));

        
        
        // $sosmed = Helper::createOption(new SosmedRepository(), false, true);
        // $category = Helper::createOption(new CategoryRepository(), false, true);
        // $product = Helper::createOption(new ProductRepository(), false, true);
        // $page = Helper::createOption(new PageRepository(), false, true);

        // $best_sellers = ProductFacades::getBestSeller()->get();

        // $slider = Helper::createOption(new SliderRepository(), false, true);
        // $promo = Helper::createOption(new PromoRepository(), false, true);

        // $this->gsosmed = $sosmed;
        // $this->gcategory = $category;
        // $this->gproduct = $product;
        // $this->gpage = $page;

        // $this->promos = $promo;
        // $this->sliders = $slider;
        // $this->categories = $category;

        // $this->best_sellers = $best_sellers;

        // if(auth()->check()){

        //     $this->data_wishlist = WishlistFacades::getUserRepository();
        // }

        // SEOTools::setTitle(config('website.name'));
        // SEOTools::setDescription(config('website.seo'));
        // SEOTools::opengraph()->setUrl(url('/'));
        // SEOTools::opengraph()->addProperty('type', 'articles');
        // SEOTools::jsonLd()->addImage(Helper::files('logo/'.config('website.logo')));
        
    }

    public function actionWishlist($product_id){

        $check = WishlistFacades::isLoveProduct($product_id);
        if($check){
            $check->delete();
        }
        else{
            WishlistFacades::insert([
                'item_wishlist_item_product_id' => $product_id,
                'item_wishlist_user_id' => auth()->user()->id
            ]);
        }

        $this->best_sellers = ProductFacades::getBestSeller()->get();
    }
}