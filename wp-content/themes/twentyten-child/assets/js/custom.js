
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

jQuery(".arival_img").on('click',function(){
var redirect = jQuery(this).find('a').attr('href');
window.location.replace(redirect);
});


jQuery(".row-column-switcher .column-switcher").on('change',function(){
var colperrow = jQuery(this).val();
jQuery(".products_outer_box ul.products").removeClass('columns-2');
jQuery(".products_outer_box ul.products").removeClass('columns-3');
jQuery(".products_outer_box ul.products").removeClass('columns-4');
jQuery(".products_outer_box ul.products ").addClass("columns-"+colperrow);
});


jQuery("div[data-attribute_name='attribute_pa_size'] input").on('change',function(){
var changedsize = jQuery(this).val();
jQuery(this).parents('tr').children('td.label').html('<label for="pa_size">Size </label><span class="varlabelval">: '+changedsize+'</span>');
var prdcode = jQuery(".stock_block").find('.sku').text();
jQuery(".prdct_code").html('SKU: <span>'+prdcode+'</span>');
});

jQuery("select[data-attribute_name='attribute_pa_color']").on('change',function(){
var changedcolor = jQuery(this).val();
jQuery(this).parents('tr').children('td.label').html('<label for="pa_size">Colour </label><span class="varlabelval">: '+changedcolor+'</span>');
var prdcode = jQuery(".stock_block").find('.sku').text();
jQuery(".prdct_code").html('SKU:<span>'+prdcode+'</span>');
});


});

jQuery(document).on("click",".reset_variations",function() {
jQuery(".varlabelval").remove();
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
  autoplay:false,
  autoplaySpeed: 3000,
  draggable: false,
  speed:500,
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
    if(scroll >= 2) {
        jQuery(".wrap-main-head").addClass("fixed_nav");
        jQuery(".top_bar").slideUp().hide();
    } else {
        jQuery(".wrap-main-head").removeClass("fixed_nav");
        jQuery(".top_bar").slideDown().show();
    }
});	
	
jQuery(document).on("mouseenter", '.new-arival_box .arival_img img', function(event) { 
        jQuery(this).closest(".new-arival_box").addClass("hover-active");
        jQuery(".new_arival_outer .slick-list").css("z-index", "700");
});

jQuery(".yith-wfbt-images .image-td").each(function(){
var datarel = jQuery(this).data('rel');
var prodname = jQuery("ul.yith-wfbt-items li label[for="+datarel+"] span.product-name").text();
prodname = prodname.replace('This Product:','');
jQuery(this).append('<h5 class="prct_name text-center">'+prodname+'</h5>');
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

jQuery(".woocommerce-checkout .coun-code-btn").on('click',function(){
    var couponcode = jQuery(".promo_box_coupon").children('input').val();
    if(couponcode == ""){
       jQuery(".promo_box_coupon").children('input').addClass('error');
    }else{
      jQuery(".woocommerce-form-coupon").find('#coupon_code').val(couponcode);
      jQuery("form.woocommerce-form-coupon").submit();
      window.scrollTo(0, 0);     
    }
})
