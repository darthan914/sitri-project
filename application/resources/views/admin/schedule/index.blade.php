{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Schedule List')

@section('js')
    <script>
        $(function () {
            let scheduleSelector = $('#schedule-list');
            let dataTableSchedule = scheduleSelector.DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('admin.schedule.dataTable') }}",
                    type: "get",
                    data: {
                        f_search: $('*[name=f_search]').val(),
                        f_active: $('*[name=f_active]').val(),
                    },
                },
                columns: [
                    {data: 'day'},
                    {data: 'start_time'},
                    {data: 'end_time'},
                    {data: 'active'},
                    {data: 'action', orderable: false, searchable: false, width: '6em'},
                ],
                paging: true,
                lengthChange: true,
                ordering: true,
                info: true,
                autoWidth: false
            });

            sweetAlertDelete(scheduleSelector, function () {
                dataTableSchedule.ajax.reload();
            });

            sweetAlertActive(scheduleSelector, function () {
                dataTableSchedule.ajax.reload();
            });
        })
    </script>
@stop

@section('content')
{{--    @include('admin.schedule.filter.index')--}}

    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body text-right">
                    <a href="{{ route('admin.schedule.create') }}" class="btn btn-default">Create</a>
                </div>
                <div class="box-body">


                    <table id="schedule-list" class="table table-bordered table-hover dataTable">
                        <thead>
                        <tr role="row">
                            <th>
                                Hari
                            </th>
                            <th>
                                Jam Mulai
                            </th>
                            <th>
                                Jam Selesai
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
