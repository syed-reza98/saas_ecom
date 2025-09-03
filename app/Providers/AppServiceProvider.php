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
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        ExportAction::configureUsing(fn (ExportAction $action) => $action->fileDisk('s3'));
    }
}
