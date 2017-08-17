//smartRollover.js
function smartRollover() {
	if(document.getElementsByTagName) {
		var images = document.getElementsByTagName("img");

		for(var i=0; i < images.length; i++) {
			if(images[i].src.match("_off."))
			{
				images[i].onmouseover = function() {
					this.setAttribute("src", this.getAttribute("src").replace("_off.", "_on."));
				}
				images[i].onmouseout = function() {
					this.setAttribute("src", this.getAttribute("src").replace("_on.", "_off."));
				}
			}
		}
	}
}

if(window.addEventListener) {
	window.addEventListener("load", smartRollover, false);
}
else if(window.attachEvent) {
	window.attachEvent("onload", smartRollover);
}

$(function() {
	
	//SCROLL TO TOP
	$(".page_up a").click(function () {
      $('body, html').animate({ scrollTop: 0 }, 500);
      return false;

	});
});

$(function() {
	$('a img').on({
		'mouseenter':function() {
			$(this).fadeTo(200, 0.6);
		},
		'mouseleave':function() {
			$(this).fadeTo(200, 1.0);
		}
	});
    $('a.link_over').on({
        'mouseenter':function() {
            $(this).fadeTo(200, 0.6);
        },
        'mouseleave':function() {
            $(this).fadeTo(200, 1.0);
        }
    });
    $('.imghover_on').each(
        function() {
            this.onImage = $(this).attr('src').replace(/^(.+)(\.[a-z]+)$/,"$1"+'_on'+"$2");
            this.onHtml = $('<img src="'+this.onImage+'" alt="" style="position:absolute; opacity:0;" />');
            $(this).before(this.onHtml);
            $(this.onHtml).hover(
                function() {
                    $(this).stop().animate({'opacity': '1'}, 100);
                },
                function() {
                    $(this).stop().animate({'opacity': '0'}, 100);
                }
            )
        }
    )
});


// SMOOTH SCROLL

$(function() {
  $('a[href*="#"]:not([href="#"])').click(function() {
    if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
      var target = $(this.hash);
      target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
      if (target.length) {
        $('html, body').animate({
          scrollTop: target.offset().top
        }, 1000);
        return false;
      }
    }
  });
   // fade in #back-top
  $("#back-top").hide();
  
  $(window).scroll(function () {
    if ($(this).scrollTop() > 100) {
      $('#back-top').fadeIn();
    } else {
      $('#back-top').fadeOut();
    }
  });

  // scroll body to 0px on click
  $('#back-top a').click(function () {
    $('body,html').animate({
      scrollTop: 0
    }, 800);
    return false;
  });
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