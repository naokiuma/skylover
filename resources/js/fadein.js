/*fadeinロゴ*/
$(function() {
	setTimeout(function(){
		$('.start h2').fadeIn(400);
    },100); //0.2秒後にロゴをフェードイン!
    setTimeout(function(){
        $('.start span').fadeIn(400);
    },200);
	setTimeout(function(){
		$('.start').fadeOut(400);
	},700); //2.5秒後にロゴ含め真っ白背景をフェードアウト！
});
      