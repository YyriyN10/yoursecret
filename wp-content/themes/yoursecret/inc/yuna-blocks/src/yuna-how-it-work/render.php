<?php
/**
 * @see https://github.com/WordPress/gutenberg/blob/trunk/docs/reference-guides/block-api/block-metadata.md#render
 */
?>

<?php if( !empty($attributes['blockTitle']) ):?>
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
      <?php if( !empty($attributes['imageUrl']) ):?>
        style="background-image: url(<?php echo $attributes['imageUrl'];?>)"
      <?php endif;?>
	>
		<div class="container">
			<div class="row">
        <h2 class="block-title col-12" data-aos="fade-up" data-aos-duration="300" data-aos-easing="ease-in-out-back">
          <span><?php echo $attributes['blockTitle'];?></span>
        </h2>
				<?php if( !empty($content) ):?>
					<ol class="items-list col-12">
						<?php echo $content; ?>
					</ol>
				<?php endif;?>
			</div>
		</div>
	</section>

<?php endif;?>


