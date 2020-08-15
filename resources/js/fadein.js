/*fadeinロゴ*/
$(function() {
	setTimeout(function(){
		$('.start h2').fadeIn(1600);
    },100); //0.2秒後にロゴをフェードイン!
    setTimeout(function(){
        $('.start span').fadeIn(1600);
    },400);
	setTimeout(function(){
		$('.start').fadeOut(500);
	},7500); //2.5秒後にロゴ含め真っ白背景をフェードアウト！
});
      