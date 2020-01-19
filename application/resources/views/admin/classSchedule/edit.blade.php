@extends('adminlte::page')

@section('title')
    Update Class Schedule
@stop

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <form class="form-horizontal" method="post" action="{{ route('admin.classSchedule.update', $classSchedule) }}">
                    <div class="box-body">
                        <div class="form-group @if($errors->first('class_room_id')) has-error @endif">
                            <label for="class_room_id" class="col-sm-2 control-label">Class</label>

                            <div class="col-sm-10">
                                <select class="form-control select2" id="class_room_id" name="class_room_id"
                                        data-placeholder="Select Class">
                                    <option value=""></option>
                                    @foreach($classRooms as $classRoom)
                                        <option value="{{ $classRoom['id'] }}"
                                                @if($classRoom['id'] == old('class_room_id', $classSchedule['class_room_id'])) selected @endif>{{ $classRoom['name'] }}</option>
                                    @endforeach
                                </select>
                                <span class="help-block">{{ $errors->first('class_room_id') }}</span>
                            </div>
                        </div>

                        <div class="form-group @if($errors->first('day')) has-error @endif">
                            <label for="day" class="col-sm-2 control-label">Day</label>

                            <div class="col-sm-10">
                                <select class="form-control" id="day" name="day">
                                    <option value="">Select Day</option>
                                    @foreach($day as $key => $value)
                                        <option value="{{ $key }}"
                                                @if(old('day', $classSchedule['schedule']['day']) == $key) selected @endif>{{ $value }}</option>
                                    @endforeach
                                </select>
                                <span class="help-block">{{ $errors->first('day') }}</span>
                            </div>
                        </div>

                        <div class="form-group @if($errors->first('schedule_id')) has-error @endif">
                            <label for="schedule_id" class="col-sm-2 control-label">Time</label>

                            <div class="col-sm-10">
                                <select class="form-control select2" id="schedule_id" name="schedule_id"
                                        data-placeholder="Select Time">
                                    <option value="">Select Time</option>
                                </select>
                                <span class="help-block">{{ $errors->first('schedule_id') }}</span>
                            </div>
                        </div>

                        <div class="form-group @if($errors->first('active')) has-error @endif">
                            <div class="col-sm-10 col-sm-offset-2">
                                <label class="checkbox-inline">
                                    <input type="checkbox" id="active" name="active" value="1"
                                           @if(old('active', $classSchedule['active']) == 1) checked @endif>Active</label>
                                <span class="help-block">{{ $errors->first('active') }}</span>
                            </div>
                        </div>

                        <div class="form-group @if($errors->first('is_trial')) has-error @endif">
                            <div class="col-sm-10 col-sm-offset-2">
                                <label class="checkbox-inline">
                                    <input type="checkbox" id="is_trial" name="is_trial" value="1"
                                           @if(old('is_trial', $classSchedule['is_trial']) == 1) checked @endif>Trial</label>
                                <span class="help-block">{{ $errors->first('is_trial') }}</span>
                            </div>
                        </div>

                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-info pull-right">Update</button>
                        <a href="{{ route('admin.classSchedule.index') }}" class="btn btn-default pull-right">Cancel</a>
                    </div>
                    <!-- /.box-footer -->
                </form>
            </div>

        </div>
    </div>
@stop

@section('js')
    <script>
        $(function () {
            let old_time = '{{ old('schedule_id', $classSchedule['schedule_id']) }}';

            let daySelector = $('select[name=day]');
            let scheduleSelector = $('select[name=schedule_id]');
            scheduleSelector.prop("disabled", true);

            const dynamicSchedule = function () {
                if (daySelector.val() === '') {
                    scheduleSelector.val('').trigger('change').prop("disabled", true);
                } else {
                    scheduleSelector.prop("disabled", false);
                    $.get("{{ route('admin.classSchedule.getTimeByDay') }}",
                        {
                            day: daySelector.val(),
                        },
                        function (data) {
                            scheduleSelector.empty();
                            $.each(data, function (i, field) {
                                if (old_time === field.id) {
                                    scheduleSelector.append("<option value='" + field.id + "' selected>" + field.start_time + " - " + field.end_time + "</option>");
                                } else {
                                    scheduleSelector.append("<option value='" + field.id + "'>" + field.start_time + " - " + field.end_time + "</option>");
                                }
                                scheduleSelector.val(old_time).trigger('change');
                            });
                        });
                }
            };

            dynamicSchedule();


            $(document).on('change', 'select[name=day]', function () {
                dynamicSchedule();
            });

        });

    </script>
@stop
