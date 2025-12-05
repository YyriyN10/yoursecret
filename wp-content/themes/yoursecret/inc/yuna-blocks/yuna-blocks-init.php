<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


	/**
	 * Create Block Category
	 */

	function yuna_custom_block_category( $categories, $post ){

		$new = array(
			array(
				'slug'  => 'yuna-block-category',
				'title' => __('Yuna Blocks', 'yoursecret'),
				'icon'  => 'admin-home',
			),
			array(
				'slug'  => 'yuna-inner-block-category',
				'title' => __('Yuna Inner Blocks', 'yoursecret'),
				'icon'  => 'category',
			),
			array(
				'slug'  => 'yuna-page-block-category',
				'title' => __('Yuna Inner Page Blocks', 'yoursecret'),
				'icon'  => 'admin-page',
			),
		);

		// додати свої категорії на початок списку
		return array_merge( $new, $categories );

	}

	add_filter( 'block_categories_all', 'yuna_custom_block_category', 10, 2);


/**
 * Registers the block using the metadata loaded from the `block.json` file.
 * Behind the scenes, it registers also all assets so they can be enqueued
 * through the block editor in the corresponding context.
 *
 * @see https://developer.wordpress.org/reference/functions/register_block_type/
 */
function yuna_custom_blocks_init() {

	register_block_type( __DIR__ . '/build/yoursecret-home-hero');

	register_block_type( __DIR__ . '/build/yoursecret-home-video-hero');

	register_block_type( __DIR__ . '/build/yoursecret-inner-page-hero');

	register_block_type( __DIR__ . '/build/yoursecret-inner-page-section');

	register_block_type( __DIR__ . '/build/yoursecret-inner-page-section-blocks');
	register_block_type( __DIR__ . '/build/yoursecret-inner-page-section-blocks-inner');

	register_block_type( __DIR__ . '/build/yoursecret-inner-page-section-text-and-blocks');
	register_block_type( __DIR__ . '/build/yoursecret-inner-page-section-text-and-blocks-inner');

	register_block_type( __DIR__ . '/build/yoursecret-inner-page-section-with-ps');

	register_block_type( __DIR__ . '/build/yoursecret-inner-page-section-with-form');

}
add_action( 'init', 'yuna_custom_blocks_init' );





