<?php
/**
 * @see https://github.com/WordPress/gutenberg/blob/trunk/docs/reference-guides/block-api/block-metadata.md#render
 */

$reviewsList = carbon_get_theme_option('yuna_clinuing-reviews_list'.yuna_lang_prefix());
?>

<?php if( !empty($attributes['blockTitle']) && !empty($reviewsList) ):?>
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
        <div class="text-content col-xl-4 col-lg-5 col-md-6">
          <h2 class="block-title" data-aos="fade-up" data-aos-duration="300" data-aos-easing="ease-in-out-back">
	          <?php echo $attributes['blockTitle'];?>
          </h2>
	        <?php if( !empty($attributes['blockText']) ):?>
              <p class="text"><?php echo $attributes['blockText'];?></p>
	        <?php endif;?>
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
        <div class="slider-wrapper col-xl-8 col-lg-7 col-md-6" ata-aos="fade-up" data-aos-duration="300" data-aos-easing="ease-in-out-back">
          <div class="slider" id="reviews-slider">
	          <?php foreach( $reviewsList as $review ):?>
                <div class="slide">
                  <div class="review-text"><?php echo wpautop($review['review']);?></div>
                  <div class="review-info">
                    <?php if( !empty($review['avatar']) ):?>
                      <div class="avatar">
                        <img
                           class="lazy object-fit"
                           data-src="<?php echo wp_get_attachment_image_src($review['avatar'], 'full')[0];?>"
                           <?php
                            $altText = get_post_meta($review['avatar'], '_wp_attachment_image_alt', TRUE);
                            if ( !empty( $altText ) ):?>
                                alt="<?php echo $altText;?>"
                            <?php else:?>
                                alt="<?php echo $review['name'];?>"
                            <?php endif;?>
                        >
                      </div>
                    <?php else:?>
                      <div class="avatar">
                        <p>
                            <?php
	                            $first_character = mb_substr($review['name'], 0, 1, 'UTF-8');

	                            echo $first_character;
                            ?>
                        </p>
                      </div>
                    <?php endif;?>

                    <p class="name"><?php echo $review['name'];?></p>
                  </div>
                </div>
	          <?php endforeach;?>
          </div>
        </div>

			</div>

		</div>
	</section>

<?php endif;?>


