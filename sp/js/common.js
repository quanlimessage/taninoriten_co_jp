// JavaScript Document
$(function() {

	//SCROLL TO TOP
	$(".page_up a").click(function () {
      $('body, html').animate({ scrollTop: 0 }, 500);
      return false;
  });
	//More-Less Text
	$(".maxheight_show").append("<span class='maxheight_btn'>...続き»</span>");
	$(".maxheight_hide").append("<span class='maxheight_btn'>閉じる</span>");
	$(".maxheight_show .maxheight_btn").on('click',function(){
		$(this).parent().next(".maxheight_hide").slideDown();
		$(this).hide();
	});
	$(".maxheight_hide .maxheight_btn").on('click',function(){
		$(this).parent().slideUp(function(){
			$(this).prev(".maxheight_show").children(".maxheight_btn").show();
		});
	});
	//accordion only 1 item open
	$(document).ready(function(){
	  $(".acco_box02 .acco_a02").next().hide();
	   $(".acco_box02 .acco_a02").click(function(){
	   $(this).next(".acco_dv02").slideToggle("slow")
	   .siblings(".acco_dv02:visible").slideUp("slow");
	   $(this).toggleClass("opened");
	   $(this).siblings(".acco_a02").removeClass("opened");
	  });
	 });
	//accordion 
	$('.acco_box .acco_a').on("click",function(){
		$(this).toggleClass('opened');
		$(this).next('.acco_dv').slideToggle('slow');
	});

	//gnav 
  	$('.btn_gnav').on("click",function(){
    $(this).toggleClass('opened');
    $('#gnav').toggleClass('opened');
    $('#gnav').slideToggle('slow');
  	});
});

// auto height
(function($) {
    $.fn.tile = function(columns) {
        var tiles, max, c, h, last = this.length - 1, s;
        if(!columns) columns = this.length;
        this.each(function() {
            s = this.style;
            if(s.removeProperty) s.removeProperty("height");
            if(s.removeAttribute) s.removeAttribute("height");
        });
        return this.each(function(i) {
            c = i % columns;
            if(c == 0) tiles = [];
            tiles[c] = $(this);
            h = tiles[c].height();
            if(c == 0 || h > max) max = h;
            if(i == last || c == columns - 1)
                $.each(tiles, function() { this.height(max); });
        });
    };
})(jQuery);
$(window).load(function(){
    $('.ctn01 li h4').tile(3);
});
//swap image
$(function(){
  $("#Thumbs img").hover(function(){
    $(this).css("cursor","pointer"); 
  },function(){
    $(this).css("cursor","default"); 
    });
  $("#Thumbs img").click(function(){
                                     
    var id = $(this).attr("class");
    $("#Thumbs li").removeClass('active');
    $(this).closest('li').addClass('active');
    
    if ($("#Fade" + id).attr("src") !== $(this).attr("src")) {
      $("#Fade" + id)
      .css('display','none')
      .attr("src",$(this).attr("src"))
      .fadeIn(700)
      .closest('a').attr("href",$(this).attr("src"));
      return false;
    }
    
  })
});