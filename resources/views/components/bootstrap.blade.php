@php
$componetName = config('livewire-permission.blade-template.component');
@endphp
<x-dynamic-component :component="$componetName">
    <div>
        <h1 class="text-center font-weight-bold text-danger">@lang('Role Management')</h1>
        <div>
            @livewire('role')
        </div>
        @livewire('permission')
    </div>
</x-dynamic-component>
