$(function() {
    $(document).ready(function(){
      //var top_title = $(".top_title").text;//意味ない
      //var top_src = $(".top_main-img").attr('src');//意味ない


      $(".image_get").click(function(){
        var src = $(this).find('img').attr('src'); //クリック部分の画像データ
        var category = $(this).find('.js-category').text();//クリック部分のカテゴリー
        var data = $(this).find('.js-post_data').text();//クリック部分の投稿日
        var title =$(this).find('.js-title').text();//クリック部分のタイトル

        //console.log(data);
        $(".top_main_img").attr("src",src);
        $(".top_main_category").text(category);
        $(".top_main_info").text(data);
        $(".top_title").text(title);

      })
    })
});
