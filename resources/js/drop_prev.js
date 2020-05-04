
/*ドロッププレビュー */

var $dropArea = $('.drag-drop-area');//ドロップエリア
var $fileInput = $('.drag-space')//実際にチェンジするエリア

$dropArea.on('dragover', function(e){
  e.stopPropagation();
  e.preventDefault();
  $(this).css('border', '3px #ccc dashed');
  });
$dropArea.on('dragleave', function(e){
  e.stopPropagation();
  e.preventDefault();
  $(this).css('border', 'none');
  });

$fileInput.on('change',function(e){
    const file = this.files[0],
          reader = new FileReader(),
          $preview = $('.preview-cover'); // 表示する所
          console.log($preview);
 
    // 画像ファイル以外は処理停止
    if(file.type.indexOf("image") < 0){
      return false;
    }
    // ファイル読み込みが完了した際に発火するイベントを登録
    reader.onload = function(event) {
        // .prevewの領域の中にロードした画像を表示
        $preview.attr('src',event.target.result);
        $preview.attr('style',"display:block");
    };
 
    reader.readAsDataURL(file);
});
