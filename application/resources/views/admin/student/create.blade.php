@extends('adminlte::page')

@section('title')
    Create Student
@stop

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <form class="form-horizontal" method="post" action="{{ route('admin.student.store') }}">
                    <div class="box-body">
                        <div class="form-group @if($errors->first('parent_email')) has-error @endif">
                            <label for="parent_email" class="col-sm-2 control-label">Parent Email</label>

                            <div class="col-sm-10">
                                <input type="email" class="form-control" id="parent_email" name="parent_email"
                                       placeholder="Parent Email"
                                       value="{{ old('parent_email') }}">
                                <span class="help-block">{{ $errors->first('parent_email') }}</span>
                            </div>
                        </div>

                        <div class="form-group @if($errors->first('parent_name')) has-error @endif">
                            <label for="parent_name" class="col-sm-2 control-label">Parent Name</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="parent_name" name="parent_name"
                                       placeholder="Parent Name"
                                       value="{{ old('parent_name') }}">
                                <span class="help-block">{{ $errors->first('parent_name') }}</span>
                            </div>
                        </div>


                        <div class="form-group @if($errors->first('parent_phone')) has-error @endif">
                            <label for="parent_phone" class="col-sm-2 control-label">Parent Phone</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="parent_phone" name="parent_phone"
                                       placeholder="Parent Phone"
                                       value="{{ old('parent_phone') }}">
                                <span class="help-block">{{ $errors->first('parent_phone') }}</span>
                            </div>
                        </div>

                        <div class="form-group @if($errors->first('name')) has-error @endif">
                            <label for="name" class="col-sm-2 control-label">Name</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="name" name="name" placeholder="Name"
                                       value="{{ old('name') }}">
                                <span class="help-block">{{ $errors->first('name') }}</span>
                            </div>
                        </div>

                        <div class="form-group @if($errors->first('surname')) has-error @endif">
                            <label for="surname" class="col-sm-2 control-label">Surname</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="surname" name="surname"
                                       placeholder="Surname"
                                       value="{{ old('surname') }}">
                                <span class="help-block">{{ $errors->first('surname') }}</span>
                            </div>
                        </div>

                        <div class="form-group @if($errors->first('birthday')) has-error @endif">
                            <label for="birthday" class="col-sm-2 control-label">Birthday</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control datepicker" id="birthday" name="birthday"
                                       placeholder="Birthday"
                                       value="{{ old('birthday') }}">
                                <span class="help-block">{{ $errors->first('birthday') }}</span>
                            </div>
                        </div>

                        <div class="form-group @if($errors->first('school')) has-error @endif">
                            <label for="school" class="col-sm-2 control-label">School</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="school" name="school" placeholder="School"
                                       value="{{ old('school') }}">
                                <span class="help-block">{{ $errors->first('school') }}</span>
                            </div>
                        </div>

                        <div class="form-group @if($errors->first('grade')) has-error @endif">
                            <label for="grade" class="col-sm-2 control-label">Grade</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="grade" name="grade" placeholder="Grade"
                                       value="{{ old('grade') }}">
                                <span class="help-block">{{ $errors->first('grade') }}</span>
                            </div>
                        </div>

                        <div class="form-group @if($errors->first('address')) has-error @endif">
                            <label for="address" class="col-sm-2 control-label">Address</label>

                            <div class="col-sm-10">
                                <textarea class="form-control" id="address" name="address"
                                          placeholder="Address">{{ old('address') }}</textarea>
                                <span class="help-block">{{ $errors->first('address') }}</span>
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

@push('js')
    <script>
        $(function () {
            $('input[name=parent_email]').blur(function () {
                $.ajax(
                    {
                        url: '{{ route('admin.user.getUserByEmail') }}',
                        data: {
                            email: $(this).val()
                        },
                        success: function (data) {
                            if (data) {
                                $('input[name=parent_name]').val(data.name);
                                $('input[name=parent_phone]').val(data.phone);
                            }
                        }
                    }
                );
            })
        })
    </script>

@endpush
