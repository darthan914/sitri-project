{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Schedule List')

@section('js')
    <script>
        $(function () {
            let scheduleSelector = $('#schedule-list');
            scheduleSelector.DataTable({
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
                searching: false,
                ordering: true,
                info: true,
                autoWidth: false
            });

            alertModal(scheduleSelector);
            activeModal(scheduleSelector);
        })
    </script>
@stop

@section('content')
    @include('admin._general.modal.alert')
    @include('admin._general.modal.alertActive')
    @include('admin.schedule.filter.index')

    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body">
                    <a href="{{ route('admin.schedule.create') }}" class="btn btn-default">Create</a>
                </div>
                <div class="box-body">


                    <table id="schedule-list" class="table table-bordered table-hover dataTable">
                        <thead>
                        <tr role="row">
                            <th>
                                Day
                            </th>
                            <th>
                                Start
                            </th>
                            <th>
                                End
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
