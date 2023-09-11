<!--

if (self!=top)
{
top.location.href=self.location.href;
}

///////

$.fn.animateBG = function(x, y, speed, def) {
    var pos = this.css('background-position').split(' ');
    this.x = 0,
    this.y = def;
    $.Animation( this, {
        x: x,
        y: y
      }, { 
        duration: speed
      }).progress(function(e) {
          this.css('background-position', e.tweens[0].now+'px '+e.tweens[1].now+'px');
    });
    return this;
}

$(document).ready(function(){
						   
$(".general-fade").hide();
$("html, body").animate({scrollTop:0}, "slow");

$(window).resize(function (){						
if($("button.collapse").css("display") == "none"){
done = 0
$(".header2 ul.main-list").show();
}
if($("button.collapse").css("display") == "block"){
if(done == 0){
done = 1;
$(".header2 ul.main-list").hide();
}
}
});

////////////////////////////////////////////////////
$(".header-wrapper ul.main-list li").hover(function(){
if($("button.collapse").css("display") == "none"){												  
$(this).children("a.main-link").addClass("current2");
$(this).children("ul").slideToggle();
}
},function(){
if($("button.collapse").css("display") == "none"){
$(this).children("a.main-link").removeClass("current2");
$(this).children("ul").hide();
}
});

////////////////////////////////////////////////////
$(".header-wrapper ul.main-list li").click(function(){
if($("button.collapse").css("display") == "block"){	
$(".header-wrapper ul.main-list li").not($(this)).children("a.current2").removeClass("current2");
$(this).children("a.main-link").toggleClass("current2");
$(".header-wrapper ul.main-list li").not($(this)).children("ul").hide("slow");
$(this).children("ul").slideToggle();
}
});

////////////////////////////////////////////////////
$(".header2 .collapse").click(function(){
$(".header2 ul.main-list").slideToggle();
});

///////////////////////////////////////////////////

    //smoothscroll
    $('a.nav_top').on('click', function (e) {
        e.preventDefault();
        $(document).off("scroll");
		
        var target = this.hash,
            menu = target;
        $target = $(target);
        $('html, body').stop().animate({
            'scrollTop': $target.offset().top+2
        }, 500, 'swing', function () {
            window.location.hash = target;
            $(document).on("scroll", onScroll);
        });
    });

//////////////////////////////////////////////////
$(".newsletter").submit(function(e){
e.preventDefault();  
var formdata = new FormData(this);
$(".general-fade").show();
var page_url = $(this).attr("action");

$.ajax({
url: page_url,
type: "POST",
data: formdata,
mimeTypes:"multipart/form-data",
contentType: false,
cache: false,
processData: false,
success: function(data){
$(".general-result").html(data);
$(".general-fade").hide();
},error: function(){
sweetAlert("Notice", "Error occured!", "error");
}
});

});
///////////////////////////////////////////////

$(".gen-save").click(function(){
var this_name = $(this).attr("name");
var this_id = $(this).attr("id");
var this_lang = $(this).attr("lang");
var this_dir = $(this).attr("dir");
var this_content = $(this).html();

$(this).html("<a><i class=\"fa fa-spinner fa-spin fa-3x fa-fw gen-spin\" aria-hidden=\"true\"></i> ........</a>");

$.post(this_lang, {save_item : this_name, separator : this_dir}, function(data){
if(data == 1){	
$("#"+this_id).html("<a><i class=\"fa fa-heart gen-heart\"></i> Unsave</a>");
}else{
$("#"+this_id).html("<a><i class=\"fa fa-heart-o gen-heart\"></i> Save</a>");
}
})
.error(function() { 
sweetAlert("Notice", "An error occured!", "error");
$("#"+this_id).html(this_content);
});
});
///////////////////////////////////////

$("#owl-content").owlCarousel({
autoPlay: 3000,
items : 1,
itemsDesktop : [1199,1],
itemsDesktopSmall : [992,2],
itemsTablet : [540,1]
});
////////////////////////////////////

//Zoom effect
$(".item-inner").hover(function() {
$(this).children("a").children(".item-picture").css({"-webkit-background-size": "110%", "-moz-background-size": "110%", "-o-background-size": "110%", "background-size": "110%"});
}, function() {
$(this).children("a").children(".item-picture").css({"-webkit-background-size": "100%", "-moz-background-size": "100%", "-o-background-size": "100%", "background-size": "100%"});
});
/////////////////////////////////////

});

function comma_separator(x) {
return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

function load_items_total() {
$.post("privates/process-data/", {load_cart_total : 1}, function(data){
$(".cart-items-counter").html(data);
})
.error(function() { 
sweetAlert("Notice", "An error occured!", "error");
});
$.post("privates/process-data/", {load_cart_items : 1}, function(data){
$(".cart-items-display").html(data);
})
.error(function() { 
sweetAlert("Notice", "An error occured!", "error");
});
}

function my_confirm(conf_title,conf_text,conf_link){
swal({
  title: conf_title,
  text: conf_text,
  type: "warning",
  showCancelButton: true,
  confirmButtonColor: "#DD6B55",
  confirmButtonText: "Yes",
  closeOnConfirm: false
},
function(isConfirm){
  if (isConfirm) {
location.href = conf_link;
  } else {
return false;
  }
});
}

//////////////////////////////////////////////

/////////////////////////////////////////
function get_search(what, url){
$.post(url, {search_item : what}, function(data){ 
if(data == 1){
document.getElementById(del_result).outerHTML = "";
}
 }).error(function() { 
alert("An error occured!");
document.getElementById(del_loader).style.display = "none";
 });	
}

//Fly in effect
var timer = 0;
function recheck() {
    var window_top = $(this).scrollTop();
    var window_height = $(this).height();
    var view_port_s = window_top;
    var view_port_e = window_top + window_height;
     
    if ( timer ) {
      clearTimeout( timer );
    }
     
    $('.fly').each(function(){
      var block = $(this);
      var block_top = block.offset().top;
      var block_height = block.height();
       
      if ( block_top < view_port_e ) {
        timer = setTimeout(function(){
          block.addClass('show-block');
        },100);      
      } else {
        timer = setTimeout(function(){
          block.removeClass('show-block');
        },100);         
      }
    });
}
 
$(function(){
  $(window).scroll(function(){
    recheck();
  });
   
  $(window).resize(function(){
     recheck();  
  });

  recheck();
});
///////////////////////////////////////

//-->