<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Filament\Actions\ExportAction;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        if ($this->app->environment('local')) {
            $this->app->register(\Laravel\Telescope\TelescopeServiceProvider::class);
            $this->app->register(TelescopeServiceProvider::class);
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        ExportAction::configureUsing(fn (ExportAction $action) => $action->fileDisk('s3'));
    }
}
