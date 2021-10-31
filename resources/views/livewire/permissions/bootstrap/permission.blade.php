<div>
    @include('permissions::livewire.permissions.'.$theme.'.modals.'.$modalDesign)
    <div class="card">
        <div class="card-body">
            <div class="row mb-4 justify-content-between">
                <div class="col-lg-4 form-inline col-sm-12 mb-lg-0 mb-1">
                    @lang('Per Page'): &nbsp;
                    <select wire:model="perPage" class="form-control form-control-sm">
                        @foreach ($perPages as $paginate)
                            <option>{{ $paginate }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-lg-3 col-sm-12 mb-lg-0 mb-1">
                    <input wire:model="search" class="form-control" type="text" placeholder="@lang('Search Role')...">
                </div>
            </div>
            <div class="row table-responsive">
                <table class="table table-striped table-sortable table-bordered">
                    <thead>
                        <tr>
                            <th width="100" class="px-4 py-2 text-center" role="button"
                                wire:click.prevent="sortBy('id')">
                                @lang('ID')
                                @include('permissions::includes._sort-icon', ['field' => 'id'])
                            </th>
                            <th width="150" class="px-4 py-2 text-center " wire:click.prevent="sortBy('name')"
                                role="button">
                                @lang('Role')
                                @include('permissions::includes._sort-icon', ['field' => 'name'])
                            </th>
                            @if ($columnAdd)
                                <th width="250" class="px-4 py-2 text-center "
                                    wire:click.prevent="sortBy('{{ $columnName }}')" role="button">
                                    @lang('Description')
                                    @include('permissions::includes._sort-icon', ['field' => $columnName])
                                </th>
                            @endif
                            <th class="px-4 py-2 text-center "> @lang('Permissions')</th>
                            <th class="px-4 py-2 text-center" colspan="3"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($roles->isNotEmpty())
                            @foreach ($roles as $role)
                                <tr>
                                    <td width="100" class="p-1 text-center  text-dark">{{ $role->id }}</td>
                                    <td class="p-1 text-center text-dark">{{ $role->name }}</td>
                                    @if ($this->columnAdd)
                                        <td class="p-1 text-center text-dark">{{ $role->description }}</td>
                                    @endif
                                    <td class="p-1  text-dark">
                                        @foreach ($role->permissions as $singlePermission)
                                            <span class="text-capitalize badge badge-info mb-1">
                                                @if ($singlePermission[config('livewire-permission.column_name.description')])
                                                    {{ $singlePermission[config('livewire-permission.column_name.description')] }}
                                                @else
                                                    {{ $singlePermission->name }}
                                                @endif
                                            </span>
                                        @endforeach
                                    </td>
                                    <td class="p-1 text-center" width="25">
                                        <a class="btn btn-sm btn-warning" data-toggle="modal" data-target="#modelRole"
                                            wire:click.prevent="$emit('editRole', {{ $role->id }})">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="text-sm" width="24"
                                                height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-edit">
                                                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7">
                                                </path>
                                                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z">
                                                </path>
                                            </svg>@lang('Edit')
                                        </a>
                                    </td>
                                    <td class="p-1 text-center" width="25">
                                        <a class="btn btn-sm btn-primary" data-toggle="modal"
                                            data-target="#modalPermission"
                                            wire:click.prevent="editPermission('{{ $role->name }}')">
                                            <div class="flex items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-shield">
                                                    <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                                                </svg>
                                                @lang('Permissions')
                                            </div>
                                        </a>
                                    </td>
                                    <td class="p-1 text-center" width="25">
                                        <a class="btn btn-sm btn-danger"
                                            wire:click.prevent="$emit('confirmDelete', '{{ __('Are you sure you want to delete this role?') }}','deleteRole', {{ $role->id }})">
                                            <div class="flex items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-trash-2">
                                                    <polyline points="3 6 5 6 21 6"></polyline>
                                                    <path
                                                        d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                                    </path>
                                                    <line x1="10" y1="11" x2="10" y2="17"></line>
                                                    <line x1="14" y1="11" x2="14" y2="17"></line>
                                                </svg>
                                                @lang('Remove')
                                            </div>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="10">
                                    <p class="text-center">@lang('No result for your search')
                                        <strong>{{ $search }}</strong> @lang('on page')
                                        <strong>{{ $page }}</strong> @lang('displaying')
                                        <strong>{{ $perPage }}
                                        </strong> @lang('per page')
                                    </p>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
            <div class="row justify-content-lg-between">
                <div class="col-lg-6 col-sm-12 text-center">
                    {{ $roles->links() }}
                </div>
                <div class="col-lg-6 col-sm-12 text-right text-mute text-centerd">
                    @lang('Show') {{ $roles->firstItem() }} @lang('to') {{ $roles->lastItem() }} @lang('of')
                    {{ $roles->total() }}
                    @lang('records')
                </div>
            </div>
        </div>
    </div>
</div>
