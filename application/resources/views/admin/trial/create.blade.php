@extends('adminlte::page')

@section('title')
    Create Trial
@stop

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <form class="form-horizontal" method="post" action="{{ route('admin.trial.store') }}">
                    <div class="box-body">
                        <div class="form-group @if($errors->first('name')) has-error @endif">
                            <label for="name" class="col-sm-2 control-label">Name</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="name" name="name" placeholder="Name"
                                       value="{{ old('name') }}">
                                <span class="help-block">{{ $errors->first('name') }}</span>
                            </div>
                        </div>

                        <div class="form-group @if($errors->first('email')) has-error @endif">
                            <label for="email" class="col-sm-2 control-label">Email</label>

                            <div class="col-sm-10">
                                <input type="email" class="form-control" id="email" name="email" placeholder="Email"
                                       value="{{ old('email') }}">
                                <span class="help-block">{{ $errors->first('email') }}</span>
                            </div>
                        </div>

                        <div class="form-group @if($errors->first('phone')) has-error @endif">
                            <label for="phone" class="col-sm-2 control-label">Phone</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone"
                                       value="{{ old('phone') }}">
                                <span class="help-block">{{ $errors->first('phone') }}</span>
                            </div>
                        </div>

                        <h3>
                            Child
                        </h3>

                        <div class="append-input-child">
                            @forelse(old('child_name', []) as $key => $value)
                                <div>
                                    <div class="form-group @if($errors->first('child_name.'.$key)) has-error @endif">
                                        <label for="child_name" class="col-sm-2 control-label">Child Name</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="child_name" name="child_name[]"
                                                   placeholder="Child Name"
                                                   value="{{ old('child_name.'.$key) }}">
                                                <span class="help-block">{{ $errors->first('child_name.'.$key) }}</span>
                                        </div>
                                    </div>

                                    <div class="form-group @if($errors->first('class_schedule_id.'.$key)) has-error @endif">
                                        <label for="class_schedule_id" class="col-sm-2 control-label">Class
                                            Schedule</label>

                                        <div class="col-sm-10">
                                            <select class="form-control select2" id="class_schedule_id"
                                                    name="class_schedule_id[]"
                                                    data-placeholder="Select Class Schedule">
                                                <option value=""></option>
                                                @foreach($classSchedules as $classSchedule)
                                                    <option value="{{ $classSchedule->id }}"
                                                            @if($classSchedule->id == old('class_schedule_id.'.$key)) selected @endif>{{ $classSchedule->getClassInfo() }}</option>
                                                @endforeach
                                            </select>
                                            <span class="help-block">{{ $errors->first('class_schedule_id.'.$key) }}</span>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <button class="btn btn-block btn-danger delete-child" type="button">
                                                Delete
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div>
                                    <div class="form-group">
                                        <label for="child_name" class="col-sm-2 control-label">Child Name</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="child_name" name="child_name[]"
                                                   placeholder="Child Name"
                                                   value="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="class_schedule_id" class="col-sm-2 control-label">Class
                                            Schedule</label>

                                        <div class="col-sm-10">
                                            <select class="form-control select2" id="class_schedule_id"
                                                    name="class_schedule_id[]"
                                                    data-placeholder="Select Class Schedule">
                                                <option value=""></option>
                                                @foreach($classSchedules as $classSchedule)
                                                    <option value="{{ $classSchedule->id }}">{{ $classSchedule->getClassInfo() }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <button class="btn btn-block btn-danger delete-child" type="button">
                                                Delete
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @endforelse
                        </div>

                        <div class="form-group">
                            <div class="col-sm-12">
                                <button type="button" class="btn btn-primary btn-block add-child btn-sm">Add more
                                    child
                                </button>
                            </div>
                        </div>


                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-info pull-right">Create</button>
                        <a href="{{ route('admin.trial.index') }}" class="btn btn-default pull-right">Cancel</a>
                    </div>
                    <!-- /.box-footer -->
                </form>
            </div>

        </div>
    </div>
@stop

@section('js')
    <script type="text/javascript">
        $(function () {
            $('.add-child').click(function () {
                $html = '<div>' +
                    '<div class="form-group">' +
                    '<label for="child_name" class="col-sm-2 control-label">Child Name</label>' +
                    '<div class="col-sm-10">' +
                    '<input type="text" class="form-control" id="child_name" name="child_name[]" placeholder="Child Name" value="">' +
                    '</div>' +
                    '</div>' +
                    '<div class="form-group">' +
                    '<label for="class_schedule_id" class="col-sm-2 control-label">Class Schedule</label>' +
                    '<div class="col-sm-10">' +
                    '<select class="form-control select2" id="class_schedule_id" name="class_schedule_id[]" data-placeholder="Select Class Schedule">' +
                    '<option value="">Select Class Schedule</option>' +
                    @foreach($classSchedules as $classSchedule)
                    '<option value="{{ $classSchedule->id }}">{{ $classSchedule->getClassInfo() }}</option>' +
                    @endforeach
                    '</select>' +
                    '</div>' +
                    '</div>' +
                    '<div class="form-group">' +
                    '<div class="col-sm-12">' +
                    '<button class="btn btn-block btn-danger delete-child" type="button">' +
                    'Delete' +
                    '</button>' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '</div>';
                $('.append-input-child').append($html);
            });

            $('.append-input-child').on('click', '.delete-child', function () {
                $(this).parent().parent().parent().remove();
            })
        });
    </script>
@stop
