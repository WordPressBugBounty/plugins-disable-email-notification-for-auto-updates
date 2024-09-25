(function($) {
    'use strict';
    $(document).ready(function() {
        $(document).on('click', '.itc_disable_update_notifications_dismissed .notice-dismiss', function() {
            var data = {
                action: 'itc_disable_update_notifications_dismissed',
            };

            $.ajax({
                url: ITC_Disable_Update_Notifications_Admin.ajaxurl,
                type: "POST",
                dataType: 'html',
                data: data,
                success: function() {

                }
            });
        });

    });
})(jQuery);