@extends('adminlte::page')

@section('title')
    Create Item
@stop

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <form class="form-horizontal" method="post" action="{{ route('admin.item.store') }}">
                    <div class="box-body">
                        <div class="form-group @if($errors->first('name')) has-error @endif">
                            <label for="name" class="col-sm-2 control-label">Nama Barang</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="name" name="name"
                                       placeholder="Nama Barang"
                                       value="{{ old('name') }}">
                                <span class="help-block">{{ $errors->first('name') }}</span>
                            </div>
                        </div>

                        <div class="form-group @if($errors->first('value')) has-error @endif">
                            <label for="value" class="col-sm-2 control-label">Harga</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control currency" id="value" name="value"
                                       placeholder="Harga"
                                       autocomplete="off"
                                       value="{{ old('value') }}">
                                <span class="help-block">{{ $errors->first('value') }}</span>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-info pull-right">Create</button>
                        <a href="{{ route('admin.item.index') }}" class="btn btn-default pull-right">Cancel</a>
                    </div>
                    <!-- /.box-footer -->
                </form>
            </div>

        </div>
    </div>
@stop

@push('js')
    <script>
        $(function () {
            $('input[name=name]').blur(function () {
                $.ajax(
                    {
                        url: '{{ route('admin.user.getUserByEmail') }}',
                        data: {
                            email: $(this).val()
                        },
                        success: function (data) {
                            if (data) {
                                $('input[name=value]').val(data.name);
                                $('input[name=parent_phone]').val(data.phone);
                            }
                        }
                    }
                );
            });

            $('input[name=birthday]').change(function () {
                let year = new Date().getFullYear();

                $('input[name=age]').val(year - $(this).datepicker("getDate").getFullYear());
            });

            let old_time = '{{ old('schedule_id') }}';

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
        })
    </script>

@endpush
