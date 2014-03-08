jQuery(function () {
    jQuery(".single-comment").draggable({
        connectWith: '.connectedSortable, #trash',
        revert: true
    }).disableSelection();

    jQuery(".trash").droppable({
        accept: ".single-comment",
        hoverClass: "ui-state-hover",
        activeClass: "ui-state-highlight",
        greedy: true,
        tolerance: "touch",
        over: function (event, ui) {
            console.log(ui);
            jQuery(ui.draggable).addClass('remove');
        },
        out: function (event, ui) {
            jQuery(ui.draggable).removeClass('remove');
        },
        drop: function (event, ui) {
            jQuery(ui.draggable).addClass('really');
            jQuery(ui.draggable).bind("transitionend webkitTransitionEnd oTransitionEnd MSTransitionEnd", function () {
                ui.draggable.remove();
            });
        }
    });

    jQuery('#comment').submit(function (e) {
        jQuery.ajax({
            url: '/Comment/Json',
            type: "POST",
            cache: false,
            dataType: "script",
            success: function (data) {
            },
            data: jQuery('#comment').serialize(),
            error: function (xhr, status, error) {
                console.log("error:", xhr, status, error);
            }
        });
        e.preventDefault();
    });

    var now = new Date();
    updateDate();
    function updateDate() {
        jQuery.ajax({
            url: '/Comment/New?after=' + now.getTime() / 1000,
            type: "POST",
            cache: false,
            dataType: "script",
            success: function (data) {
                if (data != '') {
                    now = new Date();
                }
                updateDate();
            },
            error: function (xhr, status, error) {
                updateDate();
                console.log("error:", xhr, status, error);
            }
        });
    }
});