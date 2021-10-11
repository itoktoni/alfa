<?php

namespace Modules\Linen\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factory;
use Illuminate\Support\Facades\Config;
use Modules\Linen\Dao\Models\KotorDetail;
use Modules\Linen\Dao\Models\StockDetail;

class ModuleServiceProvider extends ServiceProvider
{
    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerTranslations();
        $this->registerConfig();
        $this->registerViews();
        $this->registerFactories();
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);
        $this->app->bind('outstanding_facades', function () {
            return new \Modules\Linen\Dao\Repositories\OutstandingRepository();
        });
        $this->app->bind('delivery_facades', function () {
            return new \Modules\Linen\Dao\Repositories\DeliveryRepository();
        }); 
        $this->app->bind('grouping_facades', function () {
            return new \Modules\Linen\Dao\Repositories\GroupingRepository();
        });
        $this->app->bind('master_outstanding_facades', function () {
            return new \Modules\Linen\Dao\Models\MasterOutstanding();
        }); 
        $this->app->bind('retur_facades', function () {
            return new \Modules\Linen\Dao\Repositories\ReturRepository();
        }); 
        $this->app->bind('rewash_facades', function () {
            return new \Modules\Linen\Dao\Repositories\RewashRepository();
        });  
        $this->app->bind('kotor_facades', function () {
            return new \Modules\Linen\Dao\Repositories\KotorRepository();
        }); 
        $this->app->bind('kotor_detail_facades', function () {
            return new KotorDetail();
        });
        $this->app->bind('stock_facades', function () {
            return new \Modules\Linen\Dao\Repositories\StockRepository();
        }); 
        $this->app->bind('stock_detail_facades', function () {
            return new StockDetail();
        }); 
        $this->app->bind('card_facades', function () {
            return new \Modules\Linen\Dao\Repositories\CardRepository();
        });
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->publishes([
            __DIR__.'/../Config/config.php' => config_path('Linen.php'),
        ], 'config');
        $this->mergeConfigFrom(
            __DIR__.'/../Config/config.php', 'Linen'
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = resource_path('views/modules/Linen');

        $sourcePath = __DIR__.'/../Resources/views';

        $this->publishes([
            $sourcePath => $viewPath
        ],'views');

        $this->loadViewsFrom(array_merge(array_map(function ($path) {
            return $path . '/modules/Linen';
        }, Config::get('view.paths')), [$sourcePath]), 'Linen');
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/modules/Linen');

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, 'Linen');
        } else {
            $this->loadTranslationsFrom(__DIR__ .'/../Resources/lang', 'Linen');
        }
    }

    /**
     * Register an additional directory of Repositories.
     *
     * @return void
     */
    public function registerFactories()
    {
        // if (! app()->environment('production')) {
        //     app(Factory::class)->load(__DIR__ . '/../Database/factories');
        // }
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }
}
