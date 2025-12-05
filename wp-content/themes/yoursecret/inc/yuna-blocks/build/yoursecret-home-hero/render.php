<?php
/**
 * @see https://github.com/WordPress/gutenberg/blob/trunk/docs/reference-guides/block-api/block-metadata.md#render
 */
?>

<?php if( !empty($attributes['imageUrl']) ):?>
	<?php
		$blockAttr = get_block_wrapper_attributes();

	  $blockAttr = get_block_wrapper_attributes(["class" => "page-header-ui page-header-ui-dark bg-img-repeat bg-white"]);

	?>
  <header <?php echo $blockAttr; ?>
      <?php if( !empty($attributes['bgImageUrl']) ):?>
        style="background-image: url(<?php echo $attributes['bgImageUrl'];?>);"
      <?php endif;?>

  >
    <div class="page-header-ui-content">
      <div class="container px-4">
        <div class="row gx-4 align-items-center">
          <div class="col-lg-6 col-md-6 col-12">
            <img
                class="img-fluid mb-3 mb-lg-0 no-border-mobile"
                loading="lazy"
                src="<?php echo $attributes['imageUrl'];?>"
		          <?php
			          $altText = $attributes['imageAlt'];
			          if ( !empty( $altText ) ):?>
                  alt="<?php echo $altText;?>"
			          <?php else:?>
                  alt="<?php get_bloginfo('name');?> <?php get_bloginfo('description');?>"
			          <?php endif;?>

            >
          </div>
          <div class="col-lg-5 col-md-6 col-12 d-flex justify-content-center">
            <div class="text-dark responsive-form-container">
              <div class="card-body p-4 p-md-4 p-sm-3">
	              <?php get_template_part('template-parts/autch-form');?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </header>


<?php endif;?>


