{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Class Schedule List')

@section('js')
    <script>
        $(function () {
            let classScheduleSelector = $('#classSchedule-list');
            classScheduleSelector.DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('admin.classSchedule.dataTable') }}",
                    type: "get",
                    data: {
                        f_search: $('*[name=f_search]').val(),
                        f_active: $('*[name=f_active]').val(),
                    },
                },
                columns: [
                    {data: 'class_room_id'},
                    {data: 'schedule_id'},
                    {data: 'active'},
                    {data: 'is_trial'},
                    {data: 'action', orderable: false, searchable: false, width: '6em'},
                ],
                paging: true,
                lengthChange: true,
                searching: false,
                ordering: true,
                info: true,
                autoWidth: false
            });

            alertModal(classScheduleSelector);
            activeModal(classScheduleSelector);
        })
    </script>
@stop

@section('content')
    @include('admin._general.modal.alert')
    @include('admin._general.modal.alertActive')
    @include('admin.classSchedule.filter.index')

    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body">
                    <a href="{{ route('admin.classSchedule.create') }}" class="btn btn-default">Create</a>
                </div>
                <div class="box-body">


                    <table id="classSchedule-list" class="table table-bordered table-hover dataTable">
                        <thead>
                        <tr role="row">
                            <th>
                                Class
                            </th>
                            <th>
                                Schedule
                            </th>
                            <th>
                                Active
                            </th>
                            <th>
                                Trial
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
