@extends('adminlte::page')

@section('title')
    Update Child Trial
@stop

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <form class="form-horizontal" method="post" action="{{ route('admin.trial.child.update', [$parentTrial, $childTrial]) }}">
                    <div class="box-body">
                        <div class="form-group @if($errors->first('name')) has-error @endif">
                            <label for="name" class="col-sm-2 control-label">Name</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="name" name="name" placeholder="Name"
                                       value="{{ old('name', $childTrial->name) }}">
                                <span class="help-block">{{ $errors->first('name') }}</span>
                            </div>
                        </div>

                        <div class="form-group @if($errors->first('class_schedule_id')) has-error @endif">
                            <label for="class_schedule_id" class="col-sm-2 control-label">Class
                                Schedule</label>

                            <div class="col-sm-10">
                                <select class="form-control select2" id="class_schedule_id"
                                        name="class_schedule_id"
                                        data-placeholder="Select Class Schedule">
                                    <option value=""></option>
                                    @foreach($classSchedules as $classSchedule)
                                        <option value="{{ $classSchedule->id }}"
                                                @if($classSchedule->id == old('class_schedule_id', $childTrial->class_schedule_id)) selected @endif>{{ $classSchedule->getClassInfo() }}</option>
                                    @endforeach
                                </select>
                                <span class="help-block">{{ $errors->first('class_schedule_id') }}</span>
                            </div>
                        </div>

                        <div class="form-group @if($errors->first('school')) has-error @endif">
                            <label for="school" class="col-sm-2 control-label">School</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="school" name="school" placeholder="School"
                                       value="{{ old('school', $childTrial->school) }}">
                                <span class="help-block">{{ $errors->first('school') }}</span>
                            </div>
                        </div>

                        <div class="form-group @if($errors->first('age')) has-error @endif">
                            <label for="age" class="col-sm-2 control-label">Phone</label>

                            <div class="col-sm-10">
                                <input type="number" class="form-control" id="age" name="age" placeholder="Age"
                                       value="{{ old('age', $childTrial->age) }}">
                                <span class="help-block">{{ $errors->first('age') }}</span>
                            </div>
                        </div>

                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-info pull-right">Update</button>
                        <a href="{{ route('admin.trial.edit', $parentTrial) }}" class="btn btn-default pull-right">Cancel</a>
                    </div>
                    <!-- /.box-footer -->
                </form>
            </div>

        </div>
    </div>
@stop
