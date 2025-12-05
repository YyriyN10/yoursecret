<?php
/**
 * @see https://github.com/WordPress/gutenberg/blob/trunk/docs/reference-guides/block-api/block-metadata.md#render
 */
?>

<?php if( !empty($attributes['blockTitle']) && !empty($content) && !empty($attributes['btnText'])):?>
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
        <div class="form-wrapper col-xl-4 col-md-5" data-aos="fade-up" data-aos-duration="300" data-aos-easing="ease-in-out-back">
          <h2 class="block-title">
	          <?php echo $attributes['blockTitle'];?>
          </h2>
          <?php if( !empty($attributes['blockText']) ):?>
            <p class="text"><?php echo $attributes['blockText'];?></p>
          <?php endif;?>
	        <?php
		        $formArgs = array(
			        'btnText' => $attributes['btnText'],
		        );
		        get_template_part('template-parts/form', null, $formArgs);?>

        </div>
        <div class="slider-wrapper col-xl-8 col-md-7">
          <div class="slider" id="service-result">
			      <?php echo $content; ?>
          </div>
        </div>
			</div>
		</div>
	</section>

<?php endif;?>


