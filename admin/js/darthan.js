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

    $(".dataTable-general").DataTable();

});

const alertModal = function (selector) {
    selector.on('click', '.alert-modal', function () {
        $('#alert-modal form').attr('action', $(this).data('route'));
        $('#alert-modal .modal-title').html($(this).data('title'));
    })
};

const activeModal = function (selector) {
    selector.on('click', '.active-modal', function () {
        $('#active-modal form').attr('action', $(this).data('route'));
        $('#active-modal input[name=route]').val($(this).data('route'));
        $('#active-modal .modal-title').html($(this).data('title'));
        $('#active-modal input[name=active]').val($(this).data('active'));
        if ($(this).data('name')) {
            $('#active-modal .name-changer').attr('name', $(this).data('name'));
        }
        $('#active-modal input[name=name]').val($(this).data('name'));
    })
};

const customModal = function (selector) {
    selector.on('click', '.custom-modal', function () {
        $($(this).data('target') + ' form').attr('action', $(this).data('route'));
        $($(this).data('target') + ' input[name=route]').val($(this).data('route'));
    })
};