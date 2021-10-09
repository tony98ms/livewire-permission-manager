<?php

namespace Tonystore\LivewirePermission\Http\Controllers;

use Livewire\Component;
use Livewire\WithPagination;

class PermissionController
{
    public function index()
    {
        return view('permissions::index');
    }
}
