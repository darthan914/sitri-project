@extends('adminlte::page')

@section('title')
    Update Reschedule
@stop

@section('js')
    @include('admin.reschedule.js.createUpdate')
@stop

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <form class="form-horizontal" method="post"
                      action="{{ route('admin.reschedule.update', $reschedule) }}">
                    <div class="box-body">
                        <div class="form-group @if($errors->first('student_id')) has-error @endif">
                            <label for="student_id" class="col-sm-2 control-label">Student</label>

                            <div class="col-sm-10">
                                <select class="form-control select2" id="student_id" name="student_id"
                                        data-placeholder="Select Student">
                                    <option value=""></option>
                                    @foreach($students  as $student)
                                        <option value="{{ $reschedule->id }}"
                                                @if(old('student_id', $reschedule->student_id) == $student->id) selected @endif>{{ $student->name }}</option>
                                    @endforeach
                                </select>
                                <span class="help-block">{{ $errors->first('student_id') }}</span>
                            </div>
                        </div>

                        <div class="form-group @if($errors->first('from_date')) has-error @endif">
                            <label for="from_date" class="col-sm-2 control-label">From Date</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control datepicker" id="from_date" name="from_date"
                                       placeholder="From Date"
                                       value="{{ old('from_date', $reschedule->from_date) }}">
                                <span class="help-block">{{ $errors->first('from_date') }}</span>
                            </div>
                        </div>

                        <div class="form-group @if($errors->first('from_class_schedule_id')) has-error @endif">
                            <label for="from_class_schedule_id" class="col-sm-2 control-label">From Class
                                Schedule</label>

                            <div class="col-sm-10">
                                <select class="form-control select2" id="from_class_schedule_id"
                                        name="from_class_schedule_id" data-placeholder="Select From Class Schedule">
                                    <option value=""></option>
                                    @foreach($fromScheduleClasses as $fromScheduleClass)
                                        <option value="{{ $fromScheduleClass->id }}"
                                                @if(old('from_class_schedule_id', $reschedule->from_class_schedule_id) == $fromScheduleClass->id) selected @endif>{{ $fromScheduleClass->getClassInfo() }}</option>
                                    @endforeach
                                </select>
                                <span class="help-block">{{ $errors->first('from_class_schedule_id') }}</span>
                            </div>
                        </div>

                        <div class="form-group @if($errors->first('to_date')) has-error @endif">
                            <label for="to_date" class="col-sm-2 control-label">To Date</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control datepicker" id="to_date" name="to_date"
                                       placeholder="To Date"
                                       value="{{ old('to_date', $reschedule->to_date) }}">
                                <span class="help-block">{{ $errors->first('to_date') }}</span>
                            </div>
                        </div>

                        <div class="form-group @if($errors->first('to_class_schedule_id')) has-error @endif">
                            <label for="to_class_schedule_id" class="col-sm-2 control-label">To Class Schedule</label>

                            <div class="col-sm-10">
                                <select class="form-control select2" id="to_class_schedule_id"
                                        name="to_class_schedule_id" data-placeholder="Select To Class Schedule">
                                    <option value=""></option>
                                    @foreach($toScheduleClasses as $toScheduleClass)
                                        <option value="{{ $toScheduleClass->id }}"
                                                @if(old('to_class_schedule_id', $reschedule->to_class_schedule_id) == $toScheduleClass->id) selected @endif>{{ $toScheduleClass->getClassInfo() }}</option>
                                    @endforeach
                                </select>
                                <span class="help-block">{{ $errors->first('to_class_schedule_id') }}</span>
                            </div>
                        </div>

                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-info pull-right">Update</button>
                        <a href="{{ route('admin.reschedule.index') }}" class="btn btn-default pull-right">Cancel</a>
                    </div>
                    <!-- /.box-footer -->
                </form>
            </div>

        </div>
    </div>
@stop
