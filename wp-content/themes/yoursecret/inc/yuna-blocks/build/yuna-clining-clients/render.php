<?php
/**
 * @see https://github.com/WordPress/gutenberg/blob/trunk/docs/reference-guides/block-api/block-metadata.md#render
 */

$clientsList = carbon_get_theme_option('yuna_clinuing_clients_list');
?>

<?php if( !empty($attributes['blockTitle']) && !empty($clientsList) ):?>
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
          <p class="text col-xl-8 offset-xl-2 col-md-10 offset-md-1 col-12 text-center"><?php echo $attributes['blockText'];?></p>
        <?php endif;?>
			</div>
      <div class="row">
        <div class="slider-wrapper col-lg-8 offset-lg-2 col-sm-10 offset-sm-1 col-12" data-aos="fade-up" data-aos-duration="300" data-aos-easing="ease-in-out-back">
          <div class="slider" id="clients-slider">
	          <?php foreach( $clientsList as $client ):?>
                <div class="slide">
                  <img

                    src="<?php echo wp_get_attachment_image_src($client['logo'], 'full')[0];?>"
                     <?php
                      $altText = get_post_meta($client['logo'], '_wp_attachment_image_alt', TRUE);
                      if ( !empty( $altText ) ):?>
                          alt="<?php echo $altText;?>"
                      <?php else:?>
                          alt="<?php echo wp_strip_all_tags($attributes['blockTitle']);?>"
                      <?php endif;?>

                  >
                </div>
	          <?php endforeach;?>
          </div>
        </div>
      </div>
		</div>
	</section>

<?php endif;?>


