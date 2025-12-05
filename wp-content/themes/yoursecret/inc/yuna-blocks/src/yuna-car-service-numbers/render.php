<?php
/**
 * @see https://github.com/WordPress/gutenberg/blob/trunk/docs/reference-guides/block-api/block-metadata.md#render
 */
?>

<?php if( !empty($content)):?>
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
        <ul class="numbers-list card-list-wrapper col-12">
	        <?php echo $content; ?>
        </ul>
      </div>
		</div>
	</section>

<?php endif;?>


