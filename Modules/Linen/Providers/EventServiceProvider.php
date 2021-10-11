<?php

namespace Modules\Linen\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Modules\Linen\Events\CreateDeliveryEvent;
use Modules\Linen\Events\CreateGrouping;
use Modules\Linen\Events\CreateGroupingEvent;
use Modules\Linen\Events\CreateKotorEvent;
use Modules\Linen\Listeners\Delivery\UpdateLinenDeliveryListener;
use Modules\Linen\Listeners\Grouping\LogCardGroupingListener;
use Modules\Linen\Listeners\Grouping\UpdateLinenGroupingListener;
use Modules\Linen\Listeners\Kotor\CreateKotorLinenDetailListener;
use Modules\Linen\Listeners\Kotor\LogCardDeliveryListener;
use Modules\Linen\Listeners\Kotor\LogCardKotorListener;
use Modules\Linen\Listeners\Kotor\RemoveStockDetailKotorListener;
use Modules\Linen\Listeners\Kotor\UpdateLinenKotorListener;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        CreateKotorEvent::class => [
            UpdateLinenKotorListener::class,
            // CreateKotorLinenDetailListener::class,
            // RemoveStockDetailKotorListener::class,
            LogCardKotorListener::class,
        ],
        CreateGroupingEvent::class => [
            UpdateLinenGroupingListener::class,
        ],
        CreateDeliveryEvent::class => [
            UpdateLinenDeliveryListener::class,
            LogCardDeliveryListener::class
        ]
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
