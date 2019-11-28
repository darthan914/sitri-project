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

                        <div class="form-group @if($errors->first('registration_value')) has-error @endif">
                            <label for="registration_value" class="col-sm-2 control-label">Pendaftaran</label>

                            <div class="col-sm-10">
                                <input type="number" class="form-control" id="registration_value" name="registration_value"
                                       placeholder="Pendaftaran"
                                       value="{{ old('registration_value', $payment->registration_value) }}">
                                <span class="help-block">{{ $errors->first('registration_value') }}</span>
                            </div>
                        </div>

                        <div class="form-group @if($errors->first('monthly_value')) has-error @endif">
                            <label for="monthly_value" class="col-sm-2 control-label">Bulanan</label>

                            <div class="col-sm-10">
                                <input type="number" class="form-control" id="monthly_value" name="monthly_value"
                                       placeholder="Bulanan"
                                       value="{{ old('monthly_value', $payment->monthly_value) }}">
                                <span class="help-block">{{ $errors->first('monthly_value') }}</span>
                            </div>
                        </div>

                        <div class="form-group @if($errors->first('day_off_value')) has-error @endif">
                            <label for="day_off_value" class="col-sm-2 control-label">Cuti</label>

                            <div class="col-sm-10">
                                <input type="number" class="form-control" id="day_off_value" name="day_off_value"
                                       placeholder="Cuti"
                                       value="{{ old('day_off_value', $payment->day_off_value) }}">
                                <span class="help-block">{{ $errors->first('day_off_value') }}</span>
                            </div>
                        </div>

                        <div class="form-group @if($errors->first('shopping_value')) has-error @endif">
                            <label for="shopping_value" class="col-sm-2 control-label">Belanja</label>

                            <div class="col-sm-10">
                                <input type="number" class="form-control" id="shopping_value" name="shopping_value"
                                       placeholder="Belanja"
                                       value="{{ old('shopping_value', $payment->shopping_value) }}">
                                <span class="help-block">{{ $errors->first('shopping_value') }}</span>
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
