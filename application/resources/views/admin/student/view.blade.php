@extends('adminlte::page')

@section('title')
    {{ $student->user->name }} - {{ $student->name }}
@stop

@section('js')
    <script>
        $(function () {
            let classScheduleSelector = $('#classSchedule-list');
            classScheduleSelector.DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('admin.classStudent.dataTable') }}",
                    type: "get",
                    data: {
                        f_student: '{{ $student->id }}',
                        f_active: 1,
                    },
                },
                columns: [
                    {data: 'class_schedule_id'},
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
    @include('admin._general.modal.alert')
    @include('admin._general.modal.alertActive')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <h2>Information</h2>
                <table class="table table-bordered">
                    <tr>
                        <th>Nama Murid :</th>
                        <td>{{ $student->name }}</td>
                    </tr>
                    <tr>
                        <th>Nama Orang tua :</th>
                        <td>{{ $student->user->name }}</td>
                    </tr>
                </table>
            </div>

            <div class="box">
                <h2>Jadwal reguler</h2>
                <div class="box-body">
                    <a href="{{ route('admin.classStudent.create', ['student_id' => $student->id]) }}" class="btn btn-default">Create</a>
                </div>
                <div class="box-body">
                    <table class="table table-bordered" id="classSchedule-list">
                        <thead>
                        <tr>
                            <th>Kelas</th>
                            <th></th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>

            <div class="box">
                <h2>Pindah jadwal</h2>
                <div class="box-body">
                    <a href="{{ route('admin.reschedule.create', ['student_id' => $student->id]) }}" class="btn btn-default">Create</a>
                </div>
                <div class="box-body">
                    <table class="table table-bordered" id="reschedule-list">
                        <thead>
                        <tr>
                            <th>Dari</th>
                            <th>Pindah ke</th>
                            <th></th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>

            <div class="box">
                <h2>Pembayaran</h2>
                <div class="box-body">
                    <table class="table table-bordered" id="payment-list">
                        <thead>
                        <tr>
                            <th>No. Pembayaran</th>
                            <th>Tagihan</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>

        </div>
    </div>
@stop
