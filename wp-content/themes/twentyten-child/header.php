<?php
/**
 * Header template for our theme
 *
 * Displays all of the <head> section and everything up till <div id="main">.
 *
 * @package WordPress
 * @subpackage twentyten
 * @since twentyten 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">

<?php wp_head(); ?>
</head>
<?php
     global $woocommerce;
     $amount2 = floatval( preg_replace( '#[^\d.]#', '', $woocommerce->cart->get_cart_total() ) );
     $items = $woocommerce->cart->get_cart();
   ?> 
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<a href="#" id="back-to-top" title="Go to top"><i class="fa fa-angle-up" aria-hidden="true"></i></a>
    <!--******************************Top Bar Start****************************-->
    <div class="top_bar">
      <div class="container">
        <div class="row">
          <div class="col-md-5 col-sm-4 col-xs-12">
			  <?php
			  $woocsdata = get_option('woocs');
            global $WOOCS;
            
        $currencurrency = $WOOCS->current_currency;
		$updateprice = $woocsdata[$currencurrency]['rate']; 
		$updatedsymbol =  $woocsdata[$currencurrency]['symbol'];
		$updatedposition =   $woocsdata[$currencurrency]['position'];
		$shippingprc = 69 * $updateprice;
	     ?>
            <p>FREE Shipping on orders over <?php echo $updatedsymbol.round($shippingprc,2) ?></p>
          </div>
          <div class="col-md-7 col-sm-8 col-xs-12">
            <div class="filters pull-right">
              <div class="curruncy_box pull-left">
                <span>Currency:</span>
                <?php echo do_shortcode( '[woocs show_flags=1 txt_type="desc" style=ddslick flag_position=left ]' ); ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="fix_head">
      <!--******************************Logo Bar Start****************************-->
      <div class="logo_bar">
        <div class="container">
          <div class="row">
            <div class="col-md-6 col-sm-12 col-xs-12">
              <div class="logo_section">
                <div class="logo pull-left">
                  <a href="<?php echo site_url(); ?>"><img src="<?php echo site_url(); ?>/wp-content/uploads/2020/06/logo.png" alt="" class="img-responsive"></a>
                </div>

                <?php wp_nav_menu( array( 'theme_location' => 'top-menu','menu_class' => 'list-inline pull-left mobile-list' ) ); ?>

                <div class="clearfix"></div>
              </div>
            </div>
            <div class="col-md-6 col-sm-12 col-xs-12">
              <div class="login_area pull-right">
                <div class="src_box pull-left">
					<?php echo do_shortcode('[apsw_search_bar_preview]'); ?>
				</div>
                <div class="small-right">
                  <div class="login_box pull-left">
                    <img src="<?php echo site_url(); ?>/wp-content/uploads/2020/06/user_icon-1.png" alt="" class="img-responsive pull-left">
                    <ul class="list-inline pull-left ">
                      <li><a href="#">Login |</a></li>
                      <li><a href="#">Join</a></li>
                    </ul>
                  </div>
                  <div class="wishlist_box pull-left">
                    <a href="#">
                      <img src="<?php echo site_url(); ?>/wp-content/uploads/2020/06/heart_icon.png" alt="" class="img-responsive pull-left">
                      <span>Wishlist</span>
                    </a>
                  </div>
                  <div class="cart_box pull-left">
                  <?php  echo do_shortcode('[woo_cart_but]'); ?>
 <?php
    global $woocommerce;
     $amount2 =   $woocommerce->cart->get_cart_total();
    $items = $woocommerce->cart->get_cart();
    $cart_count = WC()->cart->cart_contents_count; // Set variable for cart item count

?>    
                    <div class="cart_container">

                      <ul>
		<?php
		
		
	if(!empty($items)){					  
	    foreach($items as $item => $values) { 
            $_product =  wc_get_product( $values['data']->get_id()); 
            $image = wp_get_attachment_image_src( get_post_thumbnail_id( $values['product_id'] ), 'full' );
            $woocsdata = get_option('woocs');
            global $WOOCS;
            
        $currencurrency = $WOOCS->current_currency;
		$updateprice = $woocsdata[$currencurrency]['rate']; 
		$updatedsymbol =  $woocsdata[$currencurrency]['symbol'];
		$updatedposition =   $woocsdata[$currencurrency]['position'];
            ?>
           
            <li>
                          <span class="prdct_img">
                            <a href=""><img src="<?php echo $image[0]; ?>" alt="" class="img-responsive"></a>
                          </span>
                          <div class="prdtc_dtls">
                            <h3 class="arrival_name text-left"><?php echo $_product->get_title() ?></h3>
                            <div class="prdct_clr">Colour :  Black</div>
                            <div class="size_txt">Size :   <?php echo $values['variation']['attribute_pa_size']; ?></div>
                            <div class="Quantity_head">Quantity : <?php echo $values['quantity']; ?></div>
                            <?php 
                            $price = get_post_meta($values['product_id'] , '_price', true); 
                            $totalamtt = $updateprice * $price;
                           
                            ?>
                            <div class="rrp_price">Sale Price: <?php echo $updatedsymbol.round($totalamtt,2); ?></div>
                          </div>
                          <div class="clearfix"></div>
              </li>            
                <?php          
        } 
     }   
        ?>
                      </ul>
                      <?php
                       $shipprcwdcur = 69 * $updateprice;
                        $newpricestr =  preg_replace('/&#36;/','',$amount2); 
                        $amount = floatval(preg_replace( "/[^0-9\.]/",'',$newpricestr));
                       $shippingprc = round($shipprcwdcur - $amount,2); 
                      ?>
                      <p class="subtotl"><b>Cart Subtotal</b> (<?php echo $cart_count; ?> Item) : <span><?php echo $amount2; ?></span></p>
                      <button class="blue_btn" onclick="window.location.href='<?php echo wc_get_cart_url(); ?>'">VIEW CART</button>
                      <?php 
                      if($shippingprc > 0){
						?>
                      <div class="away_msg text-center">You are <span><?php echo $updatedsymbol.$shippingprc; ?></span> away from <span>free shipping</span></div>
                      <?php }else{ ?>
					  <div class="away_msg text-center">You are <span>eligible</span> for <span>free shipping</span></div>  
					  <?php } ?>	   
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!--************************************Navigation Start***********************-->
 <div class="main-menu">     
	<div class="container"> 
<?php wp_nav_menu( array( 'theme_location' => 'primary-theme-menu' ) ); ?>
    </div>
</div>      
</div>
