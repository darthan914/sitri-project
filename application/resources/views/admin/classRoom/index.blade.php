{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Class Room List')

@section('js')
    <script>
        $(function () {
            $('#classRoom-list').DataTable({
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
                    {data: 'active'},
                    {data: 'action', orderable: false, searchable: false, width: '6em'},
                ],
                paging: true,
                lengthChange: true,
                searching: false,
                ordering: true,
                info: true,
                autoWidth: false
            }).on('click', '.alert-modal', function () {
                $('#alert-modal form').attr('action', $(this).data('route'));
                $('#alert-modal .modal-title').html($(this).data('title'));
            }).on('click', '.alertActive-modal', function () {
                $('#alertActive-modal form').attr('action', $(this).data('route'));
                $('#alertActive-modal input[name=route]').val($(this).data('route'));
                $('#alertActive-modal input[name=active]').val($(this).data('active'));
                $('#alertActive-modal .modal-title').html($(this).data('title'));
            })
        })
    </script>
@stop

@section('content')
    @include('admin._general.modal.alert')
    @include('admin._general.modal.alertActive')
    @include('admin.classRoom.filter.index')

    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body">
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
