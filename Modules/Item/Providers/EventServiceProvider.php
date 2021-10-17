<?php

namespace Modules\Item\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Modules\Item\Events\RegisterLinenEvent;
use Modules\Item\Listeners\Register\CreateLinenDetailListener;
use Modules\Item\Listeners\Register\CreateLinenStockCardListener;
use Modules\Item\Listeners\Register\CreateLinenStockDetailListener;
use Modules\Item\Listeners\Register\RealisasiCompanyProductListener;
use Modules\Item\Listeners\Register\UpdateLinenListener;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        RegisterLinenEvent::class => [
            UpdateLinenListener::class,
            CreateLinenDetailListener::class,
            RealisasiCompanyProductListener::class,
            CreateLinenStockCardListener::class
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
