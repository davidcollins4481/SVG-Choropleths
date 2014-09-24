;(function($) {

    $(document).ready(function() {
        $('.map').bind('click', function(e) {
            e.preventDefault();
            $('.results-container').removeClass('hidden');
        });
    });

})(jQuery);
