<?php
/**
 * @see https://github.com/WordPress/gutenberg/blob/trunk/docs/reference-guides/block-api/block-metadata.md#render
 */

?>

<?php if( !empty($attributes['blockTitle']) && !empty($attributes['blockText']) && !empty($attributes['imageUrl'])):?>
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
        <h2 class="block-title col-12" data-aos="zoom-out-left" data-aos-duration="300" data-aos-easing="ease-in-out">
          <span><?php echo $attributes['blockTitle'];?></span>
        </h2>
      </div>
			<div class="row">
        <div class="pic-wrapper col-lg-5 col-md-8 offset-md-2 col-10 offset-1 offset-lg-0">
          <div class="pic" data-aos="zoom-out-right" data-aos-duration="300" data-aos-easing="ease-in-out">
            <img
                class="lazy parallax-image"
                data-src="<?php echo $attributes['imageUrl'];?>"
	            <?php
		            $altText = $attributes['imageAlt'];
		            if ( !empty( $altText ) ):?>
                      alt="<?php echo $altText;?>"
		            <?php else:?>
                      alt="<?php echo get_bloginfo('name');?>"
		            <?php endif;?>
            >
          </div>
        </div>
        <div class="content col-lg-7" data-aos="zoom-out-left" data-aos-duration="300" data-aos-easing="ease-in-out">

          <div class="text"><?php echo $attributes['blockText'];?></div>
          <?php if( !empty($attributes['btnText']) ):?>
            <div class="button" data-bs-toggle="modal" data-bs-target="#formModal" data-aos="zoom-out-up" data-aos-duration="300" data-aos-easing="ease-in-out">
                <span class="button-text">
                  <?php echo $attributes['btnText'];?>
                </span>
            </div>
          <?php endif;?>
        </div>
			</div>
		</div>
	</section>

<?php endif;?>


