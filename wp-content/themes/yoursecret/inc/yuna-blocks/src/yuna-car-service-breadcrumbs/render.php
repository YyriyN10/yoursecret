<?php
/**
 * @see https://github.com/WordPress/gutenberg/blob/trunk/docs/reference-guides/block-api/block-metadata.md#render
 */
?>

<?php

	$blockAttr = get_block_wrapper_attributes();

  if( !empty($blockAttr) ):?>

	<section <?php echo $blockAttr; ?>>
		<div class="container">
			<div class="row">
        <ul class="breadcrumbs-list col-12">
          <li class="crumb">
            <a href="<?php home_url('/') ;?>">
              <?php echo get_the_title(get_option('page_on_front'));?>
            </a>
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
              <path d="M5 2L10.1958 6.76285C10.6282 7.15918 10.6282 7.84082 10.1958 8.23715L5 13" stroke="#575757" stroke-linecap="round"/>
            </svg>
          </li>
          <?php if( !empty($attributes['parentPage']) ):?>
            <li class="crumb">
              <a href="<?php echo get_permalink($attributes['parentPage']) ;?>">
                <?php echo get_the_title($attributes['parentPage']);?>
              </a>
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                <path d="M5 2L10.1958 6.76285C10.6282 7.15918 10.6282 7.84082 10.1958 8.23715L5 13" stroke="#575757" stroke-linecap="round"/>
              </svg>
            </li>
          <?php endif;?>
          <li class="crumb current-crumb">
            <?php the_title();?>
          </li>
        </ul>
			</div>
		</div>
	</section>

<?php endif;?>


