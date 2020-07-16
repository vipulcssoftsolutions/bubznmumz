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
			<?php 
                do_action( 'woocommerce_before_cart_contents' ); 
            ?>
			<?php
            $cat_ids=array();
			foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
				$_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
				$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );
                $cat_ids[] = $cart_item['data']->get_category_ids(); 
                
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
							echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s">'.$_product->get_title().'</a>', esc_url( $product_permalink ), $_product->get_name() ), $cart_item, $cart_item_key ) );
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
                         $brand_name = wp_get_post_terms($cart_item['product_id'], 'product_brand' );
                         if ( $brand_name && ! is_wp_error ( $brand_name ) ){
                         $single_brand = array_shift( $brand_name );
                            ?>
                                <h4 class="arival_brand"><?php echo $single_brand->name; ?></h4>
                            <?php
                            }
						?>
						<div class="prdct_code">SKU : <span><?php echo $sku; ?></span></div>
						</div>
						</td>
						<td class="product-price" data-title="<?php esc_attr_e( 'Price', 'woocommerce' ); ?>">
                            <div class="prdct_dtl2">
                            <div class="unit_price"><b>UNIT PRICE : </b>
                            <?php
								echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key ); // PHPCS: XSS ok.
							?></div>
                            <div class="size_txt"><b>SIZE : </b> <?php echo $cart_item['variation']['attribute_pa_size']; ?></div>
                            <div class="prdct_clr"><b>COLOUR :</b>  <?php echo $cart_item['variation']['attribute_pa_color']; ?></div>                               
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
                            <div class="total_price">
							<?php
								echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); // PHPCS: XSS ok.
                                global $WOOCS;        
                                $currencurrency = $WOOCS->current_currency;
                                echo ' ('.$currencurrency.')';
							?>                                    
                            </div>    
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

            do_action( 'woocommerce_cart_contents' ); ?>
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
        <?php
        $woocsdata = get_option('woocs');
        global $WOOCS;    
        $amount2 =   WC()->cart->get_cart_total();                 
        $currencurrency = $WOOCS->current_currency;
		$updateprice = $woocsdata[$currencurrency]['rate']; 
		$updatedsymbol =  $woocsdata[$currencurrency]['symbol'];
		$updatedposition =   $woocsdata[$currencurrency]['position'];
        $shipprcwdcur = get_field('free_shipping_price','option') * $updateprice;
        $newpricestr =  preg_replace('/&#36;/','',$amount2); 
        $amount = floatval(preg_replace( "/[^0-9\.]/",'',$newpricestr));
        $shippingprc = round($shipprcwdcur - $amount,2);                 
	     ?>
                            <?php 
                      if($shippingprc > 0){
						?>
                      <div class="away_msg text-right">You are <span><?php echo $updatedsymbol.$shippingprc; ?></span> away from <span>free shipping</span></div>
                      <?php }else{ ?>
					  <div class="away_msg text-right">You are <span>eligible</span> for <span>free shipping</span></div>  
					  <?php } ?>
                         
                         
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
                <?php 
                $cart_section_in_left_of_cart_total = get_field('cart_section_in_left_of_cart_total_section','option'); 
                if($cart_section_in_left_of_cart_total){
                    foreach($cart_section_in_left_of_cart_total as $itemsinloop){
                    ?>    
                        <div class="third_party_pay">
                              <h3><?php echo $itemsinloop['section_title']; ?></h3>
                              <ul class="list-inline payment_option">
                                <?php 
                                 $imaggallery = $itemsinloop['section_image_gallery']; 
                                 if($imaggallery){ 
                                     foreach($imaggallery as $image){
                                      $img_atts = wp_get_attachment_image_src( $image, 'full' );
                                      $img_src = $img_atts[0];      
                                  ?>  
                                <li><a href="#"><img src="<?php echo $img_src; ?>" alt="" class="img-responsive"></a></li>
                                <?php
                                      }
                                    } 
                                  ?>  
                              </ul>
                            </div>
                         <div class="clearfix"></div>    
                    <?php  
                    }
                }
                ?>
                        <a href="<?php echo site_url(); ?>" class="pink_btn">Continue Shopping</a>
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
                <?php 
                    $cart_sidebar = get_field('cart_sidebar','option');
                    if($cart_sidebar){
                    
                ?>      
                <div class="sidebar_block">
                <?php $accordian_section = $cart_sidebar['accordian_section']; 
                    
                    if($accordian_section){
                  ?>
                  <div class="sidebar_heading">
                    <h4 class="pull-left"><?php echo $accordian_section['accordian_title']; ?></h4>
                    <img src="<?php echo site_url(); ?>/wp-content/uploads/2020/06/question_icon-1.png" alt="" class="img-responsive pull-right">
                    <div class="clearfix"></div>
                  </div>
                  <div class="sidebar_content">
                    <div class="panel-group" id="Faqs">
                    <?php 
                        $i=0;
                        foreach($accordian_section['accordian'] as $accorditem){ 
                        $i++;
                        ?>    
                      <div class="panel panel-default">
                        <div class="panel-heading">
                          <h4 class="panel-title">
                            <?php
                              $labelstripforid = str_replace(' ', '', $accorditem['label']);
                              $labelstripforid = str_replace('&', '', $labelstripforid);
                              ?>  
                          <a data-toggle="collapse" data-parent="#Faqs" href="#<?php echo $labelstripforid; ?>" aria-expanded="<?php if($i ==1){ echo 'true'; }else{ echo 'false'; }  ?>" class="<?php if($i != 1) echo 'collapsed'; ?>">
                          <?php echo $accorditem['label']; ?></a>
                          </h4>
                        </div>
                        <div id="<?php echo $labelstripforid; ?>" class="panel-collapse collapse <?php if($i ==1) echo 'in'; ?>" aria-expanded="<?php if($i ==1){ echo 'true'; }else{ echo 'false'; }  ?>" style="<?php if($i !=1){ echo 'height:0px'; } ?>">
                          <div class="panel-body"><?php echo $accorditem['value']; ?></div>
                        </div>
                      </div>
                    <?php } ?>    
                    </div>
                  </div> 
                <?php } ?>    
                </div>
                <?php  
                  $service_section = $cart_sidebar['service_section'];  
                  if($service_section){
                  ?>  
                <div class="sidebar_block">
                  <div class="sidebar_heading">
                    <h4 class="pull-left"><?php echo $service_section['section_title']; ?></h4>
                    <img src="<?php echo site_url(); ?>/wp-content/uploads/2020/06/customer_icon.png" alt="" class="img-responsive pull-right">
                    <div class="clearfix"></div>
                  </div>
                  <div class="sidebar_content">
                    <ul>
                      <li><i class="fa fa-envelope" aria-hidden="true"></i><a href="mailto:<?php echo $service_section['email_address']; ?>"><?php echo $service_section['email_address']; ?></a></li>
                      <div class="clearfix"></div>
                      <li><i class="fa fa-phone" aria-hidden="true"></i><a href="tel:<?php echo $service_section['mobile_number']; ?>"><?php echo $service_section['mobile_number']; ?></a></li>
                      <div class="clearfix"></div>
                      <li><i class="fa fa-clock-o" aria-hidden="true"></i><?php echo $service_section['service_time_and_weekdays']; ?></li>
                      <div class="clearfix"></div>
                    </ul>
                  </div>
                </div>
              <?php
                  }
                } ?>  
             </div>
           </div> 
           </div>
           </div>
           </div>

            <?php      
        global $post;
        $related = array( 
          'category__in' => $cat_ids[0], 
          'numberposts'  => 4, 
          'post_type'    => 'product'
          );

         $loop = new WP_Query( $related  );
          ?>
<div class="new_Arivals_sec">
                <h2 class="text-center">Related Items</h2>
                <div class="new_arival_outer">
                    <?php
                while ( $loop->have_posts() ) : $loop->the_post(); global $product; ?>
                    <?php
            $product_publish_date = strtotime(get_the_date('Y-m-d', $loop->post->ID));  
            $current_date = strtotime(date('Y-m-d'));
            $diff = abs($product_publish_date - $current_date);
            $years = floor($diff / (365*60*60*24));  
            $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));  
            $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
                            ?>
                    <div class="new-arival_box text-center">
                        <div class="product_detail">
                            <h6 class="exclusive_tag"><?php if($days <= get_field('product_publish_days','option')){ echo 'New Arrivals'; } ?></h6>
                            <div class="liking text-right">
                                <?php echo do_shortcode('[yith_wcwl_add_to_wishlist]') ?>
                            </div>
                            <div class="arival_img">
                                <a href="<?php echo get_permalink( $loop->post->ID ) ?>"> <?php if (has_post_thumbnail( $loop->post->ID )){ echo '<img src="'.get_the_post_thumbnail_url($loop->post->ID, 'full').'" class="img-responsive" />'; }else{ echo '<img src="'.woocommerce_placeholder_img_src().'" alt="Placeholder" width="300px" height="300px" class="img-responsive" />'; } ?></a>
                            </div>
                            <h4 class="sale_name">
                             <?php if($days <= get_field('product_publish_days','option')){ echo 'New Arrivals'; } ?>
                         </h4>
                            <h3 class="arrival_name text-center"><?php the_title(); ?></h3>
                     <?php
                    $termsbrand =  get_the_terms($loop->post->ID, 'product_brand');
                    if($termsbrand){
                      foreach($termsbrand as $terms){
                          echo '<h5 class="arival_brand text-center">'.$terms->name.'</h5>';
                          break;
                      }    
                    }
                     ?>      
                            <div class="arival-price text-center">
                                <?php echo $product->get_price_html(); ?>
                            </div>
                            <?php
                                    $args = array(
                                        'post_type'     => 'product_variation',
                                        'post_status'   => array( 'private', 'publish' ),
                                        'numberposts'   => -1,
                                        'orderby'       => 'menu_order',
                                        'order'         => 'asc',
                                        'post_parent'   => $loop->post->ID  // get parent post-ID
                                    );

                                    $variations = get_posts( $args );
                                    $rrp_price = array();
                                    if($variations){
                                        foreach ( $variations as $variation ) {
                                            // get variation ID
                                            $variation_ID = $variation->ID;
                                            // get variations meta
                                            $product_variation = new WC_Product_Variation( $variation_ID );
                                            // get variation featured image
                                            $variation_image = $product_variation->get_image();
                                            // get variation price
                                            $variation_price = $product_variation->get_price_html();
                                            $rrp_price[] = get_post_meta( $variation_ID , 'rrp_price', true );
                                        }
                                     }

                              $woocsdata = get_option('woocs');
                              global $WOOCS;
                              $currencurrency = $WOOCS->current_currency;
                              $updateprice = $woocsdata[$currencurrency]['rate'];
                              $updatedsymbol = $woocsdata[$currencurrency]['symbol'];
                              $updatedposition = $woocsdata[$currencurrency]['position'];
                              $min_rrp_price_in_dollar = min($rrp_price);
                              $rrppricewithcurrencywitcher = $min_rrp_price_in_dollar * $updateprice;
	                       ?>
                            <div class="rrp_price">
                                RRP: <?php echo $updatedsymbol.round($rrppricewithcurrencywitcher,2); ?>
                            </div>
                            <div class="arival_rating text-center woocommerce">
                              <?php echo wc_get_rating_html( $product->get_average_rating() ); ?>
                            </div>
                                 <?php woocommerce_template_loop_add_to_cart( $loop->post, $product ); ?>
                        </div>
                    </div>
                    <?php endwhile; ?>
                    <?php wp_reset_query(); ?>
                </div>
        </div>


<?php do_action( 'woocommerce_after_cart' ); ?>
