@extends('adminlte::page')

@section('title')
    Update Trial
@stop

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <form class="form-horizontal" method="post" action="{{ route('admin.trial.update', $student) }}">
                    <div class="box-body">
                        <h3>Orang Tua</h3>
                        <div class="form-group @if($errors->first('parent_email')) has-error @endif">
                            <label for="parent_email" class="col-sm-2 control-label">Parent Email</label>

                            <div class="col-sm-10">
                                <input type="email" class="form-control" id="parent_email" name="parent_email"
                                       placeholder="Parent Email"
                                       value="{{ old('parent_email', $student->user->email) }}">
                                <span class="help-block">{{ $errors->first('parent_email') }}</span>
                            </div>
                        </div>

                        <div class="form-group @if($errors->first('parent_name')) has-error @endif">
                            <label for="parent_name" class="col-sm-2 control-label">Parent Name</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="parent_name" name="parent_name"
                                       placeholder="Parent Name"
                                       value="{{ old('parent_name', $student->user->name) }}">
                                <span class="help-block">{{ $errors->first('parent_name') }}</span>
                            </div>
                        </div>


                        <div class="form-group @if($errors->first('parent_phone')) has-error @endif">
                            <label for="parent_phone" class="col-sm-2 control-label">Parent Phone</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="parent_phone" name="parent_phone"
                                       placeholder="Parent Phone"
                                       value="{{ old('parent_phone', $student->user->phone) }}">
                                <span class="help-block">{{ $errors->first('parent_phone') }}</span>
                            </div>
                        </div>

                        <h3>Murid</h3>
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
