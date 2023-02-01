<?php

class Image_slider {

	protected $loader;

	protected $image_slider;

	protected $version;

	public function __construct() {
		if ( defined( 'IMAGE_SLIDER_VERSION' ) ) {
			$this->version = IMAGE_SLIDER_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'image-slider';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();

	}

	private function load_dependencies() {

	
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-image-slider-loader.php';

		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-image-slider-i18n.php';

		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-image-slider-admin.php';

		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-image-slider-public.php';

		$this->loader = new Image_slider_Loader();

	}


	private function set_locale() {

		$image_slider_i18n = new Image_slide_i18n();

		$this->loader->add_action( 'plugins_loaded', $image_slider_i18n, 'load_plugin_textdomain' );

	}

	private function define_admin_hooks() {

		$image_slider_admin = new Image_slide_Admin( $this->get_image_slider(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $image_slider_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $image_slider_admin, 'enqueue_scripts' );

	}

	private function define_public_hooks() {

		$image_slider_public = new Image_slide_Public( $this->get_image_slider(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $image_slider_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $image_slider_public, 'enqueue_scripts' );

	}

	
	public function run() {
		$this->loader->run();
	}


	public function get_image_slider() {
		return $this->image_slider;
	}

	
	public function get_loader() {
		return $this->loader;
	}

	public function get_version() {
		return $this->version;
	}

}
