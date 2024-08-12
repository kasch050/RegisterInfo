require(['jquery'], function($) {
    $(function() {
        $('select[name="hear_from_us"]').on('change', function() {
            $('.other-input-container').hide();
            if ( $(this).text() === 'Sonstige' ) {
                $('.other-input-container').fadeIn();
            }
        });
    });
});
