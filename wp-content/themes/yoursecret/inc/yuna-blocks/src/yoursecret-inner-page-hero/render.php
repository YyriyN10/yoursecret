<?php
/**
 * @see https://github.com/WordPress/gutenberg/blob/trunk/docs/reference-guides/block-api/block-metadata.md#render
 */
?>

<?php if( !empty($attributes['pageTitle']) ):?>
	<?php
		$blockAttr = get_block_wrapper_attributes();

	?>
  <section <?php echo $blockAttr; ?>>
    <div class="container container px-5">
      <div class="row gx-5 justify-content-center">
        <div class="col-lg-10">
          <h2 class="mb-4"><?php echo $attributes['pageTitle'];?></h2>
          <?php if( !empty($attributes['sectionText']) ):?>
            <div class="text"><?php echo $attributes['sectionText'];?></div>
          <?php endif;?>
          <hr class="my-5" />
        </div>
      </div>
    </div>
  </section>
<?php endif;?>


