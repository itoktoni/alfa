<?php

namespace Modules\System\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factory;
use Illuminate\Support\Facades\Config;

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
        $this->app->bind('action_facades', function () {
            return new \Modules\System\Dao\Repositories\ActionRepository();
        });
        $this->app->bind('module_facades', function () {
            return new \Modules\System\Dao\Repositories\ModuleRepository();
        });
        $this->app->bind('company_facades', function () {
            return new \Modules\System\Dao\Repositories\CompanyRepository();
        });
        $this->app->bind('location_facades', function () {
            return new \Modules\System\Dao\Repositories\LocationRepository();
        });
        $this->app->bind('holding_facades', function () {
            return new \Modules\System\Dao\Repositories\HoldingRepository();
        });
        $this->app->bind('team_facades', function () {
            return new \Modules\System\Dao\Repositories\TeamRepository();
        });
        $this->app->bind('group_user_facades', function () {
            return new \Modules\System\Dao\Repositories\GroupUserRepository();
        });
        $this->app->bind('group_module_facades', function () {
            return new \Modules\System\Dao\Repositories\GroupModuleRepository();
        });
        $this->app->bind('module_connection_action_facades', function () {
            return new \Modules\System\Dao\Models\ModuleConnectionAction();
        });
        $this->app->bind('group_module_connection_module_facades', function () {
            return new \Modules\System\Dao\Models\GroupModuleConnectionModule();
        });
        $this->app->bind('group_user_connection_group_module_facades', function () {
            return new \Modules\System\Dao\Models\GroupUserConnectionGroupModule();
        });
        $this->app->bind('company_connection_location_facades', function () {
            return new \Modules\System\Dao\Models\CompanyConnectionLocation();
        });
        $this->app->bind('company_connection_item_product_facades', function () {
            return new \Modules\System\Dao\Models\CompanyConnectionItemProduct();
        });
        $this->app->bind('filter_facades', function () {
            return new \Modules\System\Dao\Models\Filter();
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
            __DIR__.'/../Config/config.php' => config_path('System.php'),
        ], 'config');
        $this->mergeConfigFrom(
            __DIR__.'/../Config/config.php', 'System'
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = resource_path('views/modules/System');

        $sourcePath = __DIR__.'/../Resources/views';

        $this->publishes([
            $sourcePath => $viewPath
        ],'views');

        $this->loadViewsFrom(array_merge(array_map(function ($path) {
            return $path . '/modules/System';
        }, Config::get('view.paths')), [$sourcePath]), 'System');
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/modules/System');

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, 'System');
        } else {
            $this->loadTranslationsFrom(__DIR__ .'/../Resources/lang', 'System');
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
