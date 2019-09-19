@extends('admin._layout.filter')

@section('input')
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 form-group @if($errors->first('f_active')) has-error @endif">
            <label for="f_active">Active</label>
            <select class="form-control select2-full" id="f_active" name="f_active" data-placeholder="Filter Active" data-allow-clear="true">
                <option value=""></option>
                <option value="1" @if(old('f_active', $request->f_active) === '1') selected @endif>Active</option>
                <option value="0" @if(old('f_active', $request->f_active) === '0') selected @endif>Inactive</option>
            </select>
            <span class="help-block">{{ $errors->first('f_active') }}</span>
        </div>
    </div>
@stop
