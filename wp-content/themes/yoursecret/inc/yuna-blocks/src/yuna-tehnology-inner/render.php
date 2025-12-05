<?php
	/**
	 * @see https://github.com/WordPress/gutenberg/blob/trunk/docs/reference-guides/block-api/block-metadata.md#render
	 */
?>

<?php

	$blockAttr = get_block_wrapper_attributes();

	$class = get_block_wrapper_attributes(["class" => 'item']);

?>

<li <?php echo $class;?> data-aos="flip-left" data-aos-duration="300" data-aos-easing="ease-in-out" data-aos-delay="<?php echo ($attributes['blockIndex'] + 1) * 200;?>">
  <?php if( !empty($attributes['itemIconUrl']) ):?>
    <img class="svg-pic"
         src="<?php echo $attributes['itemIconUrl'];?>"
	    <?php
		    if ( !empty( $attributes['itemIconAlt'] ) ):?>
              alt="<?php echo $attributes['itemIconAlt'] ;?>"
		    <?php else:?>
              alt="<?php echo get_bloginfo('name');?>"
		    <?php endif;?>
    >
  <?php endif;?>
</li>



