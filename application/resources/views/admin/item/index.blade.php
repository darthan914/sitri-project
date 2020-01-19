{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Item List')

@section('js')
    <script>
        $(function () {
            let itemSelector = $('#item-list');
            let dataTableItem = itemSelector.DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('admin.item.dataTable') }}",
                    type: "get",
                },
                columns: [
                    {data: 'name'},
                    {data: 'value'},
                    {data: 'action', orderable: false, searchable: false, width: '6em'},
                ],
                paging: true,
                lengthChange: true,
                ordering: true,
                info: true,
                autoWidth: false
            });

            sweetAlertDelete(itemSelector, function () {
                dataTableItem.ajax.reload();
            });
        })
    </script>
@stop

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body text-right">
                    <a href="{{ route('admin.item.create') }}" class="btn btn-default">Create</a>
                </div>
                <div class="box-body">


                    <table id="item-list" class="table table-bordered table-hover dataTable">
                        <thead>
                        <tr role="row">
                            <th>
                                Nama Barang
                            </th>
                            <th>
                                Harga
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
