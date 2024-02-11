<?php

namespace Tonystore\LivewirePermission\Tests;

use MigrateProcessor;
use Livewire\LivewireServiceProvider;
use function Orchestra\Testbench\artisan;
use Spatie\Permission\PermissionServiceProvider;
use Orchestra\Testbench\Attributes\WithMigration;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Tonystore\LivewirePermission\LivewirePermissionProvider;

#[WithMigration('permission-migrations')]
abstract class TestCase extends \Orchestra\Testbench\TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->withoutVite();
    }

    protected function defineEnvironment($app)
    {
        // Setup default database to use sqlite :memory:
        $app['config']->set('database.default', 'testbench');
        $app['config']->set('database.connections.testbench', [
            'driver'   => 'sqlite',
            'database' => ':memory:',
            'prefix'   => '',
        ]);
    }

    protected function getPackageProviders($app): array
    {
        return [
            PermissionServiceProvider::class,
            LivewirePermissionProvider::class,
            LivewireServiceProvider::class
        ];
    }

    protected function defineDatabaseMigrations(): void
    {
        $this->loadLaravelMigrations();
        // artisan($this, 'migrate');
        // $this->beforeApplicationDestroyed(
        //     fn () => artisan($this, 'migrate:rollback', ['--database' => 'testbench'])
        // );

        $migrate = require __DIR__ . '/../vendor/spatie/laravel-permission/database/migrations/create_permission_tables.php.stub';
        $migrate->up();
    }
}
