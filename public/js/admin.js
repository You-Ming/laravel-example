$(function(){
  var total_height = $(document.body).height();
  var header_height = $("#nav_header").height();
  var content_height = $("#admin_content_wrap").height();
  var footer_height = $("#footer").height();
  if(total_height - header_height - footer_height > content_height){
    $(".wrap").css("height","100%");
  }
});

$(function(){
    $("#menu_product").click(function(){
      $(".glyphicon-chevron-right, .glyphicon-chevron-down").toggleClass("glyphicon-chevron-right glyphicon-chevron-down");
});

var pathArray = window.location.pathname.split('/');
var secondLevelLocation = pathArray[2];
var url = window.location.protocol + "//" + window.location.host + "/admin/" + secondLevelLocation;
    var element = $('ul.nav a').filter(function() {
        return this.href == url;
    }).addClass('active').parent();

    while (true) {
        if (element.parent().parent().is('li')) {
          element.parent().parent().children('a').children('span').removeClass().addClass('glyphicon glyphicon-chevron-down');
          element = element.parent().addClass('in').parent();
        } else {
            break;
        }
    }


});


$(function(){//修改產品-規格表單操作
  var mainSpecDiv = $("#product_spec_update");
  var i = $("#product_spec_update div").size()+1;

  $("#btn_add_product_spec").on('click',function(){
    $('<div id="sec_product_spec_update"><input type="text" name="txt_product_spec_key_update" class="form-control" id="txt_product_spec_key_update" placeholder="請輸入規格名稱"> <input type="text" name="txt_product_spec_value_update" class="form-control" id="txt_product_spec_value_update" placeholder="請輸入規格"> <button type="button" class="btn btn-default" id="btn_del_product_spec"><span class="glyphicon glyphicon-minus"></span></button></div>').appendTo(mainSpecDiv);
    i++;
    return false;
  });

  $(document).on('click',"#btn_del_product_spec",function(){
    if(i > 2){
      $(this).parent().remove();
      i--;
    }
    return false;
  });
});

$(function(){//新增產品-規格表單操作
  var mainSpec = $("#product_spec");
  var spec_count = $("#product_spec div").size()+1;

  $("#btn_set_product_spec").on('click',function(){
    $('<div id="sec_product_spec"><input type="text" name="txt_product_spec_key[]" class="form-control" id="txt_product_spec_key" placeholder="請輸入規格名稱"> <input type="text" name="txt_product_spec_value[]" class="form-control" id="txt_product_spec_value" placeholder="請輸入規格"> <button type="button" class="btn btn-default" id="btn_remove_product_spec"><span class="glyphicon glyphicon-minus"></span></button></div>').appendTo(mainSpec);
    spec_count++;
    return false;
  });

  $(document).on('click',"#btn_remove_product_spec",function(){
    if(spec_count > 2){
      $(this).parent().remove();
      spec_count--;
    }
    return false;
  });
});

$(function() {//預覽圖片
    // Clear event
    $('.image-preview-clear').click(function(){
        $('.image-preview-filename').val("");
        $('.image-preview-clear').hide();
        $('.image-preview-input input:file').val("");
        $('.image_preview').hide();
        $(".image-preview-input-title").text("選擇圖片");
    });
    // Create the preview image
    $(".image-preview-input input:file").change(function (){
        var preview = $(".image_preview");
        var file = this.files[0];
        var reader = new FileReader();
        // Set preview image into the popover data-content
        reader.addEventListener("load", function () {
          preview.attr("src",reader.result);
          $(".image-preview-input-title").text("變更圖片");
          $(".image-preview-clear").show();
          preview.show();
          $(".image-preview-filename").val(file.name);
          $('.upload_error').children().remove();
        }, false);

        if (file) {
          reader.readAsDataURL(file);
        }
    });
});


$(function(){
  var backPath = document.referrer;
  var backPathArray = document.referrer.split('/');
  if(backPathArray[4] == "news"){
    $("#btn_back_admin_news").attr("onclick","window.location.href='"+backPath+"'");
  }

});
