<script>
    $(function () {
        let studentSelector = $('select[name=student_id]');
        let fromDateSelector = $('input[name=from_date]');
        let fromScheduleClassSelector = $('select[name=from_class_schedule_id]');
        let toDateSelector = $('input[name=to_date]');
        let toScheduleClassSelector = $('select[name=to_class_schedule_id]');
        getDayAvailable();

        $(document).on('change', 'select[name=student_id]', function () {
            fromScheduleClassSelector.empty().val('').trigger('change');
            toScheduleClassSelector.empty().val('').trigger('change');
            fromDateSelector.val('');
            toDateSelector.val('');

            getDayAvailable();
        });

        $(document).on('change', 'input[name=from_date]', function () {
            $.get("{{ route('admin.reschedule.getRegularStudent') }}",
                {
                    student_id: studentSelector.val(),
                    date: fromDateSelector.val(),
                },
                function (data) {
                    fromScheduleClassSelector.empty();
                    $.each(data, function (i, field) {
                        fromScheduleClassSelector.append("<option value='" + field.id + "'>" + field.name + "</option>");
                    });
                    fromScheduleClassSelector.val('').trigger('change');
                });

        });

        $(document).on('change', 'input[name=to_date]', function () {
            if (fromDateSelector.val() !== '') {
                $.get("{{ route('admin.reschedule.getScheduleAvailable') }}",
                    {
                        student_id: studentSelector.val(),
                        to_date: toDateSelector.val(),
                        from_date: fromDateSelector.val(),
                    },
                    function (data) {
                        toScheduleClassSelector.empty();
                        $.each(data, function (i, field) {
                            toScheduleClassSelector.append("<option value='" + field.id + "'>" + field.name + "</option>");
                        });
                        toScheduleClassSelector.val('').trigger('change');
                    });
            }


        });

        function getDayAvailable() {
            $.get("{{ route('admin.reschedule.getDayAvailable') }}",
                {
                    student_id: studentSelector.val(),
                },
                function (data) {
                    fromDateSelector.attr('data-only-day', data)
                });
        }
    });
</script>
