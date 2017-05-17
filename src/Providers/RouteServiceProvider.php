<?php

namespace TypiCMS\Modules\Currencies\Providers;

use Illuminate\Routing\Router;
use TypiCMS\Modules\Core\Shells\Facades\TypiCMS;
use TypiCMS\Modules\Core\Shells\Providers\BaseRouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to the controller routes in your routes file.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'TypiCMS\Modules\Currencies\Shells\Http\Controllers';

    /**
     * Define the routes for the application.
     *
     * @param \Illuminate\Routing\Router $router
     *
     * @return void
     */
    public function map(Router $router)
    {
        $router->group(['namespace' => $this->namespace], function (Router $router) {

            /*
             * Front office routes
             */
            if ($page = TypiCMS::getPageLinkedToModule('currencies')) {
                $options = $page->private ? ['middleware' => 'auth'] : [];
                foreach (config('translatable.locales') as $lang) {
                    if ($page->translate($lang)->status && $uri = $page->uri($lang)) {
                        $router->get($uri, $options + ['as' => $lang.'.currencies', 'uses' => 'PublicController@index']);
                        $router->get($uri.'/{slug}', $options + ['as' => $lang.'.currencies.slug', 'uses' => 'PublicController@show']);
                    }
                }
            }

            /*
             * Admin routes
             */
            $router->get('admin/currencies', 'AdminController@index')->name('admin::index-currencies');
            $router->get('admin/currencies/create', 'AdminController@create')->name('admin::create-currency');
            $router->get('admin/currencies/{currency}/edit', 'AdminController@edit')->name('admin::edit-currency');
            $router->post('admin/currencies', 'AdminController@store')->name('admin::store-currency');
            $router->put('admin/currencies/{currency}', 'AdminController@update')->name('admin::update-currency');

            /*
             * API routes
             */
            $router->get('api/currencies', 'ApiController@index')->name('api::index-currencies');
            $router->put('api/currencies/{currency}', 'ApiController@update')->name('api::update-currency');
            $router->delete('api/currencies/{currency}', 'ApiController@destroy')->name('api::destroy-currency');
        });
    }
}
