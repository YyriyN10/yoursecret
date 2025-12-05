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
        <h2 class="block-title col-12 text-center" data-aos="fade-up" data-aos-duration="300" data-aos-easing="ease-in-out-back">
			<?php echo $attributes['blockTitle'];?>
        </h2>
		  <?php if( !empty($attributes['blockText']) ):?>
            <p class="text col-xl-8 offset-xl-2 col-md-10 offset-md-1 text-center" data-aos="fade-up" data-aos-duration="300" data-aos-easing="ease-in-out-back"><?php echo $attributes['blockText'];?></p>
		  <?php endif;?>
			</div>
      <div class="row services-list">
        <?php while ( $servicesList->have_posts() ) : $servicesList->the_post();?>
          <a href="<?php the_permalink();?>" target="_blank" class="service-item col-xl-4 col-md-6">
            <span class="inner">
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
            </span>
          </a>
	      <?php endwhile;?>
      </div>
		</div>
	</section>

	      <?php endif; ?>
	<?php wp_reset_postdata(); ?>

<?php endif;?>


