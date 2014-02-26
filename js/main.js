jQuery(function () {
    jQuery('#comment').submit(function (e) {
        jQuery('.send-comment').addClass('loading');
        jQuery.ajax({
            url: '/comment/json',
            type: "POST",
            cache: false,
            dataType: "script",
            success: function (data) {
                jQuery('.send-comment').removeClass('loading');
            },
            data: jQuery('#comment').serialize(),
            error: function (xhr, status, error) {
                console.log("error:", xhr, status, error);
            }
        });
        e.preventDefault();
    });
});