<?php

namespace Tonystore\LivewirePermission\Traits;

use Spatie\Permission\Models\Role;

trait ListModelTrait
{
    public function revokePermission($permission)
    {
        $role = Role::where('name', $this->role)->first();
        $role->revokePermissionTo($permission);
        $this->getPermissions();
    }
    public function givePermission($permission)
    {
        $role = Role::where('name', $this->role)->first();
        $role->givePermissionTo($permission);
        $this->getPermissions();
    }
    public function getPermissions()
    {
        $role = Role::where('name', $this->role)->with(['permissions'])->first();
        $this->permissionsByRole = $role->permissions;
    }
}
