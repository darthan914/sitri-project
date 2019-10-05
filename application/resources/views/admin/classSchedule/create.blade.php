@extends('adminlte::page')

@section('title')
    Create Class Schedule
@stop

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <form class="form-horizontal" method="post" action="{{ route('admin.classSchedule.store') }}">
                    <div class="box-body">
                        <div class="form-group @if($errors->first('class_room_id')) has-error @endif">
                            <label for="class_room_id" class="col-sm-2 control-label">Class</label>

                            <div class="col-sm-10">
                                <select class="form-control select2" id="class_room_id" name="class_room_id"
                                        data-placeholder="Select Class">
                                    <option value=""></option>
                                    @foreach($classRooms as $classRoom)
                                        <option value="{{ $classRoom->id }}"
                                                @if($classRoom->id == old('class_room_id')) selected @endif>{{ $classRoom->name }}</option>
                                    @endforeach
                                </select>
                                <span class="help-block">{{ $errors->first('class_room_id') }}</span>
                            </div>
                        </div>

                        <div class="form-group @if($errors->first('day')) has-error @endif">
                            <label for="day" class="col-sm-2 control-label">Day</label>

                            <div class="col-sm-10">
                                <select class="form-control" id="day" name="day">
                                    <option value="">Select Day</option>
                                    @foreach($day as $key => $value)
                                        <option value="{{ $key }}"
                                                @if(old('day') == $key) selected @endif>{{ $value }}</option>
                                    @endforeach
                                </select>
                                <span class="help-block">{{ $errors->first('day') }}</span>
                            </div>
                        </div>

                        <div class="form-group @if($errors->first('time')) has-error @endif">
                            <label for="time" class="col-sm-2 control-label">Time</label>

                            <div class="col-sm-10">
                                <select class="form-control" id="time" name="time">
                                    <option value="">Select Time</option>
                                    @foreach($time as $key => $value)
                                        <option value="{{ $key }}"
                                                @if(old('time') == $key) selected @endif>{{ $value['start_time'] }} - {{ $value['end_time'] }}</option>
                                    @endforeach
                                </select>
                                <span class="help-block">{{ $errors->first('time') }}</span>
                            </div>
                        </div>

                        <div class="form-group @if($errors->first('active')) has-error @endif">
                            <div class="col-sm-10 col-sm-offset-2">
                                <label class="checkbox-inline">
                                    <input type="checkbox" id="active" name="active" value="1"
                                           @if(old('active') == 1) checked @endif>Active</label>
                                <span class="help-block">{{ $errors->first('active') }}</span>
                            </div>
                        </div>

                        <div class="form-group @if($errors->first('is_trial')) has-error @endif">
                            <div class="col-sm-10 col-sm-offset-2">
                                <label class="checkbox-inline">
                                    <input type="checkbox" id="is_trial" name="is_trial" value="1"
                                           @if(old('is_trial') == 1) checked @endif>Trail</label>
                                <span class="help-block">{{ $errors->first('is_trial') }}</span>
                            </div>
                        </div>


                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-info pull-right">Create</button>
                        <a href="{{ route('admin.classSchedule.index') }}" class="btn btn-default pull-right">Cancel</a>
                    </div>
                    <!-- /.box-footer -->
                </form>
            </div>

        </div>
    </div>
@stop
