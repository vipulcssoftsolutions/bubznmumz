<?php
/**
 * Checkout Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-checkout.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

do_action( 'woocommerce_before_checkout_form', $checkout );

// If checkout registration is disabled and not logged in, the user cannot checkout.
if ( ! $checkout->is_registration_enabled() && $checkout->is_registration_required() && ! is_user_logged_in() ) {
	echo esc_html( apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'woocommerce' ) ) );
	return;
}

?>

<form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data">
	<?php if ( $checkout->get_checkout_fields() ) : ?>
		<?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>
        
<div class="row">
    <div class="col-md-4 col-sm-6 col-xs-12">
        <div class="process_block">
           <div class="header2">
              <div class="header_iner">
                <img src="https://woocommerce-427082-1340050.cloudwaysapps.com/wp-content/uploads/2020/07/cart_icon2.png" alt="">
                <h2>Bag</h2>
              </div>
           </div>
        

	<?php do_action( 'woocommerce_before_cart_table' ); ?>
			<?php 
                do_action( 'woocommerce_before_cart_contents' ); 
            ?>
			<?php
             $i=0;
			foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
                $i++;
              
                ?>
                    <div class="proces_content">
            <?php   
                    $cart_count = WC()->cart->cart_contents_count; // Set variable for cart item count
                    $cart_url = wc_get_cart_url();
                    if($i==1){ ?><div class="total_items"><?php echo $cart_count; ?><?php if($cart_count > 1){ echo ' items'; }else{ echo ' item'; } ?></div><?php } ?>
                        <?php
				$_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
				$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );
                
				if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
					$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
					?>
                
						<div class="prdt_img">
						<?php
						$thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );

						if ( ! $product_permalink ) {
							echo $thumbnail; // PHPCS: XSS ok.
						} else {
							printf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $thumbnail ); // PHPCS: XSS ok.
						}
						?>
						</div>
						<div class="prdct_dtl">
							<h3 class="arrival_name text-center">
						<?php
						if ( ! $product_permalink ) {
							echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ) . '&nbsp;' );
						} else {
							echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s">'.$_product->get_title().'</a>', esc_url( $product_permalink ), $_product->get_name() ), $cart_item, $cart_item_key ) );
						}

						do_action( 'woocommerce_after_cart_item_name', $cart_item, $cart_item_key );
                        ?>
                           </h3>
                        <?php
						// Meta data.
						//echo wc_get_formatted_cart_item_data( $cart_item ); // PHPCS: XSS ok.

						// Backorder notification.
						if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) ) {
							echo wp_kses_post( apply_filters( 'woocommerce_cart_item_backorder_notification', '<p class="backorder_notification">' . esc_html__( 'Available on backorder', 'woocommerce' ) . '</p>', $product_id ) );
						}
						 $productdata = $cart_item['data'];
                         $sku = $productdata->get_sku();
                         $brand_name = wp_get_post_terms($cart_item['product_id'], 'product_brand' );
                         if ( $brand_name && ! is_wp_error ( $brand_name ) ){
                         $single_brand = array_shift( $brand_name );
                            ?>
                                <h5 class="arival_brand text-center"><?php echo $single_brand->name; ?></h5>
                            <?php
                            }
						?>
                        <div class="arival-price text-center">
                            <?php
								echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key ); // PHPCS: XSS ok.
							?></div>
                       <div class="prdct_code">SKU: <span><?php echo $sku; ?></span></div>    
                            <div class="prdct_code">Size : <span> <?php echo $cart_item['variation']['attribute_pa_size']; ?></span></div>
                                <div class="prdct_code">Colour : <span><?php echo $cart_item['variation']['attribute_pa_color']; ?></span></div> 
                                <div class="prdct_code">Quantity : <span><?php echo $cart_item['quantity']; ?></span></div>     
                </div>   
						    </div>
					<?php
				}
			}
?>

 <a href="<?php echo site_url(); ?>/shop" class="pink_btn countinue_bTN">Continue Shopping</a>
        </div>
</div>
      <div class="col-md-4 col-sm-6 col-xs-12">
          <div class="process_block form-onchkout">
                <div class="header2">
                  <div class="header_iner">
                    <img src="https://woocommerce-427082-1340050.cloudwaysapps.com/wp-content/uploads/2020/07/truck_icon2.png" alt="">
                    <h2>Delivery</h2>
                  </div>
                </div>
                <?php
                if (is_user_logged_in()) {
                    ?>
                    <h4>Delivery Address</h4>
                    <div id="customer_details">
                    <div class="billing-fld">
                    <?php do_action('woocommerce_checkout_billing'); ?>
                  </div>      
                    <div class="shipping-fld">
                    <?php do_action('woocommerce_checkout_shipping'); ?>
                              <div class="when_deliver">
                                  <h4>Shipping</h4>
                        <?php wc_cart_totals_shipping_html(); ?>
                                </div>
                    </div>
              
                </div>
              <?php
                  }
                  else
                  {
                  ?>
                  </form>
                  <h4>hi There!</h4>
                  <p>Please Enter Your Email Address To Continue To Delivery And Payment.</p>
                  <!-- <input type="text" placeholder="Email Address...">
                  <a href="javascript:void(0);" class="blue_btn">Continue</a> -->
                  <?php
                  // wp_login_form();
                  echo do_shortcode('[woocommerce_my_account] '); 
                  ?>
                  <a href="javascript:void(0);" class="pink_btn guest_btn">Login as Guest</a>
                  <span class="or">or</span>
                  <div class="social_btns2">
                    <a href="https://www.facebook.com/" target="_blank" class="facebook_BTN">
                      <span>
                        <i class="fa fa-facebook" aria-hidden="true"></i>
                        Login With Facebook
                      </span>
                    </a>
                    <a href="https://accounts.google.com" target="_blank" class="google_BTN">
                      <span>
                        <!-- <i class="fa fa-google-plus" aria-hidden="true"></i> -->
                        <i class="fa fa-google-plus-square" aria-hidden="true"></i>

                        Sign in with google
                      </span>
                    </a>
                  </div>
              
                    <?php
                  }
              ?>
        </div>
    </div>
          
		<?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>

	<?php endif; ?>
   <div class="col-md-4 col-sm-12 col-xs-12">
       <div class="process_block payment_method">
       <div class="header2">
                  <div class="header_iner">
                    <img src="https://woocommerce-427082-1340050.cloudwaysapps.com/wp-content/uploads/2020/07/card_icon.png" alt="">
                    <h2>payment</h2>
                  </div>
                </div>
        <h4>Payment Method</h4>   
	<?php do_action( 'woocommerce_checkout_before_order_review_heading' ); ?>	
	<!--<h3 id="order_review_heading"><?php esc_html_e( 'Your order', 'woocommerce' ); ?></h3> -->
	
	<?php do_action( 'woocommerce_checkout_before_order_review' ); ?>

	<div id="order_review" class="woocommerce-checkout-review-order">
		<?php do_action( 'woocommerce_checkout_order_review' ); ?>
	</div>
    
	<?php do_action( 'woocommerce_checkout_after_order_review' ); ?>
    </div>   
    </div>   


</div>
<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>
