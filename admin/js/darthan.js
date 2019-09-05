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

})