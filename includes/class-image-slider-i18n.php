<?php


class Image_slide_i18n {


	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'image-slider',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
