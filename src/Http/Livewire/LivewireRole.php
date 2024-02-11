<?php

namespace Tonystore\LivewirePermission\Http\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;
use Spatie\Permission\Models\Role;

class LivewireRole extends Component
{
    public    $columnName      = '';
    public    $theme;
    public    $modalDesign;
    public    $roleName        = '';
    public    $roleDescription = '';
    public    $role_id         = '';
    public    $editMode        = false;
    public    $isOpen          = false;
    public    $columnAdd;
    public    $paginationTheme = '';

    protected $rules = [
        'roleName' => 'required'
    ];
    protected $messages = [
        'roleName.required' => 'The role name is required'
    ];

    public function __construct()
    {
        $this->theme = config('livewire-permission.theme', 'bootstrap');
        $this->paginationTheme = config('livewire-permission.theme', 'bootstrap');
        $this->columnName =  config('livewire-permission.column_name.description');
        $this->modalDesign =  config('livewire-permission.modals.role');
        $this->columnAdd =  config('livewire-permission.column_name.add_column');
    }
    public function render()
    {
        return view('permissions::livewire.permissions.' . $this->paginationTheme . '.role');
    }
    public function resetModal()
    {
        $this->resetValidation();
        $this->reset(['roleName', 'roleDescription', 'editMode', 'role_id', 'isOpen']);
        $this->dispatch('hideModal');
    }

    public function createRole()
    {
        $this->validate();
        $role = Role::create($this->getAttributesRole());
        $this->resetModal();
        $this->dispatch('roleAdd', [$role->name]);
    }

    public function getAttributesRole()
    {
        if (isset($this->columnName))
            return [
                'name' => $this->roleName,
                $this->columnName  => $this->roleDescription,
            ];
        return [
            'name' => $this->roleName
        ];
    }
    #[On('editRole')]
    public function roleEdit(Role $role)
    {
        $this->roleName = $role->name;
        $this->roleDescription = isset($this->columnName) ? $role[$this->columnName] : '';
        $this->role_id = $role->id;
        $this->editMode = true;
        $this->isOpen = true;
        $this->dispatch('showBootstrapModal');
    }
    public function roleUpdate()
    {
        $this->validate();
        $role = Role::where('id', $this->role_id)->update($this->getAttributesRole());
        $this->resetModal();
        $this->dispatch('hideModal');
    }
    #[On('deleteRole')]
    public function roleDelete(Role $role)
    {
        $role->delete();
        $this->dispatch('hideModal');
    }
}
