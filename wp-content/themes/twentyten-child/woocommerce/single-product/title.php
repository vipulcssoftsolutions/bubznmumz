<?php
/**
 * Single Product title
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/title.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see        https://docs.woocommerce.com/document/template-structure/
 * @package    WooCommerce/Templates
 * @version    1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>

</div>
<div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">
        <div class="product_full_dtail">
<?php do_action('new_arrival_single_product_hook'); ?>        	
<?php the_title( '<h3 class="product_title entry-title arrival_name text-center">', '</h3>' ); ?>
<?php do_action('brand_single_product_hook'); ?>        
        
           


