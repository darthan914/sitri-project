@extends('admin._layout.filter')

@section('input')
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 form-group @if($errors->first('f_search')) has-error @endif">
            <label for="f_search">Search</label>
            <input type="text" class="form-control" id="f_search" name="f_search" placeholder="Search"
                   value="{{ old('f_search', $request->f_search) }}">
            <span class="help-block">{{ $errors->first('f_search') }}</span>
        </div>
    </div>
@stop
