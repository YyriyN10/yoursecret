<?php
/**
 * @see https://github.com/WordPress/gutenberg/blob/trunk/docs/reference-guides/block-api/block-metadata.md#render
 */
?>

<?php if( !empty($attributes['blockTitle']) ):?>
	<?php
		$blockAttr = get_block_wrapper_attributes();

	?>

	<section <?php echo $blockAttr; ?>
			<?php if( !empty($attributes['anchorId']) ):?>
				id="<?php echo $attributes['anchorId'];?>"
			<?php endif;?>
      <?php if( !empty($attributes['imageUrl']) ):?>
        style="background-image: url(<?php echo $attributes['imageUrl'];?>)"
      <?php endif;?>
	>
		<div class="container">
			<div class="row">
        <div class="content col-12 <?php echo $attributes['topIndent'];?> <?php echo $attributes['bottomIndent'];?>">
          <h2 class="block-title text-center" data-aos="fade-up" data-aos-duration="300" data-aos-easing="ease-in-out-back">
	          <?php echo $attributes['blockTitle'];?>
          </h2>
	        <?php if( !empty($content) ):?>
              <ul class="card-list-wrapper advantages-list col-12">
		            <?php echo $content; ?>
              </ul>
	        <?php endif;?>
        </div>


			</div>
		</div>
	</section>

<?php endif;?>


