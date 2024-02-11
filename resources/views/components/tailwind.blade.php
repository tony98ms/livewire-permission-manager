@php
    $componetName = config('livewire-permission.blade-template.component');
@endphp
<x-dynamic-component :component="$componetName">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div>
        <div class="py-12">
            <div class="mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-900 overflow-hidden shadow-xl rounded-lg px-4 py-4 my-2">
                    <div>
                        @livewire('role')
                    </div>
                    @livewire('permission')
                </div>
            </div>
        </div>
    </div>
</x-dynamic-component>
