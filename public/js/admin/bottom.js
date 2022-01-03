/******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./resources/js/admin_ajax.js":
/*!************************************!*\
  !*** ./resources/js/admin_ajax.js ***!
  \************************************/
/***/ (() => {

$('[data-toggle=confirmation_about]').confirmation({
  //確認刪除關於我們
  onConfirm: function onConfirm() {
    //按下是
    var id = $(this).attr("data-id");
    $.ajax({
      url: "/admin/about/" + id,
      type: "DELETE",
      datatype: "json",
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      error: function error() {
        alert("錯誤");
      },
      success: function success(msg) {
        if (msg == "success") {
          alert("刪除成功");
          $(location).attr("href", "/admin/about");
        } else {
          alert("刪除失敗");
        }
      }
    });
  }
});
$('[data-toggle=confirmation_contact]').confirmation({
  //確認刪除聯絡我們
  onConfirm: function onConfirm() {
    var guestID = $(this).attr("data-id");
    $.ajax({
      url: "/admin/contact/" + guestID,
      type: "DELETE",
      datatype: "json",
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      error: function error() {
        alert("錯誤");
      },
      success: function success(msg) {
        if (msg == "success") {
          alert("刪除成功");
          $(location).attr("href", "/admin/contact");
        } else {
          alert("刪除失敗");
        }
      }
    });
  }
});
$('[data-toggle=confirmation_banner]').confirmation({
  //確認刪除橫幅
  onConfirm: function onConfirm() {
    var bannerID = $(this).attr("data-id");
    var bannerImgName = $(this).attr("data-name");
    $.ajax({
      url: "/admin/home/" + bannerID,
      //data:"bannerID="+bannerID+"&bannerImgName="+bannerImgName,
      type: "DELETE",
      datatype: "json",
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      error: function error() {
        alert("錯誤");
      },
      success: function success(msg) {
        if (msg == "success") {
          alert("刪除成功");
          $(location).attr("href", "/admin/home");
        } else {
          alert("刪除失敗");
        }
      }
    });
  }
});
$('[data-toggle=confirmation_news]').confirmation({
  //確認刪除新聞
  onConfirm: function onConfirm() {
    var newsID = $(this).attr("data-id");
    $.ajax({
      url: "/admin/news/" + newsID,
      type: "DELETE",
      datatype: "json",
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      error: function error() {
        alert("失敗");
      },
      success: function success(msg) {
        if (msg == "success") {
          $(location).attr("href", "/admin/news");
          alert("刪除成功");
        } else {
          alert("刪除失敗");
        }
      }
    });
  }
});
$('[data-toggle=confirmation_product]').confirmation({
  //確認刪除產品
  onConfirm: function onConfirm() {
    var productID = $(this).attr("data-id");
    $.ajax({
      url: "/admin/product/" + productID,
      type: "DELETE",
      datatype: "json",
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      error: function error() {
        alert("錯誤");
      },
      success: function success(msg) {
        if (msg == "success") {
          alert("刪除成功");
          $(location).attr("href", "/admin/product");
        } else {
          alert("刪除失敗");
        }
      }
    });
  }
});
$('[data-toggle=confirmation_type]').confirmation({
  //確認刪除產品分類
  onConfirm: function onConfirm() {
    var id = $(this).attr("data-id");
    $.ajax({
      url: "/admin/product_type/" + id,
      type: "DELETE",
      datatype: "json",
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      error: function error() {
        alert("錯誤");
      },
      success: function success(msg) {
        if (msg == "success") {
          alert("刪除成功");
          $(location).attr("href", "/admin/product_type");
        } else {
          alert("刪除失敗");
        }
      }
    });
  }
});
$('[data-toggle=confirmation_user]').confirmation({
  //確認刪除管理者
  onConfirm: function onConfirm() {
    $("#modal_user").modal(); //轉場效果輸入密碼

    $("#text_del_user").text($(this).attr("data-email")); //取得管理者E-mail

    $("#modal_user").on('shown.bs.modal', function () {
      $("#del_password").val("");
      $(this).find("#del_password").focus();
    });
  }
});
$("#modal_user").on('hidden.bs.modal', function () {
  $("#text_del_user").text("");
});
$("#btn_delete_user").click(function () {
  //確定刪除管理者
  var id = $(this).attr("data-id");
  var adminEmail = $("#text_del_user").text();
  var adminPassword = $().crypt({
    method: "sha1",
    source: $("#del_password").val()
  });
  $.ajax({
    url: "/admin/user/" + id,
    data: "adminEmail=" + adminEmail + "&adminPassword=" + adminPassword,
    type: "DELETE",
    datatype: "json",
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    error: function error() {
      alert("錯誤");
    },
    success: function success(msg) {
      if (msg == "success") {
        alert("刪除成功");
        $(location).attr("href", "/admin/user");
      } else if (msg == "passwordError") {
        alert("密碼錯誤");
      } else if (msg == "empty") {
        alert("請輸入密碼");
      } else if (msg == "deleteError") {
        alert("刪除失敗");
      } else {
        alert("失敗");
      }
    }
  });
});
$("#btn_create_banner").click(function () {
  //新增橫幅
  var name = $("#txt_banner_name").val();
  var error1 = $(".banner_error1").text();
  var formData = new FormData($('#formSetBanner')[0]);

  if (name != "" && error1 == "") {
    $.ajax({
      url: "/admin/home",
      data: formData,
      type: "POST",
      datatype: "json",
      contentType: false,
      processData: false,
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      error: function error() {
        alert("錯誤!");
      },
      success: function success(msg) {
        if (msg == "success") {
          alert("新增成功");
          $(location).attr("href", "/admin/home");
        } else if (msg == "empty") {
          alert("請輸入橫幅名稱");
        } else if (msg == "repeat") {
          alert("此名稱已使用過，請重新輸入");
        } else if (msg == "uploadError") {
          $('<p>圖片上傳失敗</p>').appendTo($('#banner_upload_error'));
        } else if (msg == "createError") {
          alert("新增失敗");
        } else {
          alert("失敗");
        }
      }
    });
  } else if (name == "") {
    alert("請輸入橫幅名稱");
  } else if (error1 != "") {
    alert("格式有誤，請重新輸入");
  } else {
    alert("錯誤");
  }
});
$("#btn_update_banner").click(function () {
  //更新橫幅
  var id = $(this).attr("data-id");
  var oldname = $(this).attr("data-name");
  var name = $("#txt_banner_name_update").val();
  var title = $("#txt_banner_title_update").val();
  var error = $(".banner_error1").text();

  if (name != "" && error == "") {
    $.ajax({
      url: "/admin/home/" + id,
      data: "bannerName=" + name + "&bannerTitle=" + title,
      type: "PUT",
      datatype: "json",
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      error: function error() {
        alert("錯誤");
      },
      success: function success(msg) {
        if (msg == "success") {
          alert("修改成功");
          $(location).attr("href", "/admin/home");
        } else if (msg == "empty") {
          alert("請輸入產品名稱");
        } else if (msg == "repeat") {
          alert("此名稱已使用過，請重新輸入");
        } else {
          alert("修改失敗");
        }
      }
    });
  } else if (name == "") {
    alert("請輸入產品名稱");
  } else if (error != "") {
    alert("格式有誤，請重新輸入");
  } else {
    alert("錯誤");
  }
});
$("#btn_create_about").click(function () {
  //新增關於我們
  var title = $("#txt_about_tile").val();
  var error = $(".about_error1").text();
  var content = CKEDITOR.instances.textarea_set_about.getData();

  if (title != "" && error == "") {
    $.ajax({
      url: "/admin/about",
      data: "aboutTitle=" + title + "&aboutContent=" + content,
      type: "POST",
      datatype: "json",
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      error: function error() {
        alert("錯誤");
      },
      success: function success(msg) {
        if (msg == "success") {
          alert("新增成功");
          $(location).attr("href", "/admin/about");
        } else if (msg == "empty") {
          alert("請輸入標題");
        } else if (msg == "repeat") {
          alert("此標題已使用，請重新輸入");
        } else if (msg == "createError") {
          alert("新增失敗");
        } else {
          alert("失敗");
        }
      }
    });
  } else if (title == "") {
    alert("請輸入標題");
  } else {
    alert("格式錯誤，請重新輸入");
  }
});
$("#btn_update_about").click(function () {
  //更新關於我們
  var id = $(this).attr("data-id");
  var title = $("#txt_update_about").val();
  var error = $(".about_error1").text();
  var content = CKEDITOR.instances.textarea_update_about.getData();

  if (title != "" && error == "") {
    $.ajax({
      url: "/admin/about/" + id,
      data: "aboutTitle=" + title + "&aboutContent=" + content,
      type: "PUT",
      datatype: "json",
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      error: function error() {
        alert("錯誤");
      },
      success: function success(msg) {
        if (msg == "success") {
          alert("更新成功");
          $(location).attr("href", "/admin/about");
        } else if (msg == "empty") {
          alert("請輸入標題");
        } else if (msg == "repeat") {
          alert("此標題已使用，請重新輸入");
        } else if (msg == "updateError") {
          alert("更新失敗");
        } else {
          alert("失敗");
        }
      }
    });
  } else if (title == "") {
    alert("請輸入標題");
  } else {
    alert("格式錯誤，請重新輸入");
  }
});
$("#btn_create_news").click(function () {
  //新增新聞
  var title = $("#txt_news_title").val();
  var time = $("#time_news").val();
  var content = CKEDITOR.instances.textarea_set_news.getData();

  if (title != "") {
    $.ajax({
      url: "/admin/news",
      data: "newsTitle=" + title + "&newsTime=" + time + "&newsContent=" + content,
      type: "POST",
      datatype: "json",
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      error: function error() {
        alert("錯誤");
      },
      success: function success(msg) {
        if (msg == "success") {
          alert("新增成功");
          $(location).attr("href", "/admin/news");
        } else if (msg == "empty") {
          alert("請輸入標題");
        } else if (msg == "createError") {
          alert("新增失敗");
        } else {
          alert("失敗");
        }
      }
    });
  } else {
    alert("請輸入標題");
  }
});
$("#btn_update_news").click(function () {
  //更新新聞
  var id = $(this).attr("data-id");
  var title = $("#txt_update_news").val();
  var content = CKEDITOR.instances.textarea_update_news.getData();
  var time = $("#time_mews_update").val();

  if (title != "" && time != "") {
    $.ajax({
      url: "/admin/news/" + id,
      data: "newsID=" + id + "&newsTitle=" + title + "&newsContent=" + content + "&newsTime=" + time,
      type: "PUT",
      datatype: "json",
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      error: function error() {
        alert("錯誤");
      },
      success: function success(msg) {
        if (msg == "success") {
          alert("修改成功");
          $(location).attr("href", "/admin/news");
        } else if (msg == "empty") {
          alert("請輸入標題及時間");
        } else if (msg == "updateError") {
          alert("修改失敗");
        } else {
          alert("失敗");
        }
      }
    });
  } else {
    alert("請輸入標題及時間");
  }
});
$("#btn_create_user").click(function () {
  //新增管理者
  var name = $("#txt_user_name").val();
  var email = $("#txt_user_email").val();
  var password = $().crypt({
    method: "sha1",
    source: $("#psw_user_password").val()
  });
  var password2 = $().crypt({
    method: "sha1",
    source: $("#psw_user_password2").val()
  });
  var error1 = $(".user_error1").text();
  var error2 = $(".user_error2").text();
  var error3 = $(".user_error3").text();
  var error4 = $(".user_error4").text();

  if (name != "" && email != "" && password != "" && password == password2 && error1 == "" && error2 == "" && error3 == "" && error4 == "") {
    $.ajax({
      url: "/admin/user",
      data: "adminName=" + name + "&adminEmail=" + email + "&adminPassword=" + password + "&adminPassword2=" + password2,
      type: "POST",
      datatype: "json",
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      error: function error() {
        alert("錯誤!");
      },
      success: function success(msg) {
        if (msg == "success") {
          alert("新增成功");
          $(location).attr("href", "/admin/user");
        } else if (msg == "empty") {
          alert("請輸入名字、E-mail及密碼");
        } else if (msg == "repeat") {
          alert("此E-mail已被使用，請重新輸入");
        } else if (msg == "passwordError") {
          alert("兩組密碼不同，請重新輸入密碼");
        } else if (msg == "createError") {
          alert("新增失敗");
        } else {
          alert("失敗");
        }
      }
    });
  } else if (name == "" || email == "" || password == "" || password2 == "") {
    alert("請輸入名字、E-mail及密碼");
  } else if (error1 != "" || error2 != "" || error3 != "" || error4 != "") {
    alert("格式有誤，請重新輸入");
    $("#psw_user_password").val("");
    $("#psw_user_password2").val("");
  } else if (password != password2) {
    alert("兩組密碼不同，請重新輸入密碼");
  } else {
    alert("錯誤");
  }
});
$("#btn_update_user").click(function () {
  //更新管理者
  var id = $(this).attr("data-id");
  var name = $("#txt_user_name_update").val(); //var email = $("#txt_email_update").text();

  var password = $().crypt({
    method: "sha1",
    source: $("#psw_user_password_update").val()
  });
  var password2 = $().crypt({
    method: "sha1",
    source: $("#psw_user_password2_update").val()
  });
  var error1 = $(".user_error1").text();
  var error2 = $(".user_error2").text();
  var error3 = $(".user_error3").text();
  var error4 = $(".user_error4").text();

  if (name != "" && password != "" && password == password2 && error1 == "" && error2 == "" && error3 == "" && error4 == "") {
    $.ajax({
      url: "/admin/user/" + id,
      data: "adminName=" + name + "&adminPassword=" + password + "&adminPassword2=" + password2,
      type: "PUT",
      datatype: "json",
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      error: function error() {
        alert("錯誤!");
      },
      success: function success(msg) {
        if (msg == "success") {
          alert("修改成功");
          $(location).attr("href", "/admin/user");
        } else if (msg == "empty") {
          alert("請輸入名字及密碼");
        } else if (msg == "passwordError") {
          alert("兩組密碼不同，請重新輸入密碼");
        } else if (msg == "permissionsError") {
          alert("沒有修改權限");
        } else if (msg == "updateError") {
          alert("修改失敗");
        } else {
          alert("失敗");
        }
      }
    });
  } else if (name == "" || password == "" || password2 == "") {
    alert("請輸入名字及密碼");
  } else if (error1 != "" || error2 != "" || error3 != "" || error4 != "") {
    alert("格式有誤，請重新輸入");
    $("#psw_user_password_update").val("");
    $("#psw_user_password2_update").val("");
  } else if (password != password2) {
    alert("兩組密碼不同，請重新輸入密碼");
  } else {
    alert("錯誤");
  }
});
$("#btn_create_productType").click(function () {
  //新增產品分類
  var name = $("#txt_productType_name").val();
  var error = $(".user_error1").text();

  if (name != "" && error == "") {
    $.ajax({
      url: "/admin/product_type",
      data: "productTypeName=" + name,
      type: "POST",
      datatype: "json",
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      error: function error() {
        alert("錯誤!");
      },
      success: function success(msg) {
        if (msg == "success") {
          alert("新增成功");
          $(location).attr("href", "/admin/product_type");
        } else if (msg == "empty") {
          alert("請輸入分類名稱");
        } else if (msg == "repeat") {
          alert("此名稱已使用過，請重新輸入");
        } else if (msg == "createError") {
          alert("新增失敗");
        } else {
          alert("失敗");
        }
      }
    });
  } else if (name == "") {
    alert("請輸入分類名稱");
  } else if (error != "") {
    alert("格式有誤，請重新輸入");
  } else {
    alert("錯誤");
  }
});
$("#btn_update_productType").click(function () {
  //更新產品分類
  var id = $(this).attr("data-id");
  var name = $("#txt_productType_name_update").val();
  var error = $(".user_error1").text();

  if (name != "" && error == "") {
    $.ajax({
      url: "/admin/product_type/" + id,
      data: "productTypeName=" + name,
      type: "PUT",
      datatype: "json",
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      error: function error() {
        alert("錯誤!");
      },
      success: function success(msg) {
        if (msg == "success") {
          alert("修改成功");
          $(location).attr("href", "/admin/product_type");
        } else if (msg == "empty") {
          alert("請輸入分類名稱");
        } else if (msg == "repeat") {
          alert("此名稱已使用過，請重新輸入");
        } else if (msg == "updateError") {
          alert("修改失敗");
        } else {
          alert("失敗");
        }
      }
    });
  } else if (name == "") {
    alert("請輸入分類名稱");
  } else if (error != "") {
    alert("格式有誤，請重新輸入");
  } else {
    alert("錯誤");
  }
});
$(document).on('click', "#btn_create_product", function (e) {
  //新增產品
  var name = $("#txt_product_name").val();
  var type = $("#sel_product_type").val();
  var error = $(".product_error1").text();
  var desc = CKEDITOR.instances.textarea_set_product_desc.getData();
  var key = $('input[name="txt_product_spec_key"]').map(function () {
    return $(this).val();
  }).get();
  var value = $('input[name="txt_product_spec_value"]').map(function () {
    return $(this).val();
  }).get();
  var i = $("#product_spec div").size();
  var json_data = {};

  for (var j = 0; j < i; j++) {
    json_data[key[j]] = value[j];
  }

  var spec = JSON.stringify(json_data);
  var formData = new FormData($('#formSetPproduct')[0]);
  formData.append("productSpecification", spec);
  formData.append("productDescription", desc);

  if (name != "" && error == "" && type != "") {
    $.ajax({
      url: "/admin/product",
      data: formData,
      type: "POST",
      datatype: "json",
      contentType: false,
      processData: false,
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      error: function error() {
        alert("錯誤!");
      },
      success: function success(msg) {
        if (msg == "success") {
          alert("新增成功");
          $(location).attr("href", "/admin/product");
        } else if (msg == "empty") {
          alert("請輸入產品名稱");
        } else if (msg == "repeat") {
          alert("此名稱已使用過，請重新輸入");
        } else if (msg == "typeEmpty") {
          alert("請選擇產品分類");
        } else if (msg == "uploadEmpty") {
          alert("請選擇圖片");
        } else if (msg == "uploadError") {
          $('<p>圖片上傳失敗</p>').appendTo($('#product_upload_error'));
        } else if (msg == "createError") {
          alert("新增失敗");
        } else {
          alert("失敗");
        }
      }
    });
  } else if (name == "") {
    alert("請輸入產品名稱");
  } else if (error != "") {
    alert("格式有誤，請重新輸入");
  } else if (type == "") {
    alert("請選擇產品分類");
  } else {
    alert("錯誤");
  }
});
$("#btn_update_product").click(function () {
  //更新產品
  var id = $(this).attr("data-id");
  var name = $("#txt_product_name_update").val();
  var type = $("#sel_product_type_update").val();
  var desc = CKEDITOR.instances.textarea_update_product_desc.getData();
  var error = $(".product_error1").text();
  var key = $('input[name="txt_product_spec_key_update"]').map(function () {
    return $(this).val();
  }).get();
  var value = $('input[name="txt_product_spec_value_update"]').map(function () {
    return $(this).val();
  }).get();
  var i = $("#product_spec_update div").size();
  var json_data = {};

  for (var j = 0; j < i; j++) {
    json_data[key[j]] = value[j];
  }

  var spec = JSON.stringify(json_data);

  if (name != "" && error == "" && type != "") {
    $.ajax({
      url: "/admin/product/" + id,
      data: "productName=" + name + "&productType=" + type + "&productSpecification=" + spec + "&productDescription=" + desc,
      type: "PUT",
      datatype: "json",
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      error: function error() {
        alert("錯誤!");
      },
      success: function success(msg) {
        if (msg == "success") {
          alert("修改成功");
          $(location).attr("href", "/admin/product");
        } else if (msg == "empty") {
          alert("請輸入產品名稱");
        } else if (msg == "repeat") {
          alert("此名稱已使用過，請重新輸入");
        } else if (msg == "typeEmpty") {
          alert("請選擇產品分類");
        } else if (msg == "updateError") {
          alert("修改失敗");
        } else {
          alert("失敗");
        }
      }
    });
  } else if (name == "") {
    alert("請輸入產品名稱");
  } else if (error != "") {
    alert("格式有誤，請重新輸入");
  } else if (type == "") {
    alert("請選擇產品分類");
  } else {
    alert("錯誤");
  }
});
$("#btn_search_news").click(function () {
  var keyword = $("#txt_search_news").val();

  if (keyword == "") {
    alert("請輸入關鍵字");
  } else {
    $(location).attr("href", "/admin/news/search?q=" + keyword);
  }
});
$("#btn_search_product").click(function () {
  var keyword = $("#txt_search_product").val();

  if (keyword == "") {
    alert("請輸入關鍵字");
  } else {
    $(location).attr("href", "/admin/product/search?q=" + keyword);
  }
});
$("#btn_search_contact").click(function () {
  var keyword = $("#txt_search_contact").val();

  if (keyword == "") {
    alert("請輸入關鍵字");
  } else {
    $(location).attr("href", "/admin/contact/search?q=" + keyword);
  }
});

/***/ }),

/***/ "./resources/js/bootstrap-confirmation.js":
/*!************************************************!*\
  !*** ./resources/js/bootstrap-confirmation.js ***!
  \************************************************/
/***/ (() => {

function _typeof(obj) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (obj) { return typeof obj; } : function (obj) { return obj && "function" == typeof Symbol && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }, _typeof(obj); }

/*!
 * Bootstrap Confirmation 2.3.1
 * Copyright 2013 Nimit Suwannagate <ethaizone@hotmail.com>
 * Copyright 2014-2016 Damien "Mistic" Sorel <contact@git.strangeplanet.fr>
 * Licensed under the Apache License, Version 2.0
 */
!function ($) {
  "use strict";

  function a(a) {
    for (var b = window, c = a.split("."), d = c.pop(), e = 0, f = c.length; e < f; e++) {
      b = b[c[e]];
    }

    return function () {
      b[d].call(this);
    };
  }

  if (!$.fn.popover) throw new Error("Confirmation requires popover.js");

  var b = function b(a, _b) {
    _b.trigger = "click", this.init(a, _b);
  };

  b.VERSION = "2.3.1", b.DEFAULTS = $.extend({}, $.fn.popover.Constructor.DEFAULTS, {
    placement: "top",
    title: "Are you sure?",
    popout: !1,
    singleton: !1,
    copyAttributes: "href target",
    buttons: null,
    onConfirm: $.noop,
    onCancel: $.noop,
    btnOkClass: "btn-xs btn-primary",
    btnOkIcon: "glyphicon glyphicon-ok",
    btnOkLabel: "是",
    btnCancelClass: "btn-xs btn-default",
    btnCancelIcon: "glyphicon glyphicon-remove",
    btnCancelLabel: "否",
    template: '<div class="popover confirmation"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content"><p class="confirmation-content"></p><div class="confirmation-buttons text-center"><div class="btn-group"><a class="btn" data-apply="confirmation"></a><a class="btn" data-dismiss="confirmation"></a></div></div></div></div>'
  }), b.prototype = $.extend({}, $.fn.popover.Constructor.prototype), b.prototype.constructor = b, b.prototype.getDefaults = function () {
    return b.DEFAULTS;
  }, b.prototype.init = function (a, b) {
    $.fn.popover.Constructor.prototype.init.call(this, "confirmation", a, b), this.options._isDelegate = !1, b.selector ? this.options._selector = this._options._selector = b._root_selector + " " + b.selector : b._selector ? (this.options._selector = b._selector, this.options._isDelegate = !0) : this.options._selector = b._root_selector;
    var c = this;
    this.options.selector || (this.options._attributes = {}, this.options.copyAttributes ? "string" == typeof this.options.copyAttributes && (this.options.copyAttributes = this.options.copyAttributes.split(" ")) : this.options.copyAttributes = [], this.options.copyAttributes.forEach(function (a) {
      this.options._attributes[a] = this.$element.attr(a);
    }, this), this.$element.on(this.options.trigger, function (a, b) {
      b || (a.preventDefault(), a.stopPropagation(), a.stopImmediatePropagation());
    }), this.$element.on("show.bs.confirmation", function (a) {
      c.options.singleton && $(c.options._selector).not($(this)).filter(function () {
        return void 0 !== $(this).data("bs.confirmation");
      }).confirmation("hide");
    })), this.options._isDelegate || (this.eventBody = !1, this.uid = this.$element[0].id || this.getUID("group_"), this.$element.on("shown.bs.confirmation", function (a) {
      c.options.popout && !c.eventBody && (c.eventBody = $("body").on("click.bs.confirmation." + c.uid, function (a) {
        $(c.options._selector).is(a.target) || ($(c.options._selector).filter(function () {
          return void 0 !== $(this).data("bs.confirmation");
        }).confirmation("hide"), $("body").off("click.bs." + c.uid), c.eventBody = !1);
      }));
    }));
  }, b.prototype.setContent = function () {
    var a = this,
        b = this.tip(),
        c = this.getTitle(),
        d = this.getContent();

    if (b.find(".popover-title")[this.options.html ? "html" : "text"](c), b.find(".confirmation-content").toggle(!!d).children().detach().end()[this.options.html ? "string" == typeof d ? "html" : "append" : "text"](d), b.on("click", function (a) {
      a.stopPropagation();
    }), this.options.buttons) {
      var e = b.find(".confirmation-buttons .btn-group").empty();
      this.options.buttons.forEach(function (b) {
        e.append($("<a></a>").addClass(b["class"]).html(b.label).prepend($("<i></i>").addClass(b.icon), " ").one("click", function () {
          b.onClick && b.onClick.call(a.$element), b.cancel ? (a.getOnCancel.call(a).call(a.$element), a.$element.trigger("canceled.bs.confirmation")) : (a.getOnConfirm.call(a).call(a.$element), a.$element.trigger("confirmed.bs.confirmation")), a.$element.confirmation("hide");
        }));
      }, this);
    } else b.find('[data-apply="confirmation"]').addClass(this.options.btnOkClass).html(this.options.btnOkLabel).attr(this.options._attributes).prepend($("<i></i>").addClass(this.options.btnOkIcon), " ").off("click").one("click", function () {
      a.getOnConfirm.call(a).call(a.$element), a.$element.trigger("confirmed.bs.confirmation"), a.$element.trigger(a.options.trigger, [!0]), a.$element.confirmation("hide");
    }), b.find('[data-dismiss="confirmation"]').addClass(this.options.btnCancelClass).html(this.options.btnCancelLabel).prepend($("<i></i>").addClass(this.options.btnCancelIcon), " ").off("click").one("click", function () {
      a.getOnCancel.call(a).call(a.$element), a.inState && (a.inState.click = !1), a.$element.trigger("canceled.bs.confirmation"), a.$element.confirmation("hide");
    });

    b.removeClass("fade top bottom left right in"), b.find(".popover-title").html() || b.find(".popover-title").hide();
  }, b.prototype.getOnConfirm = function () {
    return this.$element.attr("data-on-confirm") ? a(this.$element.attr("data-on-confirm")) : this.options.onConfirm;
  }, b.prototype.getOnCancel = function () {
    return this.$element.attr("data-on-cancel") ? a(this.$element.attr("data-on-cancel")) : this.options.onCancel;
  };
  var c = $.fn.confirmation;
  $.fn.confirmation = function (a) {
    var c = "object" == _typeof(a) && a || {};
    return c._root_selector = this.selector, this.each(function () {
      var d = $(this),
          e = d.data("bs.confirmation");
      (e || "destroy" != a) && (e || d.data("bs.confirmation", e = new b(this, c)), "string" == typeof a && (e[a](), "hide" == a && e.inState && (e.inState.click = !1)));
    });
  }, $.fn.confirmation.Constructor = b, $.fn.confirmation.noConflict = function () {
    return $.fn.confirmation = c, this;
  };
}(jQuery);

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/************************************************************************/
var __webpack_exports__ = {};
// This entry need to be wrapped in an IIFE because it need to be isolated against other modules in the chunk.
(() => {
/*!********************************!*\
  !*** ./resources/js/bottom.js ***!
  \********************************/
__webpack_require__(/*! ./bootstrap-confirmation */ "./resources/js/bootstrap-confirmation.js");

__webpack_require__(/*! ./admin_ajax */ "./resources/js/admin_ajax.js");
})();

/******/ })()
;