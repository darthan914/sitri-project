{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Class Student List')

@section('js')
    <script>
        $(function () {
            let classStudentSelector = $('#classStudent-list');
            let dataTableClassStudent = classStudentSelector.DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('admin.classStudent.dataTable') }}",
                    type: "get",
                    data: {
                        f_search: $('*[name=f_search]').val(),
                        f_active: $('*[name=f_active]').val(),
                    },
                },
                columns: [
                    {data: 'class_schedule.class_info'},
                    {data: 'student.name'},
                    {data: 'teacher_name'},
                    {data: 'action', orderable: false, searchable: false, width: '6em'},
                ],
                paging: true,
                lengthChange: true,
                ordering: true,
                info: true,
                autoWidth: false
            });

            sweetAlertDelete(classStudentSelector, function () {
                dataTableClassStudent.ajax.reload();
            });
        })
    </script>
@stop

@section('content')
{{--    @include('admin.classStudent.filter.index')--}}

    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body text-right">
                    <a href="{{ route('admin.classStudent.create') }}" class="btn btn-default">Create</a>
                </div>
                <div class="box-body">


                    <table id="classStudent-list" class="table table-bordered table-hover dataTable">
                        <thead>
                        <tr role="row">
                            <th>
                                Jadwal Kelas
                            </th>
                            <th>
                                Murid
                            </th>
                            <th>
                                Guru
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
