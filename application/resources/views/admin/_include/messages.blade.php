@if (session('success') || session('failed'))
@push('js')
    <script>
        window.setTimeout(function () {
            $(".row.session > .alert").fadeTo(700, 0).slideUp(700, function () {
                $(".row.session").remove();
            });
        }, 15000);
    </script>
@endpush
@endif

@if (session('success'))
    <div class="row session">
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-check"></i> Success!</h4>
            {{ session('success') }}
        </div>
    </div>
@endif

@if (session('failed'))
    <div class="row session">
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-times"></i> Failed!</h4>
            {{ session('failed') }}
        </div>
    </div>
@endif
