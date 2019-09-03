@extends('adminlte::page')

@section('title')
    Update Student
@stop

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <form class="form-horizontal" method="post" action="{{ route('admin.student.update', $student) }}">
                    <div class="box-body">
                        <div class="form-group @if($errors->first('user_id')) has-error @endif">
                            <label for="user_id" class="col-sm-2 control-label">User Parent</label>

                            <div class="col-sm-10">
                                <select class="form-control select2" name="user_id" id="user_id"
                                        data-placeholder="Select User Parent">
                                    <option value="">Select User Parent</option>
                                    @foreach($users as $user)
                                    <option value="{{ $user->id }}" @if($user->id == old('user_id', $student->user_id)) selected @endif>{{ $user->name }}</option>
                                    @endforeach
                                </select>
                                <span class="help-block">{{ $errors->first('user_id') }}</span>
                            </div>
                        </div>

                        <div class="form-group @if($errors->first('name')) has-error @endif">
                            <label for="name" class="col-sm-2 control-label">Name</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="name" name="name" placeholder="Name"
                                       value="{{ old('name', $student->name) }}">
                                <span class="help-block">{{ $errors->first('name') }}</span>
                            </div>
                        </div>

                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-info pull-right">Create</button>
                        <a href="{{ route('admin.student.index') }}" class="btn btn-default pull-right">Cancel</a>
                    </div>
                    <!-- /.box-footer -->
                </form>
            </div>

        </div>
    </div>
@stop
