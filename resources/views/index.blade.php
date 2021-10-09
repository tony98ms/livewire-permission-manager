@extends(config('livewire-permission.blade.extends', 'layouts.app'))
@section(config('livewire-permission.blade.section', 'content'))
    <div>
        <h1 class=" text-center font-weight-bold text-danger">@lang('Role Management')</h1>
        @livewire('permission')
    </div>
@endsection
