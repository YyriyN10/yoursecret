<?php
/**
 * @see https://github.com/WordPress/gutenberg/blob/trunk/docs/reference-guides/block-api/block-metadata.md#render
 */

$faqList = carbon_get_theme_option('yuna_clinuing-faq_list'.yuna_lang_prefix());
?>

<?php if( !empty($attributes['blockTitle']) && !empty($faqList) ):?>
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
        <h2 class="block-title col-12 text-center" data-aos="fade-up" data-aos-duration="300" data-aos-easing="ease-in-out-back">
          <?php echo $attributes['blockTitle'];?>
        </h2>
        <?php if( !empty($attributes['blockText']) ):?>
          <p class="text col-xl-8 offset-xl-2 col-md-10 offset-md-1 col-12 text-center"><?php echo $attributes['blockText'];?></p>
        <?php endif;?>
			</div>
      <div class="row">
        <div class="accordion accordion-faq col-lg-8 offset-lg-2 col-sm-10 offset-sm-1 col-12" id="accordion-faq" data-aos="fade-up" data-aos-duration="300" data-aos-easing="ease-in-out-back">
	        <?php foreach( $faqList as $index=>$question ):?>
              <div class="card">
                <div class="card-header">
                  <a class="collapsed btn" data-bs-toggle="collapse" href="#faq-<?php echo $index;?>">
                    <?php echo $question['question'];?>
                    <span class="indicator"></span>
                  </a>
                </div>
                <div id="faq-<?php echo $index;?>" class="collapse" data-bs-parent="#accordion-faq">
                  <div class="card-body">
                    <?php echo $question['answer'];?>
                  </div>
                </div>
              </div>
	        <?php endforeach;?>
        </div>
      </div>
		</div>
	</section>

<?php endif;?>


