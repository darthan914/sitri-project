@extends('adminlte::page')

@section('title')
    Update Trial
@stop

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <form class="form-horizontal" method="post" action="{{ route('admin.trial.update', $parentTrial) }}">
                    <div class="box-body">
                        <div class="form-group @if($errors->first('name')) has-error @endif">
                            <label for="name" class="col-sm-2 control-label">Name</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="name" name="name" placeholder="Name"
                                       value="{{ old('name', $parentTrial->name) }}">
                                <span class="help-block">{{ $errors->first('name') }}</span>
                            </div>
                        </div>

                        <div class="form-group @if($errors->first('email')) has-error @endif">
                            <label for="email" class="col-sm-2 control-label">Email</label>

                            <div class="col-sm-10">
                                <input type="email" class="form-control" id="email" name="email" placeholder="Email"
                                       value="{{ old('email', $parentTrial->email) }}">
                                <span class="help-block">{{ $errors->first('email') }}</span>
                            </div>
                        </div>

                        <div class="form-group @if($errors->first('phone')) has-error @endif">
                            <label for="phone" class="col-sm-2 control-label">Phone</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone"
                                       value="{{ old('phone', $parentTrial->phone) }}">
                                <span class="help-block">{{ $errors->first('phone') }}</span>
                            </div>
                        </div>

                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-info pull-right">Update</button>
                        <a href="{{ route('admin.trial.index') }}" class="btn btn-default pull-right">Cancel</a>
                    </div>
                    <!-- /.box-footer -->
                </form>
            </div>

        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <div class="box-title">
                        <h3>Child</h3>
                    </div>
                </div>
                <div class="box-body">
                    <a href="{{ route('admin.trial.child.create', $parentTrial) }}" class="btn btn-default">Create</a>
                </div>
                <div class="box-body">


                    <table id="trial-list" class="table table-bordered table-hover dataTable-general">
                        <thead>
                        <tr role="row">
                            <th>
                                Name
                            </th>
                            <th>
                                Schedule
                            </th>
                            <th>
                                School
                            </th>
                            <th>
                                Age
                            </th>
                            <th>

                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($parentTrial->childTrials as $childTrial)
                            <tr>
                                <td>{{ $childTrial->name }}</td>
                                <td>{{ $childTrial->classSchedule->getSchedule() }}</td>
                                <td>{{ $childTrial->school }}</td>
                                <td>{{ $childTrial->age }}</td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-primary dropdown-toggle"
                                                data-toggle="dropdown">
                                            Action <span class="caret"></span>
                                            <span class="sr-only">Toggle Dropdown</span>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-right" role="menu">
                                            <li>
                                                <a href="{{ route('admin.trial.child.edit', [$parentTrial, $childTrial]) }}">Edit</a>
                                            </li>
                                            <li>
                                                <a href="#" class="alert-modal" data-toggle="modal"
                                                   data-target="#alert-modal"
                                                   data-route="{{ route('admin.trial.child.delete', [$parentTrial, $childTrial]) }}"
                                                   data-title="Delete trial {{ $childTrial->name }}?"
                                                >Delete</a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

    @include('admin._general.modal.alert')
@stop

@section('js')
    <script>
        $(function () {
            alertModal($('#trial-list'));
        })
    </script>
@stop
