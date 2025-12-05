<?php
	/**
	 * @see https://github.com/WordPress/gutenberg/blob/trunk/docs/reference-guides/block-api/block-metadata.md#render
	 */
?>

<?php

	$blockAttr = get_block_wrapper_attributes();


	$class = get_block_wrapper_attributes(["class" => 'card bg-light shadow-none']);

	if (!empty($content)): ?>

  <div <?php echo $class;?>>
    <div class="card-body">
      <?php if( !empty($attributes['sectionTitle']) ):?>
        <h6><?php echo $attributes['sectionTitle'];?></h6>
      <?php endif;?>
      <?php if( !empty($content) ):?>
        <?php echo $content;?>
      <?php endif;?>
    </div>
  </div>
<?php endif;



