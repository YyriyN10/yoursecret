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

<li <?php echo $class;?> class="item" data-aos="zoom-out-up" data-aos-duration="300" data-aos-easing="ease-in-out-back" data-aos-delay="<?php echo  ($attributes['blockIndex'] + 1) * 200 ;?>"  >
  <div class="info">
    <p class="number"><?php echo $attributes['blockIndex'] + 1;?></p>
    <p class="name"><?php echo $attributes['itemName'];?></p>
  </div>

  <?php if( !empty($attributes['itemDescription']) ):?>
    <p class="description"><?php echo $attributes['itemDescription'];?></p>
  <?php endif;?>
</li>



