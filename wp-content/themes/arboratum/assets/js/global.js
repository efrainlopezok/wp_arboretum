/**
 *
 * Add .js class to body tag if JavaScript is enabled
 *
 * @since 1.0.0
 *
 */
document.getElementsByTagName("body")[0].className += " js";

(function($) {

    $(document).ready(function() {
        $(".site-header").hcSticky({top: 0});
        //$(".sfm-navicon-button.sf_label_default").hcSticky({top: 6});

        $('.custom-form :input').focus(function() {
            $(".custom-form label[for='" + this.id + "']").addClass('active');
        }).blur(function() {
            $(".custom-form label[for='" + this.id + "']").removeClass('active');
            tmpval = $(this).val();
            if (tmpval == '') {
                $(".custom-form label[for='" + this.id + "']").removeClass('active');
            } else {
                $(".custom-form label[for='" + this.id + "']").addClass('active');
            }
        });
        /**
         * Tool Tips on map
         */
        $('.TooltipRight').jBox('Tooltip', {
            position: {
                x: 'right',
                y: 'center'
            },
            outside: 'x' // Horizontal Tooltips need to change their outside position
        });
    });

})(jQuery);