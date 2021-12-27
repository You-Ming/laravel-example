$('[data-toggle=confirmation_about]').confirmation({//確認刪除關於我們
  onConfirm: function() {//按下是
    var aboutTitle = $(this).attr("data-id");
    $.ajax({
        url:"/admin/ajax/delete_about",
        data:"aboutTitle="+aboutTitle,
        type:"POST",
        datatype:"json",
        error:function(){
            alert("錯誤");
        },
        success:function(msg){
            if(msg == "success"){
                alert("刪除成功");
                $(location).attr("href","/admin/about");
            }
            else{
                alert("刪除失敗");
            }
        }
    })
  }
});

$('[data-toggle=confirmation_contact]').confirmation({//確認刪除聯絡我們
  onConfirm: function() {
    var guestID = $(this).attr("data-id");
    $.ajax({
        url:"/admin/ajax/delete_contact",
        data:"guestID="+guestID,
        type: "POST",
        datatype:"json",
        error:function(){
            alert("錯誤");
        },
        success:function(msg){
            if(msg == "success"){
                alert("刪除成功");
                $(location).attr("href","/admin/contact");
            }
            else{
                alert("刪除失敗");
            }
        }
    })
  }
});

$('[data-toggle=confirmation_banner]').confirmation({//確認刪除橫幅
  onConfirm: function() {
    var bannerID = $(this).attr("data-id");
    var bannerImgName = $(this).attr("data-name");
    $.ajax({
        url:"/admin/home/"+bannerID,
        //data:"bannerID="+bannerID+"&bannerImgName="+bannerImgName,
        type:"DELETE",
        datatype:"json",
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        error:function(){
            alert("錯誤");
        },
        success:function(msg){
            if(msg == "success"){
                alert("刪除成功");
                $(location).attr("href","/admin/home");
            }
            else{
                alert("刪除失敗");
            }
        }
    })
  }
});

$('[data-toggle=confirmation_news]').confirmation({//確認刪除新聞
  onConfirm: function() {
    var newsID = $(this).attr("data-id");
    $.ajax({
        url:"/admin/ajax/delete_news",
        data:"newsID="+newsID,
        type:"POST",
        datatype:"json",
        error:function(){
            alert("失敗");
        },
        success:function(msg){
            if(msg == "success"){
                $(location).attr("href","/admin/news");
                alert("刪除成功");
            }
            else {
                alert("刪除失敗");
            }

        }
    })
  }
});

$('[data-toggle=confirmation_product]').confirmation({//確認刪除產品
  onConfirm: function() {
    var productID = $(this).attr("data-id");
    var productImgName = $(this).attr("data-name");
    $.ajax({
        url:"/admin/ajax/delete_product",
        data:"productID="+productID+"&productImgName="+productImgName,
        type:"POST",
        datatype:"json",
        error:function(){
            alert("錯誤");
        },
        success:function(msg){
            if (msg =="success") {
                alert("刪除成功");
                $(location).attr("href","/admin/product");
            }
            else {
                alert("刪除失敗");
            }
        }
    })
  }
});

$('[data-toggle=confirmation_type]').confirmation({//確認刪除產品分類
  onConfirm: function() {
    var typeName = $(this).attr("data-id");
    $.ajax({
        url:"/admin/ajax/delete_productType",
        data:"typeName="+typeName,
        type:"POST",
        datatype:"json",
        error:function(){
            alert("錯誤");
        },
        success:function(msg){
            if (msg == "success") {
                alert("刪除成功");
                $(location).attr("href","/admin/product_type");
            }
            else {
                alert("刪除失敗");
            }
        }
    })
  }
});

$('[data-toggle=confirmation_user]').confirmation({//確認刪除管理者
  onConfirm: function() {
    $("#modal_user").modal();//轉場效果輸入密碼
    $("#text_del_user").text($(this).attr("data-id"));//取得管理者名稱
    $("#modal_user").on('shown.bs.modal',function(){
      $("#del_password").val("");
      $(this).find("#del_password").focus();
    });
  }
});
$("#modal_user").on('hidden.bs.modal',function(){
    $("#text_del_user").text("");
});
$("#btn_delete_user").click(function(){//確定刪除管理者
  var adminUsername = $("#text_del_user").text();
  var adminPassword = $("#del_password").val();
  $.ajax({
      url:"/admin/ajax/delete_user",
      data:"adminUsername="+adminUsername+"&adminPassword="+adminPassword,
      type:"POST",
      datatype:"json",
      error:function(){
          alert("錯誤");
      },
      success:function(msg){
          if(msg == "success") {
              alert("刪除成功");
              $(location).attr("href","/admin/user");
          }
          else if(msg == "passwordError") {
              alert("密碼錯誤");
          }
          else if(msg == "empty") {
              alert("請輸入密碼");
          }
          else {
              alert("刪除失敗");
          }
      }
  })
});

$("#btn_create_banner").click(function(){//新增橫幅
  var name = $("#txt_banner_name").val();
  var error1 = $(".banner_error1").text();
  var formData = new FormData($('#formSetBanner')[0]);

  if(name!="" && error1==""){
    $.ajax({
        url:"/admin/home",
        data:formData,
        type:"POST",
        datatype:"json",
        contentType: false,
        processData: false,
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        error:function(){
            alert("錯誤!");
        },
        success:function(msg){
            if(msg == "success") {
                alert("新增成功");
                $(location).attr("href","/admin/home");
            }else if(msg == "empty"){
              alert("請輸入橫幅名稱");
            }else if(msg == "repeat"){
                alert("此名稱已使用過，請重新輸入");
            }else if(msg == "uploadError"){
                $('<p>圖片上傳失敗</p>').appendTo($('#banner_upload_error'));
            }else if(msg == "createError"){
                alert("新增失敗");
            }else{
                alert("失敗");
            }
        },
    })
  }else if(name == ""){
      alert("請輸入橫幅名稱");
  }else if(error1 != ""){
      alert("格式有誤，請重新輸入");
  }else{
      alert("錯誤");
  }
});

$("#btn_update_banner").click(function(){//更新橫幅
  var id = $(this).attr("data-id");
  var oldname = $(this).attr("data-name");
  var name = $("#txt_banner_name_update").val();
  var title = $("#txt_banner_title_update").val();
  var error = $(".banner_error1").text();

  if(name!="" && error==""){
    $.ajax({
        url:"/admin/home/"+id,
        data:"bannerName="+name+"&bannerTitle="+title,
        type:"PUT",
        datatype:"json",
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        error:function(){
            alert("錯誤");
        },
        success:function(msg){
            if(msg == "success"){
              alert("修改成功");
              $(location).attr("href","/admin/home");
            }else if(msg == "empty"){
                alert("請輸入產品名稱");
            }else if(msg == "repeat"){
                alert("此名稱已使用過，請重新輸入");
            }else{
                alert("修改失敗");
            }
        },
    })
  }else if(name == ""){
      alert("請輸入產品名稱");
  }else if(error != ""){
      alert("格式有誤，請重新輸入");
  }else{
      alert("錯誤");
  }
});

$("#btn_create_about").click(function(){//新增關於我們
  var title = $("#txt_about_tile").val();
  var error = $(".about_error1").text();
  var content = CKEDITOR.instances.textarea_set_about.getData();
  if(title != "" && error =="") {
    $.ajax({
        url:"/admin/ajax/set_about",
        data:"aboutTitle="+title+"&aboutContent="+content,
        type:"POST",
        datatype:"json",
        error:function(){
            alert("錯誤");
        },
        success:function(msg){
            if(msg == "success") {
              alert("新增成功");
              $(location).attr("href","/admin/about");
            }
            else if(msg == "empty") {
              alert("請輸入標題");
            }
            else if(msg == "repeat") {
              alert("此標題已使用，請重新輸入");
            }
            else {
              alert("新增失敗");
            }
        }
    })
  }
  else if(title == ""){
    alert("請輸入標題");
  }else{
    alert("格式錯誤，請重新輸入");
  }
});

$("#btn_update_about").click(function(){//更新關於我們
  var oldtitle = $(this).attr("data-id");
  var title = $("#txt_update_about").val();
  var error = $(".about_error1").text();
  var content = CKEDITOR.instances.textarea_update_about.getData();
  if(title != "" && error == "") {
    $.ajax({
        url:"/admin/ajax/update_about",
        data:"oldtitle="+oldtitle+"&aboutTitle="+title+"&aboutContent="+content,
        type:"POST",
        datatype:"json",
        error:function(){
            alert("錯誤");
        },
        success:function(msg){
            if(msg == "success") {
              alert("更新成功");
              $(location).attr("href","/admin/about");
            }
            else if(msg == "empty") {
              alert("請輸入標題");
            }
            else if(msg == "repeat") {
              alert("此標題已使用，請重新輸入");
            }
            else {
              alert("新增失敗");
            }
        }
    })
  }
  else if(title == ""){
    alert("請輸入標題");
  }else{
    alert("格式錯誤，請重新輸入");
  }
});

$("#btn_create_news").click(function(){//新增新聞
  var title = $("#txt_news_title").val();
  var time = $("#time_news").val();
  var content = CKEDITOR.instances.textarea_set_news.getData();
  if(title != "") {
    $.ajax({
        url:"/admin/ajax/set_news",
        data:"newsTitle="+title+"&newsTime="+time+"&newsContent="+content,
        type:"POST",
        datatype:"json",
        error:function(){
            alert("錯誤");
        },
        success:function(msg){
            if(msg == "success") {
              alert("新增成功");
              $(location).attr("href","/admin/news");
            }
            else if(msg == "empty") {
              alert("請輸入標題");
            }
            else if(msg == "repeat") {
              alert("此標題已使用，請重新輸入");
            }
            else {
              alert("新增失敗");
            }
        }
    })
  }
  else {
    alert("請輸入標題");
  }
});

$("#btn_update_news").click(function(){//更新新聞
  var id = $(this).attr("data-id");
  var title = $("#txt_update_news").val();
  var content = CKEDITOR.instances.textarea_update_news.getData();
  var time = $("#time_mews_update").val();

  if(title != "" && time != ""){
    $.ajax({
        url:"/admin/ajax/update_news",
        data:"newsID="+id+"&newsTitle="+title+"&newsContent="+content+"&newsTime="+time,
        type:"POST",
        datatype:"json",
        error:function(){
          alert("錯誤");
        },
        success:function(msg){
          if(msg == "success"){
            alert("修改成功");
            $(location).attr("href","/admin/news");
          }
          else if(msg == "empty"){
            alert("請輸入標題及時間");
          }
          else {
            alert("修改失敗");
          }
        },
    })
  }
  else{
    alert("請輸入標題及時間");
  }
});

$("#btn_create_user").click(function(){//新增管理者
  var name = $("#txt_user_name").val();
  var username = $("#txt_user_username").val();
  var password = $().crypt({method:"sha1",source:$("#psw_user_password").val()});
  var password2 = $().crypt({method:"sha1",source:$("#psw_user_password2").val()});
  var error1 = $(".user_error1").text();
  var error2 = $(".user_error2").text();
  var error3 = $(".user_error3").text();
  var error4 = $(".user_error4").text();

  if(name!="" && username!="" && password!="" && password==password2 && error1=="" && error2=="" && error3=="" && error4==""){
    $.ajax({
        url:"/admin/ajax/set_user",
        data:"adminName="+name+"&adminUsername="+username+"&adminPassword="+password+"&adminPassword2="+password2,
        type:"POST",
        datatype:"json",
        error:function(){
          alert("錯誤!");
        },
        success:function(msg){
          if(msg=="success"){
            alert("新增成功");
            $(location).attr("href","/admin/user");
          }else if(msg=="empty"){
            alert("請輸入名字、帳號及密碼");
          }else if(msg=="repeat"){
            alert("此帳號已被使用，請重新輸入");
          }else if(msg=="passwordError"){
            alert("兩組密碼不同，請重新輸入密碼");
          }else{
            alert("新增失敗");
          }
        }
    })
  }else if(name=="" || username=="" || password=="" || password2==""){
    alert("請輸入名字、帳號及密碼");
  }else if(error1!="" || error2!="" || error3!="" || error4!=""){
    alert("格式有誤，請重新輸入");
    $("#psw_user_password").val("");
    $("#psw_user_password2").val("");
  }else if(password!=password2){
    alert("兩組密碼不同，請重新輸入密碼");

  }else{
    alert("錯誤");
  }
});

$("#btn_update_user").click(function(){//更新管理者
  var username = $(this).attr("data-id");
  var name = $("#txt_user_name_update").val();
  var password = $().crypt({method:"sha1",source:$("#psw_user_password_update").val()});
  var password2 = $().crypt({method:"sha1",source:$("#psw_user_password2_update").val()});
  var error1 = $(".user_error1").text();
  var error2 = $(".user_error2").text();
  var error3 = $(".user_error3").text();
  var error4 = $(".user_error4").text();

  if(name!="" && password!="" && password==password2 && error1=="" && error2=="" && error3=="" && error4==""){
    $.ajax({
        url:"/admin/ajax/update_user",
        data:"adminName="+name+"&adminUsername="+username+"&adminPassword="+password+"&adminPassword2="+password2,
        type:"POST",
        datatype:"json",
        error:function(){
          alert("錯誤!");
        },
        success:function(msg){
          if(msg=="success"){
            alert("修改成功");
            $(location).attr("href","/admin/user");
          }else if(msg=="empty"){
            alert("請輸入名字及密碼");
          }else if(msg=="passwordError"){
            alert("兩組密碼不同，請重新輸入密碼");
          }else{
            alert("修改失敗");
          }
        }
    })
  }else if(name=="" || password=="" || password2==""){
    alert("請輸入名字及密碼");
  }else if(error1!="" || error2!="" || error3!="" || error4!=""){
    alert("格式有誤，請重新輸入");
    $("#psw_user_password_update").val("");
    $("#psw_user_password2_update").val("");
  }else if(password!=password2){
    alert("兩組密碼不同，請重新輸入密碼");

  }else{
    alert("錯誤");
  }
});

$("#btn_create_productType").click(function(){//新增產品分類
  var name = $("#txt_productType_name").val();
  var error = $(".user_error1").text();

  if(name!="" && error==""){
    $.ajax({
        url:"/admin/ajax/set_productType",
        data:"typeName="+name,
        type:"POST",
        datatype:"json",
        error:function(){
            alert("錯誤!");
        },
        success:function(msg){
            if(msg == "success"){
                alert("新增成功");
                $(location).attr("href","/admin/product_type");
            }else if(msg == "empty"){
                alert("請輸入分類名稱");
            }else if(msg == "repeat"){
                alert("此名稱已使用過，請重新輸入");
            }else{
                alert("新增失敗");
            }
        },
    })
  }else if(name == ""){
      alert("請輸入分類名稱");
  }else if(error != ""){
      alert("格式有誤，請重新輸入");
  }else{
      alert("錯誤");
  }
});

$("#btn_update_productType").click(function(){//更新產品分類
  var oldname = $(this).attr("data-id");
  var name = $("#txt_productType_name_update").val();
  var error = $(".user_error1").text();

  if(name!="" && error==""){
    $.ajax({
        url:"/admin/ajax/update_productType",
        data:"typeName="+name+"&oldName="+oldname,
        type:"POST",
        datatype:"json",
        error:function(){
            alert("錯誤!");
        },
        success:function(msg){
            if(msg == "success"){
                alert("修改成功");
                $(location).attr("href","/admin/product_type");
            }else if(msg == "empty"){
                alert("請輸入分類名稱");
            }else if(msg == "repeat"){
                alert("此名稱已使用過，請重新輸入");
            }else{
                alert("修改失敗");
            }
        },
    })
  }else if(name == ""){
      alert("請輸入分類名稱");
  }else if(error != ""){
      alert("格式有誤，請重新輸入");
  }else{
      alert("錯誤");
  }
});

$(document).on('click',"#btn_create_product",function(e){//新增產品
  var name = $("#txt_product_name").val();
  var type = $("#sel_product_type").val();
  var error = $(".product_error1").text();
  var desc = CKEDITOR.instances.textarea_set_product_desc.getData();
  var key = $('input[name="txt_product_spec_key"]').map(function(){return $(this).val();}).get();
  var value = $('input[name="txt_product_spec_value"]').map(function(){return $(this).val();}).get();
  var i = $("#product_spec div").size();
  var json_data = {};
  for(var j=0;j<i;j++){
    json_data[key[j]] = value[j];
  }
  var spec = JSON.stringify(json_data);
  var formData = new FormData($('#formSetPproduct')[0]);
  formData.append("productSpecification", spec);
  formData.append("productDescription", desc);

  if(name!="" && error=="" && type!=""){
    $.ajax({
        url:"/admin/product/set_product",
        data:formData,
        type:"POST",
        datatype:"json",
        contentType: false,
        processData: false,
        error:function(){
            alert("錯誤!");
        },
        success:function(msg){
          msg = JSON.parse(msg);
          if(msg.status){
            if(msg.data == "success"){
                alert("新增成功");
                $(location).attr("href","/admin/product");
            }else if(msg.data == "empty"){
                alert("請輸入產品名稱");
            }else if(msg.data == "repeat"){
                alert("此名稱已使用過，請重新輸入");
            }else if(msg.data == "typeEmpty"){
                alert("請選擇產品分類");
            }else if(msg.data == "error"){
                alert("新增失敗");
            }
          }else{
              $('<p>'+msg.error_string+'</p>').appendTo($('#product_upload_error'));
            }
        },
    })
  }else if(name == ""){
      alert("請輸入產品名稱");
  }else if(error != ""){
      alert("格式有誤，請重新輸入");
  }else if(type == ""){
      alert("請選擇產品分類");
  }else{
      alert("錯誤");
  }
});

$("#btn_update_product").click(function(){//更新產品
  var id = $(this).attr("data-id");
  var oldname = $(this).attr("data-name");
  var name = $("#txt_product_name_update").val();
  var type = $("#sel_product_type_update").val();
  var desc = CKEDITOR.instances.textarea_update_product_desc.getData();
  var error = $(".product_error1").text();
  var key = $('input[name="txt_product_spec_key_update"]').map(function(){return $(this).val();}).get();
  var value = $('input[name="txt_product_spec_value_update"]').map(function(){return $(this).val();}).get();
  var i = $("#product_spec_update div").size();
  var json_data = {};
  for(var j=0;j<i;j++){
    json_data[key[j]] = value[j];
  }
  var spec = JSON.stringify(json_data);
  if(name!="" && error=="" && type!=""){
    $.ajax({
        url:"/admin/ajax/update_product",
        data:"productID="+id+"&productOldname="+oldname+"&productName="+name+"&productType="+type+"&productSpecification="+spec+"&productDescription="+desc,
        type:"POST",
        datatype:"json",
        error:function(){
            alert("錯誤!");
        },
        success:function(msg){
            if(msg == "success"){
                alert("修改成功");
                $(location).attr("href","/admin/product");
            }else if(msg == "empty"){
                alert("請輸入產品名稱");
            }else if(msg == "repeat"){
                alert("此名稱已使用過，請重新輸入");
            }else if(msg == "typeEmpty"){
                alert("請選擇產品分類");
            }else{
                alert("修改失敗");
            }
        },
    })
  }else if(name == ""){
      alert("請輸入產品名稱");
  }else if(error != ""){
      alert("格式有誤，請重新輸入");
  }else if(type == ""){
      alert("請選擇產品分類");
  }else{
      alert("錯誤");
  }
});


$("#btn_search_news").click(function(){
  var keyword = $("#txt_search_news").val();
  if(keyword == ""){
    alert("請輸入關鍵字");
  }else{
    $(location).attr("href","/admin/news/search?q="+keyword);
  }
});

$("#btn_search_product").click(function(){
  var keyword = $("#txt_search_product").val();
  if(keyword == ""){
    alert("請輸入關鍵字");
  }else{
    $(location).attr("href","/admin/product/search?q="+keyword);
  }
});

$("#btn_search_contact").click(function(){
  var keyword = $("#txt_search_contact").val();
  if(keyword == ""){
    alert("請輸入關鍵字");
  }else{
    $(location).attr("href","/admin/contact/search?q="+keyword);
  }
});
