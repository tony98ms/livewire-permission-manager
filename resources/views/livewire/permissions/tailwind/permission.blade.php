<div>
    @if ($isOpen)
        @include('permissions::livewire.permissions.'.$theme.'.modals.'.$modalDesign)
    @endif
    <div class="p-2">
        <div class="flex flex-row mb-3 sm:mb-3 justify-between w-full">
            <div class="flex flex-row mb-1 sm:mb-0">
                <h2 class="text-sm uppercase px-2 py-2">Por pagina</h2>
                <div class="relative mx-1">
                    <select wire:model="perPage"
                        class="appearance-none h-full rounded-l border block appearance-none w-full bg-white border-gray-300 text-gray-700 py-2 px-4 pr-8 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                        @foreach ($perPages as $paginate)
                            <option>{{ $paginate }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="block relative">
                <span class="h-full absolute inset-y-0 left-0 flex items-center pl-2">
                    <svg viewBox="0 0 24 24" class="h-4 w-4 fill-current text-gray-500">
                        <path
                            d="M10 4a6 6 0 100 12 6 6 0 000-12zm-8 6a8 8 0 1114.32 4.906l5.387 5.387a1 1 0 01-1.414 1.414l-5.387-5.387A8 8 0 012 10z">
                        </path>
                    </svg>
                </span>
                <input placeholder="@lang('Search Role')..." wire:model="search"
                    class="appearance-none rounded border border-gray-200 border-b block pl-8 pr-6 py-2 w-full bg-white text-sm placeholder-gray-400 text-gray-700 focus:bg-white focus:placeholder-gray-600 focus:text-gray-700 focus:outline-none" />
            </div>
        </div>
        <div class="overflow-x-auto w-full">
            <table
                class='mx-auto w-full whitespace-nowrap rounded-lg bg-white divide-y divide-gray-300 overflow-hidden'>
                <thead class="bg-gray-900">
                    <tr class="text-white text-left">
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
                        @if ($columnAdd)
                            <th width="250" class="px-4 py-2 text-center ">
                                <a class="text-primary" wire:click.prevent="sortBy('{{ $columnName }}')"
                                    role="button" href="#">
                                    @lang('Description')
                                    @include('permissions::includes._sort-icon', ['field' => $columnName])
                                </a>
                            </th>
                        @endif
                        <th class="px-4 py-2 text-center "> @lang('Permissions')</th>
                        <th class="px-4 py-2 text-center" colspan="3"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-500">
                    @if ($roles->isNotEmpty())
                        @foreach ($roles as $role)
                            <tr>
                                <td width="100" class="bg-gray-100 text-center">{{ $role->id }}</td>
                                <td class="bg-gray-100">{{ $role->name }}</td>
                                @if ($this->columnAdd)
                                    <td class="bg-gray-100">{{ $role->description }}</td>
                                @endif
                                <td class="bg-gray-100">
                                    @foreach ($role->permissions as $singlePermission)
                                        <span
                                            class="rounded-full py-1 px-2 bg-purple-500 text-white font-extrabold text-sm">
                                            @isset($singlePermission[config('livewire-permission.column_name.description')])
                                                {{ $singlePermission[config('livewire-permission.column_name.description')] }}
                                            @else
                                                {{ $singlePermission->name }}
                                            @endisset
                                        </span>
                                    @endforeach
                                </td>
                                <td class="bg-gray-100 p-1" width="25">
                                    <button
                                        class="bg-blue-500 hover:bg-blue-700 transition-all p-2 rounded text-sm text-white font-weight"
                                        wire:click.prevent="$emit('editRole', {{ $role->id }})">
                                        <div class="flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="text-sm" width="24"
                                                height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-edit">
                                                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7">
                                                </path>
                                                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z">
                                                </path>
                                            </svg>
                                            @lang('Edit')
                                        </div>
                                    </button>

                                </td>
                                <td class="bg-gray-100 p-1" width="25">
                                    <button
                                        class="bg-green-500 hover:bg-green-700 transition-all p-2 rounded text-sm text-white font-weight"
                                        wire:click.prevent="editPermission('{{ $role->name }}')">
                                        <div class="flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-shield">
                                                <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                                            </svg>
                                            @lang('Permissions')
                                        </div>

                                    </button>

                                </td>
                                <td class="bg-gray-100 p-1" width="25">
                                    <button
                                        class="bg-red-500 hover:bg-red-700 transition-all p-2 rounded text-sm text-white font-weight"
                                        wire:click.prevent="$emit('confirmDelete', '{{ __('Are you sure you want to delete this role?') }}','deleteRole', {{ $role->id }})">
                                        <div class="flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
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

                                    </button>

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
        <div class="justify-content-lg-between my-2">
            <div>
                {{ $roles->links() }}
            </div>
        </div>
    </div>
</div>
