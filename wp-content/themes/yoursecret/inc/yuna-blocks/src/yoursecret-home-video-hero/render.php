<?php
	/**
	 * @see https://github.com/WordPress/gutenberg/blob/trunk/docs/reference-guides/block-api/block-metadata.md#render
	 */
?>

<?php if( !empty($attributes['videoUrl']) ):?>
	<?php
	$blockAttr = get_block_wrapper_attributes();

	?>
  <section <?php echo $blockAttr; ?>>
    <div class="container-fluid p-0 m-0">
      <div class="row gx-0 m-0">
        <div class="col-12 p-0 m-0">
          <video class="w-100" autoplay muted loop playsinline preload="metadata">
            <source src="<?php echo $attributes['videoUrl'];?>" type="video/webm">
						<?php echo esc_html( pll__( 'Your browser does not support the video tag.' ) ); ?>
          </video>
        </div>
      </div>
    </div>
  </section>
<?php endif;?>


