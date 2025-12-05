<?php
/**
 * @see https://github.com/WordPress/gutenberg/blob/trunk/docs/reference-guides/block-api/block-metadata.md#render
 */

?>

<?php

	$blockAttr = get_block_wrapper_attributes();

  if( !empty($blockAttr)):?>
	<?php

		if ( !empty( $attributes['topIndent']) || !empty( $attributes['bottomIndent']) ){
			$indent = $attributes['topIndent'].' '.$attributes['bottomIndent'].'';
			$blockAttr = get_block_wrapper_attributes(["class" => $indent]);
		}

		$blogArgs = array(
			'posts_per_page' => 2,
			'orderby' 	 => 'date',
			'post_type'  => 'blog',
			'post_status'    => 'publish'
		);

		$blogList = new WP_Query( $blogArgs );

		if ( $blogList->have_posts() ) :?>

      <section <?php echo $blockAttr; ?>
		  <?php if( !empty($attributes['anchorId']) ):?>
            id="<?php echo $attributes['anchorId'];?>"
		  <?php endif;?>
      >
        <div class="container">
          <div class="row content" id="blog-list">
	          <?php while ( $blogList->have_posts() ) : $blogList->the_post();?>
              <a href="<?php the_permalink();?>" class="blog-item col-md-6 col-12">
                <span class="inner">
                  <span class="date"><?php echo get_the_date('F d Y');?></span>
                  <span class="image-wrapper">
                    <img
                       class="lazy object-fit"
                       data-src="<?php echo wp_get_attachment_image_src(get_post_thumbnail_id(), 'full')[0];?>"
                       <?php
                        $altText = get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', TRUE);
                        if ( !empty( $altText ) ):?>
                            alt="<?php echo $altText;?>"
                        <?php else:?>
                            alt="<?php the_title();?>"
                        <?php endif;?>

                    >
                  </span>
                  <span class="name"><?php the_title();?></span>
                  <span class="description"><?php the_excerpt();?></span>
                </span>
              </a>
	          <?php endwhile;?>
          </div>
	        <?php if( $blogList->max_num_pages > 1):?>
            <div class="row">
              <div class="pagination-wrapper col-12" id="pagination">
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
                  <svg width="36" height="26" viewBox="0 0 36 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M0.479111 11.8312L11.9338 0.456157C12.2424 0.160151 12.6557 -0.003641 13.0848 6.1429e-05C13.5139 0.00376386 13.9243 0.174664 14.2277 0.475952C14.5311 0.77724 14.7032 1.18481 14.7069 1.61088C14.7106 2.03695 14.5457 2.44743 14.2476 2.75391L5.58625 11.355H34.3636C34.7976 11.355 35.2138 11.5262 35.5207 11.831C35.8276 12.1357 36 12.5491 36 12.98C36 13.411 35.8276 13.8243 35.5207 14.1291C35.2138 14.4338 34.7976 14.605 34.3636 14.605H5.58625L14.2476 23.2062C14.4039 23.3561 14.5286 23.5354 14.6143 23.7336C14.7001 23.9319 14.7452 24.1451 14.7471 24.3609C14.749 24.5766 14.7076 24.7906 14.6253 24.9903C14.543 25.19 14.4215 25.3715 14.2679 25.524C14.1142 25.6766 13.9315 25.7973 13.7304 25.879C13.5293 25.9607 13.3139 26.0018 13.0966 25.9999C12.8793 25.9981 12.6646 25.9532 12.4649 25.8681C12.2653 25.7829 12.0847 25.6591 11.9338 25.5039L0.479111 14.1289C0.172337 13.8242 0 13.4109 0 12.98C0 12.5491 0.172337 12.1359 0.479111 11.8312Z" fill="white"></path>
                  </svg>
                  <span>1</span>
                </a>

				        <?php echo $blogPagination;?>

                <a href="#" rel="nofollow" class="pagination-control next">
                  <svg width="36" height="26" viewBox="0 0 36 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M35.5209 11.8312L24.0662 0.456157C23.7576 0.160151 23.3443 -0.003641 22.9152 6.1429e-05C22.4861 0.00376386 22.0757 0.174664 21.7723 0.475952C21.4689 0.77724 21.2968 1.18481 21.2931 1.61088C21.2894 2.03695 21.4543 2.44743 21.7524 2.75391L30.4137 11.355H1.63638C1.20238 11.355 0.786165 11.5262 0.479284 11.831C0.172404 12.1357 0 12.5491 0 12.98C0 13.411 0.172404 13.8243 0.479284 14.1291C0.786165 14.4338 1.20238 14.605 1.63638 14.605H30.4137L21.7524 23.2062C21.5961 23.3561 21.4714 23.5354 21.3857 23.7336C21.2999 23.9319 21.2548 24.1451 21.2529 24.3609C21.251 24.5766 21.2924 24.7906 21.3747 24.9903C21.457 25.19 21.5785 25.3715 21.7321 25.524C21.8858 25.6766 22.0685 25.7973 22.2696 25.879C22.4707 25.9607 22.6861 26.0018 22.9034 25.9999C23.1207 25.9981 23.3354 25.9532 23.5351 25.8681C23.7347 25.7829 23.9153 25.6591 24.0662 25.5039L35.5209 14.1289C35.8277 13.8242 36 13.4109 36 12.98C36 12.5491 35.8277 12.1359 35.5209 11.8312Z" fill="white"></path>
                  </svg>
                  <span>2</span>
                </a>
              </div>
            </div>
	        <?php endif;?>
        </div>
      </section>
	  <?php endif; ?>
	<?php wp_reset_postdata(); ?>
<?php endif;?>


