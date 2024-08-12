require(['jquery'], function($) {
    $(function() {
        $('select[name="hear_from_us"]').on('change', function() {
            let inputContainer = $('.other-input-container');
            inputContainer.hide();
            if ( $('option:selected', this).text().replace(/\s+/g, '') === 'Sonstige' ) {
                inputContainer.fadeIn();
            }
        });
    });
});
