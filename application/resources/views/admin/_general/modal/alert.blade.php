<div id="alert-modal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form class="form-horizontal form-label-left" action="#" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">
                </div>
                <div class="modal-footer">
                    {{ csrf_field() }}
                    <input type="hidden" name="modal_error" value="alert-modal">
                    <button type="submit" class="btn btn-primary">Yes</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                </div>
            </form>
        </div>
    </div>
</div>
