<?php
/**
 * @see https://github.com/WordPress/gutenberg/blob/trunk/docs/reference-guides/block-api/block-metadata.md#render
 */
?>

<?php if( !empty($attributes['mainTitle']) ):?>
	<?php
		$blockAttr = get_block_wrapper_attributes();

	?>

	<section <?php echo $blockAttr; ?>
      <?php if (!empty($attributes['backgroundImageUrl'])):?>
        style="background-image: url(<?php echo $attributes['backgroundImageUrl'];?>)"
      <?php endif;?>
	>
		<div class="container">
			<div class="row">
        <?php if( !empty($attributes['mainTitle'])  ):?>
          <div class="content col-12 text-center">
            <h1 class="page-title" data-aos="zoom-out-up" data-aos-duration="300" data-aos-easing="ease-in-out">
	            <?php echo $attributes['mainTitle'];?>
            </h1>
          </div>
        <?php endif;?>
			</div>
		</div>
	</section>

<?php endif;?>


