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
    @endif
    <script>
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
