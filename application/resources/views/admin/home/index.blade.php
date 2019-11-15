{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Main Page')

@section('js')
    <script>
        $(function () {
            $('.alert-modal').click(function () {
                $('#alert-modal form').attr('action', $(this).data('route'));
                $('#alert-modal .modal-title').html($(this).data('title'));
            });
        })
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
                                <td>{{ $student->surname ?? $student->name }}</td>
                                <td>{{ $student->user->name ?? '' }}</td>
                                <td><a href="{{ route('admin.student.view', $student) }}"
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
                                <td>{{ $student->surname ?? $student->name }}</td>
                                <td>{{ $student->user->name }}</td>
                                <td>
                                    <a href="{{ route('admin.student.edit', $student) }}"
                                       class="btn btn-sm btn-success">OK</a>
                                    <button type="button" data-toggle="modal" data-target="#alert-modal"
                                            data-route="{{ route('admin.student.delete', $student) }}"
                                            data-title="Delete {{ $student->name }}"
                                            class="btn btn-sm btn-danger alert-modal">Cancel
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
                                        <table class="table table-bordered" style="min-height: 300px">
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
                                                                <th class="text-center" style="width: 7em;">
                                                                    <a class="btn btn-sm btn-info btn-block"
                                                                       href="{{ route('admin.absence.create', ['date' => $weekDates[$day], 'class_schedule_id' => $classSchedule->id]) }}">{{ $classSchedule->classRoom->name }} - {{ $classSchedule->teacher_name }}</a>
                                                                </th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            @php $num = 1 @endphp
                                                            @foreach($classSchedule->classStudents as $classStudent)
                                                                <tr>
                                                                    <td>
                                                                        <a href="{{ route('admin.student.view', $classStudent->student) }}"
                                                                           class="@if(isset($listRescheduleFrom[$weekDates[$day]][$classStudent->student_id])) strikethrough @endif"
                                                                        >{{ $num++ }}. {{ $classStudent->student->surname ?? $classStudent->student->name ?? '' }}</a>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                            @foreach($rescheduleTo as $reschedule)
                                                                @if($weekDates[$day] === $reschedule->to_date && $reschedule->to_class_schedule_id === $classSchedule->id)
                                                                    <tr>
                                                                        <td>
                                                                            <a href="{{ route('admin.student.view', $reschedule->student) }}"
                                                                               class="italic"
                                                                            >{{ $num++ }}. {{ $classStudent->student->surname ?? $reschedule->student->name }}</a>
                                                                        </td>
                                                                    </tr>
                                                                @endif
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
