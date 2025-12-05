<?php
/**
 * @see https://github.com/WordPress/gutenberg/blob/trunk/docs/reference-guides/block-api/block-metadata.md#render
 */

?>

<?php
	$blockAttr = get_block_wrapper_attributes();
	$i = 0;


  if( !empty($blockAttr)):?>
	<?php

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
	      <?php while ( $servicesList->have_posts() ) : $servicesList->the_post(); $i++;?>
          <a href="<?php the_permalink();?>" target="_blank" class="service-preview col-lg-3 col-md-6 col-12">
            <span class="inner text-center">
              <span class="icon">
                 <img class="svg-pic" src="<?php echo carbon_get_post_meta(get_the_ID(), 'yuna_car_service_service_icon');?>" alt="<?php echo the_title();?>">
              </span>
              <span class="name subtitle small-subtitle"><?php echo the_title();?></span>
              <span class="description"><?php echo get_the_excerpt();?></span>
              <span class="button btn-red">
                <?php echo esc_html( pll__( 'Дізнатись більше' ) ); ?>
              </span>
            </span>
          </a>
	      <?php endwhile;?>
      </div>
		</div>
	</section>

	      <?php endif; ?>
	<?php wp_reset_postdata(); ?>

<?php endif;?>


