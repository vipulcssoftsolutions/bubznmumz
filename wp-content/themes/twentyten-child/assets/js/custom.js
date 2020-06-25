


jQuery(".navbar-nav > li ").click(function(){
    jQuery(this).children(".submenu_outer").toggleClass("mob_open");
});


// Cart open close 

jQuery(".cart_box").mouseenter(function(){
    jQuery(".cart_container").addClass("cart_open");
});

jQuery(".cart_container").mouseleave(function(){
    jQuery(this).removeClass("cart_open");
});



jQuery(document).ready(function(){
    jQuery(".mobile-toggle").click(function(){
        jQuery("#navbar1.mobile-menu").toggleClass("menu-show");
    });
});

jQuery('.main_banner').slick({
  infinite: true,
  slidesToShow: 1,
  slidesToScroll: 1,
  arrows:false,
  dots:true,
  /*autoplay:true,*/
  autoplaySpeed: 3000,
  speed:800
});

jQuery('.new_arival_outer').slick({
  infinite: true,
  slidesToShow: 5,
  slidesToScroll: 1,
  dots:true,
  autoplay:false,
  autoplaySpeed: 3000,
  draggable: false,
  speed:500,
  arrows:true,
      responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 4,
      }
    },
        {
      breakpoint: 991,
      settings: {
        slidesToShow: 3,
      }
    },
            {
      breakpoint: 600,
      settings: {
        slidesToShow: 2,
      }
    },
                {
      breakpoint: 400,
      settings: {
        slidesToShow: 2,
        autoplay:false
      }
    },
  ]
});


jQuery('.blog_outer').slick({
  infinite: true,
  slidesToShow: 3,
  slidesToScroll: 1,
  dots:false,
  arrows:true,
      responsive: [
    {
      breakpoint: 991,
      settings: {
        slidesToShow: 2,
      }
    },
        {
      breakpoint: 600,
      settings: {
        slidesToShow: 1,
      }
    }
  ]
});

 jQuery('.product_big_outer').slick({
  slidesToShow: 1,
  slidesToScroll: 1,
  arrows: false,
  fade: true,
  asNavFor: '.product_thumb'
});
jQuery('.product_thumb').slick({
  slidesToShow: 4,
  slidesToScroll: 1,
  asNavFor: '.product_big_outer',
  dots: false,
  focusOnSelect: true,
  arrows:false,
  responsive:[
    {
      breakpoint:1199,
        settings:{
            slidesToShow: 3,
        }
    }
  ]
});


jQuery('.side_prdct_slider').slick({
  infinite: true,
  slidesToShow: 3,
  slidesToScroll: 1,
  arrows:true,
  dots:false,
  vertical: true,
  draggable: true,
  centerPadding: "0px",
  swipe: true,
  touchMove: true,
  prevArrow:'.top_btn i',
  nextArrow:'.bottom_btn i',
  verticalSwiping:true,
  autoplay:true
});



jQuery(document).ready(function () {
  var jQuerynav = jQuery('.navbar-nav > li');
  jQuerynav.hover(
    function() {
            jQuery(this).children('a').addClass('hovered')
      jQuery('.submenu_outer', this).stop().slideDown(400);
    },
    function() {
            jQuery(this).children('a').removeClass('hovered')
      jQuery('.submenu_outer', this).slideUp(50);
    }
  );
});




jQuery(document).ready(function () {
   jQuery(".radio_label_box label").click(function() {
      // remove classes from all
      jQuery("label").removeClass("active");
      // add class to the one we clicked
      jQuery(this).addClass("active");
   });
});

jQuery(window).scroll(function() {    
    var scroll = jQuery(window).scrollTop();

    if(scroll >= 87) {
        jQuery(".fix_head").addClass("fixed_nav");
    } else {
        jQuery(".fix_head").removeClass("fixed_nav");
    }
});





	
	
jQuery(document).on("mouseenter", '.new-arival_box .arival_img img', function(event) { 
        jQuery(this).closest(".new-arival_box").addClass("hover-active");
        jQuery(".new_arival_outer .slick-list").css("z-index", "700");
});

jQuery(document).on("mouseleave", '.new-arival_box', function(event) { 
	  jQuery(this).removeClass("hover-active");
        jQuery(".new_arival_outer .slick-list").css("z-index", "500");
});
  


  //Click event to scroll to top
  jQuery('#top_link i').click(function(){
    jQuery('html, body').animate({scrollTop : 0},400);
    return false;
  });


jQuery(".product_filters h2 i").click(function(){
    jQuery(this).toggleClass("icon-move");
    jQuery("#accordion").slideToggle();
});

jQuery('.ex1').slider();



if (jQuery('#back-to-top').length) {
    var scrollTrigger = 100, // px
        backToTop = function () {
            var scrollTop = jQuery(window).scrollTop();
            if (scrollTop > scrollTrigger) {
                jQuery('#back-to-top').addClass('show');
            } else {
                jQuery('#back-to-top').removeClass('show');
            }
        };
    backToTop();
    jQuery(window).on('scroll', function () {
        backToTop();
    });
    jQuery('#back-to-top').on('click', function (e) {
        e.preventDefault();
        jQuery('html,body').animate({
            scrollTop: 0
        }, 700);
    });
};


var headerHeight = jQuery(".fix_head").height() + 30; // Get fixed header height

    jQuery(document).on('click', '.product_full_dtail p a', function(event) {
        var jQueryanchor = jQuery(this);
        jQuery('html, body').stop().animate({
            scrollTop: (jQuery(jQueryanchor.attr('href')).offset().top - headerHeight )
          }, 1400,);
        event.preventDefault();
    });

 

jQuery('.product_list_content .new-arival_box').equalHeights();

jQuery(".srchsubmit").on('click',function(){
jQuery("input#searchsubmit").click();
})
