/*fadeinロゴ*/
$(function() {
	setTimeout(function(){
		$('.start h2').fadeIn(1600);
    },200); //0.5秒後にロゴをフェードイン!
    setTimeout(function(){
        $('.start span').fadeIn(1600);
    },800);
	setTimeout(function(){
		$('.start').fadeOut(500);
	},1500); //2.5秒後にロゴ含め真っ白背景をフェードアウト！
});
      