;(function($) {

    $(document).ready(function() {
        $('.map').bind('click', function(e) {
            e.preventDefault();
            $('.results-container').removeClass('hidden');
            //$('.results-container').scroll();
            $.scrollTo('.results-container');
        });
    });

})(jQuery);
