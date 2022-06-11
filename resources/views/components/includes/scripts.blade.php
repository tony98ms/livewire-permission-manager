<div>
    @if (config('livewire-permission.theme') == 'bootstrap')
        <script>
            Livewire.on('roleAdd', function() {
                $('#modelRole').modal('hide');
                $('#modalPermission').modal('show');
            });
            Livewire.on('roleUpdated', function() {
                $('#modelRole').modal('hide');
            });
        </script>
    @elseif (config('livewire-permission.theme') == 'bootstrap5')
        <script>
            let roleModal = document.getElementById('modelRole');
            var role = new bootstrap.Modal(roleModal, {
                keyboard: false,
                backdrop: 'static'
            });
            Livewire.on('showBootstrapModal', () => {
                role.show();
            });
            // Livewire.on('hideModal', () => {
            //     role.hide();
            // });
            let permissionModal = document.getElementById('modalPermission');
            var permission = new bootstrap.Modal(permissionModal, {
                keyboard: false,
                backdrop: 'static'
            });
            Livewire.on('showPermissionModal', () => {
                permission.show();
            });
            Livewire.on('hideModal', () => {
                role.hide();
                permission.hide();
            });
        </script>
    @endif
    <script>
        console.log('Hola');
        Livewire.on('confirmDelete', function(title, metodo, id) {
            Swal.fire({
                title: title,
                text: "{{ __('This action can no longer be reversed!') }}",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: "{{ __('Yes, Trash!') }}",
                cancelButtonText: "{{ __('Cancel') }}",
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.emit(metodo, id)
                }
            });
        });
    </script>
</div>
