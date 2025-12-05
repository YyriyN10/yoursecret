<?php
/**
 * @see https://github.com/WordPress/gutenberg/blob/trunk/docs/reference-guides/block-api/block-metadata.md#render
 */

$teamList = carbon_get_theme_option('yuna_car_service_team_list'.yuna_lang_prefix());
?>

<?php if( !empty($attributes['blockTitle']) && !empty($teamList) ):?>
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
      <div class="row">
        <div class="slider-wrapper col-12">
          <div class="slider" id="team-slider">
	          <?php foreach( $teamList as $index=>$teamMen ):?>
              <div class="team-men slide">
                <div class="pic-wrapper">
                  <img
                      class="object-fit"
                      src="<?php echo wp_get_attachment_image_src($teamMen['image'], 'full')[0];?>"
					          <?php
						          $altText = get_post_meta($teamMen['image'], '_wp_attachment_image_alt', TRUE);
						          if ( !empty( $altText ) ):?>
                        alt="<?php echo $altText;?>"
						          <?php else:?>
                        alt="<?php echo $teamMen['name'];?>"
						          <?php endif;?>
                  >
                </div>
                <p class="name subtitle small-subtitle"><?php echo $teamMen['name'];?></p>
                <p class="specialization"><?php echo $teamMen['specialization'];?></p>
                <p class="description"><?php echo $teamMen['description'];?></p>
              </div>
	          <?php endforeach;?>
          </div>
        </div>
      </div>
		</div>
	</section>

<?php endif;?>


