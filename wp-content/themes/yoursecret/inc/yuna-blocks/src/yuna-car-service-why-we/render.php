<?php
/**
 * @see https://github.com/WordPress/gutenberg/blob/trunk/docs/reference-guides/block-api/block-metadata.md#render
 */

?>

<?php if( !empty($attributes['blockTitle']) && !empty($attributes['blockText']) && !empty($attributes['image1Url']) && !empty($attributes['image2Url'])):?>
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
        <div class="text-content col-lg-5 col-md-6" data-aos="fade-up" data-aos-duration="300" data-aos-easing="ease-in">
          <?php if( !empty($attributes['blockName']) ):?>
            <h2 class="block-name">
              <span><?php echo $attributes['blockName'];?></span>
            </h2>
          <?php endif;?>
          <h2 class="block-title big-title" >
	          <?php echo $attributes['blockTitle'];?>
          </h2>
          <div class="text" ><?php echo $attributes['blockText'];?></div>
	        <?php if( !empty($attributes['blockList']) ):?>
              <ul class="advantages-list" >
		            <?php echo $attributes['blockList'];?>
              </ul>
	        <?php endif;?>
	        <?php if( !empty($attributes['btnText']) && !empty($attributes['btnTarget']) ):?>
              <a href="<?php echo $attributes['btnTarget'];?>" class="button btn-red" >
                <?php echo $attributes['btnText'];?>
              </a>
	        <?php endif;?>
        </div>
        <div class="images-wrapper col-lg-7 col-md-6" data-aos="fade-up" data-aos-duration="300" data-aos-easing="ease-in">
          <?php if( !empty($attributes['experienceNumber']) || !empty($attributes['experienceText']) ):?>
            <div class="experience" >
              <?php if( !empty($attributes['experienceNumber']) ):?>
                <p class="number"><?php echo $attributes['experienceNumber'];?></p>
              <?php endif;?>
              <?php if( !empty($attributes['experienceText']) ):?>
                <p class="description"><?php echo $attributes['experienceText'];?></p>
              <?php endif;?>
            </div>
          <?php endif;?>

          <div class="pic-wrapper big-pic" >
            <img
               class="lazy object-fit"
               data-src="<?php echo $attributes['image1Url'];?>"
               <?php
                $altText = $attributes['image1Alt'];
                if ( !empty( $altText ) ):?>
                    alt="<?php echo $altText;?>"
                <?php else:?>
                    alt="<?php echo wp_strip_all_tags($attributes['blockName']);?>"
                <?php endif;?>
            >
          </div>
          <div class="pic-wrapper small-pic" >
            <img
                class="lazy object-fit"
                data-src="<?php echo $attributes['image2Url'];?>"
		        <?php
			        $altText = $attributes['image2Alt'];
			        if ( !empty( $altText ) ):?>
                      alt="<?php echo $altText;?>"
			        <?php else:?>
                      alt="<?php echo wp_strip_all_tags($attributes['blockName']);?>"
			        <?php endif;?>
            >
          </div>
        </div>

      </div>
		</div>
	</section>

<?php endif;?>


