<?php
/**
 * @see https://github.com/WordPress/gutenberg/blob/trunk/docs/reference-guides/block-api/block-metadata.md#render
 */

?>

<?php if( !empty($attributes['blockTitle']) && !empty($attributes['blockText']) ):?>
	<?php
		$blockAttr = get_block_wrapper_attributes();

		$i = 1;

		if ( !empty( $attributes['topIndent']) || !empty( $attributes['bottomIndent']) ){
			$indent = $attributes['topIndent'].' '.$attributes['bottomIndent'];
			$blockAttr = get_block_wrapper_attributes(["class" => $indent]);
		}

	?>

<?php
	$portfolioArgs = array(
		'posts_per_page' => -1,
		'orderby' 	 => 'date',
		'post_type'  => 'portfolio',
		'post_status'    => 'publish'
	);

	$portfolioList = new WP_Query( $portfolioArgs );

	if ( $portfolioList->have_posts() ) :?>
	<section <?php echo $blockAttr; ?>
			<?php if( !empty($attributes['anchorId']) ):?>
				id="<?php echo $attributes['anchorId'];?>"
			<?php endif;?>
	>
		<div class="container">
			<div class="row">
        <h2 class="block-title col-12 text-center" data-aos="zoom-out-up" data-aos-duration="300" data-aos-easing="ease-in-out">
          <span><?php echo $attributes['blockTitle'];?></span>
        </h2>
        <div class="text col-12" data-aos="zoom-out-up" data-aos-duration="300" data-aos-easing="ease-in-out">
            <?php echo $attributes['blockText'];?>
        </div>
			</div>
		</div>
    <div class="container-fluid">
      <div class="row">
        <div class="content col-12">
		    <?php while ( $portfolioList->have_posts() ) : $portfolioList->the_post();?>
              <div class="item" data-aos="zoom-in" data-aos-duration="300" data-aos-easing="ease-in-out" data-aos-delay="<?php echo $i * 200;?>">
                <div class="front" style="background-image: url(<?php echo wp_get_attachment_image_src(get_post_thumbnail_id(), 'full')[0];?>)">
                  <h3 class="name"><?php the_title();?></h3>
                  <div class="more">
                    <svg xmlns="http://www.w3.org/2000/svg" shape-rendering="geometricPrecision" text-rendering="geometricPrecision" image-rendering="optimizeQuality" fill-rule="evenodd" clip-rule="evenodd" viewBox="0 0 512 478.17"><path fill-rule="nonzero" d="M98.24 433.08h315.52c14.59 0 27.88-5.98 37.52-15.63 9.64-9.64 15.63-22.93 15.63-37.51V98.23c0-14.58-5.99-27.86-15.64-37.51-9.64-9.64-22.92-15.63-37.51-15.63H98.24c-14.59 0-27.88 5.99-37.52 15.63-9.64 9.64-15.63 22.92-15.63 37.51v281.71c0 14.65 5.95 27.93 15.54 37.51l.09.09c9.59 9.59 22.87 15.54 37.52 15.54zm137.87-283.35 84.25 79.73c5.32 5.62 5.07 14.49-.55 19.81l-82.64 78.17a14.064 14.064 0 0 1-10.69 4.91c-7.79 0-14.09-6.31-14.09-14.09V159.91h.07c0-3.46 1.27-6.92 3.84-9.63 5.31-5.62 14.19-5.87 19.81-.55zm177.65 328.44H98.24c-26.92 0-51.42-11.02-69.26-28.79l-.14-.14C11.04 431.41 0 406.87 0 379.94V98.23C0 71.2 11.05 46.64 28.84 28.84 46.64 11.05 71.21 0 98.24 0h315.52c27.03 0 51.6 11.05 69.39 28.85C500.95 46.64 512 71.21 512 98.23v281.71c0 27.02-11.05 51.6-28.84 69.39-17.8 17.79-42.36 28.84-69.4 28.84z"/></svg>
                  </div>
                </div>
                <div class="back">
                  <p class="description"><?php echo carbon_get_post_meta(get_the_ID(), 'yuna_portfolio_card_description');?></p>
                  <div class="buttons-wrapper">
                    <a href="<?php echo carbon_get_post_meta(get_the_ID(), 'yuna_portfolio_card_link');?>" rel="nofollow" class="button" >
                      <span class="button-text">
                          <?php echo esc_html( pll__( 'Дивитись' ) ); ?>
                      </span>
                    </a>
	                  <?php if( !empty($attributes['btnText']) ):?>
                        <div class="button sale-btn" data-theme-name="<?php the_title();?>" data-bs-toggle="modal" data-bs-target="#formModal">
                          <span class="button-text">
                            <?php echo $attributes['btnText'];?>
                          </span>
                        </div>
	                  <?php endif;?>
                  </div>

                </div>
              </div>
		    <?php $i++; endwhile;?>
        </div>

      </div>
    </div>
	</section>
  <?php endif; ?>
	<?php wp_reset_postdata(); ?>

<?php endif;?>


