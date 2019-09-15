@extends('admin._layout.filter')

@section('input')
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 form-group @if($errors->first('f_paid')) has-error @endif">
            <label for="f_paid">Status Payment</label>
            <select class="form-control select2-full" id="f_paid" name="f_paid" data-placeholder="Filter Paid" data-allow-clear="true">
                <option value=""></option>
                <option value="0" @if(old('f_paid', $request->f_paid) === '0') selected @endif>PENDING</option>
                <option value="1" @if(old('f_paid', $request->f_paid) === '1') selected @endif>PAID</option>
            </select>
            <span class="help-block">{{ $errors->first('f_paid') }}</span>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 form-group @if($errors->first('f_search')) has-error @endif">
            <label for="f_search">Search</label>
            <input type="text" class="form-control" id="f_search" name="f_search" placeholder="Search"
                   value="{{ old('f_search', $request->f_search) }}">
            <span class="help-block">{{ $errors->first('f_search') }}</span>
        </div>
    </div>
@stop
