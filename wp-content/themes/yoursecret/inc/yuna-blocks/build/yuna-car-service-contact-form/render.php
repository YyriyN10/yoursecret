<?php
/**
 * @see https://github.com/WordPress/gutenberg/blob/trunk/docs/reference-guides/block-api/block-metadata.md#render
 */

?>

<?php if( !empty($attributes['blockTitle']) && !empty($attributes['btnText'])):?>
	<?php
	$blockAttr = get_block_wrapper_attributes();

	if ( !empty( $attributes['topIndent'])  ){
		$indent = $attributes['topIndent'];
		$blockAttr = get_block_wrapper_attributes(["class" => $indent]);
	}

	?>

	<section <?php echo $blockAttr; ?>
			<?php if( !empty($attributes['anchorId']) ):?>
				id="<?php echo $attributes['anchorId'];?>"
			<?php endif;?>
	>
		<div class="container">
      <div class="row">
        <div class="heading col-lg-8" data-aos="fade-up" data-aos-duration="300" data-aos-easing="ease-in">
		      <?php if( !empty($attributes['blockName']) ):?>
            <h2 class="block-name"><?php echo $attributes['blockName'];?></h2>
		      <?php endif;?>
          <h3 class="block-title small-title" >
			      <?php echo $attributes['blockTitle'];?>
          </h3>
        </div>
	      <?php if( !empty($attributes['blockText']) ):?>
          <p class="text col-lg-4" data-aos="fade-up" data-aos-duration="300" data-aos-easing="ease-in">
			      <?php echo $attributes['blockText'];?>
          </p>
	      <?php endif;?>
      </div>
    </div>
    <div class="map-wrapper">
      <div class="container">
        <div class="row">
          <div class="form-wrapper col-lg-5 col-md-6">
            <div class="inner">
	            <?php
		            $formArgs = array(
			            'btnText' => $attributes['btnText'],
		            );
		            get_template_part('template-parts/form', null, $formArgs);?>
            </div>

          </div>
        </div>
      </div>
	    <?php
		    $mapLink = carbon_get_theme_option('yuna_car_service_office_map_link');

		    if( !empty($mapLink) ):?>
          <div class="map">
            <iframe src="<?php echo $mapLink;?>" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
          </div>
		    <?php endif;?>
    </div>
	</section>

<?php endif;?>


