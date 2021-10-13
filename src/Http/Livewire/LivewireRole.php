<?php

namespace Tonystore\LivewirePermission\Http\Livewire;

use Livewire\Component;
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
    protected $rules = [
        'roleName' => 'required'
    ];
    protected $messages = [
        'roleName.required' => 'The role name is required'
    ];
    protected $listeners = ['editRole'];

    public function __construct()
    {
        $this->theme = config('livewire-permission.theme', 'bootstrap');
        $this->paginationTheme = config('livewire-permission.theme', 'bootstrap');
        $this->columnName =  config('livewire-permission.column_name.description');
        $this->modalDesign =  config('livewire-permission.modals.role');
    }
    public function render()
    {
        return view('permissions::livewire.permissions.' . $this->paginationTheme . '.role');
    }
    public function resetModal()
    {
        $this->resetValidation();
        $this->reset(['roleName', 'roleDescription', 'editMode', 'role_id', 'isOpen']);
    }

    public function createRole()
    {
        $this->validate();
        $role = Role::create($this->getAttributes());
        $this->resetModal();
        $this->emit('roleAdd', [$role->name]);
    }

    public function getAttributes()
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
    public function editRole(Role $role)
    {
        $this->roleName = $role->name;
        $this->roleDescription = isset($this->columnName) ? $role[$this->columnName] : '';
        $this->role_id = $role->id;
        $this->editMode = true;
        $this->isOpen = true;
    }
    public function updateRole()
    {
        $this->validate();
        $role = Role::where('id', $this->role_id)->update($this->getAttributes());
        $this->resetModal();
        $this->emit('roleUpdated');
    }
}
