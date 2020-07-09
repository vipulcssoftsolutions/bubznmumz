<?php
/**
 * Loop Price
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/price.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;
?>
 <?php
    $termsbrand =  get_the_terms($product->get_id(), 'product_brand');
        if($termsbrand){
            foreach($termsbrand as $terms){
                echo '<h5 class="arival_brand text-center">'.$terms->name.'</h5>';
                break;
            }    
        }
?>
<div class="arival-price text-center">
<?php if ( $price_html = $product->get_price_html() ) : ?>
	<span class="price"><?php echo $price_html; ?></span>
<?php endif; ?>
</div>
<?php
            $args = array(
                 'post_type'     => 'product_variation',
                 'post_status'   => array( 'private', 'publish' ),
                 'numberposts'   => -1,
                 'orderby'       => 'menu_order',
                 'order'         => 'asc',
                 'post_parent'   => $product->get_id() // get parent post-ID
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

