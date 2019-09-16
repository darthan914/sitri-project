{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Payment List')

@section('js')
    <script>
        $(function () {
            let paymentSelector = $('#payment-list');
            paymentSelector.DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('admin.payment.dataTable') }}",
                    type: "get",
                    data: {
                        f_search: $('*[name=f_search]').val(),
                        f_paid: $('*[name=f_paid]').val(),
                    },
                },
                columns: [
                    {data: 'no_payment'},
                    {data: 'student_id'},
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
    @include('admin.payment.filter.index')

    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body">
                    <a href="{{ route('admin.payment.create') }}" class="btn btn-default">Create</a>
                </div>
                <div class="box-body">


                    <table id="payment-list" class="table table-bordered table-hover dataTable">
                        <thead>
                        <tr role="row">
                            <th>
                                No Payment
                            </th>
                            <th>
                                Student
                            </th>
                            <th>
                                Value
                            </th>
                            <th>
                                Date Paid
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
