function displayFilterDrawer(isVisible) {
    if (isVisible) {
        $(".filter-button").html('Close Filter');
    } else {
        $(".filter-button").html('Open Filter');
    }
}

$(function () {
    displayFilterDrawer($('.filter-content').is(":visible"));

    $(".filter-button").click(function () {
        $(".filter-content").slideToggle(function () {
            displayFilterDrawer($('.filter-content').is(":visible"));
        });
    });

    $(".select2").select2();
    $(".select2-full").select2({width: '100%'});

    $('input[type=text].datetimepicker').daterangepicker({
        singleDatePicker: true,
        timePicker: true,
        timePicker24Hour: true,
        autoUpdateInput: false,
        locale: {
            cancelLabel: 'Clear',
            format: 'YYYY-MM-DD',
        }
    }).on('apply.daterangepicker', function (ev, picker) {
        $(this).val(picker.startDate.format('YYYY-MM-DD HH:mm'));
    });

    $('input[type=text].datepicker').daterangepicker({
        singleDatePicker: true,
        autoUpdateInput: false,
        locale: {
            cancelLabel: 'Clear',
            format: 'YYYY-MM-DD',
        }
    }).on('apply.daterangepicker', function (ev, picker) {
        $(this).val(picker.startDate.format('YYYY-MM-DD'));
    });

    $('.timepicker').timepicker({
        timeFormat: 'H:mm:ss',
        interval: 30,
        minTime: '8',
        maxTime: '9:00pm',
        startTime: '10:00',
        dynamic: true,
        dropdown: true,
        scrollbar: true
    });

    $(".check-all").click(function () {
        if ($(this).is(':checked')) {
            $('.' + $(this).attr('data-target')).prop('checked', true);
        } else {
            $('.' + $(this).attr('data-target')).prop('checked', false);
        }
    });

})