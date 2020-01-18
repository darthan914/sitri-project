{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'User List')

@section('js')
    <script>
        $(function () {
            let userSelector = $('#user-list');
            let dataTableUser = userSelector.DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('admin.user.dataTable') }}",
                    type: "get",
                    data: {
                        f_active: $('*[name=f_active]').val(),
                    },
                },
                columns: [
                    {data: 'name'},
                    {data: 'email'},
                    {data: 'active'},
                    {data: 'action', orderable: false, searchable: false, width: '6em'},
                ],
                paging: true,
                lengthChange: true,
                ordering: true,
                info: true,
                autoWidth: false
            });

            sweetAlertActive(userSelector, function () {dataTableUser.ajax.reload()});
            sweetAlertDelete(userSelector, function () {dataTableUser.ajax.reload()});
        })
    </script>
@stop

@section('content')
{{--    @include('admin.user.filter.index')--}}

    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body">
                    <a href="{{ route('admin.user.create') }}" class="btn btn-default pull-right">Create</a>
                </div>
                <div class="box-body">
                    <table id="user-list" class="table table-bordered table-hover dataTable">
                        <thead>
                        <tr role="row">
                            <th>
                                Name
                            </th>
                            <th>
                                Email
                            </th>
                            <th>
                                Active
                            </th>
                            <th>

                            </th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop
