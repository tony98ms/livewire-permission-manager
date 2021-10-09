<div>
    @include('permissions::livewire.permissions.'.$theme.'.modals.'.$modalDesign)
    <div class="card">
        <div class="card-body">
            <div class="row mb-4 justify-content-between">
                <div class="col-lg-4 form-inline col-sm-12 mb-lg-0 mb-1">
                    @lang('Per Page'): &nbsp;
                    <select wire:model="perPage" class="form-control form-control-sm">
                        <option>10</option>
                        <option>15</option>
                        <option>25</option>
                    </select>
                </div>
                <div class="col-lg-3 col-sm-12 mb-lg-0 mb-1">
                    <input wire:model="search" class="form-control" type="text" placeholder="@lang('Search Role')...">
                </div>
            </div>
            <div class="row table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th width="100" class="px-4 py-2 text-center ">
                                <a class="text-primary" wire:click.prevent="sortBy('id')" role="button" href="#">
                                    @lang('ID')
                                    @include('permissions::includes._sort-icon', ['field' => 'id'])
                                </a>
                            </th>
                            <th width="150" class="px-4 py-2 text-center ">
                                <a class="text-primary" wire:click.prevent="sortBy('name')" role="button" href="#">
                                    @lang('Role')
                                    @include('permissions::includes._sort-icon', ['field' => 'name'])
                                </a>
                            </th>
                            @isset($this->columnName)
                                <th width="250" class="px-4 py-2 text-center ">
                                    <a class="text-primary" wire:click.prevent="sortBy('description')" role="button"
                                        href="#">
                                        @lang('Description')
                                        @include('permissions::includes._sort-icon', ['field' => 'description'])
                                    </a>
                                </th>
                            @endisset
                            <th class="px-4 py-2 text-center "> @lang('Permissions')</th>
                            <th class="px-4 py-2 text-center"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($roles->isNotEmpty())
                            @foreach ($roles as $role)
                                <tr>
                                    <td width="100" class="p-1 text-center  text-dark">{{ $role->id }}</td>
                                    <td class="p-1 text-center  text-dark">{{ $role->name }}</td>
                                    @isset($this->columnName)
                                        <td class="p-1 text-center  text-dark">{{ $role->description }}</td>
                                    @endisset
                                    <td class="p-1  text-dark">
                                        @foreach ($role->permissions as $singlePermission)
                                            <span class="text-capitalize badge badge-info mb-1">
                                                @isset($singlePermission[config('livewire-permission.column_name.description')])
                                                    {{ $singlePermission[config('livewire-permission.column_name.description')] }}
                                                @else
                                                    {{ $singlePermission->name }}
                                                @endisset
                                            </span>
                                        @endforeach
                                    </td>
                                    <td class="p-1 text-center" width="25">
                                        <a class="btn btn-sm btn-warning text-dark" data-toggle="modal"
                                            data-target="#modalPermission"
                                            wire:click.prevent="editPermission('{{ $role->name }}')">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="10">
                                    <p class="text-center">No hay resultado para la busqueda
                                        <strong>{{ $search }}</strong> en la pagina
                                        <strong>{{ $page }}</strong> al mostrar <strong>{{ $perPage }}
                                        </strong> por pagina
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
