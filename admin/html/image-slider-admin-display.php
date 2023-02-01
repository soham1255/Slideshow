<div class="wrap">
    <h1><?php _e('Slideshow Settings','image-slider'); ?></h1>
    <p><?php _e('Please upload your slider images','image-slider'); ?></p>
    <form method="post" action="options.php">
        <?php settings_fields( 'slideshow-settings' ); ?>
        <table class="form-table">
            <tr valign="top">
                <th scope="row"><?php _e('Images','image-slider'); ?></th>
                <td>
                    <ul id="slideshow-images">
                        <?php $images = get_option( 'slideshow-images' );
                        if ( $images ) :
                            foreach ( $images as $image_id ) :
                                $image_url = wp_get_attachment_url( $image_id );
                                ?>
                                <li>
                                    <input type="hidden" name="slideshow-images[]" value="<?php echo esc_attr( $image_id ); ?>">
                                    <img src="<?php echo esc_url( $image_url ); ?>" width="200">
                                    <a href="#" class="remove-slideshow-image">Remove</a>
                                </li>
                            <?php endforeach;
                        endif;
                        ?>
                    </ul>
                    <input type="button" class="button add-slideshow-image" value="Add Image">
                </td>
            </tr>
        </table>
        <?php submit_button(); ?>
    </form>
    <p><?php _e( 'To display the slider on your website, please use the following shortcode:', 'image-slider' ); ?></p>
    <code class="copy_shoortcode" data-copytxt="[myslideshow]">[myslideshow]</code>
    <p><?php _e( 'You can place this shortcode in your page or post content, or in a widget area.', 'image-slider' ); ?></p>
</div>

