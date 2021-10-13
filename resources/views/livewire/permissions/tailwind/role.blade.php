<div>
    @if ($isOpen)
        @include('permissions::livewire.permissions.tailwind.modals.createrole')
    @endif
    <h1 class="font-bold text-red-500 text-5xl text-gray-800 leading-tight text-center ">@lang('Role Management')</h1>
    <button class="bg-red-600 p-2 rounded font-bold text-white show-modal  hover:bg-red-400 hover:text-black-800"
        wire:click="$set('isOpen', true)"><i class="fas fa-plus-circle"></i>
        @lang('Create Role')</button>

</div>
