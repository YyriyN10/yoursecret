<?php

	if ( ! defined( 'ABSPATH' ) ) {
		exit;
	}

	use Carbon_Fields\Container;
	use Carbon_Fields\Field;

	add_action( 'carbon_fields_register_fields', 'yuna_theme_options' );

	function yuna_theme_options() {
		Container::make( 'theme_options', __( 'Theme options', 'yoursecret') )
				->add_fields(array(
					Field::make_image('yuna_option_logo', __('Site logo', 'yoursecret'))
					     ->set_type('image')
					     ->set_value_type('url'),
					Field::make_text('yuna_option_logo_texr'.yuna_lang_prefix(), __('Logo text part', 'yoursecret'))
				))

			->add_tab(__('Social networks', 'yoursecret'), array(
				Field::make_text('social_network_tweeter', __('Tweeter', 'yoursecret'))
					->set_attribute('type', 'url'),
				Field::make_text('social_network_threads', __('Threads', 'yoursecret'))
				     ->set_attribute('type', 'url'),
				Field::make_text('social_network_instagram', __('Instagram', 'yoursecret'))
				     ->set_attribute('type', 'url'),
				Field::make_text('social_network_youtube', __('Youtube', 'yoursecret'))
				     ->set_attribute('type', 'url'),
			))
			->add_tab(__('Breadcrumbs', 'yoursecret'), array(
				Field::make_text('blog_paren_page_url'.yuna_lang_prefix(), __('Blog page url', 'yoursecret'))
					->set_attribute('type', 'url'),
				Field::make_text('news_paren_page_url'.yuna_lang_prefix(), __('News page url', 'yoursecret'))
				     ->set_attribute('type', 'url'),
			))

			->add_tab(__('Footer', 'yoursecret'), array(
				Field::make_complex('footer_download_list'.yuna_lang_prefix(), __('List of services or pages for downloading', 'yoursecret'))
					->add_fields(array(
							Field::make_text('custom_link', __('Link from resource', 'yoursecret'))
								->set_attribute('type', 'url'),
							Field::make_image('service_image', __('Service image', 'yoursecret'))
								->set_value_type('url'),
							Field::make_text('service_name', __('Service name', 'yoursecret'))

						)),
					));

	}



