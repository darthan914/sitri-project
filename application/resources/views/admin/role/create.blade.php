@extends('adminlte::page')

@section('title')
    Create Role
@stop

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <form class="form-horizontal" method="post" action="{{ route('admin.role.store') }}">
                    <div class="box-body">
                        <div class="form-group @if($errors->first('name')) has-error @endif">
                            <label for="name" class="col-sm-2 control-label">Name</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="name" name="name"
                                       placeholder="Name"
                                       value="{{ old('name') }}">
                                <span class="help-block">{{ $errors->first('name') }}</span>
                            </div>
                        </div>

                        @foreach(config('darthan.accesses') as $list)
                            <div class="form-group">
                                <label class="control-label checkbox-inline col-sm-2">
                                    <input type="checkbox" data-target="group-{{ $list['id'] }}" class="check-all">
                                    Access {{ $list['name'] }}
                                </label>
                                <div class="col-sm-10">
                                    @foreach($list['data'] as $list2)
                                        <label class="checkbox-inline">
                                            <input type="checkbox" name="can[]"
                                                   class="group-{{ $list['id'] }}"
                                                   value="{{ $list2['value'].'-'.$list['id'] }}"
                                                   @if(in_array($list2['value'].'-'.$list['id'], old('can', []))) checked @endif>{{ $list2['name'] }}
                                        </label>
                                    @endforeach
                                    <span class="help-block">{{ $errors->first('can') }}</span>
                                </div>
                            </div>
                        @endforeach

                        <div class="form-group @if($errors->first('active')) has-error @endif">
                            <div class="col-sm-10 col-sm-offset-2">
                                <label class="checkbox-inline">
                                    <input type="checkbox" id="active" name="active" value="1"
                                           @if(old('active') == 1) checked @endif>Active</label>
                                <span class="help-block">{{ $errors->first('active') }}</span>
                            </div>
                        </div>

                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-info pull-right">Create</button>
                        <a href="{{ route('admin.role.index') }}" class="btn btn-default pull-right">Cancel</a>
                    </div>
                    <!-- /.box-footer -->
                </form>
            </div>

        </div>
    </div>
@stop
