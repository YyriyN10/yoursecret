<?php

	if ( ! defined( 'ABSPATH' ) ) {
				exit;
			}

	/**
	 * Register a news types post type.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/register_post_type
	 *
	 * @since yoursecret 1.0
	 */

	function news_post_type() {

		$labels = array(
			'name'               => _x( 'News', 'post type general name', 'yoursecret' ),
			'singular_name'      => _x( 'News', 'post type singular name', 'yoursecret' ),
			'menu_name'          => _x( 'News', 'admin menu', 'yoursecret' ),
			'name_admin_bar'     => _x( 'News', 'add new on admin bar', 'yoursecret' ),
			'add_new'            => _x( 'Add new', 'actions', 'yoursecret' ),
			'add_new_item'       => __( 'Add new news', 'yoursecret' ),
			'new_item'           => __( 'New news', 'yoursecret' ),
			'edit_item'          => __( 'Edit news', 'yoursecret' ),
			'view_item'          => __( 'Watch news', 'yoursecret' ),
			'all_items'          => __( 'All news', 'yoursecret' ),
			'search_items'       => __( 'Search news', 'yoursecret' ),
			'parent_item_colon'  => __( 'Parent news:', 'yoursecret' ),
			'not_found'          => __( 'News not found', 'yoursecret' ),
			'not_found_in_trash' => __( 'No news found in cart', 'yoursecret' )
		);

		$args = array(
			'labels'             => $labels,
			'taxonomies'         => ['news_tax'],
			'description'        => __( 'Description.', 'news' ),
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_rest'       => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'rewrite'            => array( 'slug' => 'news' ),
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => true,
			'exclude_from_search'=> false,
			'menu_position'      => 6,
			'menu_icon'          => 'dashicons-welcome-write-blog',
			'supports'           => array( 'title', 'thumbnail', 'editor', 'excerpt')
		);

		register_post_type( 'news', $args );
	}

	add_action( 'init', 'news_post_type' );

	add_action( 'init', 'news_taxonomy' );
	function news_taxonomy(){

		register_taxonomy('news_tax', 'news', array(
			'label'                 => 'news_tax', // определяется параметром $labels->name
			'labels'                => array(
				'name'              => 'News category',
				'singular_name'     => 'News category',
				'search_items'      => 'Search news',
				'all_items'         => 'All category',
				'view_item '        => 'View Genre',
				'parent_item'       => 'Parent Genre',
				'parent_item_colon' => 'Parent Genre:',
				'edit_item'         => 'Edit category',
				'update_item'       => 'Update category',
				'add_new_item'      => 'Add category',
				'new_item_name'     => 'New Genre Name',
				'menu_name'         => 'News category',
			),
			'description'           => __( 'Description.', 'news' ), // описание таксономии
			'public'                => true,
			'publicly_queryable'    => true, // равен аргументу public
			'show_in_nav_menus'     => true, // равен аргументу public
			'show_ui'               => true, // равен аргументу public
			'show_in_menu'          => true, // равен аргументу show_ui
			'show_tagcloud'         => true, // равен аргументу show_ui
			'show_in_rest'          => true, // добавить в REST API
			'rest_base'             => true, // $taxonomy
			'hierarchical'          => true,
			'supports'           => array( 'title', 'thumbnail', 'revisions' ),

			/*'update_count_callback' => '_update_post_term_count',*/
			'rewrite'               => array('slug' => 'news'),
			/*'query_var'             => 'news_tax',*/ // название параметра запроса
			'capabilities'          => array(),
			'meta_box_cb'           => null, // callback функция. Отвечает за html код метабокса (с версии 3.8): post_categories_meta_box или post_tags_meta_box. Если указать false, то метабокс будет отключен вообще
			'show_admin_column'     => true, // Позволить или нет авто-создание колонки таксономии в таблице ассоциированного типа записи. (с версии 3.5)
			/*'_builtin'              => false,*/
			'show_in_quick_edit'    => true, // по умолчанию значение show_ui
		) );
	}
