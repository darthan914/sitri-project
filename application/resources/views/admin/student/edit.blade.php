@extends('adminlte::page')

@section('title')
    Update Student
@stop

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <form class="form-horizontal" method="post"
                      action="{{ route('admin.student.update', $student['id']) }}">
                    <div class="box-body">
                        <h3>Orang tua</h3>
                        <div class="form-group @if($errors->first('parent_email')) has-error @endif">
                            <label for="parent_email" class="col-sm-2 control-label">Email</label>

                            <div class="col-sm-10">
                                <input type="email" class="form-control" id="parent_email" name="parent_email"
                                       placeholder="Email"
                                       value="{{ old('parent_email', $student['user']['email']) }}">
                                <span class="help-block">{{ $errors->first('parent_email') }}</span>
                            </div>
                        </div>

                        <div class="form-group @if($errors->first('parent_name')) has-error @endif">
                            <label for="parent_name" class="col-sm-2 control-label">Nama Lengkap</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="parent_name" name="parent_name"
                                       placeholder="Nama Lengkap"
                                       value="{{ old('parent_name', $student['user']['name']) }}">
                                <span class="help-block">{{ $errors->first('parent_name') }}</span>
                            </div>
                        </div>


                        <div class="form-group @if($errors->first('parent_phone')) has-error @endif">
                            <label for="parent_phone" class="col-sm-2 control-label">Telepon</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="parent_phone" name="parent_phone"
                                       placeholder="Telepon"
                                       value="{{ old('parent_phone', $student['user']['phone']) }}">
                                <span class="help-block">{{ $errors->first('parent_phone') }}</span>
                            </div>
                        </div>

                        <div class="form-group @if($errors->first('address')) has-error @endif">
                            <label for="address" class="col-sm-2 control-label">Alamat</label>

                            <div class="col-sm-10">
                                <textarea class="form-control" id="address" name="address"
                                          placeholder="Alamat">{{ old('address', $student['address']) }}</textarea>
                                <span class="help-block">{{ $errors->first('address') }}</span>
                            </div>
                        </div>

                        <h3>Murid</h3>

                        <div class="form-group @if($errors->first('name')) has-error @endif">
                            <label for="name" class="col-sm-2 control-label">Nama Lengkap</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="name" name="name" placeholder="Nama Lengkap"
                                       value="{{ old('name', $student['name']) }}">
                                <span class="help-block">{{ $errors->first('name') }}</span>
                            </div>
                        </div>

                        <div class="form-group @if($errors->first('surname')) has-error @endif">
                            <label for="surname" class="col-sm-2 control-label">Nama Panggilan</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="surname" name="surname"
                                       placeholder="Nama Panggilan"
                                       value="{{ old('surname', $student['surname']) }}">
                                <span class="help-block">{{ $errors->first('surname') }}</span>
                            </div>
                        </div>

                        <div class="form-group @if($errors->first('birthday')) has-error @endif">
                            <label for="birthday" class="col-sm-2 control-label">Tanggal lahir</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control datepicker" id="birthday" name="birthday"
                                       placeholder="Tanggal lahir"
                                       value="{{ old('birthday', $student['birthday']) }}" autocomplete="off">
                                <span class="help-block">{{ $errors->first('birthday') }}</span>
                            </div>
                        </div>

                        <div class="form-group @if($errors->first('age')) has-error @endif">
                            <label for="age" class="col-sm-2 control-label">Umur</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="age" name="age" placeholder="Umur"
                                       value="{{ old('age', $student['age']) }}">
                                <span class="help-block">{{ $errors->first('age') }}</span>
                            </div>
                        </div>

                        <div class="form-group @if($errors->first('school')) has-error @endif">
                            <label for="school" class="col-sm-2 control-label">Sekolah</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="school" name="school" placeholder="Sekolah"
                                       value="{{ old('school', $student['school']) }}">
                                <span class="help-block">{{ $errors->first('school') }}</span>
                            </div>
                        </div>

                        <div class="form-group @if($errors->first('grade')) has-error @endif">
                            <label for="grade" class="col-sm-2 control-label">Kelas</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="grade" name="grade" placeholder="Kelas"
                                       value="{{ old('grade', $student['grade']) }}">
                                <span class="help-block">{{ $errors->first('grade') }}</span>
                            </div>
                        </div>

                        <div class="form-group @if($errors->first('date_enter')) has-error @endif">
                            <label for="date_enter" class="col-sm-2 control-label">Tanggal Masuk</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control datepicker" id="date_enter" name="date_enter"
                                       placeholder="Tanggal Masuk"
                                       value="{{ old('date_enter', $student['date_enter']) }}" autocomplete="off">
                                <span class="help-block">{{ $errors->first('date_enter') }}</span>
                            </div>
                        </div>


                        <div class="form-group @if($errors->first('recommendation')) has-error @endif">
                            <label for="recommendation" class="col-sm-2 control-label">Rekomendasi dari</label>

                            <div class="col-sm-10">
                                @foreach(config('sitri.recommendation') as $key => $recommendation)
                                    <label class="checkbox-inline">
                                        <input type="checkbox" name="recommendation[]"
                                               value="{{ $key }}"
                                               @if(in_array($key, old('recommendation', $student['recommendation'] ?? []))) checked @endif>{{ $recommendation }}
                                    </label>
                                @endforeach
                                <span class="help-block">{{ $errors->first('recommendation') }}</span>
                            </div>
                        </div>

                        <h3>Jadwal Les</h3>

                        <div class="form-group @if($errors->first('class_room_id')) has-error @endif">
                            <label for="class_room_id" class="col-sm-2 control-label">Kelas</label>

                            <div class="col-sm-10">
                                <select class="form-control select2" id="class_room_id" name="class_room_id"
                                        data-placeholder="Pilih Kelas">
                                    <option value=""></option>
                                    @foreach($classRooms as $classRoom)
                                        <option value="{{ $classRoom['id'] }}"
                                                @if($classRoom['id'] == old('class_room_id', $student['class_student']['class_schedule']['class_room_id'] ?? '')) selected @endif>{{ $classRoom['name'] }}</option>
                                    @endforeach
                                </select>
                                <span class="help-block">{{ $errors->first('class_room_id') }}</span>
                            </div>
                        </div>

                        <div class="form-group @if($errors->first('day')) has-error @endif">
                            <label for="day" class="col-sm-2 control-label">Day</label>

                            <div class="col-sm-10">
                                <select class="form-control" id="day" name="day">
                                    <option value="">Select Day</option>
                                    @foreach($day as $key => $value)
                                        <option value="{{ $key }}"
                                                @if(old('day', $student['class_student']['class_schedule']['schedule']['day'] ?? '') == $key) selected @endif>{{ $value }}</option>
                                    @endforeach
                                </select>
                                <span class="help-block">{{ $errors->first('day') }}</span>
                            </div>
                        </div>

                        <div class="form-group @if($errors->first('schedule_id')) has-error @endif">
                            <label for="schedule_id" class="col-sm-2 control-label">Time</label>

                            <div class="col-sm-10">
                                <select class="form-control select2" id="schedule_id" name="schedule_id"
                                        data-placeholder="Select Time">
                                    <option value="">Select Time</option>
                                </select>
                                <span class="help-block">{{ $errors->first('schedule_id') }}</span>
                            </div>
                        </div>

                        <div class="form-group @if($errors->first('teacher_name')) has-error @endif">
                            <label for="name" class="col-sm-2 control-label">Nama Guru</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="teacher_name" name="teacher_name"
                                       placeholder="Nama Guru"
                                       value="{{ old('teacher_name', $student['class_student']['teacher_name'] ?? '') }}">
                                <span class="help-block">{{ $errors->first('teacher_name') }}</span>
                            </div>
                        </div>

                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-info pull-right">Update</button>
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
            $('input[name=parent_email]').change(function () {
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
            });

            $('input[name=birthday]').change(function () {
                let year = new Date().getFullYear();

                $('input[name=age]').val(year - $(this).datepicker("getDate").getFullYear());
            });


            let old_time = '{{ old('schedule_id', $student['class_student']['class_schedule']['schedule_id'] ?? '') }}';

            let daySelector = $('select[name=day]');
            let scheduleSelector = $('select[name=schedule_id]');
            scheduleSelector.prop("disabled", true);

            const dynamicSchedule = function () {
                if (daySelector.val() === '') {
                    scheduleSelector.val('').trigger('change').prop("disabled", true);
                } else {
                    scheduleSelector.prop("disabled", false);
                    $.get("{{ route('admin.classSchedule.getTimeByDay') }}",
                        {
                            day: daySelector.val(),
                        },
                        function (data) {
                            scheduleSelector.empty();
                            $.each(data, function (i, field) {
                                if (old_time === field.id) {
                                    scheduleSelector.append("<option value='" + field.id + "' selected>" + field.start_time + " - " + field.end_time + "</option>");
                                } else {
                                    scheduleSelector.append("<option value='" + field.id + "'>" + field.start_time + " - " + field.end_time + "</option>");
                                }
                                scheduleSelector.val(old_time).trigger('change');
                            });
                        });
                }
            };

            dynamicSchedule();


            $(document).on('change', 'select[name=day]', function () {
                dynamicSchedule();
            });
        })
    </script>

@endpush
