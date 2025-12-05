<?php
	/**
	 * @see https://github.com/WordPress/gutenberg/blob/trunk/docs/reference-guides/block-api/block-metadata.md#render
	 */
?>

<?php

	$blockAttr = get_block_wrapper_attributes();

	$class = get_block_wrapper_attributes(["class" => 'slide']);

?>

<div <?php echo $class;?>  >
  <?php if( !empty($attributes['imageUrl']) ):?>
    <div class="pic-wrapper">
      <img
         class="object-fit"
         src="<?php echo $attributes['imageUrl'];?>"
         <?php
          $altText = $attributes['imageAlt'];
          if ( !empty( $altText ) ):?>
              alt="<?php echo $altText;?>"
          <?php else:?>
              alt="<?php the_title();?>"
          <?php endif;?>
      >
    </div>
  <?php endif;?>

</div>



