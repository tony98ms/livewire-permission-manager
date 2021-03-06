<?php

use Illuminate\Support\Facades\Route;
use Tonystore\LivewirePermission\Http\Controllers\PermissionController;

Route::prefix(config('livewire-permission.route.prefix', 'admin'))->middleware(config('livewire-permission.route.middleware', 'web'))->group(function () {
    Route::get(config('livewire-permission.route.url', '/roles/manager'), [PermissionController::class, 'index'])->name(config('livewire-permission.route.name'));
});
