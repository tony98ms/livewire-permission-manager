<?php

namespace Tonystore\LivewirePermission;

use Livewire\Livewire;
use Illuminate\Support\ServiceProvider;
use Tonystore\LivewirePermission\Http\Livewire\LivewirePermission;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Blade;
use Tonystore\LivewirePermission\Http\Livewire\LivewireRole;

class LivewirePermissionProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/livewire-permission.php', 'livewire-permission');
    }
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Livewire::component('permission', LivewirePermission::class);
        Livewire::component('role', LivewireRole::class);
        Blade::component('permissions::components.includes.scripts', 'permissions::scripts');
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'permissions');
        $this->loadRoutesFrom(__DIR__ . '/../routes/permission.php');
        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'permissions');
        $this->loadJsonTranslationsFrom(__DIR__ . '/../resources/lang');
        $this->loadJsonTranslationsFrom(resource_path('lang/vendor/permissions'));

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../resources/views' => resource_path('views/vendor/permissions')
            ], 'views');
            $this->publishes([
                __DIR__ . '/../config/livewire-permission.php' => config_path('livewire-permission.php'),
            ], 'config');
            $this->publishes([
                __DIR__ . '/../database/migrations/update_permission_tables.php.stub' => $this->getMigrationFileName('update_permission_tables.php'),
            ], 'migrations');
            $this->publishes([
                __DIR__ . '/../resources/lang' => resource_path('lang/vendor/permissions'),
            ], 'langs');
        }
    }

    protected function getMigrationFileName($migrationFileName): string
    {
        $timestamp = date('Y_m_d_His');

        $filesystem = $this->app->make(Filesystem::class);

        return Collection::make($this->app->databasePath() . DIRECTORY_SEPARATOR . 'migrations' . DIRECTORY_SEPARATOR)
            ->flatMap(function ($path) use ($filesystem, $migrationFileName) {
                return $filesystem->glob($path . '*_' . $migrationFileName);
            })
            ->push($this->app->databasePath() . "/migrations/{$timestamp}_{$migrationFileName}")
            ->first();
    }
}
