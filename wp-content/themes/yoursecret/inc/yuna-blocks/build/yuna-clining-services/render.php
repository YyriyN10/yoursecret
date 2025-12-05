<?php
/**
 * @see https://github.com/WordPress/gutenberg/blob/trunk/docs/reference-guides/block-api/block-metadata.md#render
 */

?>

<?php if( !empty($attributes['blockTitle'])):?>
	<?php
		$blockAttr = get_block_wrapper_attributes();

		if ( !empty( $attributes['topIndent']) || !empty( $attributes['bottomIndent']) ){
			$indent = $attributes['topIndent'].' '.$attributes['bottomIndent'];
			$blockAttr = get_block_wrapper_attributes(["class" => $indent]);
		}

		 	$servicesArgs = array(
		 		'posts_per_page' => -1,
		 		'orderby' 	 => 'date',
		 		'post_type'  => 'services',
		 		'post_status'    => 'publish'
		 	);

		 	$servicesList = new WP_Query( $servicesArgs );

		 		  if ( $servicesList->have_posts()) :?>

	<section <?php echo $blockAttr; ?>
			<?php if( !empty($attributes['anchorId']) ):?>
				id="<?php echo $attributes['anchorId'];?>"
			<?php endif;?>
	>
		<div class="container">
			<div class="row">
        <div class="heading col-xl-6 col-md-8">
          <h2 class="block-title" data-aos="fade-up" data-aos-duration="300" data-aos-easing="ease-in-out-back">
	          <?php echo $attributes['blockTitle'];?>
          </h2>
          <?php if( !empty($attributes['blockText']) ):?>
            <p class="text"><?php echo $attributes['blockText'];?></p>
          <?php endif;?>
        </div>
        <div class="controls-wrapper col-xl-6 col-md-4" data-aos="fade-up" data-aos-duration="300" data-aos-easing="ease-in-out-back">
          <div class="control-wrapper">
            <div class="control prev">
              <svg width="24" height="25" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M8.28802 12.479L14.298 18.489L15.712 17.075L11.112 12.475L15.712 7.87499L14.298 6.46899L8.28802 12.479Z" fill="#272640"/>
              </svg>
            </div>
            <div class="control next">
              <svg width="24" height="25" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M15.712 12.479L9.70197 18.489L8.28798 17.075L12.888 12.475L8.28798 7.87499L9.70197 6.46899L15.712 12.479Z" fill="#272640"/>
              </svg></div>
          </div>
        </div>
			</div>
      <div class="row">
        <div class="slider-wrapper col-12" data-aos="fade-up" data-aos-duration="300" data-aos-easing="ease-in-out-back">
          <div class="slider" id="services-slider">
	          <?php while ( $servicesList->have_posts() ) : $servicesList->the_post();?>
              <a href="<?php the_permalink();?>" target="_blank" class="slide">
                <span class="pic-wrapper">
                  <img
                      class="object-fit"
                      src="<?php echo wp_get_attachment_image_src(get_post_thumbnail_id(), 'full')[0];?>"
                     <?php
                      $altText = get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', TRUE);
                      if ( !empty( $altText ) ):?>
                          alt="<?php echo $altText;?>"
                      <?php else:?>
                          alt="<?php the_title();?>"
                      <?php endif;?>
                  >
                </span>
                <span class="name subtitle"><?php echo the_title();?></span>
                <span class="description"><?php the_excerpt();?></span>
                <span class="more"><?php echo esc_html( pll__( 'Дізнатись більше' ) ); ?></span>
              </a>
	          <?php endwhile;?>
          </div>
        </div>
      </div>
		</div>
	</section>

	      <?php endif; ?>
	<?php wp_reset_postdata(); ?>

<?php endif;?>


