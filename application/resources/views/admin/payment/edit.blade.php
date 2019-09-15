@extends('adminlte::page')

@section('title')
    Update {{ $payment->no_payment }} - {{ $payment->student->name }} - {{ $payment->student->user->name }}
@stop

@section('js')
@stop

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <form class="form-horizontal" method="post"
                      action="{{ route('admin.payment.update', $payment) }}">
                    <div class="box-body">
                        <div class="form-group @if($errors->first('value')) has-error @endif">
                            <label for="value" class="col-sm-2 control-label">Value</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="value" name="value"
                                       placeholder="From Date"
                                       value="{{ old('value', $payment->value) }}">
                                <span class="help-block">{{ $errors->first('value') }}</span>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-info pull-right">Update</button>
                        <a href="{{ route('admin.payment.index') }}" class="btn btn-default pull-right">Cancel</a>
                    </div>
                    <!-- /.box-footer -->
                </form>
            </div>

        </div>
    </div>
@stop
