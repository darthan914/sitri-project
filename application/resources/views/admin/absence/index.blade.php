{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Absence List')

@section('js')
    <script>
        $(function () {
            let absenceSelector = $('#absence-list');
            let dataTableAbsence = absenceSelector.DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('admin.absence.dataTable') }}",
                    type: "get",
                    data: {
                    },
                },
                columns: [
                    {data: 'class_schedule.class_info'},
                    {data: 'date'},
                    {data: 'action', orderable: false, searchable: false, width: '6em'},
                ],
                paging: true,
                lengthChange: true,
                searching: false,
                ordering: true,
                info: true,
                autoWidth: false
            });

            sweetAlertDelete(absenceSelector, function () {
                dataTableAbsence.ajax.reload();
            });

        })
    </script>
@stop

@section('content')
    @include('admin._general.modal.alert')
    @include('admin._general.modal.alertActive')

    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body text-right">
                    <a href="{{ route('admin.absence.create') }}" class="btn btn-default">Create</a>
                </div>
                <div class="box-body">


                    <table id="absence-list" class="table table-bordered table-hover dataTable">
                        <thead>
                        <tr role="row">
                            <th>
                                Class
                            </th>
                            <th>
                                Date
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
