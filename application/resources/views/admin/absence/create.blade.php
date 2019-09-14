@extends('adminlte::page')

@section('title')
    Create Absence
@stop

@section('js')
    @include('admin.absence.js.createUpdate')
@stop

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <form class="form-horizontal" method="post" action="{{ route('admin.absence.store') }}">
                    <div class="box-body">
                        <div class="form-group @if($errors->first('date')) has-error @endif">
                            <label for="date" class="col-sm-2 control-label">From Date</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control datepicker" id="date" name="date"
                                       placeholder="From Date"
                                       value="{{ old('date') }}">
                                <span class="help-block">{{ $errors->first('date') }}</span>
                            </div>
                        </div>

                        <div class="form-group @if($errors->first('class_schedule_id')) has-error @endif">
                            <label for="class_schedule_id" class="col-sm-2 control-label">From Class
                                Schedule</label>

                            <div class="col-sm-10">
                                <select class="form-control select2" id="class_schedule_id"
                                        name="class_schedule_id" data-placeholder="Select From Class
                                Schedule">
                                    <option value=""></option>
                                </select>
                                <span class="help-block">{{ $errors->first('class_schedule_id') }}</span>
                            </div>
                        </div>

                        <div class="student-list">

                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-info pull-right">Create</button>
                        <a href="{{ route('admin.absence.index') }}" class="btn btn-default pull-right">Cancel</a>
                    </div>
                    <!-- /.box-footer -->
                </form>
            </div>

        </div>
    </div>
@stop
