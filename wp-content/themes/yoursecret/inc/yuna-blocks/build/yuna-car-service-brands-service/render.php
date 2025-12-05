<?php
/**
 * @see https://github.com/WordPress/gutenberg/blob/trunk/docs/reference-guides/block-api/block-metadata.md#render
 */

$brandsList = carbon_get_theme_option('yuna__car_service_brands_list');
?>

<?php if( !empty($attributes['blockTitle']) && !empty($brandsList) ):?>
	<?php
		$blockAttr = get_block_wrapper_attributes();

		if ( !empty( $attributes['topIndent']) || !empty( $attributes['bottomIndent']) ){
			$indent = $attributes['topIndent'].' '.$attributes['bottomIndent'];
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
        <h2 class="subtitle big-subtitle col-lg-4" data-aos="fade-up" data-aos-duration="300" data-aos-easing="ease-in">
          <?php echo $attributes['blockTitle'];?>
        </h2>
        <ul class="card-list-wrapper brands-list col-lg-8" data-aos="fade-up" data-aos-duration="300" data-aos-easing="ease-in">
	        <?php foreach( $brandsList as $brand ):?>
            <li class="card-item brand" >
              <img src="<?php echo $brand['logo'];?>" alt="<?php echo $brand['name'];?>">
            </li>
          <?php endforeach;?>
        </ul>
			</div>
		</div>
	</section>

<?php endif;?>


