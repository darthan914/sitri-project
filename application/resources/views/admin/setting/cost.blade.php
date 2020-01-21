@extends('adminlte::page')

@section('title')
    Update Cost Setting
@stop

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <form class="form-horizontal" method="post" action="{{ route('admin.setting.cost') }}">
                    <div class="box-body">
                        <div class="form-group @if($errors->first('register')) has-error @endif">
                            <label for="register" class="col-sm-2 control-label">Biaya fomulir</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control currency" id="register" name="register" placeholder="Fomulir"
                                       value="{{ old('register', $cost['register']) }}">
                                <span class="help-block">{{ $errors->first('register') }}</span>
                            </div>
                        </div>

                        <div class="form-group @if($errors->first('one_month')) has-error @endif">
                            <label for="one_month" class="col-sm-2 control-label">Biaya 1 bulan</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control currency" id="one_month" name="one_month" placeholder="1 bulan"
                                       value="{{ old('one_month', $cost['one_month']) }}">
                                <span class="help-block">{{ $errors->first('one_month') }}</span>
                            </div>
                        </div>

                        <div class="form-group @if($errors->first('three_month')) has-error @endif">
                            <label for="three_month" class="col-sm-2 control-label">Biaya 3 bulan</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control currency" id="three_month" name="three_month" placeholder="3 bulan"
                                       value="{{ old('three_month', $cost['three_month']) }}">
                                <span class="help-block">{{ $errors->first('three_month') }}</span>
                            </div>
                        </div>

                        <div class="form-group @if($errors->first('day_off')) has-error @endif">
                            <label for="day_off" class="col-sm-2 control-label">Biaya cuti</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control currency" id="day_off" name="day_off" placeholder="cuti"
                                       value="{{ old('day_off', $cost['day_off']) }}">
                                <span class="help-block">{{ $errors->first('day_off') }}</span>
                            </div>
                        </div>

                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-info pull-right">Update</button>
                        <a href="{{ route('admin.user.index') }}" class="btn btn-default pull-right">Cancel</a>
                    </div>
                    <!-- /.box-footer -->
                </form>
            </div>

        </div>
    </div>
@stop
