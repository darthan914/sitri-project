@extends('adminlte::page')

@section('title')
    Edit Payment
@stop

@section('js')
    <script>
        $(function () {
            hideShowCheckbox($('input[name=use_registration]'), $('.use-registration'));
            hideShowCheckbox($('input[name=use_monthly]'), $('.use-monthly'));
            hideShowCheckbox($('input[name=use_shopping]'), $('.use-shopping'));

            hideShowRadio('type_month_payment', $('.radio-use-monthly'), [
                {'value': 'ONE_MONTH', 'target': $('.use-one-month')},
                {'value': 'THREE_MONTH', 'target': $('.use-three-month')},
                {'value': 'DAY_OFF', 'target': $('.use-day-off')},
            ]);

            $('.add-item').click(function () {
                $html =
                    '<div>' +
                    '<div class="form-group">' +
                    '<label for="item" class="col-sm-2 control-label">Barang / Quantity</label>' +
                    '<div class="col-sm-6">' +
                    '<select class="form-control select2" id="item" name="item[]" data-placeholder="Pilih Barang">' +
                    '<option value=""></option>' +
                    @foreach($items as $item)
                        '<option value="{{ $item['name'] }}">{{ $item['name'] }} - Rp. {{ number_format($item['value']) }}</option>' +
                    @endforeach
                        '</select>' +
                    '</div>' +
                    '<div class="col-sm-2">' +
                    '<input type="number" class="form-control" id="quantity" name="quantity[]" placeholder="Quantity" value="0">' +
                    '</div>' +
                    '<div class="col-sm-2">' +
                    '<button class="btn btn-block btn-danger delete-item" type="button">Delete</button>' +
                    '</div>' +
                    '</div>' +
                    '</div>';
                $('.append-input-item').append($html);
                $('.select2').select2();
            });

            $('.append-input-item').on('click', '.delete-item', function () {
                $(this).parent().parent().parent().remove();

            });

        })
    </script>

@stop

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <form class="form-horizontal" method="post"
                      action="{{ route('admin.payment.update', $payment['id']) }}">
                    <div class="box-body">
                        <div class="form-group @if($errors->first('student_id')) has-error @endif">
                            <label for="student_id" class="col-sm-2 control-label">Student</label>

                            <div class="col-sm-10">
                                <select class="form-control select2" id="student_id" name="student_id"
                                        data-placeholder="Select Student">
                                    <option value=""></option>
                                    @foreach($students as $student)
                                        <option value="{{ $student['id'] }}"
                                                @if(old('student_id', $payment['student_id']) == $student['id']) selected @endif>{{ $student['name'] }}</option>
                                    @endforeach
                                </select>
                                <span class="help-block">{{ $errors->first('student_id') }}</span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="register_value" class="col-sm-2 control-label"></label>

                            <div class="col-sm-10">
                                <label class="checkbox-inline">
                                    <input type="checkbox" name="use_registration" value="1"
                                           @if(old('use_registration', $payment['use_registration']) == 1) checked @endif>
                                    Gunakan Pendaftaran</label>
                                <label class="checkbox-inline">
                                    <input type="checkbox" name="use_monthly" value="1"
                                           @if(old('use_monthly', $payment['use_monthly']) == 1) checked @endif>
                                    Gunakan Bulanan</label>
                                <label class="checkbox-inline">
                                    <input type="checkbox" name="use_shopping" value="1"
                                           @if(old('use_shopping', $payment['use_shopping']) == 1) checked @endif>
                                    Gunakan Belanja</label>
                                <span class="help-block"></span>
                            </div>
                        </div>

                        <div class="use-registration">
                            <div class="form-group @if($errors->first('register_value')) has-error @endif">
                                <label for="register_value" class="col-sm-2 control-label">Pendaftaran</label>

                                <div class="col-sm-10">
                                    <input type="text" class="form-control currency" id="register_value"
                                           name="register_value"
                                           placeholder="Pendaftaran"
                                           value="{{ old('register_value', $payment['register_value']) }}">
                                    <span class="help-block">{{ $errors->first('register_value') }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="use-monthly">
                            <div class="form-group">
                                <label for="type_month_payment" class="col-sm-2 control-label"></label>

                                <div class="col-sm-10">
                                    <label class="radio-inline">
                                        <input type="radio" name="type_month_payment" value="ONE_MONTH"
                                               @if(old('type_month_payment', $payment['type_month_payment']) == 'ONE_MONTH') checked @endif>1
                                        Bulan</label>
                                    <label class="radio-inline">
                                        <input type="radio" name="type_month_payment" value="THREE_MONTH"
                                               @if(old('type_month_payment', $payment['type_month_payment']) == 'THREE_MONTH') checked @endif>3
                                        Bulan</label>
                                    <label class="radio-inline">
                                        <input type="radio" name="type_month_payment" value="DAY_OFF"
                                               @if(old('type_month_payment', $payment['type_month_payment']) == 'DAY_OFF') checked @endif>Cuti</label>
                                    <span class="help-block"></span>
                                </div>
                            </div>

                            <div class="radio-use-monthly use-one-month">
                                <div class="form-group @if($errors->first('one_month_month')) has-error @endif">
                                    <label for="one_month_month" class="col-sm-2 control-label">Bulan</label>

                                    <div class="col-sm-10">
                                        <select class="form-control select2" id="one_month_month" name="one_month_month"
                                                data-placeholder="Select Month">
                                            <option value=""></option>
                                            @foreach($months as $key => $month)
                                                <option value="{{ $key }}"
                                                        @if(old('one_month_month', $payment['one_month_month']) == $key) selected @endif>{{ $month }}</option>
                                            @endforeach
                                        </select>
                                        <span class="help-block">{{ $errors->first('one_month_month') }}</span>
                                    </div>
                                </div>

                                <div class="form-group @if($errors->first('one_month_value')) has-error @endif">
                                    <label for="one_month_value" class="col-sm-2 control-label">Biaya 1 bulan</label>

                                    <div class="col-sm-10">
                                        <input type="text" class="form-control currency" id="one_month_value"
                                               name="one_month_value"
                                               placeholder="Biaya"
                                               value="{{ old('one_month_value', $payment['one_month_value']) }}">
                                        <span class="help-block">{{ $errors->first('one_month_value') }}</span>
                                    </div>
                                </div>
                            </div>

                            <div class="radio-use-monthly use-three-month">
                                <div class="form-group @if($errors->first('three_month_month')) has-error @endif">
                                    <label for="three_month_month" class="col-sm-2 control-label">Bulan antara</label>

                                    <div class="col-sm-10">
                                        <select class="form-control select2" id="three_month_month"
                                                name="three_month_month"
                                                data-placeholder="Select Month">
                                            <option value=""></option>
                                            @foreach($months as $key => $month)
                                                @php $plus2Month = (($key + 1) % 12) + 1 @endphp
                                                <option value="{{ $key }}-{{ $plus2Month }}"
                                                        @if(old('three_month_month', $payment['three_month_month']) == $key.'-'.$plus2Month) selected @endif>{{ $month }} - {{ config('sitri.month')[$plus2Month] }}</option>
                                            @endforeach
                                        </select>
                                        <span class="help-block">{{ $errors->first('three_month_month') }}</span>
                                    </div>
                                </div>

                                <div class="form-group @if($errors->first('three_month_value')) has-error @endif">
                                    <label for="three_month_value" class="col-sm-2 control-label">Biaya 3 bulan</label>

                                    <div class="col-sm-10">
                                        <input type="text" class="form-control currency" id="three_month_value"
                                               name="three_month_value"
                                               placeholder="Biaya"
                                               value="{{ old('three_month_value', $payment['three_month_value']) }}">
                                        <span class="help-block">{{ $errors->first('three_month_value') }}</span>
                                    </div>
                                </div>
                            </div>

                            <div class="radio-use-monthly use-day-off">
                                <div class="form-group @if($errors->first('day_off_month')) has-error @endif">
                                    <label for="month" class="col-sm-2 control-label">Bulan</label>

                                    <div class="col-sm-10">
                                        <select class="form-control select2" id="day_off_month" name="day_off_month"
                                                data-placeholder="Select Month">
                                            <option value=""></option>
                                            @foreach($months as $key => $month)
                                                <option value="{{ $key }}"
                                                        @if(old('day_off_month', $payment['day_off_month']) == $key) selected @endif>{{ $month }}</option>
                                            @endforeach
                                        </select>
                                        <span class="help-block">{{ $errors->first('day_off_month') }}</span>
                                    </div>
                                </div>

                                <div class="form-group @if($errors->first('day_off_value')) has-error @endif">
                                    <label for="day_off_value" class="col-sm-2 control-label">Cuti</label>

                                    <div class="col-sm-10">
                                        <input type="text" class="form-control currency" id="day_off_value"
                                               name="day_off_value"
                                               placeholder="Cuti"
                                               value="{{ old('day_off_value', $payment['day_off_value']) }}">
                                        <span class="help-block">{{ $errors->first('day_off_value') }}</span>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="use-shopping">
                            <div class="append-input-item">
                                @forelse(old('item', $payment['items']) as $key => $value)
                                    <div>
                                        <div
                                            class="form-group @if($errors->first('item.'.$key) || $errors->first('quantity.'.$key)) has-error @endif">
                                            <label for="item" class="col-sm-2 control-label">Barang / Quantity</label>
                                            <div class="col-sm-6">
                                                @php $itemExists = collect($items)->pluck('name')->all(); @endphp
                                                <select class="form-control select2" id="item"
                                                        name="item[]"
                                                        @if(!in_array($payment['items'][$key]['name'], $itemExists))
                                                        data-placeholder="(Item: {{ $payment['items'][$key]['name'] }} - Rp. {{ number_format($payment['items'][$key]['value']) }}, has been deleted or updated)"
                                                        @else
                                                        data-placeholder="Pilih Barang"
                                                    @endif
                                                >
                                                    <option value=""></option>
                                                    @foreach($items as $item)
                                                        <option value="{{ $item['name'] }}"
                                                                @if($item['name'] == old('item.'.$key, $payment['items'][$key]['name'])) selected @endif>{{ $item['name'] }}
                                                            - Rp. {{ number_format($item['value']) }}</option>
                                                    @endforeach
                                                </select>


                                                <span class="help-block">{{ $errors->first('item.'.$key) }}</span>
                                            </div>

                                            <div class="col-sm-2">
                                                <input type="number" class="form-control" id="quantity"
                                                       name="quantity[]"
                                                       placeholder="Quantity"
                                                       value="{{ old('quantity.'.$key, $payment['items'][$key]['quantity']) }}">
                                                <span class="help-block">{{ $errors->first('quantity.'.$key) }}</span>
                                            </div>

                                            <div class="col-sm-2">
                                                <button class="btn btn-block btn-danger delete-item" type="button">
                                                    Delete
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                @empty
                                    <div>
                                        <div class="form-group">
                                            <label for="item" class="col-sm-2 control-label">Barang / Quantity</label>
                                            <div class="col-sm-6">
                                                <select class="form-control select2" id="item"
                                                        name="item[]"
                                                        data-placeholder="Pilih Barang">
                                                    <option value=""></option>
                                                    @foreach($items as $item)
                                                        <option value="{{ $item['name'] }}">{{ $item['name'] }} -
                                                            Rp. {{ number_format($item['value']) }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="col-sm-2">
                                                <input type="number" class="form-control" id="quantity"
                                                       name="quantity[]" placeholder="Quantity" value="0">
                                            </div>

                                            <div class="col-sm-2">
                                                <button class="btn btn-block btn-danger delete-item" type="button">
                                                    Delete
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                @endforelse
                            </div>

                            <div class="form-group">
                                <div class="col-sm-12">
                                    <button type="button" class="btn btn-primary btn-block add-item btn-sm">Add more
                                        item
                                    </button>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-info pull-right">Update</button>
                        <a href="{{ route('admin.payment.index') }}" class="btn btn-default pull-right">Cancel</a>
                    </div>
                    <!-- /.box-footer -->
                </form>
            </div>

        </div>
    </div>
@stop
