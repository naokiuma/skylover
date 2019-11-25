$(function($){
  $('.js-select-category').change(function(e){
  //$('.js-select-category').on('change',function(e){ でもいけるよ！

    //var $that = $(this);
    //var target = $('.js-select-category option:selected').val();
    //console.log(target, true);
    //console.log("検索開始！");
    var $setect_category = $(this).val();
    console.log($setect_category);
    //console.log($(this).val(), true);
    $.ajax({ //参考https://mintaku-blog.net/laravel-ajax/
      headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      type:'get',
      dataType: 'json',
      url: '/posts/gallery',
      data:{'setect_category':$(this).val()
      }

    }).done(function(data){
      if(data){
        console.log("成功！");
      }
    });
});
});
