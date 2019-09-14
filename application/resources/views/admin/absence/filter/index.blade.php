@extends('admin._layout.filter')

@section('input')
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 form-group @if($errors->first('f_student')) has-error @endif">
            <label for="f_student">Student</label>
            <select class="form-control select2-full" id="f_student" name="f_student" data-placeholder="Filter Student" data-allow-clear="true">
                <option value=""></option>
                @foreach($students as $student)
                <option value="{{ $student->id }}" @if(old('f_student', $request->f_student) === $student->id) selected @endif>{{ $student->name }}</option>
                @endforeach
            </select>
            <span class="help-block">{{ $errors->first('f_student') }}</span>
        </div>
    </div>
@stop
