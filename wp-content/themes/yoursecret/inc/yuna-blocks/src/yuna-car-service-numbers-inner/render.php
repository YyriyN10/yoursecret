<?php
	/**
	 * @see https://github.com/WordPress/gutenberg/blob/trunk/docs/reference-guides/block-api/block-metadata.md#render
	 */
?>

<?php

	$blockAttr = get_block_wrapper_attributes();
	$context = isset( $block->context ) && is_array( $block->context ) ? $block->context : [];

	$class = get_block_wrapper_attributes(["class" => 'card-item item text-center']);

?>

<li <?php echo $class;?> data-aos="zoom-out" data-aos-duration="300" data-aos-delay="<?php echo $attributes['blockIndex'] * 150;?>" >
  <?php if( !empty($attributes['itemName']) ):?>
    <p class="number"><?php echo $attributes['itemName'];?></p>
  <?php endif;?>
  <?php if( !empty($attributes['itemDescription']) ):?>
    <p class="description"><?php echo $attributes['itemDescription'];?></p>
  <?php endif;?>
</li>



