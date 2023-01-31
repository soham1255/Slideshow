<?php


class Image_slide_Admin {

	
	private $image_slider;

	
	private $version;

	
	public function __construct( $image_slider, $version ) {

		$this->image_slider = $image_slider;
		$this->version = $version;
		
		add_action( 'admin_menu', array( $this, 'add_settings_page' ) );
    add_action( 'admin_init', array( $this, 'register_settings' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_styles' ) );
    add_action( 'wp_ajax_remove_slideshow_image', array( $this, 'remove_slideshow_image' ) );
		add_action( 'wp_ajax_save_slideshow_images', array( $this, 'save_slideshow_images' ) );

	}

	
	public function enqueue_styles() {

		wp_enqueue_style( 'image-slider-admin', plugin_dir_url( __FILE__ ) . 'css/image-slider-admin.css', 'all' );

	}

	public function enqueue_scripts() {
    
    wp_enqueue_media();
		wp_enqueue_script( 'jquery-ui-sortable' );
		wp_enqueue_script( 'image-slider-admin', plugin_dir_url( __FILE__ ) . 'js/image-slider-admin.js' );
		wp_localize_script( 'wpslideshow-admin', 'wpslideshow', array(
            'ajax_url' => admin_url( 'admin-ajax.php' ),
        ) );

	}

	
	public function add_settings_page() {
        add_menu_page( 'Slideshow Settings', 'Image Slider', 'manage_options', 'slideshow-settings', array( $this, 'settings_page' ), 'dashicons-images-alt2', 25 );
    }

	public function register_settings() {
        register_setting( 'slideshow-settings', 'slideshow-images' );
    }

	
	public function settings_page() {
        if ( !current_user_can( 'manage_options' ) ) {
            wp_die( 'You do not have permission to access this page.' );
        }
		include 'html/image-slider-admin-display.php';
        
    }
   
	public function save_slideshow_images() {
		$images = array_map( 'absint', $_POST['images'] );
		update_option( 'slideshow-images', $images );
		wp_send_json_success();
	}
   

	public function remove_slideshow_image() {
        $image_id = absint( $_POST['image_id'] );
        $images = get_option( 'slideshow-images', array() );
        if ( ( $key = array_search( $image_id, $images ) ) !== false ) {
            unset( $images[$key] );
            update_option( 'slideshow-images', $images );
            wp_delete_attachment( $image_id );
        }
        wp_send_json_success();
    }
  
}
