<?php
/**
 * @see https://github.com/WordPress/gutenberg/blob/trunk/docs/reference-guides/block-api/block-metadata.md#render
 */

$reviewsList = carbon_get_theme_option('yuna_car_service_reviews_list'.yuna_lang_prefix());
?>

<?php if( !empty($attributes['blockTitle']) && !empty($reviewsList) ):?>
	<?php
		$blockAttr = get_block_wrapper_attributes();

		if ( !empty( $attributes['topIndent']) || !empty( $attributes['bottomIndent']) ){
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
        <div class="heading col-lg-8 col-md-7" data-aos="fade-up" data-aos-duration="300" data-aos-easing="ease-in">
          <?php if( !empty($attributes['blockName']) ):?>
            <h2 class="block-name"><?php echo $attributes['blockName'];?></h2>
          <?php endif;?>
          <h3 class="block-title big-title" >
	          <?php echo $attributes['blockTitle'];?>
          </h3>
        </div>
        <?php if( !empty($attributes['blockText']) ):?>
           <p class="text col-lg-4 col-md-5" data-aos="fade-up" data-aos-duration="300" data-aos-easing="ease-in">
             <?php echo $attributes['blockText'];?>
           </p>
        <?php endif;?>
			</div>
      <div class="row">
        <div class="slider-wrapper col-12" data-aos="fade-up" data-aos-duration="300" data-aos-easing="ease-in">
          <div class="slider <?php echo $attributes['bottomIndent'];?>" id="reviews-slider">
	        <?php foreach( $reviewsList as $review ):?>
              <div class="slide">
	              <?php if( !empty($review['avatar']) ):?>
                    <div class="avatar">
                      <img
                          class="lazy object-fit"
                          data-src="<?php echo wp_get_attachment_image_src($review['avatar'], 'full')[0];?>"
                      <?php
                        $altText = get_post_meta($review['avatar'], '_wp_attachment_image_alt', TRUE);
                        if ( !empty( $altText ) ):?>
                                  alt="<?php echo $altText;?>"
                        <?php else:?>
                                  alt="<?php echo $review['name'];?>"
                        <?php endif;?>
                      >
                    </div>
	              <?php else:?>
                    <div class="avatar">
                      <p>
			              <?php
				              $first_character = mb_substr($review['name'], 0, 1, 'UTF-8');

				              echo $first_character;
			              ?>
                      </p>
                    </div>
	              <?php endif;?>
                <div class="review-text"><?php echo wpautop($review['review']);?></div>
                <p class="name subtitle small-subtitle"><?php echo $review['name'];?></p>
              </div>
	        <?php endforeach;?>
        </div>
          <div class="control-wrapper">
            <div class="control prev">
              <svg width="36" height="26" viewBox="0 0 36 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0.479111 11.8312L11.9338 0.456157C12.2424 0.160151 12.6557 -0.003641 13.0848 6.1429e-05C13.5139 0.00376386 13.9243 0.174664 14.2277 0.475952C14.5311 0.77724 14.7032 1.18481 14.7069 1.61088C14.7106 2.03695 14.5457 2.44743 14.2476 2.75391L5.58625 11.355H34.3636C34.7976 11.355 35.2138 11.5262 35.5207 11.831C35.8276 12.1357 36 12.5491 36 12.98C36 13.411 35.8276 13.8243 35.5207 14.1291C35.2138 14.4338 34.7976 14.605 34.3636 14.605H5.58625L14.2476 23.2062C14.4039 23.3561 14.5286 23.5354 14.6143 23.7336C14.7001 23.9319 14.7452 24.1451 14.7471 24.3609C14.749 24.5766 14.7076 24.7906 14.6253 24.9903C14.543 25.19 14.4215 25.3715 14.2679 25.524C14.1142 25.6766 13.9315 25.7973 13.7304 25.879C13.5293 25.9607 13.3139 26.0018 13.0966 25.9999C12.8793 25.9981 12.6646 25.9532 12.4649 25.8681C12.2653 25.7829 12.0847 25.6591 11.9338 25.5039L0.479111 14.1289C0.172337 13.8242 0 13.4109 0 12.98C0 12.5491 0.172337 12.1359 0.479111 11.8312Z" fill="white"/>
              </svg>

            </div>
            <div class="control next">
              <svg width="36" height="26" viewBox="0 0 36 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M35.5209 11.8312L24.0662 0.456157C23.7576 0.160151 23.3443 -0.003641 22.9152 6.1429e-05C22.4861 0.00376386 22.0757 0.174664 21.7723 0.475952C21.4689 0.77724 21.2968 1.18481 21.2931 1.61088C21.2894 2.03695 21.4543 2.44743 21.7524 2.75391L30.4137 11.355H1.63638C1.20238 11.355 0.786165 11.5262 0.479284 11.831C0.172404 12.1357 0 12.5491 0 12.98C0 13.411 0.172404 13.8243 0.479284 14.1291C0.786165 14.4338 1.20238 14.605 1.63638 14.605H30.4137L21.7524 23.2062C21.5961 23.3561 21.4714 23.5354 21.3857 23.7336C21.2999 23.9319 21.2548 24.1451 21.2529 24.3609C21.251 24.5766 21.2924 24.7906 21.3747 24.9903C21.457 25.19 21.5785 25.3715 21.7321 25.524C21.8858 25.6766 22.0685 25.7973 22.2696 25.879C22.4707 25.9607 22.6861 26.0018 22.9034 25.9999C23.1207 25.9981 23.3354 25.9532 23.5351 25.8681C23.7347 25.7829 23.9153 25.6591 24.0662 25.5039L35.5209 14.1289C35.8277 13.8242 36 13.4109 36 12.98C36 12.5491 35.8277 12.1359 35.5209 11.8312Z" fill="white"/>
              </svg>

            </div>
          </div>
        </div>
      </div>
		</div>
	</section>

<?php endif;?>


