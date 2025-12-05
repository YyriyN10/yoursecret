<?php
	/**
	 * @see https://github.com/WordPress/gutenberg/blob/trunk/docs/reference-guides/block-api/block-metadata.md#render
	 */
?>

<?php

	$blockAttr = get_block_wrapper_attributes();
	$context = isset( $block->context ) && is_array( $block->context ) ? $block->context : [];

	$class = get_block_wrapper_attributes(["class" => 'item']);

?>

<li <?php echo $class;?> >
  <?php if( !empty($attributes['itemName']) ):?>
    <h4 class="name subtitle big-subtitle"><?php echo $attributes['itemName'];?></h4>
  <?php endif;?>
  <?php if( !empty($attributes['itemDescription']) ):?>
    <p class="description"><?php echo $attributes['itemDescription'];?></p>
  <?php endif;?>
</li>



