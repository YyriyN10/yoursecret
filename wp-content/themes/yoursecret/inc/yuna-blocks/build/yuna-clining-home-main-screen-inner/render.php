<?php
	/**
	 * @see https://github.com/WordPress/gutenberg/blob/trunk/docs/reference-guides/block-api/block-metadata.md#render
	 */
?>

<?php

	$blockAttr = get_block_wrapper_attributes();

	$class = get_block_wrapper_attributes(["class" => 'slide']);

?>

<div <?php echo $class;?>>
  <div class="inner">
	  <?php if( !empty($attributes['imageUrl']) ):?>

        <img src="<?php echo $attributes['imageUrl'];?>"
		    <?php
			    if ( !empty( $attributes['imageAlt'] ) ):?>
                  alt="<?php echo $attributes['imageAlt'] ;?>"
			    <?php else:?>
                  alt="<?php echo $attributes['serviceName'];?>"
			    <?php endif;?>
        >
	  <?php endif;?>
    <?php if( !empty($attributes['serviceName']) ):?>
      <p class="name"><?php echo $attributes['serviceName'];?></p>
    <?php endif;?>

  </div>

</div>



