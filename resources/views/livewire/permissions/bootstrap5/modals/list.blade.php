<div wire:ignore.self class="modal fade" id="modalPermission" data-backdrop="static" data-keyboard="false"
    tabindex="-1" aria-labelledby="modalPermissionLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-dark" id="modalPermissionTitle">@lang('Permission Management')</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                    wire:click="resetModal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h1 class="text-center font-weight-bold text-danger">@lang('Manage Permissions')
                </h1>
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label text-lg-right">@lang('Selected
                        role')</label>
                    <div class="col-sm-3">
                        <select class="custom-select btn-block" wire:model="role" wire:change="getPermissions()">
                            @foreach ($allRoles as $singleRole)
                                <option value="{{ $singleRole->name }}">
                                    @isset($singleRole[config('livewire-permission.column_name.description')])
                                        {{ $singleRole[config('livewire-permission.column_name.description')] }}
                                    @else
                                        {{ $singleRole->name }}
                                    @endisset
                                </option>
                            @endforeach
                        </select>
                    </div>
                    {{-- <label class="my-1 mr-2" for="inlineFormCustomSelectPref">@lang('Rol Seleccionado')</label> --}}

                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <h4 class="text-center text-danger font-weight-bold ">@lang('Assigned')</h4>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>@lang('Permission')</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($permissionsByRole as $modalPermission)
                                    <tr>
                                        <td class="text-capitalize">
                                            @isset($modalPermission[config('livewire-permission.column_name.description')])
                                                {{ $modalPermission[config('livewire-permission.column_name.description')] }}
                                            @else
                                                {{ $modalPermission->name }}
                                            @endisset
                                        </td>
                                        <td width="25" class="text-left">
                                            <button
                                                wire:target="revokePermission, givePermission, editPermission, getPermissions"
                                                wire:loading.attr="disabled"
                                                wire:click.prevent="revokePermission('{{ $modalPermission->name }}')"
                                                class="btn btn-danger">@lang('Remove')
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="col-lg-6">
                        <h4 class="text-center text-danger font-weight-bold ">@lang('Available at')</h4>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>@lang('Permission')</th>
                                    <th width="50"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($freePermissions as $freePermision)
                                    <tr>
                                        <td class="text-capitalize">
                                            @isset($freePermision[config('livewire-permission.column_name.description')])
                                                {{ $freePermision[config('livewire-permission.column_name.description')] }}
                                            @else
                                                {{ $freePermision->name }}
                                            @endisset
                                        </td>
                                        <td class="text-left">
                                            <button
                                                wire:target="revokePermission, givePermission,editPermission, getPermissions"
                                                wire:loading.attr="disabled"
                                                wire:click.prevent="givePermission('{{ $freePermision->name }}')"
                                                class="btn btn-success">@lang('Assign')
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
