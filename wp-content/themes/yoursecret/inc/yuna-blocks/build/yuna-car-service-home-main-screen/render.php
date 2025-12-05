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
          <div class="content col-12">
            <h1 class="page-title" data-aos="zoom-out-up" data-aos-duration="300" data-aos-easing="ease-in-out">
	            <?php echo $attributes['mainTitle'];?>
            </h1>
            <?php if( (!empty($attributes['btnFormText']) && !empty($attributes['btnFormAnchor'])) || (!empty($attributes['btnServiceText']) && !empty($attributes['btnServiceAnchor'])) ):?>
              <div class="buttons-wrapper" data-aos="zoom-out-up" data-aos-duration="300" data-aos-easing="ease-in-out">
	              <?php if( !empty($attributes['btnFormText']) && !empty($attributes['btnFormAnchor'])):?>
                  <div class="button btn-red" data-bs-toggle="modal" data-bs-target="<?php echo $attributes['btnFormAnchor'];?>">
                    <?php echo $attributes['btnFormText'];?>
                  </div>
	              <?php endif;?>
	              <?php if( !empty($attributes['btnServiceText']) && !empty($attributes['btnServiceAnchor']) ):?>
                    <a href="<?php echo $attributes['btnServiceAnchor'];?>" class="button btn-opacity">
		                <?php echo $attributes['btnServiceText'];?>
                    </a>
	              <?php endif;?>
              </div>
            <?php endif;?>

	          <?php if( !empty($attributes['mainText'])):?>
                <p class="slogan-text" data-aos="zoom-out-up" data-aos-duration="300" data-aos-easing="ease-in-out">
		              <?php echo $attributes['mainText'];?>
                </p>
	          <?php endif;?>

          </div>
        <?php endif;?>
			</div>
		</div>
	</section>

<?php endif;?>


