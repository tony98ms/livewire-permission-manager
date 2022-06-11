<div>
    @php
        $hola = config('livewire-permission.theme', 'bootstrap');
    @endphp
    @include("permissions::livewire.permissions.$hola.modals.createrole")
    <div class="row mb-2">
        <div class="col-lg-3">
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modelRole"><i
                    class="fas fa-plus-circle"></i> @lang('Create Role')</button>
        </div>
    </div>
</div>
