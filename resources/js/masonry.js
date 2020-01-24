
// init Masonry
var $each_posts = $('.each_posts').masonry({
    // options
      itemSelector: '.each_post',
      columnWidth: 50,
      gutter: 5,
      fitWidth: true
  });
  // layout Masonry after each image loads （imagesLoaded）
  $each_posts.imagesLoaded().progress( function() {
    $each_posts.masonry('layout');
  });
  