@extends('adminlte::page')

@section('title')
    Update Schedule
@stop

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <form class="form-horizontal" method="post" action="{{ route('admin.schedule.update', $schedule) }}">
                    <div class="box-body">
                        <div class="form-group @if($errors->first('day')) has-error @endif">
                            <label for="day" class="col-sm-2 control-label">Day</label>

                            <div class="col-sm-10">
                                <select class="form-control" id="day" name="day">
                                    @foreach($day as $key => $value)
                                        <option value="{{ $key }}"
                                                @if(old('day', $schedule['day']) == $key) selected @endif>{{ $value }}</option>
                                    @endforeach
                                </select>
                                <span class="help-block">{{ $errors->first('day') }}</span>
                            </div>
                        </div>

                        <div class="form-group @if($errors->first('start_time')) has-error @endif">
                            <label for="start_time" class="col-sm-2 control-label">Start Time</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control timepicker" id="start_time" name="start_time"
                                       placeholder="Start Time"
                                       value="{{ old('start_time', $schedule['start_time']) }}">
                                <span class="help-block">{{ $errors->first('start_time') }}</span>
                            </div>
                        </div>

                        <div class="form-group @if($errors->first('end_time')) has-error @endif">
                            <label for="end_time" class="col-sm-2 control-label">End Time</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control timepicker" id="end_time" name="end_time"
                                       placeholder="End Time"
                                       value="{{ old('end_time', $schedule['end_time']) }}">
                                <span class="help-block">{{ $errors->first('end_time') }}</span>
                            </div>
                        </div>

                        <div class="form-group @if($errors->first('active')) has-error @endif">
                            <div class="col-sm-10 col-sm-offset-2">
                                <label class="checkbox-inline">
                                    <input type="hidden" name="active" value="0">
                                    <input type="checkbox" id="active" name="active" value="1"
                                           @if(old('active', $schedule['active']) == 1) checked @endif>Active</label>
                                <span class="help-block">{{ $errors->first('active') }}</span>
                            </div>
                        </div>

                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-info pull-right">Update</button>
                        <a href="{{ route('admin.schedule.index') }}" class="btn btn-default pull-right">Cancel</a>
                    </div>
                    <!-- /.box-footer -->
                </form>
            </div>

        </div>
    </div>
@stop
