jQuery(function () {
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
    function updateDate(){
        jQuery.ajax({
            url: '/Comment/New?after='+now.getTime()/1000,
            type: "POST",
            cache: false,
            dataType: "script",
            success: function (data) {
                if (data != ''){
                    now = new Date();
                }
                console.log(data);
                updateDate();
            },
            error: function (xhr, status, error) {
                console.log("error:", xhr, status, error);
            }
        });
    }
});