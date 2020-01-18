{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Student List')

@section('js')
    <script>
        $(function () {
            let studentSelector = $('#student-list');
            studentSelector.DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('admin.student.dataTable') }}",
                    type: "get",
                    data: {
                        f_search: $('*[name=f_search]').val(),
                    },
                },
                columns: [
                    {data: 'check', orderable: false},
                    {data: 'name'},
                    {data: 'age'},
                    {data: 'user.name'},
                    {data: 'action', orderable: false, searchable: false, width: '6em'},
                ],
                paging: true,
                lengthChange: true,
                ordering: true,
                info: true,
                autoWidth: false
            });

            sweetAlertDelete(studentSelector);
        })
    </script>
@stop

@section('content')
{{--    @include('admin.student.filter.index')--}}

    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body text-right">
                    <a href="{{ route('admin.student.create') }}" class="btn btn-default">Create</a>
                    <button class="btn btn-danger"
                            onclick="event.preventDefault(); if(confirm('Are you sure to delete this selected?')) {document.getElementById('action').submit();}">Delete
                        Selected
                    </button>
                    <form id="action"
                          action="{{ route('admin.student.deleteMultiple') }}"
                          method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </div>
                <div class="box-body">


                    <table id="student-list" class="table table-bordered table-hover dataTable">
                        <thead>
                        <tr role="row">
                            <th nowrap>
                                <label class="checkbox-inline"><input type="checkbox" data-target="check"
                                                                      class="check-all" id="check-all">S</label>
                            </th>
                            <th>
                                Nama Murid
                            </th>
                            <th>
                                Umur
                            </th>
                            <th>
                                Nama Orang tua
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
