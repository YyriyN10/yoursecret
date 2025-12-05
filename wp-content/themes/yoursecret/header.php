<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package yoursecret
 */

	if ( ! defined( 'ABSPATH' ) ) {
		exit;
	}

	$langArgs = array(
		'show_names' => 1,
		'display_names_as' => 'name',
		'show_flags' => 0,
		'hide_current' => 0
	);

	$siteLogo = carbon_get_theme_option('yuna_option_logo');
	$sitrTextLogo = carbon_get_theme_option('yuna_option_logo_texr'.yuna_lang_prefix());
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

  <!-- Google tag (gtag.js) -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=G-WL916VM1EQ"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'G-WL916VM1EQ');
  </script>

  <style>
    .btn-outline-secondary2 {
      --bs-btn-color: grey;
      --bs-btn-border-color: grey;
      --bs-btn-hover-color: #fff;
      --bs-btn-hover-bg: grey;
      --bs-btn-hover-border-color: grey;
      --bs-btn-focus-shadow-rgb: 105, 0, 199;
      --bs-btn-active-color: #fff;
      --bs-btn-active-bg: grey;
      --bs-btn-active-border-color: grey;
      --bs-btn-active-shadow: inset 0 3px 5px rgba(0, 0, 0, 0.125);
      --bs-btn-disabled-color: grey;
      --bs-btn-disabled-bg: transparent;
      --bs-btn-disabled-border-color: grey;
      --bs-gradient: none;
    }
  </style>

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div class="wrapper">
  <header class="site-header bg-white border-bottom header-main">
    <div class="header-container">
      <nav class="navbar navbar-expand-md">
        <?php if( is_front_page() ):?>
	        <?php if( !empty($siteLogo) || !empty($sitrTextLogo) ):?>
            <div  class="navbar-brand navbar-brand-custom">
			        <?php if( !empty($siteLogo) ):?>
                <img src="<?php echo $siteLogo;?>" alt="YourSecret" style="height: 36px;"/>
			        <?php endif;?>
              <div class="divider-right divider-vertical d-none d-md-block"></div>
			        <?php if( !empty($sitrTextLogo) ):?>
                <span class="nav-slogan d-none d-md-inline"><?php echo $sitrTextLogo;?></span>
			        <?php endif;?>
            </div>
	        <?php endif;?>
        <?php else:?>
	        <?php if( !empty($siteLogo) || !empty($sitrTextLogo) ):?>
            <a href="<?php echo get_home_url('/');?>" class="navbar-brand navbar-brand-custom">
			        <?php if( !empty($siteLogo) ):?>
                <img src="<?php echo $siteLogo;?>" alt="YourSecret" style="height: 36px;"/>
			        <?php endif;?>
              <div class="divider-right divider-vertical d-none d-md-block"></div>
			        <?php if( !empty($sitrTextLogo) ):?>
                <span class="nav-slogan d-none d-md-inline"><?php echo $sitrTextLogo;?></span>
			        <?php endif;?>
            </a>
	        <?php endif;?>


        <?php endif;?>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
	        <?php
		        wp_nav_menu(
			        array(
				        'theme_location' => 'menu-1',
				        'menu_id'        => 'primary-menu',
				        'container' => false,
				        'menu_class' => 'navbar-nav ms-auto nav-gap'
			        )
		        );
	        ?>

	        <?php if ( $langArgs ):?>
            <div class="lang-wrapper" id="lang-wrapper">
              <div class="page-lang">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-globe me-2" style="width: 24px; height: 24px;"><circle cx="12" cy="12" r="10"></circle><line x1="2" y1="12" x2="22" y2="12"></line><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path></svg>
                <span class="lang-name"></span>
              </div>

              <ul class="lang-list">
				        <?php pll_the_languages( $langArgs ); ?>
              </ul>

            </div>
	        <?php endif;?>
        </div>
      </nav>
    </div>
  </header>
  <main>
