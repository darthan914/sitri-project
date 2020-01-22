@extends('admin._layout.filter')

@section('input')
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 form-group @if($errors->first('f_year')) has-error @endif">
            <label for="f_year">Active</label>
            <select class="form-control select2-full" id="f_year" name="f_year" data-placeholder="This Year"
                    data-allow-clear="true">
                <option value="">This Year</option>
                @foreach(range($startYear, \Carbon\Carbon::now()->year) as $year)
                    <option value="{{ $year }}" @if(old('f_year', $request->f_year) == $year) selected @endif>{{ $year }}</option>
                @endforeach
            </select>
            <span class="help-block">{{ $errors->first('f_year') }}</span>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 form-group @if($errors->first('f_month')) has-error @endif">
            <label for="f_month">Active</label>
            <select class="form-control select2-full" id="f_month" name="f_month" data-placeholder="This Month"
                    data-allow-clear="true">
                <option value="">This Month</option>
                @foreach(config('sitri.month') as $key => $month)
                    <option value="{{ $key }}" @if(old('f_month', $request->f_month) == $key) selected @endif>{{ $month }}</option>
                @endforeach
            </select>
            <span class="help-block">{{ $errors->first('f_month') }}</span>
        </div>
    </div>
@stop
