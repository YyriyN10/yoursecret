<?php
/**
 * @see https://github.com/WordPress/gutenberg/blob/trunk/docs/reference-guides/block-api/block-metadata.md#render
 */

?>

<?php if( !empty($attributes['blockTitle']) && !empty($attributes['btnText'])):?>
	<?php
		$blockAttr = get_block_wrapper_attributes();
	?>

	<section <?php echo $blockAttr; ?>
			<?php if( !empty($attributes['anchorId']) ):?>
				id="<?php echo $attributes['anchorId'];?>"
			<?php endif;?>
	>
		<div class="container">
			<div class="row">
        <div class="content col-12 <?php echo $attributes['topIndent'];?> <?php echo $attributes['bottomIndent'];?>">
          <div class="form-wrapper">
            <h2 class="block-title" data-aos="fade-up" data-aos-duration="300" data-aos-easing="ease-in-out-back">
		        <?php echo $attributes['blockTitle'];?>
            </h2>
	          <?php if( !empty($attributes['blockText']) ):?>
                <div class="text" data-aos="fade-up" data-aos-duration="300" data-aos-easing="ease-in-out-back"><?php echo $attributes['blockText'];?></div>
	          <?php endif;?>
	          <?php
		          $formArgs = array(
			          'btnText' => $attributes['btnText'],
		          );
		          get_template_part('template-parts/form', null, $formArgs);?>
          </div>
          <div class="contacts-wrapper">


	          <?php
		          $sitePhone = carbon_get_theme_option('yuna_clining_contact_phone_list');
		          $siteEmail = carbon_get_theme_option('yuna_clining_contact_email_list');
		          $officeAddress = carbon_get_theme_option('yuna_clining_office_address'.yuna_lang_prefix());
		          $mainSchedule = carbon_get_theme_option('yuna_clining_weekday_schedule'.yuna_lang_prefix());
		          $secondSchedule = carbon_get_theme_option('yuna_clining_weekend_schedule'.yuna_lang_prefix());

		          if( !empty($sitePhone) || !empty($siteEmail) || !empty($officeAddress) || !empty($mainSchedule) || !empty($secondSchedule)): ?>
                    <div class="contacts-list">
                      <div class="contact-column">
	                      <?php if(!empty($officeAddress) ):?>
                            <p class="contact-item">
	                            <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 92.25 122.88" style="enable-background:new 0 0 92.25 122.88" xml:space="preserve"><g><path clip-rule="evenodd" fill-rule="evenodd"  d="M68.51,106.28c-5.59,6.13-12.1,11.62-19.41,16.06c-0.9,0.66-2.12,0.74-3.12,0.1 c-10.8-6.87-19.87-15.12-27-24.09C9.14,86.01,2.95,72.33,0.83,59.15c-2.16-13.36-0.14-26.22,6.51-36.67 c2.62-4.13,5.97-7.89,10.05-11.14C26.77,3.87,37.48-0.08,48.16,0c10.28,0.08,20.43,3.91,29.2,11.92c3.08,2.8,5.67,6.01,7.79,9.49 c7.15,11.78,8.69,26.8,5.55,42.02c-3.1,15.04-10.8,30.32-22.19,42.82V106.28L68.51,106.28z M46.12,23.76 c12.68,0,22.95,10.28,22.95,22.95c0,12.68-10.28,22.95-22.95,22.95c-12.68,0-22.95-10.27-22.95-22.95 C23.16,34.03,33.44,23.76,46.12,23.76L46.12,23.76z"/></g>
                              </svg>
                              <span><?php echo $officeAddress;?></span>

                            </p>
	                      <?php endif;?>
	                      <?php if( !empty($mainSchedule) ):?>
                            <p class="contact-item">
	                            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 110.01 122.88" style="enable-background:new 0 0 110.01 122.88" xml:space="preserve"><g><path fill-rule="evenodd" clip-rule="evenodd" d="M1.87,14.69h22.66L24.5,14.3V4.13C24.5,1.86,26.86,0,29.76,0c2.89,0,5.26,1.87,5.26,4.13V14.3l-0.03,0.39 h38.59l-0.03-0.39V4.13C73.55,1.86,75.91,0,78.8,0c2.89,0,5.26,1.87,5.26,4.13V14.3l-0.03,0.39h24.11c1.03,0,1.87,0.84,1.87,1.87 v19.46c0,1.03-0.84,1.87-1.87,1.87H1.87C0.84,37.88,0,37.04,0,36.01V16.55C0,15.52,0.84,14.69,1.87,14.69L1.87,14.69z M31.35,83.53 c-2.27-1.97-2.52-5.41-0.55-7.69c1.97-2.28,5.41-2.53,7.69-0.56l12.45,10.8l20.31-20.04c2.13-2.12,5.59-2.11,7.71,0.02 c2.12,2.13,2.11,5.59-0.02,7.71L55.02,97.37c-2,1.99-5.24,2.14-7.41,0.26L31.35,83.53L31.35,83.53L31.35,83.53z M0.47,42.19h109.08 c0.26,0,0.46,0.21,0.46,0.47l0,0v79.76c0,0.25-0.21,0.46-0.46,0.46l-109.08,0c-0.25,0-0.46-0.21-0.46-0.46V42.66 C0,42.4,0.21,42.19,0.47,42.19L0.47,42.19L0.47,42.19z M8.84,50.58h93.84c0.52,0,0.94,0.45,0.94,0.94v62.85 c0,0.49-0.45,0.94-0.94,0.94H8.39c-0.49,0-0.94-0.42-0.94-0.94v-62.4c0-1.03,0.84-1.86,1.86-1.86L8.84,50.58L8.84,50.58z M78.34,29.87c2.89,0,5.26-1.87,5.26-4.13V15.11l-0.03-0.41l-10.45,0l-0.03,0.41v10.16c0,2.27,2.36,4.13,5.25,4.13L78.34,29.87 L78.34,29.87z M29.29,29.87c2.89,0,5.26-1.87,5.26-4.13V15.11l-0.03-0.41l-10.46,0l-0.03,0.41v10.16c0,2.27,2.36,4.13,5.25,4.13 V29.87L29.29,29.87z"/></g>
                              </svg>
                              <span><?php echo $mainSchedule;?></span>

                            </p>
	                      <?php endif;?>
	                      <?php if( $secondSchedule ):?>
                            <p class="contact-item">
	                            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 110.01 122.88" style="enable-background:new 0 0 110.01 122.88" xml:space="preserve"><g><path fill-rule="evenodd" clip-rule="evenodd" d="M1.87,14.69h22.66L24.5,14.3V4.13C24.5,1.86,26.86,0,29.76,0c2.89,0,5.26,1.87,5.26,4.13V14.3l-0.03,0.39 h38.59l-0.03-0.39V4.13C73.55,1.86,75.91,0,78.8,0c2.89,0,5.26,1.87,5.26,4.13V14.3l-0.03,0.39h24.11c1.03,0,1.87,0.84,1.87,1.87 v19.46c0,1.03-0.84,1.87-1.87,1.87H1.87C0.84,37.88,0,37.04,0,36.01V16.55C0,15.52,0.84,14.69,1.87,14.69L1.87,14.69z M64.24,61.76 c2.11-2.14,5.55-2.16,7.68-0.02c2.12,2.14,2.13,5.61,0.02,7.75l-9.27,9.41l9.29,9.42c2.09,2.13,2.07,5.58-0.06,7.71 c-2.13,2.13-5.56,2.12-7.65-0.01l-9.22-9.35l-9.24,9.37c-2.11,2.15-5.55,2.16-7.68,0.02c-2.12-2.13-2.13-5.61-0.02-7.75l9.28-9.41 l-9.29-9.42c-2.09-2.13-2.07-5.58,0.06-7.71c2.13-2.13,5.56-2.12,7.65,0.01L55,71.13L64.24,61.76L64.24,61.76L64.24,61.76z M0.47,42.19h109.08c0.26,0,0.46,0.21,0.46,0.46l0,0v79.76c0,0.25-0.21,0.46-0.46,0.46l-109.08,0c-0.25,0-0.46-0.21-0.46-0.46 V42.66C0,42.4,0.21,42.19,0.47,42.19L0.47,42.19L0.47,42.19z M8.84,50.58h93.84c0.52,0,0.94,0.45,0.94,0.94v62.85 c0,0.49-0.45,0.94-0.94,0.94H8.39c-0.49,0-0.94-0.42-0.94-0.94v-62.4c0-1.03,0.84-1.86,1.86-1.86L8.84,50.58L8.84,50.58z M78.34,29.87c2.89,0,5.26-1.87,5.26-4.13V15.11l-0.03-0.41H73.11l-0.03,0.41v10.16c0,2.27,2.36,4.13,5.25,4.13V29.87L78.34,29.87z M29.29,29.87c2.89,0,5.26-1.87,5.26-4.13V15.11l-0.03-0.41H24.07l-0.03,0.41v10.16c0,2.27,2.36,4.13,5.25,4.13L29.29,29.87 L29.29,29.87z"/></g>
                              </svg>
                              <span><?php echo $secondSchedule;?></span>

                            </p>
	                      <?php endif;?>
                      </div>
                      <div class="contact-column">
	                      <?php if( !empty($sitePhone) ):?>
		                      <?php foreach( $sitePhone as $phone):
			                      $phoneToCall =  preg_replace( '/[^0-9]/', '', $phone['phone'] );
			                      ?>
                              <a href="tel:<?php echo $phoneToCall;?>" rel="nofollow" class="contact-item">
	                              <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 122.88 122.27" style="enable-background:new 0 0 122.88 122.27" xml:space="preserve"><g><path d="M33.84,50.25c4.13,7.45,8.89,14.6,15.07,21.12c6.2,6.56,13.91,12.53,23.89,17.63c0.74,0.36,1.44,0.36,2.07,0.11 c0.95-0.36,1.92-1.15,2.87-2.1c0.74-0.74,1.66-1.92,2.62-3.21c3.84-5.05,8.59-11.32,15.3-8.18c0.15,0.07,0.26,0.15,0.41,0.21 l22.38,12.87c0.07,0.04,0.15,0.11,0.21,0.15c2.95,2.03,4.17,5.16,4.2,8.71c0,3.61-1.33,7.67-3.28,11.1 c-2.58,4.53-6.38,7.53-10.76,9.51c-4.17,1.92-8.81,2.95-13.27,3.61c-7,1.03-13.56,0.37-20.27-1.69 c-6.56-2.03-13.17-5.38-20.39-9.84l-0.53-0.34c-3.31-2.07-6.89-4.28-10.4-6.89C31.12,93.32,18.03,79.31,9.5,63.89 C2.35,50.95-1.55,36.98,0.58,23.67c1.18-7.3,4.31-13.94,9.77-18.32c4.76-3.84,11.17-5.94,19.47-5.2c0.95,0.07,1.8,0.62,2.25,1.44 l14.35,24.26c2.1,2.72,2.36,5.42,1.21,8.12c-0.95,2.21-2.87,4.25-5.49,6.15c-0.77,0.66-1.69,1.33-2.66,2.03 c-3.21,2.33-6.86,5.02-5.61,8.18L33.84,50.25L33.84,50.25L33.84,50.25z"/></g>
                                </svg>
                                <span><?php echo $phone['phone'];?></span>

                              </a>
		                      <?php endforeach;?>
	                      <?php endif;?>
	                      <?php if( !empty($siteEmail) ):?>
		                      <?php foreach( $siteEmail as $email ):?>
                              <a href="mailto:<?php echo antispambot($email['email'], true);?>" class="contact-item" rel="nofollow" target="_blank">
	                              <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="122.88px" height="78.607px" viewBox="0 0 122.88 78.607" enable-background="new 0 0 122.88 78.607" xml:space="preserve"><g><path fill-rule="evenodd" clip-rule="evenodd" d="M61.058,65.992l24.224-24.221l36.837,36.836H73.673h-25.23H0l36.836-36.836 L61.058,65.992L61.058,65.992z M1.401,0l59.656,59.654L120.714,0H1.401L1.401,0z M0,69.673l31.625-31.628L0,6.42V69.673L0,69.673z M122.88,72.698L88.227,38.045L122.88,3.393V72.698L122.88,72.698z"/></g>
                                </svg>
                                <span><?php echo antispambot($email['email'], false);?></span>

                              </a>
		                      <?php endforeach;?>
	                      <?php endif;?>
                      </div>
                    </div>
		          <?php endif;?>
          </div>
        </div>



			</div>
		</div>
	</section>

<?php endif;?>


