<?php

namespace Tonystore\LivewirePermission\Http\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Tonystore\LivewirePermission\Traits\SortByTrait;
use Tonystore\LivewirePermission\Traits\ListModelTrait;

class LivewirePermission extends Component
{
    use WithPagination, SortByTrait, ListModelTrait;
    #[Url]
    public string $search = '';
    protected $listeners = ['roleUpdated' => 'render', 'roleDeleted' => 'render'];
    protected $excludeRoles;
    public    $perPage;
    public    $perPages;
    public    $orderBy           = 'id';
    public    $orderAsc          = true;
    public    $role              = '';
    public    $permissionsByRole = [];
    public    $permissions       = [];
    public    $freePermissions   = [];
    public    $allRoles          = [];
    public    $editMode          = false;
    public    $columnName        = '';
    public    $columnAdd;
    public    $theme;
    public    $modalDesign;
    public    $isOpen            = false;
    public    $roleName          = '';
    public    $paginationTheme          = '';
    public function __construct()
    {
        $this->theme = config('livewire-permission.theme', 'bootstrap');
        $this->paginationTheme = config('livewire-permission.theme') == 'bootstrap5' ? 'bootstrap' : config('livewire-permission.theme');
        $this->columnName =  config('livewire-permission.column_name.description');
        $this->columnAdd =  config('livewire-permission.column_name.add_column');
        $this->excludeRoles =  config('livewire-permission.roles.excludes');
        $this->modalDesign =  config('livewire-permission.modals.role');
        $this->perPages =  config('livewire-permission.paginate.perPages');
        $this->perPage =  $this->perPages[0];
    }
    #[On('role-deleted')]
    public function render()
    {
        $this->freePermissions = Permission::where(function ($query) {
            if (count($this->permissionsByRole) > 0) {
                $query->whereNotIn('name', $this->getPermissionsByRole());
            }
        })->get();
        $this->allRoles = Role::select($this->getSelectByPermission())->whereNotIn('name', $this->excludeRoles)->get();
        $roles = Role::whereNotIn('name', $this->excludeRoles)
            ->with(['permissions'])
            ->orderBy($this->orderBy, $this->orderAsc ? 'asc' : 'desc')
            ->where('name', 'like', '%' . $this->search . '%')
            ->paginate($this->perPage);
        return view('permissions::livewire.permissions.' . $this->theme . '.permission', compact('roles'));
    }
    public function updatedSearch()
    {
        $this->resetPage();
    }
    public function editPermission($name)
    {
        $this->role = $name;
        $this->getPermissions();
        $this->isOpen = true;
        $this->dispatch('showPermissionModal');
    }
    public function getSelectByPermission()
    {
        if (isset($this->columnName)) {
            return ['name', config('livewire-permission.column_name.description')];
        } else {
            return ['name'];
        }
    }
    /**
     * Get the value of permissionsByRole
     */
    public function getPermissionsByRole()
    {
        return collect($this->permissionsByRole)->pluck('name');
    }
    public function resetModal()
    {
        $this->reset(['role', 'permissionsByRole', 'isOpen']);
        $this->dispatch('hideModal');
    }
    #[On('roleAdd')]
    public function roleAdd($role)
    {
        $this->role = $role;
        $this->isOpen = true;
        $this->render();
    }
}
