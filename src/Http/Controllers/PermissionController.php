<?php

namespace Tonystore\LivewirePermission\Http\Controllers;

use Livewire\Component;
use Livewire\WithPagination;

class PermissionController
{
    public $elementType, $theme;
    public function __construct()
    {
        $this->elementType = config('livewire-permission.blade-template.type');
        $this->theme = config('livewire-permission.theme');
    }
    public function index()
    {
        return view('permissions::' . $this->elementType . '.' . $this->theme);
    }
}
