{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Class Room List')

@section('js')
    <script>
        $(function () {
            let classRoomSelector = $('#classRoom-list');

            let dataTableClassRoom = classRoomSelector.DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('admin.classRoom.dataTable') }}",
                    type: "get",
                    data: {
                        f_search: $('*[name=f_search]').val(),
                        f_active: $('*[name=f_active]').val(),
                    },
                },
                columns: [
                    {data: 'name'},
                    {data: 'max_student'},
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

            sweetAlertActive(classRoomSelector, function () {
                dataTableClassRoom.ajax.reload();
            });
            sweetAlertDelete(classRoomSelector, function () {
                dataTableClassRoom.ajax.reload();
            });
        })
    </script>
@stop

@section('content')
{{--    @include('admin.classRoom.filter.index')--}}

    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body text-right">
                    <a href="{{ route('admin.classRoom.create') }}" class="btn btn-default">Create</a>
                </div>
                <div class="box-body">


                    <table id="classRoom-list" class="table table-bordered table-hover dataTable">
                        <thead>
                        <tr role="row">
                            <th>
                                Name
                            </th>
                            <th>
                                Max Student
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
