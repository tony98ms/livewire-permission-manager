<div>
    <script>
        Livewire.on('roleAdd', function() {
            $('#modelRole').modal('hide');
            $('#modalPermission').modal('show');
        });
        Livewire.on('roleUpdated', function() {
            $('#modelRole').modal('hide');
        });
    </script>
</div>
