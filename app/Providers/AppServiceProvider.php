<?php

namespace App\Providers;

use App\Integration\SuiteCRM\SuiteCrmIntegrationProvider;
use App\Observers\CategoryObserver;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        Blade::if('permission', function (array $permissions) {
            return validatePermission($permissions);
        });

        $this->dateTimeBladeDirectives();
    }

    private function dateTimeBladeDirectives()
    {
        $dateFormat = config('app.date_format', 'Y-m-d');
        $timeFormat = config('app.time_format', 'H:i');
        $dateTimeFormat = $dateFormat . ' ' . $timeFormat;

        Blade::directive('formatDate', function ($expression) use ($dateFormat) {
            return "<?php echo $expression ? ($expression)->format('$dateFormat') : ''; ?>";
        });

        Blade::directive('formatTime', function ($expression) use ($timeFormat) {
            return "<?php echo $expression ? ($expression)->format('$timeFormat') : ''; ?>";
        });

        Blade::directive('formatDateTime', function ($expression) use ($dateTimeFormat) {
            return "<?php echo $expression ? ($expression)->format('$dateTimeFormat') : ''; ?>";
        });

        Blade::directive('upper', function ($expression) {
            return "<?php echo \Illuminate\Support\Str::upper($expression); ?>";
        });

        Blade::directive('formatNumber', function ($expression) {
            $params = explode(',', $expression);
            $params[2] = '\'' . config('app.number_dec_sep', ',') . '\'';
            $params[3] = '\'' . config('app.number_grp', '.') . '\'';

            return "<?php echo number_format(" . implode(', ', $params) . ") ?>";
        });

        Blade::directive('routeIs', function ($expression) {
            return "<?php echo \Request::url() === url('$expression') ? 'hidden' : ''; ?>";
        });
    }
}
