<?php

namespace AuthUser\Providers;

use Illuminate\Support\ServiceProvider;

class AuthUserServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

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
        $this->publishMigrations();
        $this->publishSeeders();
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RepositoryServiceProvider::class);
        $this->app->register(RouteServiceProvider::class);
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->publishes([
            __DIR__.'/../Config/config.php' => config_path('authuser.php'),
        ], 'config');
        $this->mergeConfigFrom(
            __DIR__.'/../Config/config.php', 'authuser'
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = base_path('resources/views/modules/authuser');

        $sourcePath = __DIR__.'/../resources/views';

        $this->publishes([
            $sourcePath => $viewPath
        ]);

        $this->loadViewsFrom(array_merge(array_map(function ($path) {
            return $path . '/modules/authuser';
        }, \Config::get('view.paths')), [$sourcePath]), 'authuser');
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = base_path('resources/lang/modules/authuser');

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, 'authuser');
        } else {
            $this->loadTranslationsFrom(__DIR__ .'/../resources/lang', 'authuser');
        }
    }

    public function publishMigrations(){
        $sourcePath = __DIR__.'/../database/migrations';

        $this->publishes([
            $sourcePath => database_path('migrations')
        ], 'migrations');
    }

    public function publishSeeders(){
        $sourcePath = __DIR__.'/../database/seeders';

        $this->publishes([
            $sourcePath => database_path('seeds')
        ], 'seeders');
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