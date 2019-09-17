@extends('adminlte::register')

@section('additional-input')

    <div class="append-input-student">
        @forelse(old('student_name', []) as $key => $value)
            <div class="form-group has-feedback {{ $errors->has('student_name.'.$key) ? 'has-error' : '' }}">
                <div class="input-group">
                    <input type="text" id="student_name" name="student_name[{{ $key }}]"
                           class="form-control"
                           value="{{ old('student_name.'.$key) }}" placeholder="Student Name">
                    <div class="input-group-btn">
                        <button class="btn btn-danger delete-student" type="button">
                            Delete
                        </button>
                    </div>
                </div>
                @if ($errors->has('student_name.'.$key))
                    <span class="help-block">
                                    <strong>{{ $errors->first('student_name.'.$key) }}</strong>
                                </span>
                @endif
            </div>
        @empty
            <div class="form-group has-feedback">
                <div class="input-group">
                    <input type="text" id="student_name" name="student_name[]"
                           class="form-control"
                           value="" placeholder="Student Name">
                    <div class="input-group-btn">
                        <button class="btn btn-danger delete-student" type="button">
                            Delete
                        </button>
                    </div>
                </div>
            </div>
        @endforelse
    </div>
    <button type="button" class="btn btn-primary btn-block add-student btn-sm">Add more student
    </button>
@stop

@section('js')
    <script type="text/javascript">
        $(function () {
            $('.add-student').click(function () {
                $html = '<div class="form-group has-feedback">' +
                    '<div class="input-group">' +
                    '<input type="text" id="student_name" name="student_name[]" class="form-control" value="" placeholder="Student Name">' +
                    '<div class="input-group-btn">' +
                    '<button class="btn btn-danger delete-student" type="button">Delete</button>' +
                    '</div>' +
                    '</div>' +
                    '</div>';
                $('.append-input-student').append($html);
            });

            $('.append-input-student').on('click', '.delete-student', function () {
                $(this).parent().parent().parent().remove();
            })
        });
    </script>
@stop
