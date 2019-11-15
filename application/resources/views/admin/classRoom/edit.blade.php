@extends('adminlte::page')

@section('title')
    Update Class Room
@stop

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <form class="form-horizontal" method="post" action="{{ route('admin.classRoom.update', $classRoom) }}">
                    <div class="box-body">
                        <div class="form-group @if($errors->first('name')) has-error @endif">
                            <label for="name" class="col-sm-2 control-label">Start Time</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="name" name="name"
                                       placeholder="Start Time"
                                       value="{{ old('name', $classRoom->name) }}">
                                <span class="help-block">{{ $errors->first('name') }}</span>
                            </div>
                        </div>

                        <div class="form-group @if($errors->first('max_student')) has-error @endif">
                            <label for="max_student" class="col-sm-2 control-label">Max Student</label>

                            <div class="col-sm-10">
                                <input type="number" class="form-control" id="max_student" name="max_student"
                                       placeholder="Max Student"
                                       value="{{ old('max_student', $classRoom->max_student) }}">
                                <span class="help-block">{{ $errors->first('max_student') }}</span>
                            </div>
                        </div>

                        <div class="form-group @if($errors->first('active')) has-error @endif">
                            <div class="col-sm-10 col-sm-offset-2">
                                <label class="checkbox-inline">
                                    <input type="checkbox" id="active" name="active" value="1"
                                           @if(old('active', $classRoom->active) == 1) checked @endif>Active</label>
                                <span class="help-block">{{ $errors->first('active') }}</span>
                            </div>
                        </div>

                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-info pull-right">Update</button>
                        <a href="{{ route('admin.classRoom.index') }}" class="btn btn-default pull-right">Cancel</a>
                    </div>
                    <!-- /.box-footer -->
                </form>
            </div>

        </div>
    </div>
@stop
