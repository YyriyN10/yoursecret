/**
 * Use this file for JavaScript code that you want to run in the front-end
 * on posts/pages that contain this block.
 *
 * When this file is defined as the value of the `viewScript` property
 * in `block.json` it will be enqueued on the front end of the site.
 *
 * Example:
 *
 * ```js
 * {
 *   "viewScript": "file:./view.js"
 * }
 * ```
 *
 * If you're not making any changes to this file because your project doesn't need any
 * JavaScript running in the front-end, then you should delete this file and remove
 * the `viewScript` property from `block.json`.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-metadata/#view-script
 */

jQuery(function($) {

  let windWidth = $(window).width();

  $(window).resize(function () {
    windWidth = $(window).width();
  });


  $('#portfolio-slider').slick({
    autoplay: true,
    autoplaySpeed: 1500,
    infinite: true,
    speed: 500,
    cssEase: 'ease-out',
    arrows: false,
    dots: true,
    slidesToShow: 2,
    slidesToScroll: 1,
    responsive: [
      {
        breakpoint: 768,
        settings: {
          slidesToShow: 1,
          fade: true
        }
      }
    ]
  });

  $('#portfolio-slider .slide').each(function () {
    const thisProject =  $(this);

    let desktopImage = thisProject.attr('data-desktop-image');
    let mobileImage = thisProject.attr('data-mobile-image');


    if ( windWidth > 575){
      thisProject.css({'background-image': 'url('+ desktopImage +')'});
    }else{
      thisProject.css({'background-image': 'url('+ mobileImage +')'});
    }

    $(window).resize(function () {
      if ( windWidth > 575){
        thisProject.css({'background-image': 'url('+ desktopImage +')'});
      }else{
        thisProject.css({'background-image': 'url('+ mobileImage +')'});
      }
    });

  })
});
