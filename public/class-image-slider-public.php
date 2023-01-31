<?php

class Image_slide_Public {

	private $image_slider;

	private $version;

	public function __construct( $image_slider, $version ) {

		$this->image_slider = $image_slider;
		$this->version = $version;

		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_styles' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		add_shortcode( 'myslideshow', array( $this, 'slideshow_shortcode' ) );
	}

	public function enqueue_styles() {

		wp_enqueue_style( 'image-slider-public', plugin_dir_url( __FILE__ ) . 'css/image-slider-public.css', array(), $this->version, 'all' );
		wp_enqueue_style( 'swiper', 'https://cdnjs.cloudflare.com/ajax/libs/Swiper/5.4.5/css/swiper.min.css' );
	}

	
	public function enqueue_scripts() {

		wp_enqueue_script( 'image-slider-public', plugin_dir_url( __FILE__ ) . 'js/image-slider-public.js', array( 'jquery' ), $this->version, false );
		wp_enqueue_script( 'swiper', 'https://cdnjs.cloudflare.com/ajax/libs/Swiper/5.4.5/js/swiper.min.js', array( 'jquery' ), '5.4.5', true );

	}

	public function slideshow_shortcode() {
		$images = get_option( 'slideshow-images', array() );
      if ( ! $images ) {
        return;
      }
		  ob_start();
		?>
          <div class="swiper-container">
            <div class="swiper-wrapper">
            <?php foreach ( $images as $image_id ) :
                  $image_url = wp_get_attachment_url( $image_id );
                  ?>
                    <div class="swiper-slide">
                      <img src="<?php echo esc_url( $image_url ); ?>" alt="">
                    </div>
            <?php endforeach; ?>
            </div>
            <!-- Add Pagination -->
            <div class="swiper-pagination"></div>
          </div>
		<?php
		 
		 ?>
		
		<?php
		  return ob_get_clean();
	}
		

}
