@extends('adminlte::page')

@section('title')
    Create Class Student
@stop

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <form class="form-horizontal" method="post" action="{{ route('admin.classStudent.store') }}">
                    <div class="box-body">
                        <div class="form-group @if($errors->first('student_id')) has-error @endif">
                            <label for="student_id" class="col-sm-2 control-label">Student</label>

                            <div class="col-sm-10">
                                <select class="form-control select2" id="student_id" name="student_id"
                                        data-placeholder="Select Student">
                                    <option value=""></option>
                                    @foreach($students as $student)
                                        <option value="{{ $student['id'] }}"
                                                @if($student['id'] == old('student_id', $request['student_id'])) selected @endif>{{ $student['name'] }}
                                        </option>
                                    @endforeach
                                </select>
                                <span class="help-block">{{ $errors->first('student_id') }}</span>
                            </div>
                        </div>

                        <div class="form-group @if($errors->first('class_schedule_id')) has-error @endif">
                            <label for="class_schedule_id" class="col-sm-2 control-label">Class Schedule</label>

                            <div class="col-sm-10">
                                <select class="form-control select2" id="class_schedule_id" name="class_schedule_id"
                                        data-placeholder="Select Class Schedule">
                                    <option value=""></option>
                                    @foreach($classSchedules as $classSchedule)
                                        <option value="{{ $classSchedule['id'] }}"
                                                @if(in_array($classSchedule['id'], old('class_schedule_id', []))) selected @endif>{{ $classSchedule['class_info'] }}</option>
                                    @endforeach
                                </select>
                                <span class="help-block">{{ $errors->first('class_schedule_id') }}</span>
                            </div>
                        </div>

                        <div class="form-group @if($errors->first('teacher_name')) has-error @endif">
                            <label for="teacher_name" class="col-sm-2 control-label">Teacher</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="teacher_name" name="teacher_name"
                                        placeholder="Teacher" value="{{ old('teacher_name') }}">
                                <span class="help-block">{{ $errors->first('teacher_name') }}</span>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-info pull-right">Create</button>
                        <a href="{{ route('admin.classStudent.index') }}" class="btn btn-default pull-right">Cancel</a>
                    </div>
                    <!-- /.box-footer -->
                </form>
            </div>

        </div>
    </div>
@stop
