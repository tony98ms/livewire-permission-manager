<!-- Modal -->
<div wire:ignore.self class="modal fade" id="modelRole" data-bs-backdrop="static" data-bs-keyboard="false"
    tabindex="-1" aria-labelledby="modelRoleLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-dark" id="modelRoleTitle">
                    @if ($editMode)
                        @lang('Update Role')
                    @else
                        @lang('Create Role')
                    @endif
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="form-group col">
                        <label for="">@lang('Role name')</label>
                        <input type="text" class="form-control" wire:model.refer="roleName"
                            placeholder="@lang('Role name')">
                        @error('roleName')
                            <p class="error-message text-danger font-weight-bold">@lang($message)</p>
                        @enderror
                    </div>
                    @if ($columnAdd)
                        <div class="form-group col-12">
                            <label for="">@lang('Description name')</label>
                            <input type="text" class="form-control" wire:model.refer="roleDescription"
                                placeholder="@lang('Description name')">
                            @error('roleDescription')
                                <p class="error-message text-danger font-weight-bold">@lang($message)</p>
                            @enderror
                        </div>
                    @endif
                </div>
                <div class="row justify-content-center mt-1">
                    <div class="col-lg-12">
                        @if ($editMode)
                            <button class="btn btn-info" wire:target="editRole,updateRole"
                                wire:loading.attr="disabled"
                                wire:click.prevent="updateRole()">@lang('Update Role')</button>
                        @else
                            <button class="btn btn-warning" wire:target="editRole,updateRole"
                                wire:loading.attr="disabled"
                                wire:click.prevent="createRole()">@lang('Create Role')</button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
