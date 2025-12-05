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

<li <?php echo $class;?> class="item" data-aos="flip-left" data-aos-duration="300" data-aos-delay="<?php echo ($attributes['blockIndex'] + 1) * 200 ;?>" data-aos-easing="ease-in-out" >


  <?php if( !empty($attributes['itemIconUrl']) ):?>
    <div class="icon">
      <img class="svg-pic"
           src="<?php echo $attributes['itemIconUrl'];?>"
	      <?php
		      if ( !empty( $attributes['itemIconAlt'] ) ):?>
                alt="<?php echo $attributes['itemIconAlt'] ;?>"
		      <?php else:?>
                alt="<?php wp_strip_all_tags($attributes['itemName']);?>"
		      <?php endif;?>
      >
    </div>

  <?php endif;?>

	<?php if( !empty($attributes['itemName']) ):?>
    <p class="text"><?php echo $attributes['itemName'];?></p>
	<?php endif;?>
</li>



