<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package yoursecret
 */
	if ( ! defined( 'ABSPATH' ) ) {
		exit;
	}

	$siteLogo = carbon_get_theme_option('yuna_option_logo');
?>
</main>
<footer class="footer site-footer">
  <div class="footer-container">
    <div class="footer-content">
      <div class="footer-brand-section">
        <?php if( !empty($siteLogo) ):?>
          <div class="footer-brand">
            <img src="<?php echo $siteLogo;?>" alt="YourSecret"/>
          </div>
        <?php endif;?>

        <p class="footer-description"><?php echo esc_html( pll__( 'YourSecret, developed and operated by Farnora Limited, uses cookies to  make the platform safer and smoother.  We don’t sell data. We protect  it.' ) ); ?> </p>
        <?php
          $tweeterLink = carbon_get_theme_option('social_network_tweeter');
	        $threadsLink = carbon_get_theme_option('social_network_threads');
	        $instagramLink = carbon_get_theme_option('social_network_instagram');
	        $youtubeLink = carbon_get_theme_option('social_network_youtube');

          if(!empty($tweeterLink) || !empty($threadsLink) || !empty($instagramLink) || !empty($youtubeLink) ):?>
            <div class="footer-social">
              <?php if( !empty($tweeterLink) ):?>
                <a href="<?php echo $tweeterLink;?>" rel="nofollow" target="_blank" class="footer-social-link">
                  <i class="fa-brands fa-x-twitter" style="width: 24px; height: 24px; color: #01979F"></i>
                </a>
              <?php endif;?>

	            <?php if( !empty($threadsLink) ):?>
                <a href="<?php echo $threadsLink;?>" rel="nofollow" target="_blank" class="footer-social-link">
                  <i class="fa-brands fa-threads" style="width: 21px; height: 24px;"></i>
                </a>
	            <?php endif;?>

	            <?php if( !empty($instagramLink) ):?>
                <a href="<?php echo $instagramLink;?>" rel="nofollow" target="_blank" class="footer-social-link"><i class="fa-brands fa-instagram" style="width: 21px; height: 24px;"></i></a>
	            <?php endif;?>

	            <?php if( !empty($youtubeLink) ):?>
                <a href="<?php echo $youtubeLink;?>" rel="nofollow" target="_blank" class="footer-social-link"><i class="fa-brands fa-youtube" style="width: 27px; height: 24px"></i></a>
	            <?php endif;?>

            </div>
        <?php endif;?>

      </div>
      <div class="footer-links-section">
        <div class="footer-column">
          <h6 class="footer-heading"><?php echo esc_html( pll__( 'Company' ) ); ?> </h6>
	        <?php
		        wp_nav_menu(
			        array(
				        'theme_location' => 'menu-2',
				        'menu_id'        => 'company-menu',
				        'container' => false,
				        'menu_class' => 'footer-links'
			        )
		        );
	        ?>
          <h6 class="footer-heading"><?php echo esc_html( pll__( 'Trust, Safety and Community' ) ); ?> </h6>
	        <?php
		        wp_nav_menu(
			        array(
				        'theme_location' => 'menu-4',
				        'menu_id'        => 'trust-menu',
				        'container' => false,
				        'menu_class' => 'footer-links'
			        )
		        );
	        ?>
        </div>
        <div class="footer-column">
          <h6 class="footer-heading"><?php echo esc_html( pll__( 'Legal Information' ) ); ?></h6>
	        <?php
		        wp_nav_menu(
			        array(
				        'theme_location' => 'menu-3',
				        'menu_id'        => 'legal-information-menu',
				        'container' => false,
				        'menu_class' => 'footer-links'
			        )
		        );
	        ?>
          <h6 class="footer-heading"><?php echo esc_html( pll__( 'Support' ) ); ?></h6>
	        <?php
		        wp_nav_menu(
			        array(
				        'theme_location' => 'menu-5',
				        'menu_id'        => 'support-menu',
				        'container' => false,
				        'menu_class' => 'footer-links'
			        )
		        );
	        ?>
        </div>
        <?php
          $footerDownloadList = carbon_get_theme_option('footer_download_list'.yuna_lang_prefix());

          if( !empty($footerDownloadList) ):?>
            <div class="footer-column">
              <h6 class="footer-heading"><?php echo esc_html( pll__( 'Download' ) ); ?></h6>
              <div class="footer-download">
                <?php foreach( $footerDownloadList as $downloadItem ):?>
                  <a href="<?php echo $downloadItem['custom_link'];?>" class="footer-download-btn">
                    <img  src="<?php echo $downloadItem['service_image'];?>" alt="<?php echo $downloadItem['service_name'];?>" class="download-badge svg-pic"/>
                  </a>
                <?php endforeach;?>
              </div>
            </div>
        <?php endif;?>
      </div>
    </div>
    <hr class="footer-divider"/>
    <div class="footer-bottom">
      <p class="footer-copyright">Copyright © <?php echo date('Y');?>, Farnora Limited</p>
    </div>
  </div>
</footer>
</div>

<?php wp_footer(); ?>

</body>
</html>
