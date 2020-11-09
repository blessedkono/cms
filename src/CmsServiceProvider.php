<?php
namespace Nextbyte\Cms;
use \Illuminate\Support\ServiceProvider;
class CmsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/routes/web.php');
        $this->loadViewsFrom(__DIR__.'/views/cms', 'cms');
        $this->loadRoutesFrom(__DIR__.'/routes/Cms/dashboard.php');
        $this->loadRoutesFrom(__DIR__.'/routes/Cms/blog.php');
        $this->loadRoutesFrom(__DIR__.'/routes/Cms/category.php');
        $this->loadRoutesFrom(__DIR__.'/routes/Cms/faq.php');
        $this->loadRoutesFrom(__DIR__.'/routes/Cms/client.php');
        $this->loadRoutesFrom(__DIR__.'/routes/Cms/testimonial.php');
//        $this->loadViewsFrom(__DIR__.'/views','cms');
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');

        //call method to publish files
        $this->publishFiles();

    }

    public function register()
    {
        parent::register();
    }

    public function publishFiles()
    {
        //publish from package to laravel project
        $this->publishes([
            __DIR__.'/database/migrations/' => database_path('migrations'),
            __DIR__.'/Models/Cms' => resource_path('Models/Cms'),
            __DIR__.'/Http/Controllers/Cms' => resource_path('Controllers/Cms'),

        ], 'migrations');

        $this->publishes([
            __DIR__.'/assets/cms/' => public_path('cms/public'),
            __DIR__.'/routes/' => base_path('routes'),
            __DIR__.'/views/' => resource_path('views')

        ], 'assets');
    }
}
