<?php
/**
 * @see https://github.com/WordPress/gutenberg/blob/trunk/docs/reference-guides/block-api/block-metadata.md#render
 */

?>

<?php if( !empty($attributes['blockTitle']) && !empty($attributes['blockText']) && !empty($attributes['image1Url']) && !empty($attributes['image2Url'])):?>
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
        <h2 class="block-title col-12 text-center" data-aos="zoom-out-left" data-aos-duration="300" data-aos-easing="ease-in-out">
          <span><?php echo $attributes['blockTitle'];?></span>
        </h2>
      </div>
      <div class="row">
        <div class="images-wrapper col-xl-6 col-lg-4 col-md-4">
          <div class="pic-wrapper pic-1" data-aos-duration="300" data-aos-easing="ease-in-out">
            <img
                data-aos="zoom-out-left"
               class="lazy object-fit"
               data-src="<?php echo $attributes['image1Url'];?>"
               <?php
                $altText = get_post_meta($attributes['image1Alt'], '_wp_attachment_image_alt', TRUE);
                if ( !empty( $altText ) ):?>
                    alt="<?php echo $altText;?>"
                <?php else:?>
                    alt="<?php echo wp_strip_all_tags($attributes['blockTitle']);?>"
                <?php endif;?>
            >
          </div>
          <div class="pic-wrapper pic-2" data-aos-duration="300" data-aos-delay="150" data-aos-easing="ease-in-out">
            <img
                data-aos="zoom-out-left"
                class="lazy object-fit"
                data-src="<?php echo $attributes['image2Url'];?>"
		        <?php
			        $altText = get_post_meta($attributes['image2Alt'], '_wp_attachment_image_alt', TRUE);
			        if ( !empty( $altText ) ):?>
                      alt="<?php echo $altText;?>"
			        <?php else:?>
                      alt="<?php echo wp_strip_all_tags($attributes['blockTitle']);?>"
			        <?php endif;?>
            >
          </div>
        </div>
        <div class="text-content col-xl-6 col-lg-8 col-md-8">
          <div class="text"><?php echo $attributes['blockText'];?></div>
          <?php if( !empty($attributes['blockList']) ):?>
            <ul class="clining-list" data-aos="zoom-out-right" data-aos-duration="300" data-aos-easing="ease-in-out">
	            <?php echo $attributes['blockList'];?>
            </ul>
          <?php endif;?>
          <?php if( !empty($attributes['image3Url']) ):?>
            <div class="pic-wrapper pic-content" data-aos="zoom-out-right" data-aos-duration="300" data-aos-easing="ease-in-out">
              <img
                  class="lazy object-fit"
                  data-src="<?php echo $attributes['image3Url'];?>"
		          <?php
			          $altText = $attributes['image3Alt'];
			          if ( !empty( $altText ) ):?>
                        alt="<?php echo $altText;?>"
			          <?php else:?>
                        alt="<?php echo get_bloginfo('name');?>"
			          <?php endif;?>
              >
            </div>
          <?php endif;?>
        </div>
      </div>
		</div>
	</section>

<?php endif;?>


