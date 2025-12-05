<?php
	/**
	 * The template for displaying archive pages
	 *
	 * Template Name: News
	 *
	 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
	 *
	 * @package yoursecret
	 */

	get_header();
?>

	<section class="bg-light py-5">
		<div class="container px-5 mb-4">
			<?php
				$blogCat = get_categories( array(
					'taxonomy'     => 'news_tax',
					'type'         => 'news',
					'child_of'     => false,
					'parent'       => '',
					'orderby'      => 'name',
					'order'        => 'ASC',
					'hide_empty'   => 1,
					'hierarchical' => false,
					'number'       => 0,
					'pad_counts'   => false,
				) );
				if ( $blogCat ):?>


					<ul class="nav nav-pills justify-content-center flex-wrap post-cat-nav" id="news-cat-filter">

						<li class="nav-item active" data-cat-id="0">
							<?php echo esc_html( pll__( 'All' ) ); ?>
						</li>
						<?php foreach( $blogCat as $catItem ):?>
							<li class="nav-item" data-cat-id="<?php echo $catItem->term_id;?>">
								<?php echo $catItem->name;?>
							</li>
						<?php endforeach;?>
					</ul>
				<?php endif;?>
		</div>
		<div class="container px-5">
			<div class="row gy-4" id="news-list">
				<?php
					$blogArgs = array(
						'posts_per_page' => 5,
						'orderby' 	 => 'date',
						'post_type'  => 'news',
						'post_status'    => 'publish'
					);

					$blogList = new WP_Query( $blogArgs );

					if ( $blogList->have_posts() ) :?>

				<?php while ( $blogList->have_posts() ) : $blogList->the_post();?>
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
	                          $postCat = get_the_terms(get_the_ID(), 'news_tax');
	                          echo $postCat[0]->name;?>
                        </span>
                          <span><?php echo get_the_date('d.m.Y') ;?></span>
                        </span>
                      </span>
						</a>
					</div>
				<?php endwhile;?>

			</div>
			<?php if( $blogList->max_num_pages > 1):?>
				<div class="row">
					<div class="pagination-wrapper col-12 mt-3" id="pagination">
						<?php

							$big = 999999999;
							$blogPagination =  paginate_links( array(
								'prev_next' => false,
								'end_size' => 2,
								'mid_size' => 1,
								'type' => 'list',
								'base' => str_replace( $big, '%#%', get_pagenum_link( $big ) ),
								'format' => '?paged=%#%',
								'current' => max( 1, get_query_var('paged') ),
								'total' => $blogList->max_num_pages
							) );?>

						<a href="#" rel="nofollow" class="pagination-control prev disable">
							<svg  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 103.28 122.88"><polygon points="103.28 122.88 0 76.93 0 45.95 103.28 0 103.28 33.94 27.83 61.34 103.28 88.74 103.28 122.88 103.28 122.88"/></svg>
							<span class="number">1</span>
						</a>

						<?php echo $blogPagination;?>

						<a href="#" rel="nofollow" class="pagination-control next">
							<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 103.28 122.88"><polygon points="0 122.88 103.28 76.93 103.28 45.95 0 0 0 33.94 75.46 61.34 0 88.74 0 122.88 0 122.88"/></svg>
							<span class="number">2</span>
						</a>
					</div>
				</div>
			<?php endif;?>


			<?php endif; ?>
			<?php wp_reset_postdata(); ?>
		</div>
	</section>

<?php
	get_footer();
