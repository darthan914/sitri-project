{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Main Page')

@section('js')
    <script>
        sweetAlertDelete($('body'), function () {
            location.reload();
        });
    </script>
@stop

@section('css')
    <style>
        .highlight-today {
            background-color: #00e765;
        }

        .strikethrough {
            text-decoration: line-through;
        }

        .italic {
            font-style: italic;
            font-weight: bold;
            background-color: yellow;

        }

        .content-overflow {
            overflow: auto;
        }
    </style>
@stop

@section('content')
    @include('admin._general.modal.alert')
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
                                <td>{{ $student['surname'] ?? $student['name'] }}</td>
                                <td>{{ $student['user']['name'] }}</td>
                                <td><a href="{{ route('admin.student.view', $student['id']) }}"
                                       class="btn btn-sm btn-primary">View</a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="box">
                <div class="box-title">
                    <h2>Student On Trial</h2>
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
                        @foreach($studentOnTrial as $student)
                            <tr>
                                <td>{{ $student['surname'] ?? $student['name'] }}</td>
                                <td>{{ $student['user']['name'] }}</td>
                                <td>
                                    <a href="{{ route('admin.student.edit', $student['id']) }}"
                                       class="btn btn-sm btn-success">OK</a>
                                    <button type="button"
                                            data-route="{{ route('admin.student.delete', $student['id']) }}"
                                            data-title="Delete {{ $student['name'] }}"
                                            class="btn btn-sm btn-danger sweet-alert-delete">Cancel
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>


            <div class="box content-overflow">
                <div class="box-title">
                    <h2>Schedule Table</h2>
                </div>
                <div class="box-body">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            @foreach($tableSchedules as $tableSchedule)
                                <th class="text-center @if($tableSchedule['day'] == date('w')) highlight-today @endif"
                                    nowrap>
                                    {{ config('sitri.day')[$tableSchedule['day']] }} {{ \Carbon\Carbon::parse($tableSchedule['date'])->format('d/m/y') }}
                                </th>
                            @endforeach
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($tableSchedules as $tableSchedule)
                            <td class="@if($tableSchedule == date('w')) highlight-today @endif">
                                @foreach($tableSchedule['schedules'] as $schedule)
                                    <table class="table table-bordered" style="min-height: 300px">
                                        <thead>
                                        <th colspan="{{ count($schedule['class_rooms']) }}" class="text-center"
                                            nowrap>
                                            {{ $schedule['time'] }}
                                        </th>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            @foreach($schedule['class_rooms'] as $classRoom)
                                                <td>
                                                    <table class="table table-bordered">
                                                        <thead>
                                                        <tr>
                                                            <th class="text-center" style="width: 7em;" colspan="3">
                                                                <a class="btn btn-sm btn-info btn-block"
                                                                   href="{{ route('admin.absence.create', ['date' => $tableSchedule['date'], 'class_schedule_id' => $classRoom['class_schedule_id']]) }}">
                                                                    {{ $classRoom['name'] }}
                                                                </a>
                                                            </th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @php $num = 1 @endphp
                                                        @foreach($classRoom['students'] as $student)
                                                            <tr>
                                                                <td nowrap>
                                                                    <a href="{{ route('admin.student.view', $student['student_id']) }}"
                                                                       class="@if($student['on_reschedule']) strikethrough @endif"
                                                                    >{{ $num++ }}</a>
                                                                </td>

                                                                <td nowrap>
                                                                    <a href="{{ route('admin.student.view', $student['student_id']) }}"
                                                                       class="@if($student['on_reschedule']) strikethrough @endif"
                                                                    >{{ $student['student_name'] }}</a>
                                                                </td>

                                                                <td nowrap>
                                                                    <a href="{{ route('admin.student.view', $student['student_id']) }}"
                                                                       class="@if($student['on_reschedule']) strikethrough @endif"
                                                                    >{{ $student['teacher_name'] }}</a>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                        @foreach($classRoom['student_reschedules'] as $student)
                                                            <tr>
                                                                <td>
                                                                    <a href="{{ route('admin.student.view', $student['student_id']) }}"
                                                                       class="italic"
                                                                    >{{ $num++ }}</a>
                                                                </td>
                                                                <td>
                                                                    <a href="{{ route('admin.student.view', $student['student_id']) }}"
                                                                       class="italic"
                                                                    >{{ $student['student_name'] }}</a>
                                                                </td>
                                                                <td>
                                                                    <a href="{{ route('admin.student.view', $student['student_id']) }}"
                                                                       class="italic"
                                                                    >{{ $student['teacher_name'] }}</a>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                        @foreach(range(1, 16 - count($classRoom['students']) - count($classRoom['student_reschedules'])) as $number)
                                                            <tr>
                                                                <td nowrap>{{ $num++ }}</td>
                                                                <td nowrap></td>
                                                                <td nowrap></td>
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                </td>
                                            @endforeach
                                        </tr>
                                        </tbody>
                                    </table>
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
