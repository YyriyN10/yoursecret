<?php
/**
 * @see https://github.com/WordPress/gutenberg/blob/trunk/docs/reference-guides/block-api/block-metadata.md#render
 */

?>

<?php if( !empty($attributes['blockTitle'])):?>
	<?php
		$blockAttr = get_block_wrapper_attributes();
		$i = 0;

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
        <div class="content col-12">
          <div class="heading">
	          <?php if( !empty($attributes['blockName']) ):?>
                <h2 class="block-name" data-aos="fade-up" data-aos-duration="300" data-aos-easing="ease-in">
                    <?php echo $attributes['blockName'];?>
                </h2>
	          <?php endif;?>
            <h3 class="block-title big-title" data-aos="fade-up" data-aos-duration="300" data-aos-easing="ease-in">
	            <?php echo $attributes['blockTitle'];?>
            </h3>
          </div>
          <?php if( !empty($attributes['blockText']) ):?>
            <p class="text" data-aos="fade-up" data-aos-duration="300" data-aos-easing="ease-in">
                <?php echo $attributes['blockText'];?>
            </p>
          <?php endif;?>
        </div>
			</div>
      <div class="row">
        <div class="slider-wrapper col-12" data-aos="fade-up" data-aos-duration="300" data-aos-easing="ease-in">
          <div class="slider" id="services-slider">
	          <?php while ( $servicesList->have_posts() ) : $servicesList->the_post(); $i++;?>
              <a href="<?php the_permalink();?>" target="_blank" class="slide">
	              <?php if( $i < 10 ):?>
                    <span class="number">0<?php echo $i;?></span>
	              <?php else:?>
                    <span class="number"><?php echo $i;?></span>
	              <?php endif;?>
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
                <span class="info">
                  <span class="icon">
                    <img class="svg-pic" src="<?php echo carbon_get_post_meta(get_the_ID(), 'yuna_car_service_service_icon');?>" alt="<?php echo the_title();?>">
                  </span>
                  <span class="name subtitle small-subtitle"><?php echo the_title();?></span>
                </span>
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


