<?php

	if ( ! defined( 'ABSPATH' ) ) {
				exit;
			}

	/**
	 * Blog pagination
	 */

	add_action('wp_ajax_blog_pagination', 'blog_pagination_callback');
	add_action('wp_ajax_nopriv_blog_pagination', 'blog_pagination_callback');

	function blog_pagination_callback(){

		$currentPage = $_POST['currentPage'];

		$paged = $currentPage;

		$blogPostPerPage = 5;


		$blogArgs = array(
			'posts_per_page' => $blogPostPerPage,
			'orderby' 	 => 'date',
			'post_type'  => 'post',
			'post_status'    => 'publish',
			'paged' => $paged,
		);

		$blogList = new WP_Query( $blogArgs );

		$response = [];

		ob_start();

		if ( $blogList->have_posts() ) :

			while ( $blogList->have_posts() ) : $blogList->the_post(); ?>

				<div class="col-12">
					<a href="<?php the_permalink();?>" class="d-flex flex-column flex-md-row align-items-start rounded text-decoration-none p-3 post-preview" >
						<img src="<?php echo get_the_post_thumbnail_url();?>" alt="<?php the_title();?>" class="rounded img-fluid mb-3 mb-md-0 post-image"/>
						<span class="ps-md-4">
                      <span class="fw-semibold mb-2 fs-5 fs-md-4 post-name">
	                      <?php the_title();?>
                      </span>
                      <span class="mb-2 text-muted small">
                        <?php echo get_the_excerpt();?>
                      </span>
                      <span class="d-flex align-items-center text-muted small gap-2 flex-wrap">
                        <span class="px-2 py-1 border rounded-pill post-category" >
                          <?php
	                          $postCat = get_the_category(get_the_ID());
	                          echo $postCat[0]->name;?>
                        </span>
                          <span><?php echo get_the_date('d.m.Y') ;?></span>
                        </span>
                      </span>
					</a>
				</div>

			<?php endwhile;
		endif;

		$response['posts'] = ob_get_clean();

		ob_start();

		$big = 999999999;
		$blogPagination =  paginate_links( array(
			'prev_next' => false,
			'end_size' => 2,
			'mid_size' => 1,
			'type' => 'list',
			'base' => str_replace( $big, '%#%', get_pagenum_link( $big ) ),
			'format' => '',
			'current' => max( $currentPage, get_query_var('paged') ),
			'total' => $blogList->max_num_pages
		) );?>

		<?php

		if ( $paged == 1 ):
			?>
			<a href="#" rel="nofollow" class="pagination-control prev disable">
        <svg  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 103.28 122.88"><polygon points="103.28 122.88 0 76.93 0 45.95 103.28 0 103.28 33.94 27.83 61.34 103.28 88.74 103.28 122.88 103.28 122.88"/></svg>
				<span class="number"><?php echo $paged -1;?></span>
			</a>
		<?php else:?>
			<a href="#" rel="nofollow" class="pagination-control prev">
        <svg  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 103.28 122.88"><polygon points="103.28 122.88 0 76.93 0 45.95 103.28 0 103.28 33.94 27.83 61.34 103.28 88.74 103.28 122.88 103.28 122.88"/></svg>
				<span class="number"><?php echo $paged -1;?></span>
			</a>
		<?php endif;?>

		<?php echo $blogPagination;?>

		<?php if ( $paged == $blogList->max_num_pages ):?>
			<a href="#" rel="nofollow" class="pagination-control next disable">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 103.28 122.88"><polygon points="0 122.88 103.28 76.93 103.28 45.95 0 0 0 33.94 75.46 61.34 0 88.74 0 122.88 0 122.88"/></svg>
				<span class="number"><?php echo $paged + 1;?></span>
			</a>
		<?php else:?>
			<a href="#" rel="nofollow" class="pagination-control next">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 103.28 122.88"><polygon points="0 122.88 103.28 76.93 103.28 45.95 0 0 0 33.94 75.46 61.34 0 88.74 0 122.88 0 122.88"/></svg>
				<span class="number"><?php echo $paged + 1;?></span>
			</a>
		<?php endif;?>

		<?php

		$response['pagination'] = ob_get_clean();

		wp_send_json($response);

		wp_reset_postdata();
		wp_die();
	}

	/**
	 * Blog cat filter
	 */

	add_action('wp_ajax_blog_cat_filter', 'blog_cat_filter_callback');
	add_action('wp_ajax_nopriv_blog_cat_filter', 'blog_cat_filter_callback');

	function blog_cat_filter_callback(){

		$currentCat = $_POST['currentCat'];

		$currentPage = 1;
		$paged = $currentPage;


		$blogPostPerPage = 5;

		if ( $currentCat != 0 ){
			$blogArgs = array(
				'tax_query' => array(
					array(
						'taxonomy' => 'category',
						'field' => 'id',
						'lang' => false,
						'suppress_filters' => false,
						'terms' => $currentCat

					)
				),
				'posts_per_page' => $blogPostPerPage,
				'orderby' 	 => 'date',
				'post_type'  => 'post',
				'post_status'    => 'publish',
				'paged' => $paged,
			);
    }else{
			$blogArgs = array(
				'posts_per_page' => 5,
				'orderby' 	 => 'date',
				'post_type'  => 'post',
				'post_status'    => 'publish'
			);
    }

		$blogList = new WP_Query( $blogArgs );

		$total_posts = $blogList->found_posts;

		$response = [];

		ob_start();

		if ( $blogList->have_posts() ) :

			while ( $blogList->have_posts() ) : $blogList->the_post(); ?>

        <div class="col-12">
          <a href="<?php the_permalink();?>" class="d-flex flex-column flex-md-row align-items-start rounded text-decoration-none p-3 post-preview" >
            <img src="<?php echo get_the_post_thumbnail_url();?>" alt="<?php the_title();?>" class="rounded img-fluid mb-3 mb-md-0 post-image"/>
            <span class="ps-md-4">
                      <span class="fw-semibold mb-2 fs-5 fs-md-4 post-name">
	                      <?php the_title();?>
                      </span>
                      <span class="mb-2 text-muted small">
                        <?php echo get_the_excerpt();?>
                      </span>
                      <span class="d-flex align-items-center text-muted small gap-2 flex-wrap">
                        <span class="px-2 py-1 border rounded-pill post-category" >
                          <?php
	                          $postCat = get_the_category(get_the_ID());
	                          echo $postCat[0]->name;?>
                        </span>
                          <span><?php echo get_the_date('d.m.Y') ;?></span>
                        </span>
                      </span>
          </a>
        </div>

			<?php endwhile;
		endif;

		$response['posts'] = ob_get_clean();

		ob_start();

		$big = 999999999;
		$blogPagination =  paginate_links( array(
			'prev_next' => false,
			'end_size' => 2,
			'mid_size' => 1,
			'type' => 'list',
			'base' => str_replace( $big, '%#%', get_pagenum_link( $big ) ),
			'format' => '',
			'current' => max( $currentPage, get_query_var('paged') ),
			'total' => $blogList->max_num_pages
		) );?>

		<?php if( $total_posts > 5 ):?>
      <?php if ( $paged == 1 ):?>

          <a href="#" rel="nofollow" class="pagination-control prev disable">
            <svg  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 103.28 122.88"><polygon points="103.28 122.88 0 76.93 0 45.95 103.28 0 103.28 33.94 27.83 61.34 103.28 88.74 103.28 122.88 103.28 122.88"/></svg>
            <span class="number"><?php echo $paged -1;?></span>
          </a>
        <?php else:?>
          <a href="#" rel="nofollow" class="pagination-control prev">
            <svg  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 103.28 122.88"><polygon points="103.28 122.88 0 76.93 0 45.95 103.28 0 103.28 33.94 27.83 61.34 103.28 88.74 103.28 122.88 103.28 122.88"/></svg>
            <span class="number"><?php echo $paged -1;?></span>
          </a>
        <?php endif;?>

        <?php echo $blogPagination;?>

        <?php if ( $paged == $blogList->max_num_pages ):?>
          <a href="#" rel="nofollow" class="pagination-control next disable">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 103.28 122.88"><polygon points="0 122.88 103.28 76.93 103.28 45.95 0 0 0 33.94 75.46 61.34 0 88.74 0 122.88 0 122.88"/></svg>
            <span class="number"><?php echo $paged + 1;?></span>
          </a>
        <?php else:?>
          <a href="#" rel="nofollow" class="pagination-control next">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 103.28 122.88"><polygon points="0 122.88 103.28 76.93 103.28 45.95 0 0 0 33.94 75.46 61.34 0 88.74 0 122.88 0 122.88"/></svg>
            <span class="number"><?php echo $paged + 1;?></span>
          </a>
      <?php endif;?>

		<?php endif;?>

		<?php

		$response['pagination'] = ob_get_clean();

		wp_send_json($response);

		wp_reset_postdata();
		wp_die();
	}

	/**
	 * News pagination
	 */

	add_action('wp_ajax_news_pagination', 'news_pagination_callback');
	add_action('wp_ajax_nopriv_news_pagination', 'news_pagination_callback');

	function news_pagination_callback(){

		$currentPage = $_POST['currentPage'];

		$paged = $currentPage;

		$blogPostPerPage = 5;


		$blogArgs = array(
			'posts_per_page' => $blogPostPerPage,
			'orderby' 	 => 'date',
			'post_type'  => 'news',
			'post_status'    => 'publish',
			'paged' => $paged,
		);

		$blogList = new WP_Query( $blogArgs );

		$response = [];

		ob_start();

		if ( $blogList->have_posts() ) :

			while ( $blogList->have_posts() ) : $blogList->the_post(); ?>

        <div class="col-12">
          <a href="<?php the_permalink();?>" class="d-flex flex-column flex-md-row align-items-start rounded text-decoration-none p-3 post-preview" >
            <img src="<?php echo get_the_post_thumbnail_url();?>" alt="<?php the_title();?>" class="rounded img-fluid mb-3 mb-md-0 post-image"/>
            <span class="ps-md-4">
                      <span class="fw-semibold mb-2 fs-5 fs-md-4 post-name">
	                      <?php the_title();?>
                      </span>
                      <span class="mb-2 text-muted small">
                        <?php echo get_the_excerpt();?>
                      </span>
                      <span class="d-flex align-items-center text-muted small gap-2 flex-wrap">
                        <span class="px-2 py-1 border rounded-pill post-category" >
                          <?php
	                          $postCat = get_the_category(get_the_ID());
	                          echo $postCat[0]->name;?>
                        </span>
                          <span><?php echo get_the_date('d.m.Y') ;?></span>
                        </span>
                      </span>
          </a>
        </div>

			<?php endwhile;
		endif;

		$response['posts'] = ob_get_clean();

		ob_start();

		$big = 999999999;
		$blogPagination =  paginate_links( array(
			'prev_next' => false,
			'end_size' => 2,
			'mid_size' => 1,
			'type' => 'list',
			'base' => str_replace( $big, '%#%', get_pagenum_link( $big ) ),
			'format' => '',
			'current' => max( $currentPage, get_query_var('paged') ),
			'total' => $blogList->max_num_pages
		) );?>

		<?php

		if ( $paged == 1 ):
			?>
      <a href="#" rel="nofollow" class="pagination-control prev disable">
        <svg  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 103.28 122.88"><polygon points="103.28 122.88 0 76.93 0 45.95 103.28 0 103.28 33.94 27.83 61.34 103.28 88.74 103.28 122.88 103.28 122.88"/></svg>
        <span class="number"><?php echo $paged -1;?></span>
      </a>
		<?php else:?>
      <a href="#" rel="nofollow" class="pagination-control prev">
        <svg  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 103.28 122.88"><polygon points="103.28 122.88 0 76.93 0 45.95 103.28 0 103.28 33.94 27.83 61.34 103.28 88.74 103.28 122.88 103.28 122.88"/></svg>
        <span class="number"><?php echo $paged -1;?></span>
      </a>
		<?php endif;?>

		<?php echo $blogPagination;?>

		<?php if ( $paged == $blogList->max_num_pages ):?>
      <a href="#" rel="nofollow" class="pagination-control next disable">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 103.28 122.88"><polygon points="0 122.88 103.28 76.93 103.28 45.95 0 0 0 33.94 75.46 61.34 0 88.74 0 122.88 0 122.88"/></svg>
        <span class="number"><?php echo $paged + 1;?></span>
      </a>
		<?php else:?>
      <a href="#" rel="nofollow" class="pagination-control next">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 103.28 122.88"><polygon points="0 122.88 103.28 76.93 103.28 45.95 0 0 0 33.94 75.46 61.34 0 88.74 0 122.88 0 122.88"/></svg>
        <span class="number"><?php echo $paged + 1;?></span>
      </a>
		<?php endif;?>

		<?php

		$response['pagination'] = ob_get_clean();

		wp_send_json($response);

		wp_reset_postdata();
		wp_die();
	}

	/**
	 * Blog cat filter
	 */

	add_action('wp_ajax_news_cat_filter', 'news_cat_filter_callback');
	add_action('wp_ajax_nopriv_news_cat_filter', 'bnews_cat_filter_callback');

	function news_cat_filter_callback(){

		$currentCat = $_POST['currentCat'];

		$currentPage = 1;
		$paged = $currentPage;


		$blogPostPerPage = 5;

		if ( $currentCat != 0 ){
			$blogArgs = array(
				'tax_query' => array(
					array(
						'taxonomy' => 'news_tax',
						'field' => 'id',
						'lang' => false,
						'suppress_filters' => false,
						'terms' => $currentCat

					)
				),
				'posts_per_page' => $blogPostPerPage,
				'orderby' 	 => 'date',
				'post_type'  => 'news',
				'post_status'    => 'publish',
				'paged' => $paged,
			);
		}else{
			$blogArgs = array(
				'posts_per_page' => 5,
				'orderby' 	 => 'date',
				'post_type'  => 'news',
				'post_status'    => 'publish'
			);
		}

		$blogList = new WP_Query( $blogArgs );

		$total_posts = $blogList->found_posts;

		$response = [];

		ob_start();

		if ( $blogList->have_posts() ) :

			while ( $blogList->have_posts() ) : $blogList->the_post(); ?>

        <div class="col-12">
          <a href="<?php the_permalink();?>" class="d-flex flex-column flex-md-row align-items-start rounded text-decoration-none p-3 post-preview" >
            <img src="<?php echo get_the_post_thumbnail_url();?>" alt="<?php the_title();?>" class="rounded img-fluid mb-3 mb-md-0 post-image"/>
            <span class="ps-md-4">
                      <span class="fw-semibold mb-2 fs-5 fs-md-4 post-name">
	                      <?php the_title();?>
                      </span>
                      <span class="mb-2 text-muted small">
                        <?php echo get_the_excerpt();?>
                      </span>
                      <span class="d-flex align-items-center text-muted small gap-2 flex-wrap">
                        <span class="px-2 py-1 border rounded-pill post-category" >
                          <?php
	                          $postCat = get_the_category(get_the_ID());
	                          echo $postCat[0]->name;?>
                        </span>
                          <span><?php echo get_the_date('d.m.Y') ;?></span>
                        </span>
                      </span>
          </a>
        </div>

			<?php endwhile;
		endif;

		$response['posts'] = ob_get_clean();

		ob_start();

		$big = 999999999;
		$blogPagination =  paginate_links( array(
			'prev_next' => false,
			'end_size' => 2,
			'mid_size' => 1,
			'type' => 'list',
			'base' => str_replace( $big, '%#%', get_pagenum_link( $big ) ),
			'format' => '',
			'current' => max( $currentPage, get_query_var('paged') ),
			'total' => $blogList->max_num_pages
		) );?>

		<?php if( $total_posts > 5 ):?>
			<?php if ( $paged == 1 ):?>

        <a href="#" rel="nofollow" class="pagination-control prev disable">
          <svg  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 103.28 122.88"><polygon points="103.28 122.88 0 76.93 0 45.95 103.28 0 103.28 33.94 27.83 61.34 103.28 88.74 103.28 122.88 103.28 122.88"/></svg>
          <span class="number"><?php echo $paged -1;?></span>
        </a>
			<?php else:?>
        <a href="#" rel="nofollow" class="pagination-control prev">
          <svg  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 103.28 122.88"><polygon points="103.28 122.88 0 76.93 0 45.95 103.28 0 103.28 33.94 27.83 61.34 103.28 88.74 103.28 122.88 103.28 122.88"/></svg>
          <span class="number"><?php echo $paged -1;?></span>
        </a>
			<?php endif;?>

			<?php echo $blogPagination;?>

			<?php if ( $paged == $blogList->max_num_pages ):?>
        <a href="#" rel="nofollow" class="pagination-control next disable">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 103.28 122.88"><polygon points="0 122.88 103.28 76.93 103.28 45.95 0 0 0 33.94 75.46 61.34 0 88.74 0 122.88 0 122.88"/></svg>
          <span class="number"><?php echo $paged + 1;?></span>
        </a>
			<?php else:?>
        <a href="#" rel="nofollow" class="pagination-control next">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 103.28 122.88"><polygon points="0 122.88 103.28 76.93 103.28 45.95 0 0 0 33.94 75.46 61.34 0 88.74 0 122.88 0 122.88"/></svg>
          <span class="number"><?php echo $paged + 1;?></span>
        </a>
			<?php endif;?>

		<?php endif;?>

		<?php

		$response['pagination'] = ob_get_clean();

		wp_send_json($response);

		wp_reset_postdata();
		wp_die();
	}