<?php
/**
 * @see https://github.com/WordPress/gutenberg/blob/trunk/docs/reference-guides/block-api/block-metadata.md#render
 */
?>

<?php if( !empty($content) ):?>
	<?php
	$blockAttr = get_block_wrapper_attributes();

	if ( !empty( $attributes['topIndent']) || !empty( $attributes['bottomIndent']) ){
		$indent = $attributes['topIndent'].' '.$attributes['bottomIndent'].'';
		$blockAttr = get_block_wrapper_attributes(["class" => $indent]);
	}

	?>

	<section <?php echo $blockAttr; ?>>
		<div class="container">
			<div class="row">
        <div class="content col-12">
          <?php echo $content;?>
        </div>
			</div>
		</div>
	</section>

<?php endif;?>


