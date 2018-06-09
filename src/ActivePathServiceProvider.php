<?php

namespace TarasenkoEvgenii\ActivePath;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class ActivePathServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/config/activepath.php' => config_path('activepath.php'),
        ], 'config');

        Blade::directive('isNav', function ($navName, $className = null) {
            if($className) {
                return "<?php echo ActivePath::isNav($navName, $className); ?>";
            }else {
                return "<?php echo ActivePath::isNav($navName); ?>";
            }
        });

        Blade::directive('isPath', function ($navName, $className = null) {
            if($className) {
                return "<?php echo ActivePath::isPath($navName, $className); ?>";
            }else {
                return "<?php echo ActivePath::isPath($navName); ?>";
            }
        });

        Blade::directive('isSegment', function ($navName, $value, $className = null) {
            if($className) {
                return "<?php echo ActivePath::isSegment($navName, $value, $className); ?>";
            }else {
                return "<?php echo ActivePath::isSegment($navName, $value); ?>";
            }
        });
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('activePath', function ($app) {
            return new ActivePath();
        });
    }
}
