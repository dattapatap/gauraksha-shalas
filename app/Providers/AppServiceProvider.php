<?php

namespace App\Providers;

use App\View\Composers\AdminViewComposer;
use App\View\Composers\CommonViewComposer;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

        $this->app['request']->server->set('HTTPS', $this->app->environment() != 'local');

        URL::forceRootUrl(Config::get('app.url'));
        if (str_contains(Config::get('app.url'), 'https://')) {
            URL::forceScheme('https');
        }

        Paginator::useBootstrap();

        date_default_timezone_set('Asia/Kolkata');
        view()->composer(['frontend.layouts.*', 'frontend.home.', 'frontend.sections.*', 'frontend.website.*'], CommonViewComposer::class);
        view()->composer('backend.layouts.app', AdminViewComposer::class);

    }

}
