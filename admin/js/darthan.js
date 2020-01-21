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

    $('input[type=text].datepicker').datepicker({
        changeMonth: true,
        changeYear: true,
        maxDate: "",
        dateFormat: "yy-mm-dd",
        yearRange: "c-75:c+0",
        beforeShowDay: function (date) {
            let day = date.getDay();
            let onlyDay = $(this).attr('data-only-day');
            if (onlyDay === undefined) {
                return [true];
            }

            let array = onlyDay.split(',');
            return [array.includes(day.toString()) || array === []];
        }
    });

    $('input[type=text].timepicker').timepicker({
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

new AutoNumeric.multiple('.currency', {
    decimalCharacter: '.',
    digitGroupSeparator: ',',
    decimalPlaces: 0,
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

const sweetAlertDateActive = function (selector, cbSuccess = emptyFunction(), cbError = emptyFunction()) {
    selector.on('click', '.sweet-alert-date-active', function () {
        let option = {
            title: $(this).attr('data-title'),
            type: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes',
        };

        if ($(this).attr('data-active') === '1') {
            let addOption = {
                html: '<input type="text" id="sweet-alert-datepicker" name="date" placeholder="Date" autocomplete="off">',
                onOpen: function () {
                    $('#sweet-alert-datepicker').datepicker({
                        changeMonth: true,
                        changeYear: true,
                        maxDate: "",
                        dateFormat: "yy-mm-dd",
                    });
                },
            };

            option = Object.assign(option, addOption);
        }


        Swal.fire(option).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "POST",
                    url: $(this).attr('data-route'),
                    data: {
                        active: $(this).attr('data-active'),
                        date: $('#sweet-alert-datepicker').val(),
                    },
                    success: function (response) {
                        Swal.fire("Success!", response.messages, "success");
                        cbSuccess();
                    },
                    error: function (response) {
                        Swal.fire("Failed!", 'Failed to update!', "error");
                        cbError();
                    }
                });
            }
        })
    });
};

const sweetAlertActive = function (selector, cbSuccess = emptyFunction(), cbError = emptyFunction()) {
    selector.on('click', '.sweet-alert-active', function () {
        Swal.fire({
            title: $(this).attr('data-title'),
            type: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "POST",
                    url: $(this).attr('data-route'),
                    data: {
                        active: $(this).attr('data-active'),
                    },
                    success: function (response) {
                        Swal.fire("Success!", response.messages, "success");
                        cbSuccess();
                    },
                    error: function (response) {
                        Swal.fire("Failed!", 'Failed to update!', "error");
                        cbError();
                    }
                });
            }
        })
    });
};

const sweetAlertDelete = function (selector, cbSuccess = emptyFunction(), cbError = emptyFunction()) {
    selector.on('click', '.sweet-alert-delete', function () {
        Swal.fire({
            title: $(this).attr('data-title'),
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "POST",
                    url: $(this).attr('data-route'),
                    cache: false,
                    success: function (response) {
                        Swal.fire("Success!", response.messages, "success");
                        cbSuccess();
                    },
                    error: function (response) {
                        Swal.fire("Failed!", 'Failed to delete!', "error");
                        cbError();
                    }
                });
            }
        })
    });
};

const hideShowCheckbox = function (selector, target) {
    if (selector.prop('checked') === false) {
        target.hide();
    }

    selector.click(function () {
        target.slideToggle();

    });
};

const hideShowRadio = function (name, target, data) {
    for (let key in data) {
        if ($('input[name=' + name + '][value=' + data[key].value + ']').prop('checked') === false) {
            data[key].target.hide();
        }
    }

    $('input[name=' + name + ']').change(function () {
        let value = $(this).val();
        target.slideUp();

        for (let key in data) {
            if (value === data[key].value) {
                data[key].target.slideDown();
            }
        }
    });
};

const emptyFunction = function () {
};