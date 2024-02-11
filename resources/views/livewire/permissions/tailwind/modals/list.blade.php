<div class="fixed z-50 inset-0 overflow-y-auto ease-out duration-400">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        <div class="inline-block align-bottom bg-white dark:bg-gray-800 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-7xl sm:w-full"
            role="dialog" aria-modal="true" aria-labelledby="modal-headline">
            <div class="border-b px-4 py-2 flex justify-between items-center bg-blue-600 dark:bg-gray-800">
                <h3 class="font-bold text-2xl text-white">
                    @lang('Permission Management')
                </h3>
                <button class="text-black close-modal" wire:click="resetModal">&cross;</button>
            </div>
            <h1 class="text-center text-blue-500 text-xl xl:text-4xl font-bold mt-1">@lang('Manage Permissions')
            </h1>
            <div class="w-full mx-4">
                <div class="flex items-center">
                    <h2 class="text-sm uppercase my-auto">@lang('Selected role'):</h2>
                    <div class="mx-1">
                        <select wire:model.live="role" wire:change="getPermissions()"
                            class="mt-2 block w-full rounded-md border-0 py-1.5 pl-3 pr-10 text-gray-900 ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-indigo-600 sm:text-sm sm:leading-6">
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
            <div class="px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="grid grid-cols-1 xl:grid-cols-2 gap-4">
                    <div class="border border-blue-400 rounded-lg p-1 w-full">
                        <h3 class="text-center text-blue-500 text-lg xl:text-4xl font-bold py-1">@lang('Assigned')</h3>
                        <table class="w-full">
                            <thead class="bg-blue-400 dark:bg-gray-900">
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
                                                class="bg-blue-500 p-2 rounded text-white font-bold transition-all duration-700 ease-in-out hover:bg-blue-600">@lang('Remove')
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="border border-blue-400 rounded-lg p-1 w-full">
                        <h3 class="text-center text-blue-500 text-lg xl:text-4xl font-bold py-1">@lang('Available at')
                        </h3>
                        <table class="w-full">
                            <thead class="bg-blue-400 dark:bg-gray-900">
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
