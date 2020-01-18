@extends('adminlte::page')

@section('title')
    Create Reschedule
@stop

@section('js')
    @include('admin.reschedule.js.createUpdate')
@stop

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <form class="form-horizontal" method="post" action="{{ route('admin.reschedule.store') }}">
                    <div class="box-body">
                        <div class="form-group @if($errors->first('student_id')) has-error @endif">
                            <label for="student_id" class="col-sm-2 control-label">Student</label>

                            <div class="col-sm-10">
                                <select class="form-control select2" id="student_id" name="student_id"
                                        data-placeholder="Select Student">
                                    <option value=""></option>
                                    @foreach($students  as $student)
                                        <option value="{{ $student['id'] }}"
                                                @if(old('student_id', $request['student_id']) == $student['id']) selected @endif>{{ $student['name']}}</option>
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
                                       value="{{ old('from_date') }}" autocomplete="off"
                                >
                                <span class="help-block">{{ $errors->first('from_date') }}</span>
                            </div>
                        </div>

                        <div class="form-group @if($errors->first('from_class_schedule_id')) has-error @endif">
                            <label for="from_class_schedule_id" class="col-sm-2 control-label">Regular Class</label>

                            <div class="col-sm-10">
                                <select class="form-control select2" id="from_class_schedule_id"
                                        name="from_class_schedule_id" data-placeholder="Select Regular Class">
                                    <option value=""></option>
                                </select>
                                <span class="help-block">{{ $errors->first('from_class_schedule_id') }}</span>
                            </div>
                        </div>

                        <div class="form-group @if($errors->first('to_date')) has-error @endif">
                            <label for="to_date" class="col-sm-2 control-label">To Date</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control datepicker" id="to_date" name="to_date"
                                       placeholder="To Date"
                                       value="{{ old('to_date') }}" autocomplete="off"
                                       data-only-day="{{ $toDateDayAvailable }}">
                                <span class="help-block">{{ $errors->first('to_date') }}</span>
                            </div>
                        </div>

                        <div class="form-group @if($errors->first('to_class_schedule_id')) has-error @endif">
                            <label for="to_class_schedule_id" class="col-sm-2 control-label">Reschedule Class</label>

                            <div class="col-sm-10">
                                <select class="form-control select2" id="to_class_schedule_id"
                                        name="to_class_schedule_id" data-placeholder="Select Reschedule Class">
                                    <option value=""></option>
                                </select>
                                <span class="help-block">{{ $errors->first('to_class_schedule_id') }}</span>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        {{ csrf_field() }}
                        <input type="hidden" name="go_to_student" value="{{ $request['student_id'] ? 'yes' : '' }}">
                        <button type="submit" class="btn btn-info pull-right">Create</button>
                        <a href="{{ route('admin.reschedule.index') }}" class="btn btn-default pull-right">Cancel</a>
                    </div>
                    <!-- /.box-footer -->
                </form>
            </div>

        </div>
    </div>
@stop
