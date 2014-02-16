jQuery(function () {
    jQuery('#addComment').submit(function (e) {
        jQuery('.send-comment').addClass('loading');
        jQuery.ajax({
            url: '/comment/json',
            type: "POST",
            cache: false,
            success: function (data) {
                jQuery('.send-comment').removeClass('loading');
                console.log(data);
                jQuery('#addComment .error').html(data.message.error);
                jQuery('#addComment .error').slideDown();
            },
            data: jQuery('#addComment').serialize(),
            error: function (xhr, status, error) {
                console.log("error:", xhr, status, error);
            }
        });
        e.preventDefault();
    });
});