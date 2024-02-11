<?php

namespace Tonystore\LivewirePermission\Tests;

use Livewire\Livewire;
use Spatie\Permission\Models\Role;
use Tonystore\LivewirePermission\Http\Livewire\LivewirePermission;
use Tonystore\LivewirePermission\Http\Livewire\LivewireRole;

class LivewirePermissionManagerTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(LivewireRole::class)
            ->assertStatus(200);
    }
    public function test_reset_modal_event(): void
    {
        Livewire::test(LivewireRole::class)
            ->call('resetModal')
            ->assertDispatched('hideModal');
    }
    public function test_display_roles(): void
    {
        foreach (['admin', 'user'] as  $value) {
            Role::create(['name' => $value]);
        }
        Livewire::test(LivewirePermission::class)
            ->assertViewHas('roles', function ($posts) {
                return count($posts) == 2;
            });
    }
    public function test_create_role(): void
    {
        $this->assertEquals(0, Role::count());
        Livewire::test(LivewireRole::class)
            ->set('roleName', 'admin')
            ->call('createRole');
        $this->assertEquals(1, Role::count());
    }
    public function test_edit_role_role(): void
    {
        $role = Role::create(['name' => 'admin']);
        Livewire::test(LivewireRole::class)
            ->call('roleEdit', $role)
            ->assertSet('roleName', $role->name);
    }
    public function test_edit_role_with_dispatch(): void
    {
        $role = Role::create(['name' => 'admin']);
        Livewire::test(LivewireRole::class)
            ->dispatch('editRole', $role)
            ->assertSet('roleName', $role->name);
    }
}
