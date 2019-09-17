<script>
    $(function () {
        let oldClassScheduleId = '{{ old('class_schedule_id', $request->class_schedule_id) }}';
        let oldDate = '{{ old('date', $request->date) }}';
        let classScheduleSelector = $('select[name=class_schedule_id]');
        let dateSelector = $('input[name=date]');

        if(oldDate !== '') {
            getScheduleDate(oldDate);
            if(oldClassScheduleId !== '') {
                getStudentList(oldClassScheduleId, oldDate);
            }
        }

        $(document).on('blur', 'input[name=date]', function () {
            if (dateSelector.val() !== '') {
                getScheduleDate(dateSelector.val());
            }
            $('.student-list').html('');
        });

        $(document).on('change', 'select[name=class_schedule_id]', function () {
            if (dateSelector.val() !== '') {
                getStudentList(classScheduleSelector.val(), dateSelector.val());
            }
        });

        function getScheduleDate(date) {
            $.get("{{ route('admin.absence.getScheduleDate') }}",
                {
                    date: date,
                },
                function (data) {
                    classScheduleSelector.empty();
                    $.each(data, function (i, field) {
                        classScheduleSelector.append("<option value='" + field.id + "'>" + field.name + "</option>");
                    });
                    classScheduleSelector.val(oldClassScheduleId).trigger('change');
                });

        }

        function getStudentList(classSchedule, date) {
            $.get("{{ route('admin.absence.getStudentList') }}",
                {
                    class_schedule_id: classSchedule,
                    date: date,
                },
                function (data) {
                    $('.student-list').html(data);
                });

        }
    });
</script>
