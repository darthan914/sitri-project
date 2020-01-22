{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Dashboard')

@section('js')

@stop

@section('css')
    <style>
        .color-paid {
            background-color: #00ff00;
        }
        .color-time {
            background-color: #00ffff;
        }
        .color-class {
            background-color: #b4b4b4;
        }
        .color-student {
            background-color: #fffc00;
        }
    </style>
@stop

@section('content')
    @include('admin.dashboard.filter.index')
    <div class="row">
        <div class="col-xs-12">
            <div class="box content-overflow">
                <div class="box-title">
                    <h2>Schedule Table</h2>
                </div>
                <div class="box-body">
                    @foreach($headerTables as $day => $headerTable)
                        <h2>{{ $headerTable['name'] }}</h2>
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th class="color-student">Student</th>
                                @foreach($headerTable['dates'] as $date)
                                    <th>{{ $date }}</th>
                                @endforeach
                                <th class="color-paid">Bulanan</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($tableDashboards[$day] as $dashboard)
                                @foreach($dashboard as $schedule)
                                    <tr>
                                        <td colspan="{{ 2 + count($headerTable['dates']) }}" class="color-time">
                                            Jam {{ $schedule['time'] }}</td>
                                    </tr>
                                    @foreach($schedule['class_rooms'] as $classRoom)
                                        <tr>
                                            <td colspan="{{ 2 + count($headerTable['dates']) }}" class="color-class">
                                                Kelas {{ $classRoom['name'] }}</td>
                                        </tr>
                                        @foreach($classRoom['students'] as $student)
                                            <tr>
                                                <td class="color-student">{{ $student['student_name'] }}</td>
                                                @foreach($headerTable['dates'] as $date)
                                                    <td>{{ $student['absences'][$date] }}</td>
                                                @endforeach
                                                <td class="color-paid">{{ $student['paid'] }}</td>
                                            </tr>
                                        @endforeach
                                    @endforeach
                                @endforeach
                            @endforeach
                            </tbody>
                        </table>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@stop
