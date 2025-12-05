<?php
/**
 * @see https://github.com/WordPress/gutenberg/blob/trunk/docs/reference-guides/block-api/block-metadata.md#render
 */
?>

<?php

	$blockAttr = get_block_wrapper_attributes();

  if( !empty($blockAttr) ):?>
	<?php


		if(!empty($attributes['lastInPage'])){
			$blockAttr = get_block_wrapper_attributes(["class" => "last-section"]);
    }

	?>
  <section <?php echo $blockAttr; ?>>
    <div class="container container px-5">
      <div class="row gx-5 justify-content-center">
        <div class="col-lg-10">
          <?php if( !empty($attributes['sectionTitle']) ):?>
            <h4 class="mb-4">
	            <?php if( empty($attributes['blueDecorToggle']) ):?>
                <div class="icon-stack bg-primary text-white me-2">
			            <?php if( !empty($attributes['arrowImage']) ):?>
                    <img src="<?php echo $attributes['arrowImage'];?>" alt="icon" class="svg-pic icon">
			            <?php else:?>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right icon"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline>
                    </svg>
			            <?php endif;?>
                </div>
	            <?php endif;?>
		          <?php echo $attributes['sectionTitle'];?>
            </h4>
          <?php endif;?>

          <?php if( !empty($content) ):?>
            <div class="text">
              <?php echo $content;?>
            </div>
          <?php endif;?>
	        <?php if( !empty($attributes['btnCall']) ):?>
            <p class="button-call"><?php echo $attributes['btnCall'];?></p>
	        <?php endif;?>
          <?php if( !empty($attributes['btnText']) && !empty($attributes['btnLink'])):?>
            <a href="<?php echo $attributes['btnLink'];?>" class="btn btn-primary">
              <?php echo $attributes['btnText'];?> →
            </a>
          <?php endif;?>
          <hr class="my-5" />
        </div>
      </div>
    </div>
  </section>
<?php endif;?>


