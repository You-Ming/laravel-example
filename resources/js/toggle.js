
$(document).ready(function(){
    $("#nav_admin_product").click(function(){
        $("#nav_admin_product_list").slideToggle("slow");
    });
});

$(document).ready(function(){
    $("#about_flip").click(function(){
      $(".toggle_nav, .toggle_nav_open").toggleClass("toggle_nav toggle_nav_open");
      $(".glyphicon-chevron-down, .glyphicon-chevron-up").toggleClass("glyphicon-chevron-down glyphicon-chevron-up");

    });
});

$(document).ready(function(){
    $("#product_flip").click(function(){
      $(".toggle_nav, .toggle_nav_open").toggleClass("toggle_nav toggle_nav_open");
      $(".glyphicon-chevron-down, .glyphicon-chevron-up").toggleClass("glyphicon-chevron-down glyphicon-chevron-up");

    });
});

$(function(){
  var url = window.location;
      var element = $('ul.nav a').filter(function() {
          return this.href == url;
      }).addClass('active').parent();
});
