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
                        <h3>Orang tua</h3>
                        <div class="form-group @if($errors->first('parent_email')) has-error @endif">
                            <label for="parent_email" class="col-sm-2 control-label">Email</label>

                            <div class="col-sm-10">
                                <input type="email" class="form-control" id="parent_email" name="parent_email"
                                       placeholder="Email"
                                       value="{{ old('parent_email') }}">
                                <span class="help-block">{{ $errors->first('parent_email') }}</span>
                            </div>
                        </div>

                        <div class="form-group @if($errors->first('parent_name')) has-error @endif">
                            <label for="parent_name" class="col-sm-2 control-label">Nama Lengkap</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="parent_name" name="parent_name"
                                       placeholder="Nama Lengkap"
                                       value="{{ old('parent_name') }}">
                                <span class="help-block">{{ $errors->first('parent_name') }}</span>
                            </div>
                        </div>


                        <div class="form-group @if($errors->first('parent_phone')) has-error @endif">
                            <label for="parent_phone" class="col-sm-2 control-label">Telepon</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="parent_phone" name="parent_phone"
                                       placeholder="Telepon"
                                       value="{{ old('parent_phone') }}">
                                <span class="help-block">{{ $errors->first('parent_phone') }}</span>
                            </div>
                        </div>

                        <div class="form-group @if($errors->first('address')) has-error @endif">
                            <label for="address" class="col-sm-2 control-label">Alamat</label>

                            <div class="col-sm-10">
                                <textarea class="form-control" id="address" name="address"
                                          placeholder="Alamat">{{ old('address') }}</textarea>
                                <span class="help-block">{{ $errors->first('address') }}</span>
                            </div>
                        </div>

                        <h3>Murid</h3>

                        <div class="form-group @if($errors->first('name')) has-error @endif">
                            <label for="name" class="col-sm-2 control-label">Nama Lengkap</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="name" name="name" placeholder="Nama Lengkap"
                                       value="{{ old('name') }}">
                                <span class="help-block">{{ $errors->first('name') }}</span>
                            </div>
                        </div>

                        <div class="form-group @if($errors->first('surname')) has-error @endif">
                            <label for="surname" class="col-sm-2 control-label">Nama Panggilan</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="surname" name="surname"
                                       placeholder="Surname"
                                       value="{{ old('surname') }}">
                                <span class="help-block">{{ $errors->first('surname') }}</span>
                            </div>
                        </div>

                        <div class="form-group @if($errors->first('birthday')) has-error @endif">
                            <label for="birthday" class="col-sm-2 control-label">Tanggal lahir</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control dropdown-datepicker" id="birthday" name="birthday"
                                       placeholder="Tanggal lahir"
                                       value="{{ old('birthday') }}">
                                <span class="help-block">{{ $errors->first('birthday') }}</span>
                            </div>
                        </div>

                        <div class="form-group @if($errors->first('age')) has-error @endif">
                            <label for="age" class="col-sm-2 control-label">Umur</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="age" name="age" placeholder="Umur"
                                       value="{{ old('age') }}">
                                <span class="help-block">{{ $errors->first('age') }}</span>
                            </div>
                        </div>

                        <div class="form-group @if($errors->first('school')) has-error @endif">
                            <label for="school" class="col-sm-2 control-label">Sekolah</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="school" name="school" placeholder="Sekolah"
                                       value="{{ old('school') }}">
                                <span class="help-block">{{ $errors->first('school') }}</span>
                            </div>
                        </div>

                        <div class="form-group @if($errors->first('grade')) has-error @endif">
                            <label for="grade" class="col-sm-2 control-label">Kelas</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="grade" name="grade" placeholder="Kelas"
                                       value="{{ old('grade') }}">
                                <span class="help-block">{{ $errors->first('grade') }}</span>
                            </div>
                        </div>

                        <div class="form-group @if($errors->first('date_enter')) has-error @endif">
                            <label for="date_enter" class="col-sm-2 control-label">Tanggal Masuk</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control dropdown-datepicker" id="date_enter" name="date_enter"
                                       placeholder="Tanggal Masuk"
                                       value="{{ old('date_enter') }}">
                                <span class="help-block">{{ $errors->first('date_enter') }}</span>
                            </div>
                        </div>

                        <div class="form-group @if($errors->first('recommendation')) has-error @endif">
                            <label for="recommendation" class="col-sm-2 control-label">Rekomendasi dari</label>

                            <div class="col-sm-10">
                                @foreach(config('sitri.recommendation') as $key => $recommendation)
                                    <label class="checkbox-inline">
                                        <input type="checkbox" name="recommendation[]"
                                               value="{{ $key }}" @if(in_array($key, old('recommendation', []))) checked @endif>{{ $recommendation }}
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
                                        <option value="{{ $classRoom->id }}"
                                                @if($classRoom->id == old('class_room_id')) selected @endif>{{ $classRoom->name }}</option>
                                    @endforeach
                                </select>
                                <span class="help-block">{{ $errors->first('class_room_id') }}</span>
                            </div>
                        </div>

                        <div class="form-group @if($errors->first('day')) has-error @endif">
                            <label for="day" class="col-sm-2 control-label">Hari</label>

                            <div class="col-sm-10">
                                <select class="form-control" id="day" name="day">
                                    <option value="">Pilih Hari</option>
                                    @foreach($day as $key => $value)
                                        <option value="{{ $key }}"
                                                @if(old('day') == $key) selected @endif>{{ $value }}</option>
                                    @endforeach
                                </select>
                                <span class="help-block">{{ $errors->first('day') }}</span>
                            </div>
                        </div>

                        <div class="form-group @if($errors->first('time')) has-error @endif">
                            <label for="time" class="col-sm-2 control-label">Jam</label>

                            <div class="col-sm-10">
                                <select class="form-control" id="time" name="time">
                                    <option value="">Pilih Jam</option>
                                    @foreach($time as $key => $value)
                                        <option value="{{ $key }}"
                                                @if(old('time') == $key) selected @endif>{{ $value['start_time'] }} - {{ $value['end_time'] }}</option>
                                    @endforeach
                                </select>
                                <span class="help-block">{{ $errors->first('time') }}</span>
                            </div>
                        </div>

                        <div class="form-group @if($errors->first('teacher_name')) has-error @endif">
                            <label for="name" class="col-sm-2 control-label">Nama Guru</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="teacher_name" name="teacher_name" placeholder="Nama Guru"
                                       value="{{ old('teacher_name') }}">
                                <span class="help-block">{{ $errors->first('teacher_name') }}</span>
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
