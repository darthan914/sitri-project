@push('js')
    <script>
        $(function () {
            @if(old('route') && 'active-modal' === old('modal'))
            $('#active-modal form').attr('action', '{{ old('route') }}');
            @endif
        });
    </script>
@endpush

<div id="active-modal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form class="form-horizontal form-label-left" action="#" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Failed update</h4>
                </div>
                <div class="modal-body">
                </div>
                <div class="modal-footer">
                    {{ csrf_field() }}
                    <input type="hidden" name="modal_error" value="active-modal">
                    <input type="hidden" name="active" class="name-changer" value="{{ old('active') }}">
                    <input type="hidden" name="route" value="{{ old('route') }}">
                    <input type="hidden" name="name" value="{{ old('name') }}">
                    <input type="hidden" name="modal_error" value="active-modal">
                    <button type="submit" class="btn btn-primary">Yes</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                </div>
            </form>
        </div>
    </div>
</div>
