<?php

namespace App\Providers;

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
        // Canonical, sitemap e links sempre com o domínio de APP_URL (inclusive atrás de proxy/HTTPS).
        if ($this->app->isProduction()) {
            if (config('ordik.force_root_url')) {
                URL::forceRootUrl(config('app.url'));
            }

            URL::forceScheme(parse_url(config('app.url'), PHP_URL_SCHEME) ?: 'https');
        }
    }
}
