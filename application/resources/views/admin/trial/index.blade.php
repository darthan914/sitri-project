{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Trial List')

@section('js')
    <script>
        $(function () {
            let trialSelector = $('#trial-list');
            let dataTableTrial = trialSelector.DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('admin.trial.dataTable') }}",
                    type: "get",
                    data: {
                        f_search: $('*[name=f_search]').val(),
                    },
                },
                columns: [
                    {data: 'name'},
                    {data: 'user.name'},
                    {data: 'class_student.class_schedule.class_info'},
                    {data: 'class_student.teacher_name'},
                    {data: 'action', orderable: false, searchable: false, width: '6em'},
                ],
                paging: true,
                lengthChange: true,
                ordering: true,
                info: true,
                autoWidth: false
            });

            sweetAlertDelete(trialSelector, function () {
                dataTableTrial.ajax.reload();
            });
        })
    </script>
@stop

@section('content')
    {{--    @include('admin.trial.filter.index')--}}

    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body text-right">
                    <a href="{{ route('admin.trial.create') }}" class="btn btn-default">Create</a>
                </div>
                <div class="box-body">


                    <table id="trial-list" class="table table-bordered table-hover dataTable">
                        <thead>
                        <tr role="row">
                            <th>
                                Murid
                            </th>
                            <th>
                                Orang tua
                            </th>
                            <th>
                                Jadwal Kelas
                            </th>
                            <th>
                                Dibimbing
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
