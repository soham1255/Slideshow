(function($){
    var slider_front_js = {
        __init: function(){
            $(document).ready(this.initialize_ele);
        },
        initialize_ele: function(){
            jQuery(document).ready(function ($) {
                var swiper = new Swiper('.swiper-container', {
                    pagination: {
                    el: '.swiper-pagination',
                    },
                });
            });
        }
    }
    slider_front_js.__init();
})(jQuery); 
