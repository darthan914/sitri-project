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
                        <h3>
                            Orang Tua
                        </h3>

                        <div class="form-group @if($errors->first('parent_name')) has-error @endif">
                            <label for="parent_name" class="col-sm-2 control-label">Nama</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="parent_name" name="parent_name" placeholder="Nama"
                                       value="{{ old('parent_name') }}">
                                <span class="help-block">{{ $errors->first('parent_name') }}</span>
                            </div>
                        </div>

                        <div class="form-group @if($errors->first('parent_email')) has-error @endif">
                            <label for="parent_email" class="col-sm-2 control-label">Email</label>

                            <div class="col-sm-10">
                                <input type="email" class="form-control" id="parent_email" name="parent_email" placeholder="Email"
                                       value="{{ old('parent_email') }}">
                                <span class="help-block">{{ $errors->first('parent_email') }}</span>
                            </div>
                        </div>

                        <div class="form-group @if($errors->first('parent_phone')) has-error @endif">
                            <label for="phone" class="col-sm-2 control-label">Telepon</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="parent_phone" name="parent_phone" placeholder="Telepon"
                                       value="{{ old('parent_phone') }}">
                                <span class="help-block">{{ $errors->first('parent_phone') }}</span>
                            </div>
                        </div>

                        <h3>
                            Murid
                        </h3>

                        <div class="append-input-child">
                            @forelse(old('name', []) as $key => $value)
                                <div>
                                    <div class="form-group @if($errors->first('name.'.$key)) has-error @endif">
                                        <label for="name" class="col-sm-2 control-label">Nama</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="name" name="name[]"
                                                   placeholder="Nama"
                                                   value="{{ old('name.'.$key) }}">
                                                <span class="help-block">{{ $errors->first('name.'.$key) }}</span>
                                        </div>
                                    </div>

                                    <div class="form-group @if($errors->first('teacher_name.'.$key)) has-error @endif">
                                        <label for="teacher_name" class="col-sm-2 control-label">Dibimbing</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="teacher_name" name="teacher_name[]"
                                                   placeholder="Nama Guru"
                                                   value="{{ old('teacher_name.'.$key) }}">
                                                <span class="help-block">{{ $errors->first('teacher_name.'.$key) }}</span>
                                        </div>
                                    </div>

                                    <div class="form-group @if($errors->first('class_schedule_id.'.$key)) has-error @endif">
                                        <label for="class_schedule_id" class="col-sm-2 control-label">Class
                                            Schedule</label>

                                        <div class="col-sm-10">
                                            <select class="form-control select2" id="class_schedule_id"
                                                    name="class_schedule_id[]"
                                                    data-placeholder="Pilih Jadwal">
                                                <option value=""></option>
                                                @foreach($classSchedules as $classSchedule)
                                                    <option value="{{ $classSchedule['id'] }}"
                                                            @if($classSchedule['id'] == old('class_schedule_id.'.$key)) selected @endif>{{ $classSchedule['class_info'] }}</option>
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
                                        <label for="name" class="col-sm-2 control-label">Nama</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="name" name="name[]"
                                                   placeholder="Nama"
                                                   value="">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="teacher_name" class="col-sm-2 control-label">Dibimbing</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="teacher_name" name="teacher_name[]"
                                                   placeholder="Nama Guru"
                                                   value="">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="class_schedule_id" class="col-sm-2 control-label">Jadwal</label>

                                        <div class="col-sm-10">
                                            <select class="form-control select2" id="class_schedule_id"
                                                    name="class_schedule_id[]"
                                                    data-placeholder="Pilih Jadwal">
                                                <option value=""></option>
                                                @foreach($classSchedules as $classSchedule)
                                                    <option value="{{ $classSchedule['id'] }}">{{ $classSchedule['class_info'] }}</option>
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
                    '<label for="name" class="col-sm-2 control-label">Nama</label>' +
                    '<div class="col-sm-10">' +
                    '<input type="text" class="form-control" id="name" name="name[]" placeholder="Nama" value="">' +
                    '</div>' +
                    '</div>' +
                    '<div class="form-group">' +
                    '<label for="teacher_name" class="col-sm-2 control-label">Dibimbing</label>' +
                    '<div class="col-sm-10">' +
                    '<input type="text" class="form-control" id="teacher_name" name="teacher_name[]" placeholder="Nama Guru" value="">' +
                    '</div>' +
                    '</div>' +
                    '<div class="form-group">' +
                    '<label for="class_schedule_id" class="col-sm-2 control-label">Jadwal</label>' +
                    '<div class="col-sm-10">' +
                    '<select class="form-control select2" id="class_schedule_id" name="class_schedule_id[]" data-placeholder="Pilih Jadwal">' +
                    '<option value="">Pilih Jadwal</option>' +
                    @foreach($classSchedules as $classSchedule)
                    '<option value="{{ $classSchedule['id'] }}">{{ $classSchedule['class_info'] }}</option>' +
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
                $('.select2').select2();
            });

            $('.append-input-child').on('click', '.delete-child', function () {
                $(this).parent().parent().parent().remove();

            })
        });
    </script>
@stop
