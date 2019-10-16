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
                        <h3>Orang tua</h3>
                        <div class="form-group @if($errors->first('parent_email')) has-error @endif">
                            <label for="parent_email" class="col-sm-2 control-label">Email</label>

                            <div class="col-sm-10">
                                <input type="email" class="form-control" id="parent_email" name="parent_email"
                                       placeholder="Email"
                                       value="{{ old('parent_email', $student->user->email) }}">
                                <span class="help-block">{{ $errors->first('parent_email') }}</span>
                            </div>
                        </div>

                        <div class="form-group @if($errors->first('parent_name')) has-error @endif">
                            <label for="parent_name" class="col-sm-2 control-label">Nama Lengkap</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="parent_name" name="parent_name"
                                       placeholder="Nama Lengkap"
                                       value="{{ old('parent_name', $student->user->name) }}">
                                <span class="help-block">{{ $errors->first('parent_name') }}</span>
                            </div>
                        </div>


                        <div class="form-group @if($errors->first('parent_phone')) has-error @endif">
                            <label for="parent_phone" class="col-sm-2 control-label">Telepon</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="parent_phone" name="parent_phone"
                                       placeholder="Telepon"
                                       value="{{ old('parent_phone', $student->user->phone) }}">
                                <span class="help-block">{{ $errors->first('parent_phone') }}</span>
                            </div>
                        </div>

                        <div class="form-group @if($errors->first('address')) has-error @endif">
                            <label for="address" class="col-sm-2 control-label">Alamat</label>

                            <div class="col-sm-10">
                                <textarea class="form-control" id="address" name="address"
                                          placeholder="Alamat">{{ old('address', $student->address) }}</textarea>
                                <span class="help-block">{{ $errors->first('address') }}</span>
                            </div>
                        </div>

                        <h3>Murid</h3>

                        <div class="form-group @if($errors->first('name')) has-error @endif">
                            <label for="name" class="col-sm-2 control-label">Nama Lengkap</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="name" name="name" placeholder="Nama Lengkap"
                                       value="{{ old('name', $student->name) }}">
                                <span class="help-block">{{ $errors->first('name') }}</span>
                            </div>
                        </div>

                        <div class="form-group @if($errors->first('surname')) has-error @endif">
                            <label for="surname" class="col-sm-2 control-label">Nama Panggilan</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="surname" name="surname"
                                       placeholder="Nama Panggilan"
                                       value="{{ old('surname', $student->surname) }}">
                                <span class="help-block">{{ $errors->first('surname') }}</span>
                            </div>
                        </div>

                        <div class="form-group @if($errors->first('birthday')) has-error @endif">
                            <label for="birthday" class="col-sm-2 control-label">Tanggal lahir</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control datepicker" id="birthday" name="birthday"
                                       placeholder="Tanggal lahir"
                                       value="{{ old('birthday', $student->birthday) }}">
                                <span class="help-block">{{ $errors->first('birthday') }}</span>
                            </div>
                        </div>

                        <div class="form-group @if($errors->first('school')) has-error @endif">
                            <label for="school" class="col-sm-2 control-label">Sekolah</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="school" name="school" placeholder="Sekolah"
                                       value="{{ old('school', $student->school) }}">
                                <span class="help-block">{{ $errors->first('school') }}</span>
                            </div>
                        </div>

                        <div class="form-group @if($errors->first('grade')) has-error @endif">
                            <label for="grade" class="col-sm-2 control-label">Kelas</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="grade" name="grade" placeholder="Kelas"
                                       value="{{ old('grade', $student->grade) }}">
                                <span class="help-block">{{ $errors->first('grade') }}</span>
                            </div>
                        </div>


                        <div class="form-group @if($errors->first('recommendation')) has-error @endif">
                            <label for="recommendation" class="col-sm-2 control-label">Rekomendasi dari</label>

                            <div class="col-sm-10">
                                @foreach(config('sitri.recommendation') as $key => $recommendation)
                                    <label class="checkbox-inline">
                                        <input type="checkbox" name="recommendation[]"
                                               value="{{ $key }}"
                                               @if(in_array($key, old('recommendation', $student->recommendation))) checked @endif>{{ $recommendation }}
                                    </label>
                                @endforeach
                                <span class="help-block">{{ $errors->first('recommendation') }}</span>
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
