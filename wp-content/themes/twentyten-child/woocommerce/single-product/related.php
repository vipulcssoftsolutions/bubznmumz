<?php
/**
 * Related Products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/related.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce/Templates
 * @version     3.9.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( $related_products ) : 


global $post;
$related = array( 
  'category__in' => wp_get_post_categories( $post->ID ), 
  'numberposts'  => 4, 
  'post__not_in' => array( $post->ID ),
  'post_type'    => 'product'
  );

$loop = new WP_Query( $related  );

?>
  <div class="new_Arivals_sec">
                <h2 class="text-center">Similar Items</h2>
                <div class="new_arival_outer">
                    <?php
                while ( $loop->have_posts() ) : $loop->the_post(); global $product; ?>
                      <?php
            $product_publish_date = strtotime(get_the_date('Y-m-d', $loop->post->ID));  
            $current_date = strtotime(date('Y-m-d'));
            $diff = abs($product_publish_date - $current_date);
            $years = floor($diff / (365*60*60*24));  
            $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));  
            $days = floor(($diff - $years * 365*60*60*24 -  
            $months*30*60*60*24)/ (60*60*24));
                            ?>
                    <div class="new-arival_box text-center">
                        <div class="product_detail">
                            <h6 class="exclusive_tag"><?php if($days <= get_field('product_publish_days','option')){ echo 'New Arrivals'; } ?></h6>
                            <div class="liking text-right">
                                <?php echo do_shortcode('[yith_wcwl_add_to_wishlist]') ?>
                            </div>
                            <div class="arival_img">
                                <a href="<?php echo get_permalink( $loop->post->ID ) ?>"> <?php if (has_post_thumbnail( $loop->post->ID )){ echo '<img src="'.get_the_post_thumbnail_url($loop->post->ID, 'full').'" class="img-responsive" />'; }else{ echo '<img src="'.woocommerce_placeholder_img_src().'" alt="Placeholder" width="300px" height="300px" class="img-responsive" />'; } ?></a></div>
                                       
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
                     ?>                            <div class="arival-price text-center">
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

  <div class="new_Arivals_sec">
                <h2 class="text-center">You may also like</h2>
                <div class="new_arival_outer">
                    <?php
                while ( $loop->have_posts() ) : $loop->the_post(); global $product; ?>
                    <?php
            $product_publish_date = strtotime(get_the_date('Y-m-d', $loop->post->ID));  
            $current_date = strtotime(date('Y-m-d'));
            $diff = abs($product_publish_date - $current_date);
            $years = floor($diff / (365*60*60*24));  
            $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));  
            $days = floor(($diff - $years * 365*60*60*24 -  
            $months*30*60*60*24)/ (60*60*24));
                            ?>
                    <div class="new-arival_box text-center">
                        <div class="product_detail">
                            <h6 class="exclusive_tag"><?php if($days <= get_field('product_publish_days','option')){ echo 'New Arrivals'; } ?></h6>
                            <div class="liking text-right">
                                <?php echo do_shortcode('[yith_wcwl_add_to_wishlist]') ?>
                                
                            </div>
                            <div class="arival_img">
                                <a href="<?php echo get_permalink( $loop->post->ID ) ?>"> <?php if (has_post_thumbnail( $loop->post->ID )){ echo '<img src="'.get_the_post_thumbnail_url($loop->post->ID, 'full').'" class="img-responsive" />'; }else{ echo '<img src="'.woocommerce_placeholder_img_src().'" alt="Placeholder" width="300px" height="300px" class="img-responsive" />'; } ?></a></div>
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
                     ?>     <div class="arival-price text-center">
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
	<?php
endif;
wp_reset_postdata();
