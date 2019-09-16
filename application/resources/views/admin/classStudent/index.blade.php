{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Class Student List')

@section('js')
    <script>
        $(function () {
            let classStudentSelector = $('#classStudent-list');
            classStudentSelector.DataTable({
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
                    {data: 'class_schedule_id'},
                    {data: 'student_id'},
                    {data: 'action', orderable: false, searchable: false, width: '6em'},
                ],
                paging: true,
                lengthChange: true,
                searching: false,
                ordering: true,
                info: true,
                autoWidth: false
            });

            alertModal(classStudentSelector);
            activeModal(classStudentSelector);
        })
    </script>
@stop

@section('content')
    @include('admin._general.modal.alert')
    @include('admin._general.modal.alertActive')
    @include('admin.classStudent.filter.index')

    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body">
                    <a href="{{ route('admin.classStudent.create') }}" class="btn btn-default">Create</a>
                </div>
                <div class="box-body">


                    <table id="classStudent-list" class="table table-bordered table-hover dataTable">
                        <thead>
                        <tr role="row">
                            <th>
                                Class Schedule
                            </th>
                            <th>
                                Student
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
