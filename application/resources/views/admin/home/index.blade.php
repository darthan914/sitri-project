{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Main Page')

@section('js')

@stop

@section('css')
    <style>
        .highlight-today {
            background-color: #00e765;
        }
    </style>
@stop

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-title">
                    <h2>Student list not on schedule</h2>
                </div>
                <div class="box-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Student Name</th>
                            <th>Parent Name</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($studentNotOnSchedule as $student)
                            <tr>
                                <td>{{ $student->name }}</td>
                                <td>{{ $student->user->name }}</td>
                                <td><a href="{{ route('admin.student.view', $student) }}" class="btn btn-sm btn-primary">View</a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="box">
                <div class="box-title">
                    <h2>Schedule Table</h2>
                </div>
                <div class="box-body">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            @foreach($activeDayLists as $day)
                                <th class="text-center @if($day == date('w')) highlight-today @endif">
                                    {{ config('sitri.day')[$day] }} {{ \Carbon\Carbon::parse($weekDates[$day])->format('d/m/y') }}
                                </th>
                            @endforeach
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($activeDayLists as $day)
                            <td class="@if($day == date('w')) highlight-today @endif">
                                @foreach($schedules as $schedule)
                                    @if($schedule->day === $day)
                                        <table class="table table-bordered">
                                            <thead>
                                            <th colspan="{{ $schedule->classSchedules->count() }}" class="text-center">
                                                {{ $schedule->start_time }} - {{ $schedule->end_time }}
                                            </th>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                @foreach($schedule->classSchedules as $classSchedule)
                                                    <td>
                                                        <table class="table table-bordered">
                                                            <thead>
                                                            <tr>
                                                                <th class="text-center">
                                                                    <a class="btn btn-sm btn-info btn-block"
                                                                       href="{{ route('admin.absence.create', ['date' => $weekDates[$day], 'class_schedule_id' => $classSchedule->id]) }}">{{ $classSchedule->classRoom->name }}</a>
                                                                </th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            @foreach($classSchedule->classStudents as $classStudent)
                                                                <tr>
                                                                    <td>
                                                                        <a href="{{ route('admin.student.view', $classStudent->student) }}">{{ $classStudent->student->name }}</a>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                @endforeach
                                            </tr>
                                            </tbody>
                                        </table>
                                    @endif
                                @endforeach
                            </td>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop
