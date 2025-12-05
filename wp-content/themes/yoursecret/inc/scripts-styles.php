<?php

	if ( ! defined( 'ABSPATH' ) ) {
		exit;
	}

	function yoursecret_scripts() {
		wp_enqueue_style( 'yoursecret-style', get_stylesheet_uri(), array(), _S_VERSION );

		wp_enqueue_style( 'yoursecret-style-main', get_template_directory_uri() . '/assets/css/styles.css', array(), _S_VERSION );
		wp_enqueue_style( 'yoursecret-style-custom', get_template_directory_uri() . '/assets/css/custom-style.min.css', array(), _S_VERSION );
		wp_enqueue_style( 'font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css', array(), '6.5.2', 'all' );

		wp_enqueue_script( 'bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js', array(), '5.2.3', true );

		wp_enqueue_script( 'yoursecret-js-main', get_template_directory_uri() . '/assets/js/scripts.js', array(), _S_VERSION, true );

		wp_enqueue_script( 'yoursecret-js-custom', get_template_directory_uri() . '/assets/js/main.min.js', array('jquery'), _S_VERSION, true );




	}
	add_action( 'wp_enqueue_scripts', 'yoursecret_scripts' );

	add_action( 'wp_enqueue_scripts', 'yoursecret_ajax_data', 99 );
	function yoursecret_ajax_data(){

		wp_localize_script('yoursecret-js-custom', 'yoursecret_ajax',
			array(
				'url' => admin_url('admin-ajax.php')
			)
		);

	}
