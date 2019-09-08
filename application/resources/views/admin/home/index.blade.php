{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Main Page')

@section('js')

@stop

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            @foreach($activeDayLists as $day)
                                <th class="text-center">
                                    {{ config('sitri.day')[$day] }}
                                </th>
                            @endforeach
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($activeDayLists as $day)
                            <td>
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
                                                                <th class="text-center">{{ $classSchedule->classRoom->name }}</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            @foreach($classSchedule->classStudents as $classStudent)
                                                                <tr>
                                                                    <td>
                                                                        {{ $classStudent->student->name }}
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
