<?php

namespace App\Http\Livewire\Ecommerce;

use Artesaos\SEOTools\Facades\SEOTools;
use Livewire\Component;
use Plugin\Helper;

class MetaLivewire extends Component
{
    protected $listeners = ['updateMeta'];

    public function updateMeta($category){
        SEOTools::setTitle('Belanja '.$category['title']);
        SEOTools::setDescription($category['description']);
        SEOTools::opengraph()->setUrl($category['url']);
        SEOTools::opengraph()->addProperty('type', 'articles');
        SEOTools::jsonLd()->addImage($category['image']);
    }
    public function render()
    {
        return View(Helper::setViewLivewire(__CLASS__));
    }
}
