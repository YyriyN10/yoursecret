<?php
/**
 * @see https://github.com/WordPress/gutenberg/blob/trunk/docs/reference-guides/block-api/block-metadata.md#render
 */

?>

<?php if( !empty($attributes['blockTitle'])):?>
	<?php
		$blockAttr = get_block_wrapper_attributes();

		if ( !empty( $attributes['topIndent']) || !empty( $attributes['bottomIndent']) ){
			$indent = $attributes['topIndent'].' '.$attributes['bottomIndent'].'';
			$blockAttr = get_block_wrapper_attributes(["class" => $indent]);
		}

		$blogArgs = array(
			'posts_per_page' => 3,
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
          <div class="row">
            <div class="heading col-lg-8" data-aos="fade-up" data-aos-duration="300" data-aos-easing="ease-in">
				<?php if( !empty($attributes['blockName']) ):?>
                  <h2 class="block-name"><?php echo $attributes['blockName'];?></h2>
				<?php endif;?>
              <h3 class="block-title small-title" >
				  <?php echo $attributes['blockTitle'];?>
              </h3>
            </div>
			  <?php if( !empty($attributes['blockText']) ):?>
                <p class="text col-lg-4" data-aos="fade-up" data-aos-duration="300" data-aos-easing="ease-in">
					<?php echo $attributes['blockText'];?>
                </p>
			  <?php endif;?>
          </div>
          <div class="row content">
	          <?php while ( $blogList->have_posts() ) : $blogList->the_post();?>
              <a href="<?php the_permalink();?>" class="blog-item col-lg-4 col-md-6 col-12">
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
        </div>
      </section>
	  <?php endif; ?>
	<?php wp_reset_postdata(); ?>
<?php endif;?>


