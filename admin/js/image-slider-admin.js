(function($){
    var slider_js = {
        __init: function(){
            $(document).ready(this.initialize_ele);
        },
        initialize_ele: function(){
           
                $( '#slideshow-images' ).sortable();
                $( '.add-slideshow-image' ).click( function() {
                    var fileFrame = wp.media.frames.fileFrame = wp.media({
                        title: 'Select Image',
                        button: {
                            text: 'Select Image'
                        },
                        multiple: true
                    });

                    fileFrame.on( 'select', function() {
                        var attachments = fileFrame.state().get( 'selection' ).toJSON();
                        $.each( attachments, function( i, attachment ) {
                            $( '#slideshow-images' ).append( '<li><input type="hidden" name="slideshow-images[]" value="' + attachment.id + '"><img src="' + attachment.url + '" width="150"><a href="#" class="remove-slideshow-image">Remove</a></li>' );
                        });
                    });

                    fileFrame.open();
                });

                $( '#slideshow-images' ).on( 'click', '.remove-slideshow-image', function() {
                    $( this ).closest( 'li' ).remove();
                });

                $('.copy_shoortcode').click(function(){
                    var copyText = $(this).attr('data-copytxt');
                    navigator.clipboard.writeText(copyText);
                    alert("Shorcode Copied");
                });
           
      }
    }
    slider_js.__init();
})(jQuery); 
