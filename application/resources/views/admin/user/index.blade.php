{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'User List')

@section('js')
    <script>
        $(function () {
            let userSelector = $('#user-list');
            userSelector.DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('admin.user.dataTable') }}",
                    type: "get",
                    data: {
                        f_search: $('*[name=f_search]').val(),
                        f_active: $('*[name=f_active]').val(),
                    },
                },
                columns: [
                    {data: 'name'},
                    {data: 'active'},
                    {data: 'action', orderable: false, searchable: false, width: '6em'},
                ],
                paging: true,
                lengthChange: true,
                searching: false,
                ordering: true,
                info: true,
                autoWidth: false
            });

            alertModal(userSelector);
            activeModal(userSelector);
        })
    </script>
@stop

@section('content')
    @include('admin._general.modal.alert')
    @include('admin._general.modal.alertActive')
    @include('admin.user.filter.index')

    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body">
                    <a href="{{ route('admin.user.create') }}" class="btn btn-default">Create</a>
                </div>
                <div class="box-body">


                    <table id="user-list" class="table table-bordered table-hover dataTable">
                        <thead>
                        <tr role="row">
                            <th>
                                Information
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
