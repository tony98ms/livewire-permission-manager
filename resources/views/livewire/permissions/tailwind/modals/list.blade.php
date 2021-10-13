<div class="fixed z-10 inset-0 overflow-y-auto ease-out duration-400">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-7xl sm:w-full"
            role="dialog" aria-modal="true" aria-labelledby="modal-headline">
            <div class="border-b px-4 py-2 flex justify-between items-center bg-red-200">
                <h3 class="font-bold text-2xl">
                    @lang('Permission Management')
                </h3>
                <button class="text-black close-modal" wire:click="resetModal">&cross;</button>
            </div>
            <h1 class="text-center text-red-500 text-xl xl:text-4xl font-bold mt-1">@lang('Manage Permissions')
            </h1>
            <div class="flex flex-row mb-3 sm:mb-3 justify-between w-full px-4 pt-5 pb-2">
                <div class="flex flex-row mb-1 sm:mb-0">
                    <h2 class="text-sm uppercase px-2 py-2">@lang('Selected
                        role')</h2>
                    <div class="relative mx-1">
                        <select wire:model="role" wire:change="getPermissions()"
                            class="appearance-none h-full rounded-l border block appearance-none w-full bg-white border-gray-300 text-gray-700 py-2 px-4 pr-8 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
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
                </div>
            </div>
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="grid grid-cols-1 xl:grid-cols-2 gap-4">
                    <div class="border border-red-400 rounded-b-lg p-1 w-full">
                        <h3 class="text-center text-red-500 text-lg xl:text-4xl font-bold py-1">@lang('Assigned')</h3>
                        <table class="w-full">
                            <thead class="bg-gray-200">
                                <tr>
                                    <th width="70%" class="p-2 m-1 px-4 py-2">@lang('Permission')</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-500">
                                @foreach ($permissionsByRole as $modalPermission)
                                    <tr>
                                        <td class="capitalize p-2 w-1/4">
                                            @isset($modalPermission[config('livewire-permission.column_name.description')])
                                                {{ $modalPermission[config('livewire-permission.column_name.description')] }}
                                            @else
                                                {{ $modalPermission->name }}
                                            @endisset
                                        </td>
                                        <td width="25" class="text-right p-2">
                                            <button
                                                wire:target="revokePermission, givePermission, editPermission, getPermissions"
                                                wire:loading.attr="disabled" wire:loading.class="disabled:opacity-50"
                                                wire:click.prevent="revokePermission('{{ $modalPermission->name }}')"
                                                class="bg-red-500 p-2 rounded text-white font-bold transition-all duration-700 ease-in-out hover:bg-red-600">@lang('Remove')
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="border border-red-400 rounded-b-lg p-1 w-full">
                        <h3 class="text-center text-red-500 text-lg xl:text-4xl font-bold py-1">@lang('Available at')
                        </h3>
                        <table class="w-full">
                            <thead class="bg-gray-200">
                                <tr>
                                    <th width="70%" class="p-2 m-1 px-4 py-2">@lang('Permission')</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-500">
                                @foreach ($freePermissions as $freePermision)
                                    <tr>
                                        <td class="capitalize p-2 w-1/4">
                                            @isset($freePermision[config('livewire-permission.column_name.description')])
                                                {{ $freePermision[config('livewire-permission.column_name.description')] }}
                                            @else
                                                {{ $freePermision->name }}
                                            @endisset
                                        </td>
                                        <td class="text-right p-2">
                                            <button
                                                wire:target="revokePermission, givePermission,editPermission, getPermissions"
                                                wire:loading.attr="disabled" wire:loading.class="disabled:opacity-50"
                                                wire:click.prevent="givePermission('{{ $freePermision->name }}')"
                                                class="transition-all duration-700 ease-in-out bg-green-500 p-2 rounded text-white font-bold hover:bg-green-600">@lang('Assign')
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
