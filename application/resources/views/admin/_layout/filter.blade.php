<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-body">
                <div class="filter-content" style="display: none">
                    <form method="get">
                        <div class="box-body">
                            @yield('input')
                        </div>
                        <div class="box-footer text-right">
                            <input type="hidden" name="tab" value="{{ $request->tab }}">
                            <button type="reset" class="btn btn-default">Reset</button>
                            <button type="submit" class="btn btn-primary">Filter</button>
                        </div>
                    </form>
                </div>
                <button type="button" class="btn btn-info btn-block btn-sm filter-button">Open Filter</button>
            </div>
        </div>
    </div>
</div>
