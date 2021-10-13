@extends(config('livewire-permission.blade-template.directives.extends', 'layouts.app'))
@section(config('livewire-permission.blade-template.directives.section', 'content'))
    <div>
        <h1 class=" text-center font-weight-bold text-danger">@lang('Role Management')</h1>
        <div>
            @livewire('role')
        </div>
        @livewire('permission')
    </div>
@endsection
@section('js')
    <script>
        Livewire.on('roleAdd', function() {
            $('#modelRole').modal('hide');
            $('#modalPermission').modal('show');
        });
        Livewire.on('roleUpdated', function() {
            $('#modelRole').modal('hide');
        });
    </script>
@endsection
