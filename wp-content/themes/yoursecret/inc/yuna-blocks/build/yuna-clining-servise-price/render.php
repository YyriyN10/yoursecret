<?php
/**
 * @see https://github.com/WordPress/gutenberg/blob/trunk/docs/reference-guides/block-api/block-metadata.md#render
 */
?>

<?php if( !empty($attributes['blockTitle']) && !empty($content) ):?>
	<?php
		$blockAttr = get_block_wrapper_attributes();

	?>

	<section <?php echo $blockAttr; ?>
			<?php if( !empty($attributes['anchorId']) ):?>
				id="<?php echo $attributes['anchorId'];?>"
			<?php endif;?>
	>
		<div class="container">
			<div class="row">
        <div class="content col-12 <?php echo $attributes['topIndent'];?> <?php echo $attributes['bottomIndent'];?>">
          <div class="text-wrapper">
            <h2 class="block-title" data-aos="fade-up" data-aos-duration="300" data-aos-easing="ease-in-out-back">
	            <?php echo $attributes['blockTitle'];?>
            </h2>
            <ul class="price-list">
	            <?php echo $content; ?>
            </ul>
          </div>
          <?php if( !empty($attributes['imageUrl']) ):?>
            <div class="image-wrapper">
              <img
                  class="lazy object-fit"
                  data-src="<?php echo $attributes['imageUrl'];?>"
		          <?php
			          $altText = $attributes['imageAlt'];
			          if ( !empty( $altText ) ):?>
                        alt="<?php echo $altText;?>"
			          <?php else:?>
                        alt="<?php echo wp_strip_all_tags($attributes['blockTitle']);?>"
			          <?php endif;?>

              >
            </div>
          <?php endif;?>
        </div>


			</div>
		</div>
	</section>

<?php endif;?>


