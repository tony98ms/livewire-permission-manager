<div class="fixed z-10 inset-0 overflow-y-auto ease-out duration-400">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>​
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full"
            role="dialog" aria-modal="true" aria-labelledby="modal-headline">
            <div class="border-b px-4 py-2 flex justify-between items-center bg-red-100">
                <h3 class="font-semibold text-lg">
                    @if ($editMode)
                        @lang('Update Role')
                    @else
                        @lang('Create Role')
                    @endif
                </h3>
                <button class="text-black close-modal" wire:click="resetModal">&cross;</button>
            </div>
            <form>
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="">
                        <div class="mb-4">
                            <label for="inputName" class="block text-gray-700 text-sm font-bold mb-2">@lang('Role
                                name')</label>
                            <input type="text"
                                class="appearance-none rounded border border-gray-200 border-b block w-full bg-white text-sm placeholder-gray-400 text-gray-700 focus:bg-white focus:placeholder-gray-600 focus:text-gray-700 focus:outline-none"
                                id="inputName" placeholder="@lang('Role name')" wire:model.refer="roleName">
                            @error('roleName') <span class="text-red-500">@lang($message)</span>@enderror
                        </div>
                        @if ($columnAdd)
                            <div class="mb-4">
                                <label for="inputDescription"
                                    class="block text-gray-700 text-sm font-bold mb-2">@lang('Description name')</label>
                                <input type="text"
                                    class="appearance-none rounded border border-gray-200 border-b block w-full bg-white text-sm placeholder-gray-400 text-gray-700 focus:bg-white focus:placeholder-gray-600 focus:text-gray-700 focus:outline-none"
                                    id="inputDescription" placeholder="@lang('Description name')"
                                    wire:model.refer="roleDescription">
                                @error('roleDescription') <span class="text-red-500">@lang($message)</span>@enderror
                            </div>
                        @endif
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                        @if ($editMode)
                            <button wire:target="editRole,updateRole" wire:loading.attr="disabled"
                                wire:click.prevent="updateRole()" type="button"
                                class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                                @lang('Update Role')
                            </button>
                        @else
                            <button
                                class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5"
                                wire:target="editRole,updateRole" wire:loading.attr="disabled"
                                wire:click.prevent="createRole()">@lang('Create
                                Role')</button>
                        @endif
                    </span>
            </form>
        </div>
    </div>
</div>
</div>
