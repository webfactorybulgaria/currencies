<?php

namespace TypiCMS\Modules\Currencies\Providers;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use TypiCMS\Modules\Core\Shells\Facades\TypiCMS;
use TypiCMS\Modules\Core\Shells\Observers\FileObserver;
use TypiCMS\Modules\Core\Shells\Observers\SlugObserver;
use TypiCMS\Modules\Core\Shells\Services\Cache\LaravelCache;
use TypiCMS\Modules\Currencies\Shells\Models\Currency;
use TypiCMS\Modules\Currencies\Shells\Models\CurrencyTranslation;
use TypiCMS\Modules\Currencies\Shells\Repositories\CacheDecorator;
use TypiCMS\Modules\Currencies\Shells\Repositories\EloquentCurrency;

class ModuleProvider extends ServiceProvider
{
    public function boot()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/config.php', 'typicms.currencies'
        );

        $modules = $this->app['config']['typicms']['modules'];
        $this->app['config']->set('typicms.modules', array_merge(['currencies' => []], $modules));

        $this->loadViewsFrom(__DIR__.'/../resources/views/', 'currencies');
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'currencies');

        $this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/currencies'),
        ], 'views');
        $this->publishes([
            __DIR__.'/../database' => base_path('database'),
        ], 'migrations');

        AliasLoader::getInstance()->alias(
            'Currencies',
            'TypiCMS\Modules\Currencies\Shells\Facades\Facade'
        );
    }

    public function register()
    {
        $app = $this->app;

        /*
         * Register route service provider
         */
        $app->register('TypiCMS\Modules\Currencies\Shells\Providers\RouteServiceProvider');

        /*
         * Sidebar view composer
         */
        $app->view->composer('core::admin._sidebar', 'TypiCMS\Modules\Currencies\Shells\Composers\SidebarViewComposer');

        /*
         * Add the page in the view.
         */
        $app->view->composer('currencies::public.*', function ($view) {
            $view->page = TypiCMS::getPageLinkedToModule('currencies');
        });

        $app->bind('TypiCMS\Modules\Currencies\Shells\Repositories\CurrencyInterface', function (Application $app) {
            $repository = new EloquentCurrency(new Currency());
            if (!config('typicms.cache')) {
                return $repository;
            }
            $laravelCache = new LaravelCache($app['cache'], 'currencies', 10);

            return new CacheDecorator($repository, $laravelCache);
        });
    }
}
