@extends(config('livewire-permission.blade.extends', 'layouts.app'))
@section(config('livewire-permission.blade.section', 'content'))
    <div>
        <livewire:permission />
    </div>
@endsection
