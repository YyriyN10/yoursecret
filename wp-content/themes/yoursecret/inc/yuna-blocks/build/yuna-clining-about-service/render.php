<?php
/**
 * @see https://github.com/WordPress/gutenberg/blob/trunk/docs/reference-guides/block-api/block-metadata.md#render
 */

?>

<?php if( !empty($attributes['blockText']) ):?>
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
        <div class="text-content col-xl-5 col-lg-6 col-md-7 col-sm-8" data-aos="fade-up" data-aos-duration="300" data-aos-easing="ease-in-out-back">
	        <?php echo $attributes['blockText'];?>
          <div class="button" data-servise="<?php echo get_the_ID();?>" data-bs-toggle="modal" data-bs-target="#formModal">
	          <?php echo $attributes['btnText'];?>
          </div>
        </div>
        <div class="image-wrapper col-lg-6 col-md-5 col-sm-4 offset-xl-1">
          <img
             class="lazy object-fit"
             data-src="<?php echo $attributes['imageUrl'];?>"
             <?php
              $altText = $attributes['imageAlt'];
              if ( !empty( $altText ) ):?>
                  alt="<?php echo $altText;?>"
              <?php else:?>
                  alt="<?php the_title();?>"
              <?php endif;?>
          >
        </div>

			</div>
		</div>
	</section>

<?php endif;?>


