@extends('adminlte::page')

@section('title')
    Update Absence
@stop

@section('js')
@stop

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <form class="form-horizontal" method="post"
                      action="{{ route('admin.absence.update', $absence) }}">
                    <div class="box-body">
                        <div class="form-group @if($errors->first('date')) has-error @endif">
                            <table class="table table-bordered">
                                <tr>
                                    <th>Date :</th>
                                    <td>{{ \Carbon\Carbon::parse($absence->date)->format('d F Y') }}</td>
                                </tr>
                                <tr>
                                    <th>Class :</th>
                                    <td>{{ $absence->classSchedule->getClassInfo() }}</td>
                                </tr>
                            </table>
                        </div>

                        <div class="student-list">
                            <table class="table table-bordered table-hover table-striped">
                                <thead>
                                <tr>
                                    <th>Student</th>
                                    <th>Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($absence->absenceDetails as $absenceDetail)
                                    <tr>
                                        <td>{{ $absenceDetail->student->name }}</td>
                                        <td>
                                            @if($absenceDetail->student->isReschedule($absence->date))
                                                <input type="hidden" name="status[{{ $absenceDetail->student->id }}]"
                                                       value="RESCHEDULE">
                                                RESCHEDULE
                                            @else
                                                <label class="radio-inline">
                                                    <input type="radio"
                                                           name="status[{{ $absenceDetail->student->id }}]"
                                                           value="PRESENT"
                                                           @if($absenceDetail->status === 'PRESENT') checked @endif
                                                    >
                                                    Present
                                                </label>
                                                <label class="radio-inline">
                                                    <input type="radio"
                                                           name="status[{{ $absenceDetail->student->id }}]"
                                                           value="ABSENCE"
                                                           @if($absenceDetail->status === 'ABSENCE') checked @endif
                                                    >
                                                    Absence
                                                </label>
                                            @endif
                                        </td>
                                    </tr>


                                @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-info pull-right">Update</button>
                        <a href="{{ route('admin.absence.index') }}" class="btn btn-default pull-right">Cancel</a>
                    </div>
                    <!-- /.box-footer -->
                </form>
            </div>

        </div>
    </div>
@stop
