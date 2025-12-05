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

  $(document).on('click', '#pagination a', function (e) {

    e.preventDefault();

    let thisNumber = $(this);

    let pageNumber = Number( thisNumber.text() );

    $('ul.page-numbers .page-numbers.current').removeClass('current');

    thisNumber.addClass('current');

    let data = {
      action: 'blog_pagination',
      currentPage: pageNumber,
    };

    $.post( yuna_ajax.url, data, function(response) {

      if( $.trim(response) !== ''){

        $('#blog-list').html(response.posts);
        $('#pagination').html(response.pagination);

      }
    });

  });
});
