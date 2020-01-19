@extends('adminlte::page')

@section('title')
    Update Trial
@stop

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <form class="form-horizontal" method="post" action="{{ route('admin.trial.update', $student['id']) }}">
                    <div class="box-body">
                        <h3>Orang Tua</h3>
                        <div class="form-group @if($errors->first('parent_email')) has-error @endif">
                            <label for="parent_email" class="col-sm-2 control-label">Parent Email</label>

                            <div class="col-sm-10">
                                <input type="email" class="form-control" id="parent_email" name="parent_email"
                                       placeholder="Parent Email"
                                       value="{{ old('parent_email', $student['user']['email']) }}">
                                <span class="help-block">{{ $errors->first('parent_email') }}</span>
                            </div>
                        </div>

                        <div class="form-group @if($errors->first('parent_name')) has-error @endif">
                            <label for="parent_name" class="col-sm-2 control-label">Parent Name</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="parent_name" name="parent_name"
                                       placeholder="Parent Name"
                                       value="{{ old('parent_name', $student['user']['name']) }}">
                                <span class="help-block">{{ $errors->first('parent_name') }}</span>
                            </div>
                        </div>


                        <div class="form-group @if($errors->first('parent_phone')) has-error @endif">
                            <label for="parent_phone" class="col-sm-2 control-label">Parent Phone</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="parent_phone" name="parent_phone"
                                       placeholder="Parent Phone"
                                       value="{{ old('parent_phone', $student['user']['phone']) }}">
                                <span class="help-block">{{ $errors->first('parent_phone') }}</span>
                            </div>
                        </div>

                        <h3>Murid</h3>
                        <div class="form-group @if($errors->first('name')) has-error @endif">
                            <label for="name" class="col-sm-2 control-label">Name</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="name" name="name" placeholder="Name"
                                       value="{{ old('name', $student['name']) }}">
                                <span class="help-block">{{ $errors->first('name') }}</span>
                            </div>
                        </div>

                        <div class="form-group @if($errors->first('age')) has-error @endif">
                            <label for="age" class="col-sm-2 control-label">Umur</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" id="age" name="age"
                                       placeholder="Umur"
                                       value="{{ old('age', $student['age']) }}">
                                <span class="help-block">{{ $errors->first('age') }}</span>
                            </div>
                        </div>

                        <div class="form-group @if($errors->first('teacher_name')) has-error @endif">
                            <label for="teacher_name" class="col-sm-2 control-label">Dibimbing</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="teacher_name" name="teacher_name"
                                       placeholder="Nama Guru"
                                       value="{{ old('teacher_name', $student['class_student']['teacher_name']) }}">
                                <span class="help-block">{{ $errors->first('teacher_name') }}</span>
                            </div>
                        </div>

                        <div class="form-group @if($errors->first('class_schedule_id')) has-error @endif">
                            <label for="class_schedule_id" class="col-sm-2 control-label">Class
                                Schedule</label>

                            <div class="col-sm-10">
                                <select class="form-control select2" id="class_schedule_id"
                                        name="class_schedule_id"
                                        data-placeholder="Pilih Jadwal">
                                    <option value=""></option>
                                    @foreach($classSchedules as $classSchedule)
                                        <option value="{{ $classSchedule['id'] }}"
                                                @if($classSchedule['id'] == old('class_schedule_id', $student['class_student']['class_schedule_id'])) selected @endif>{{ $classSchedule['class_info'] }}</option>
                                    @endforeach
                                </select>
                                <span class="help-block">{{ $errors->first('class_schedule_id') }}</span>
                            </div>
                        </div>

                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-info pull-right">Update</button>
                        <a href="{{ route('admin.trial.index') }}" class="btn btn-default pull-right">Cancel</a>
                    </div>
                    <!-- /.box-footer -->
                </form>
            </div>

        </div>
    </div>

@stop

@section('js')

@stop
