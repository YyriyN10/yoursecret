<?php
/**
 * @see https://github.com/WordPress/gutenberg/blob/trunk/docs/reference-guides/block-api/block-metadata.md#render
 */
?>

<?php if( !empty($attributes['blockTitle']) ):?>
	<?php
		$blockAttr = get_block_wrapper_attributes();

	?>

	<section <?php echo $blockAttr; ?> id="particles-js"
      <?php if (!empty($attributes['backgroundImageUrl'])):?>
        style="background-image: url(<?php echo $attributes['backgroundImageUrl'];?>)"
      <?php endif;?>
	>
		<div class="container">
			<div class="row">
				<?php if( !empty($attributes['blockTitle'])):?>
          <h1 class="main-title text-center col-12" data-aos="zoom-out-up" data-aos-duration="300" data-aos-easing="ease-in-out">
            <?php echo $attributes['blockTitle'];?>
          </h1>
				<?php endif;?>
				<?php if( !empty($attributes['blockText'])):?>
					<p class="slogan-text text-center col-12" data-aos="zoom-out-up" data-aos-duration="300" data-aos-easing="ease-in-out">
            <?php echo $attributes['blockText'];?>
          </p>
				<?php endif;?>

				<?php if ( !empty( $attributes['btnText'] ) ):?>
            <div class="col-12 text-center">
              <div class="button" data-bs-toggle="modal" data-bs-target="#formModal" data-aos="zoom-out-up" data-aos-duration="300" data-aos-easing="ease-in-out">
                <span class="button-text">
                  <?php echo $attributes['btnText'];?>
                </span>
              </div>
            </div>
				<?php endif;?>
			</div>
		</div>
	</section>

<?php endif;?>


