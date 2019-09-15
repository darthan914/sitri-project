@extends('adminlte::page')

@section('title')
    Create Payment
@stop

@section('js')
@stop

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <form class="form-horizontal" method="post" action="{{ route('admin.payment.store') }}">
                    <div class="box-body">
                        <div class="form-group @if($errors->first('code')) has-error @endif">
                            <label for="code" class="col-sm-2 control-label">Code</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="code" name="code"
                                       placeholder="Code"
                                       value="{{ old('code') }}">
                                <span class="help-block">{{ $errors->first('code') }}</span>
                            </div>
                        </div>

                        <div class="student-list">
                            <table class="table table-bordered table-hover table-striped">
                                <thead>
                                <tr>
                                    <th>Student</th>
                                    <th>Status</th>
                                    <th>
                                        <label class="checkbox-inline">
                                            <input type="checkbox"
                                                   class="check-all"
                                                   data-target="check-payment"
                                                   value="1"> Check All
                                        </label>
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($students as $student)
                                    <tr>
                                        <td>{{ $student->name }} - {{ $student->user->name }}</td>
                                        <td>
                                            <input class="form-control" type="number" name="value[{{ $student->id }}]"
                                                   value="{{ old('value.' . $student->id, 1000000) }}">
                                        </td>
                                        <td>
                                            <label class="checkbox-inline">
                                                <input type="checkbox"
                                                       class="check-payment"
                                                       name="check[{{ $student->id }}]"
                                                       @if(old('check.' . $student->id) == 1) checked @endif
                                                       value="1"> Add to payment
                                            </label>

                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-info pull-right">Create</button>
                        <a href="{{ route('admin.payment.index') }}" class="btn btn-default pull-right">Cancel</a>
                    </div>
                    <!-- /.box-footer -->
                </form>
            </div>

        </div>
    </div>
@stop
