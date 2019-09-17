@extends('adminlte::page')

@section('title')
    {{ $student->user->name }} - {{ $student->name }}
@stop

@section('js')
    <script>
        $(function () {
            let classScheduleSelector = $('#classSchedule-list');
            $('#classSchedule-list').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('admin.classSchedule.dataTable') }}",
                    type: "get",
                    data: {
                        f_student: '{{ $student->id }}',
                        f_active: 1,
                    },
                },
                columns: [
                    {data: 'class_room_id'},
                    {data: 'schedule_id'},
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

            let rescheduleSelector = $('#reschedule-list');
            rescheduleSelector.DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('admin.reschedule.dataTable') }}",
                    type: "get",
                    data: {
                        f_student: '{{ $student->id }}',
                    },
                },
                columns: [
                    {data: 'from_date'},
                    {data: 'to_date'},
                    {data: 'action', orderable: false, searchable: false, width: '6em'},
                ],
                paging: true,
                lengthChange: true,
                searching: false,
                ordering: true,
                info: true,
                autoWidth: false
            });
            alertModal(rescheduleSelector);

            let paymentSelector = $('#payment-list');
            paymentSelector.DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('admin.payment.dataTable') }}",
                    type: "get",
                    data: {
                        f_student: '{{ $student->id }}',
                    },
                },
                columns: [
                    {data: 'no_payment'},
                    {data: 'value'},
                    {data: 'date_paid'},
                    {data: 'action', orderable: false, searchable: false, width: '6em'},
                ],
                paging: true,
                lengthChange: true,
                searching: false,
                ordering: true,
                info: true,
                autoWidth: false
            });

            alertModal(paymentSelector);
            activeModal(paymentSelector);
        })
    </script>
@stop

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <h2>Information</h2>
                <table class="table table-bordered">
                    <tr>
                        <th>Student Name :</th>
                        <td>{{ $student->name }}</td>
                    </tr>
                    <tr>
                        <th>Parent Name :</th>
                        <td>{{ $student->user->name }}</td>
                    </tr>
                </table>
            </div>

            <div class="box">
                <h2>Regular Schedule</h2>
                <div class="box-body">
                    <table class="table table-bordered" id="classSchedule-list">
                        <thead>
                        <tr>
                            <th>Class Name</th>
                            <th>Schedule</th>
                            <th></th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>

            <div class="box">
                <h2>Reschedule</h2>
                <div class="box-body">
                    <a href="{{ route('admin.reschedule.create', ['student_id' => $student->id]) }}" class="btn btn-default">Create</a>
                </div>
                <div class="box-body">
                    <table class="table table-bordered" id="reschedule-list">
                        <thead>
                        <tr>
                            <th>From</th>
                            <th>To</th>
                            <th></th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>

            <div class="box">
                <h2>Payment</h2>
                <div class="box-body">
                    <table class="table table-bordered" id="payment-list">
                        <thead>
                        <tr>
                            <th>No. Payment</th>
                            <th>Value</th>
                            <th>Paid</th>
                            <th></th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>

        </div>
    </div>
@stop
