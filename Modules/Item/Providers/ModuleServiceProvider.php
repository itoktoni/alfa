<?php

namespace Modules\Item\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factory;
use Illuminate\Support\Facades\Config;
use Modules\Item\Dao\Models\LinenDetail;

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
        $this->app->bind('category_facades', function () {
            return new \Modules\Item\Dao\Repositories\CategoryRepository();
        });
        $this->app->bind('product_facades', function () {
            return new \Modules\Item\Dao\Repositories\ProductRepository();
        });
        $this->app->bind('linen_facades', function () {
            return new \Modules\Item\Dao\Repositories\LinenRepository();
        }); 
        $this->app->bind('linen_detail_facades', function () {
            return new LinenDetail();
        });
        $this->app->bind('unit_facades', function () {
            return new \Modules\Item\Dao\Repositories\UnitRepository();
        });
        $this->app->bind('size_facades', function () {
            return new \Modules\Item\Dao\Repositories\SizeRepository();
        });
        $this->app->bind('company_product_facades', function () {
            return new \Modules\Item\Dao\Repositories\CompanyProductRepository();
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
            __DIR__.'/../Config/config.php' => config_path('Item.php'),
        ], 'config');
        $this->mergeConfigFrom(
            __DIR__.'/../Config/config.php', 'Item'
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = resource_path('views/modules/Item');

        $sourcePath = __DIR__.'/../Resources/views';

        $this->publishes([
            $sourcePath => $viewPath
        ],'views');

        $this->loadViewsFrom(array_merge(array_map(function ($path) {
            return $path . '/modules/Item';
        }, Config::get('view.paths')), [$sourcePath]), 'Item');
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/modules/Item');

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, 'Item');
        } else {
            $this->loadTranslationsFrom(__DIR__ .'/../Resources/lang', 'Item');
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
