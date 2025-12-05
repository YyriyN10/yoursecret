<?php
	/**
	 * @see https://github.com/WordPress/gutenberg/blob/trunk/docs/reference-guides/block-api/block-metadata.md#render
	 */
?>

<?php

	$blockAttr = get_block_wrapper_attributes();

	$class = get_block_wrapper_attributes(["class" => 'card-item item']);

?>

<li <?php echo $class;?>  data-aos="zoom-out-up" data-aos-duration="300" data-aos-easing="ease-in-out-back" data-aos-delay="<?php echo  ($attributes['blockIndex'] + 1) * 200 ;?>"  >
  <?php if( !empty($attributes['iconUrl']) ):?>
    <div class="icon">
      <img class="svg-pic" src="<?php echo $attributes['iconUrl'];?>" alt="<?php echo $attributes['itemName'];?>">
    </div>
  <?php endif;?>
  <?php if( !empty($attributes['itemName']) ):?>
    <p class="name subtitle"><?php echo $attributes['itemName'];?></p>
  <?php endif;?>

  <?php if( !empty($attributes['itemDescription']) ):?>
    <p class="description"><?php echo $attributes['itemDescription'];?></p>
  <?php endif;?>
</li>



