require(['jquery'], function($) {
    $(function() {
        $('select[name="hear_from_us"]').on('change', function() {
            let inputContainer = $('.other-input-container');
            inputContainer.hide();
            if ( $(this).text() === 'Sonstige' ) {
                inputContainer.fadeIn();
            }
        });
    });
});
