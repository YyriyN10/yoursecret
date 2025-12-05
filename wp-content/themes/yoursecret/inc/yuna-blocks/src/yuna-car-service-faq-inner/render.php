<?php
	/**
	 * @see https://github.com/WordPress/gutenberg/blob/trunk/docs/reference-guides/block-api/block-metadata.md#render
	 */
?>

<?php

	$blockAttr = get_block_wrapper_attributes();
	$context = isset( $block->context ) && is_array( $block->context ) ? $block->context : [];

	$class = get_block_wrapper_attributes(["class" => 'card']);

?>
<div <?php echo $class;?>>
  <div class="card-header">
    <a class="collapsed btn subtitle small-subtitle" data-bs-toggle="collapse" href="#faq-<?php echo
    $attributes['blockIndex'];?>">
	    <?php echo $attributes['itemName'];?>
      <span class="indicator">
        <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M23.1162 11.4697C23.2139 11.3721 23.3721 11.3721 23.4697 11.4697L23.8232 11.8232C23.9209 11.9209 23.9208 12.0791 23.8232 12.1768L16.1768 19.8232C16.0791 19.9209 15.9209 19.9209 15.8232 19.8232L8.17676 12.1768C8.07914 12.0791 8.07913 11.9209 8.17676 11.8232L8.53027 11.4697C8.62789 11.3721 8.78615 11.3721 8.88379 11.4697L16 18.5859L23.1162 11.4697Z" fill="#EBEBEB" stroke="#EBEBEB"/>
</svg>
      </span>
    </a>
  </div>
  <div id="faq-<?php echo
  $attributes['blockIndex'];?>" class="collapse" data-bs-parent="#accordion-faq">
    <div class="card-body">
	    <?php echo $attributes['itemDescription'];?>
    </div>
  </div>
</div>




