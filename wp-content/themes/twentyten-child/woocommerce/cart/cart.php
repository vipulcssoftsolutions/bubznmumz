<?php
/**
 * Cart Page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.8.0
 */

defined( 'ABSPATH' ) || exit;


?>

        
      
<?php

do_action( 'woocommerce_before_cart' ); ?>

<div class="cart_content">
	<div class="container">
		<div class="row">
<div class="col-lg-9 col-md-12 col-sm-12 col-xs-12">
	<div class="cart_left">
		<div class="table-responsive">
			
<form class="woocommerce-cart-form" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
	<?php do_action( 'woocommerce_before_cart_table' ); ?>

	<table class="shop_table shop_table_responsive cart woocommerce-cart-form__contents table table-bordered" cellspacing="0">
		<colgroup>
			      <col width="280">
                    <col width="170">
                    <col width="120">
                    <col width="130">
                    <col width="120">
         </colgroup>
		<thead>
			<tr>
  			<th class="product-name"><?php esc_html_e( 'Items', 'woocommerce' ); ?></th>
				<th class="product-price"><?php esc_html_e( 'Detail', 'woocommerce' ); ?></th>
				<th class="product-quantity"><?php esc_html_e( 'Quantity', 'woocommerce' ); ?></th>
				<th class="product-subtotal"><?php esc_html_e( 'Total', 'woocommerce' ); ?></th>
			    <th class="product-remove">Remove</th>
			</tr>
		</thead>
		<tbody>
			<?php do_action( 'woocommerce_before_cart_contents' ); ?>

			<?php
			foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
				$_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
				$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

				if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
					$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
					?>
					<tr class="woocommerce-cart-form__cart-item <?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">
						<td class="product-name" data-title="<?php esc_attr_e( 'Product', 'woocommerce' ); ?>">
						<div class="prdct_img2 pull-left">
						<?php
						$thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );

						if ( ! $product_permalink ) {
							echo $thumbnail; // PHPCS: XSS ok.
						} else {
							printf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $thumbnail ); // PHPCS: XSS ok.
						}
						?>
						</div>
						<div class="prdct_info pull-left">
							<h2 class="arrival_name">
						<?php
						if ( ! $product_permalink ) {
							echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ) . '&nbsp;' );
						} else {
							echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $_product->get_name() ), $cart_item, $cart_item_key ) );
						}

						do_action( 'woocommerce_after_cart_item_name', $cart_item, $cart_item_key );
                        ?>
                        </h2>
                        <?php
						// Meta data.
						//echo wc_get_formatted_cart_item_data( $cart_item ); // PHPCS: XSS ok.

						// Backorder notification.
						if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) ) {
							echo wp_kses_post( apply_filters( 'woocommerce_cart_item_backorder_notification', '<p class="backorder_notification">' . esc_html__( 'Available on backorder', 'woocommerce' ) . '</p>', $product_id ) );
						}
						 $productdata = $cart_item['data'];
                         $sku = $productdata->get_sku();
						?>
						<h4 class="arival_brand">Rollas</h4>
						<div class="prdct_code">SKU : <span><?php echo $sku; ?></span></div>
						</div>
						</td>

						<td class="product-price" data-title="<?php esc_attr_e( 'Price', 'woocommerce' ); ?>">
						   <div class="total_price">
							<?php
								echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key ); // PHPCS: XSS ok.
							?>
							</div>
						</td>
						

						<td class="product-quantity" data-title="<?php esc_attr_e( 'Quantity', 'woocommerce' ); ?>">
						
						
						<?php
						if ( $_product->is_sold_individually() ) {
							$product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
						} else {
							$product_quantity = woocommerce_quantity_input(
								array(
									'input_name'   => "cart[{$cart_item_key}][qty]",
									'input_value'  => $cart_item['quantity'],
									'max_value'    => $_product->get_max_purchase_quantity(),
									'min_value'    => '0',
									'product_name' => $_product->get_name(),
								),
								$_product,
								false
							);
						}

						echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item ); // PHPCS: XSS ok.
						?>
						</td>

						<td class="product-subtotal" data-title="<?php esc_attr_e( 'Subtotal', 'woocommerce' ); ?>">
							<?php
								echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); // PHPCS: XSS ok.
							?>
						</td>
						<td class="product-remove">
							<div class="remove_box">
							<?php
								echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
									'woocommerce_cart_item_remove_link',
									sprintf(
										'<a href="%s" class="remove pink_link" aria-label="%s" data-product_id="%s" data-product_sku="%s"><i class="fa fa-times pull-left" aria-hidden="true"></i> Remove</a>',
										esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
										esc_html__( 'Remove this item', 'woocommerce' ),
										esc_attr( $product_id ),
										esc_attr( $_product->get_sku() )
									),
									$cart_item_key
								);
							?>
						   </div>
						</td>
					</tr>
					<?php
				}
			}
			?>

			<?php do_action( 'woocommerce_cart_contents' ); ?>



                
                
			<tr>
				<td colspan="5" class="actions">
					<div class="promo_bar">
                  <div class="col-md-6 col-sm-6 col-xs-12">
					<?php if ( wc_coupons_enabled() ) { ?>
						<div class="coupon">
							<label for="coupon_code"><?php esc_html_e( 'Coupon:', 'woocommerce' ); ?></label> <input type="text" name="coupon_code" class="input-text" id="coupon_code" value="" placeholder="<?php esc_attr_e( 'Coupon code', 'woocommerce' ); ?>" /> <button type="submit" class="button" name="apply_coupon" value="<?php esc_attr_e( 'Apply coupon', 'woocommerce' ); ?>"><?php esc_attr_e( 'Apply code', 'woocommerce' ); ?></button>
							<?php do_action( 'woocommerce_cart_coupon' ); ?>
						</div>
					<?php } ?>
                    </div>
                     <div class="col-md-6 col-sm-6 col-xs-12">
					    <div class="away_msg text-right">You are <span>$5</span> away from <span>free shipping</span></div>	 
					<button type="submit" class="button" name="update_cart" value="<?php esc_attr_e( 'Update cart', 'woocommerce' ); ?>"><?php esc_html_e( 'Update cart', 'woocommerce' ); ?></button>
                    </div>
					<?php do_action( 'woocommerce_cart_actions' ); ?>

					<?php wp_nonce_field( 'woocommerce-cart', 'woocommerce-cart-nonce' ); ?>
				</td>
			</tr>

			<?php do_action( 'woocommerce_after_cart_contents' ); ?>
		</tbody>
	</table>
	<?php do_action( 'woocommerce_after_cart_table' ); ?>
</form>
</div>

<?php do_action( 'woocommerce_before_cart_collaterals' ); ?>

<div class="cart_payment">
	<div class="col-xs-12">
		<div class="row">
			<div class="col-md-6 padd0 col-sm-5 col-xs-12">
                        <div class="third_party_pay">
                          <h3>safe &amp; secure</h3>
                          <ul class="list-inline payment_option">
                            <li><a href="#"><img src="<?php echo site_url(); ?>/wp-content/uploads/2020/06/pay_1.png" alt="" class="img-responsive"></a></li>
                            <li><a href="#"><img src="<?php echo site_url(); ?>/wp-content/uploads/2020/06/pay_2.png" alt="" class="img-responsive"></a></li>
                            <li><a href="#"><img src="<?php echo site_url(); ?>/wp-content/uploads/2020/06/pay_3.png" alt="" class="img-responsive"></a></li>
                            <li><a href="#"><img src="<?php echo site_url(); ?>/wp-content/uploads/2020/06/pay_8.png" alt="" class="img-responsive"></a></li>
                          </ul>
                        </div>
                        <div class="clearfix"></div>
                        <div class="third_party_pay">
                          <h3>Processed By</h3>
                          <ul class="list-inline payment_option">
                            <li><a href="#"><img src="<?php echo site_url(); ?>/wp-content/uploads/2020/06/pay_7.png" alt="" class="img-responsive"></a></li>
                            <li><a href="#"><img src="<?php echo site_url(); ?>/wp-content/uploads/2020/06/pay_4-1.png" alt="" class="img-responsive"></a></li>
                            <div class="clearfix"></div>
                          </ul>
                        </div>
                        <div class="clearfix"></div>
                        <a href="#" class="pink_btn">Continue Shopping</a>
                      </div>
                      <div class="col-md-6 padd0 col-sm-7 col-xs-12">
						  <div class="payment_dlt_box">
	<?php
		/**
		 * Cart collaterals hook.
		 *
		 * @hooked woocommerce_cross_sell_display
		 * @hooked woocommerce_cart_totals - 10
		 */
		do_action( 'woocommerce_cart_collaterals' );
	?>
	</div>
	  </div>
	  </div>
	</div>
</div>
</div>
</div>

<div class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
              <div class="sidebar">
                <div class="sidebar_block">
                  <div class="sidebar_heading">
                    <h4 class="pull-left">Faqs</h4>
                    <img src="<?php echo site_url(); ?>/wp-content/uploads/2020/06/question_icon-1.png" alt="" class="img-responsive pull-right">
                    <div class="clearfix"></div>
                  </div>
                  <div class="sidebar_content">
                    <div class="panel-group" id="Faqs">
                      <div class="panel panel-default">
                        <div class="panel-heading">
                          <h4 class="panel-title">
                          <a data-toggle="collapse" data-parent="#Faqs" href="#detail" aria-expanded="true" class="">
                          Details</a>
                          </h4>
                        </div>
                        <div id="detail" class="panel-collapse collapse in" aria-expanded="true" style="">
                          <div class="panel-body">Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                            sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad
                            minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
                          commodo consequat.</div>
                        </div>
                      </div>
                      <div class="panel panel-default">
                        <div class="panel-heading">
                          <h4 class="panel-title">
                          <a data-toggle="collapse" data-parent="#Faqs" href="#instruction" class="collapsed" aria-expanded="false">
                          Instruction</a>
                          </h4>
                        </div>
                        <div id="instruction" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                          <div class="panel-body">Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                            sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad
                            minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
                          commodo consequat.</div>
                        </div>
                      </div>
                      <div class="panel panel-default">
                        <div class="panel-heading">
                          <h4 class="panel-title">
                          <a data-toggle="collapse" data-parent="#Faqs" href="#delivery" class="collapsed" aria-expanded="false">
                          Shipping &amp; Delivery</a>
                          </h4>
                        </div>
                        <div id="delivery" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                          <div class="panel-body">Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                            sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad
                            minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
                          commodo consequat.</div>
                        </div>
                      </div>
                      <div class="panel panel-default">
                        <div class="panel-heading">
                          <h4 class="panel-title">
                          <a data-toggle="collapse" data-parent="#Faqs" href="#return" class="collapsed" aria-expanded="false">
                          Return</a>
                          </h4>
                        </div>
                        <div id="return" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                          <div class="panel-body">Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                            sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad
                            minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
                          commodo consequat.</div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="sidebar_block">
                  <div class="sidebar_heading">
                    <h4 class="pull-left">customer service</h4>
                    <img src="<?php echo site_url(); ?>/wp-content/uploads/2020/06/customer_icon.png" alt="" class="img-responsive pull-right">
                    <div class="clearfix"></div>
                  </div>
                  <div class="sidebar_content">
                    <ul>
                      <li><i class="fa fa-envelope" aria-hidden="true"></i><a href="mailto:www.example.com">www.example.com</a></li>
                      <div class="clearfix"></div>
                      <li><i class="fa fa-phone" aria-hidden="true"></i><a href="tel:+91-9417154753">+91-9417154753</a></li>
                      <div class="clearfix"></div>
                      <li><i class="fa fa-clock-o" aria-hidden="true"></i>Mon-Fri 9:00 AM To 5:00 PM</li>
                      <div class="clearfix"></div>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
            
           </div>
           </div>
           </div> 
<?php echo do_shortcode('[new_arrivals_section_on_home_page]'); ?>


<?php do_action( 'woocommerce_after_cart' ); ?>
