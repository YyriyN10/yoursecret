<?php
/**
 * @see https://github.com/WordPress/gutenberg/blob/trunk/docs/reference-guides/block-api/block-metadata.md#render
 */

$portfolioList = carbon_get_theme_option('portfolio_list');
?>

<?php if( !empty($attributes['blockTitle']) && !empty($portfolioList) ):?>
	<?php
		$blockAttr = get_block_wrapper_attributes();

		if ( !empty( $attributes['topIndent']) || !empty( $attributes['bottomIndent']) ){
			$indent = $attributes['topIndent'].' '.$attributes['bottomIndent'];
			$blockAttr = get_block_wrapper_attributes(["class" => $indent]);
		}

	?>

	<section <?php echo $blockAttr; ?>
			<?php if( !empty($attributes['anchorId']) ):?>
				id="<?php echo $attributes['anchorId'];?>"
			<?php endif;?>
	>
		<div class="container">
			<div class="row">
        <h2 class="block-title text-center col-12" data-aos="fade-up" data-aos-duration="300" data-aos-easing="ease-in-out-back">
          <span><?php echo $attributes['blockTitle'];?></span>
        </h2>
			</div>

		</div>
    <div class="container-fluid">
      <div class="row">
        <div class="slider-wrapper col-12" data-aos="fade-up" data-aos-duration="300" data-aos-easing="ease-in-out-back">
          <div class="slider" id="portfolio-slider">
		      <?php foreach( $portfolioList as $index=>$project ):?>
                <a href="<?php echo $project['link'];?>"
                   target="_blank"
                   rel="nofollow"
                   class="slide"
                   data-desktop-image="<?php echo $project['screenshot_desktop'];?>"
                   data-mobile-image="<?php echo $project['screenshot_mob'];?>"
                >
                  <span class="info">
                    <span class="name"><?php echo $project['name'];?></span>
                    <span class="button">
                      <span class="button-text"><?php echo esc_html( pll__( 'Дивитись' ) ); ?></span>
                    </span>
                  </span>
                </a>
		      <?php endforeach;?>
          </div>
        </div>
      </div>
    </div>
	</section>

<?php endif;?>


