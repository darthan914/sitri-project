{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Payment List')

@section('js')
    <script>
        $(function () {
            let paymentSelector = $('#payment-list');
            let dataTablePayment =paymentSelector.DataTable({
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
                    {data: 'student.name'},
                    {data: 'total'},
                    {data: 'status_payment'},
                    {data: 'action', orderable: false, searchable: false, width: '6em'},
                ],
                paging: true,
                lengthChange: true,
                ordering: true,
                info: true,
                autoWidth: false
            });

            sweetAlertDateActive(paymentSelector, function () {
                dataTablePayment.ajax.reload();
            });
            sweetAlertDelete(paymentSelector, function () {
                dataTablePayment.ajax.reload();
            });
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
                <div class="box-body text-right">
                    <a href="{{ route('admin.payment.create') }}" class="btn btn-default">Create</a>
                </div>
                <div class="box-body">


                    <table id="payment-list" class="table table-bordered table-hover dataTable">
                        <thead>
                        <tr role="row">
                            <th>
                                No Invoice
                            </th>
                            <th>
                                Murid
                            </th>
                            <th>
                                Jumlah Tagihan
                            </th>
                            <th>
                                Tanggal Bayar
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
