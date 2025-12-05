<?php
/**
 * @see https://github.com/WordPress/gutenberg/blob/trunk/docs/reference-guides/block-api/block-metadata.md#render
 */

$teamList = carbon_get_theme_option('yuna_clinuing-team_list'.yuna_lang_prefix());
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
        <h2 class="block-title col-12 text-center" data-aos="fade-up" data-aos-duration="300" data-aos-easing="ease-in-out-back">
          <?php echo $attributes['blockTitle'];?>
        </h2>
        <?php if( !empty($attributes['blockText']) ):?>
              <p class="text text-center col-xl-4 offset-xl-4 col-lg-6 offset-lg-3 col-md-8 offset-md-2 col-12"><?php echo $attributes['blockText'];?></p>
        <?php endif;?>
			</div>
      <div class="row team-list-wrapper" id="team-list-wrapper">
	      <?php foreach( $teamList as $index=>$teamMen ):?>
            <?php if( $index < 4 ):?>
            <div class="team-men col-xl-3 col-md-6 col-sm-6">
              <div class="inner">
                <p class="name subtitle"><?php echo $teamMen['name'];?></p>
                <p class="specialization"><?php echo $teamMen['specialization'];?></p>
                <div class="pic-wrapper">
                  <img
                      class="lazy object-fit"
                      data-src="<?php echo wp_get_attachment_image_src($teamMen['image'], 'full')[0];?>"
		              <?php
			              $altText = get_post_meta($teamMen['image'], '_wp_attachment_image_alt', TRUE);
			              if ( !empty( $altText ) ):?>
                            alt="<?php echo $altText;?>"
			              <?php else:?>
                            alt="<?php echo $teamMen['name'];?>"
			              <?php endif;?>

                  >
                </div>
              </div>
            </div>
            <?php else:?>
            <div class="team-men col-xl-3 col-md-6 col-sm-6 d-none">
              <div class="inner">
                <p class="name subtitle"><?php echo $teamMen['name'];?></p>
                <p class="specialization"><?php echo $teamMen['specialization'];?></p>
                <div class="pic-wrapper">
                  <img
                      class="lazy object-fit"
                      data-src="<?php echo wp_get_attachment_image_src($teamMen['image'], 'full')[0];?>"
				      <?php
					      $altText = get_post_meta($teamMen['image'], '_wp_attachment_image_alt', TRUE);
					      if ( !empty( $altText ) ):?>
                            alt="<?php echo $altText;?>"
					      <?php else:?>
                            alt="<?php echo $teamMen['name'];?>"
					      <?php endif;?>

                  >
                </div>
              </div>
            </div>
            <?php endif;?>
	      <?php endforeach;?>
      </div>
      <?php if( !empty($attributes['btnText']) && (count($teamList) > 4 )):?>
        <div class="row">
          <div class="more-team-men col-12 text-center">
            <div class="button" id="all-team-men-btn">
		        <?php echo $attributes['btnText']; ?>
            </div>
          </div>
        </div>
      <?php endif;?>


		</div>
	</section>

<?php endif;?>


