<?php
/**
 * @see https://github.com/WordPress/gutenberg/blob/trunk/docs/reference-guides/block-api/block-metadata.md#render
 */
?>

<?php if( !empty($attributes['blockTitle']) && !empty($content) ):?>
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
        <div class="heading col-lg-8 col-md-7" data-aos="fade-up" data-aos-duration="300" data-aos-easing="ease-in">
					<?php if( !empty($attributes['blockName']) ):?>
            <h2 class="block-name"><?php echo $attributes['blockName'];?></h2>
					<?php endif;?>
          <h3 class="block-title big-title">
						<?php echo $attributes['blockTitle'];?>
          </h3>
        </div>
				<?php if( !empty($attributes['blockText']) ):?>
          <div class="text col-lg-4 col-md-5" data-aos="fade-up" data-aos-duration="300" data-aos-easing="ease-in">
            <?php echo $attributes['blockText'];?>
          </div>
				<?php endif;?>
      </div>
      <div class="row">
        <div class="image-wrapper col-lg-6 col-md-4">
          <div class="inner">
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
        </div>
        <div class="accordion accordion-faq col-lg-6 col-md-8" id="accordion-faq" data-aos="fade-up" data-aos-duration="300" data-aos-easing="ease-in-out-back">
	        <?php echo $content; ?>
        </div>
      </div>
		</div>
	</section>

<?php endif;?>


