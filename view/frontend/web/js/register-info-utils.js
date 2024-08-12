require(['jquery'], function($) {
    $(function() {
        $('select[name="hear_from_us"]').on('change', function() {
            $('.other-input-container').hide();
            if ( $(this).val() === '220' ) {
                $('.other-input-container').fadeIn();
            }
        });
    });
});
