<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package yoursecret
 */

get_header();
?>


  <section class="py-5 bg-light">
    <div class="container">
      <?php
        $parentPage = carbon_get_theme_option('blog_paren_page_url'.yuna_lang_prefix());

	      $post_id = url_to_postid( $parentPage );
	      $page_title = get_the_title( $post_id );

        if (!empty($parentPage)):?>
          <p class="mb-4 text-muted breadcrumbs">
            <a href="<?php echo $parentPage;?>"><?php echo $page_title;?></a> <span class="mx-1">-</span>
	        <?php
	        $postCat = get_the_category(get_the_ID());

	        if (!empty($postCat)):?>
            <a href="<?php echo $parentPage;?>#<?php echo $postCat[0]->term_id;?>"><?php echo $postCat[0]->name;?></a> <span class="mx-1">-</span>
	        <?php endif;?>
            <span><?php the_title();?></span>
          </p>
      <?php endif;?>
      <div class="row justify-content-center">
        <div class="col-lg-10">
          <article class="bg-white p-4 p-md-5 rounded shadow-sm">
            <header class="mb-4">
              <h1 class="fw-bold display-5 mb-3"><?php the_title();?></h1>
              <div class="text-muted small"><?php echo get_the_date('d.m.Y');?></div>
            </header>
            <img src="<?php the_post_thumbnail_url();?>" alt="<?php the_title();?>" class="img-fluid rounded mb-4 w-100 post-featured">
            <section class="news-body lh-lg fs-5">
	            <?php the_content();?>
            </section>
          </article>
        </div>
      </div>
    </div>
  </section>

<?php

get_footer();
