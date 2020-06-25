<?php
/**
 * Single Product Meta
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/meta.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce/Templates
 * @version     3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product;
?>
 <div class="stock_block">
<div class="product_meta">

	<?php do_action( 'woocommerce_product_meta_start' ); ?>

	<?php if ( wc_product_sku_enabled() && ( $product->get_sku() || $product->is_type( 'variable' ) ) ) : ?>

		<span class="sku_wrapper"><?php esc_html_e( 'SKU:', 'woocommerce' ); ?> <span class="sku"><?php echo ( $sku = $product->get_sku() ) ? $sku : esc_html__( 'N/A', 'woocommerce' ); ?></span></span>

	<?php endif; ?>

	<?php echo wc_get_product_category_list( $product->get_id(), ', ', '<span class="posted_in">' . _n( 'Category:', 'Categories:', count( $product->get_category_ids() ), 'woocommerce' ) . ' ', '</span>' ); ?>

	<?php echo wc_get_product_tag_list( $product->get_id(), ', ', '<span class="tagged_as">' . _n( 'Tag:', 'Tags:', count( $product->get_tag_ids() ), 'woocommerce' ) . ' ', '</span>' ); ?>

	<?php do_action( 'woocommerce_product_meta_end' ); ?>

</div>

</div>


</div>
</div>

 <div class="col-lg-2 col-md-2 col-sm-0 hidden-sm hidden-xs">
        <div class="right_slider_outer">
             <h2>You May Also Like</h2>
             <button class="top_btn"><i class="fa fa-angle-up" aria-hidden="true"></i></button>
             <button class="bottom_btn"><i class="fa fa-angle-down" aria-hidden="true"></i></button>  
        <div class="side_prdct_slider">
          <div>
            <div class="side_product_slide">
              <img src="https://woocommerce-427082-1340050.cloudwaysapps.com/wp-content/uploads/2020/06/arival-3.jpg" alt="" class="img-responsive">
            </div>
          </div>
          <div>
            <div class="side_product_slide">
              <img src="https://woocommerce-427082-1340050.cloudwaysapps.com/wp-content/uploads/2020/06/arival-4.jpg" alt="" class="img-responsive">
            </div>
          </div>
          <div>
            <div class="side_product_slide">
              <img src="https://woocommerce-427082-1340050.cloudwaysapps.com/wp-content/uploads/2020/06/arival-5.jpg" alt="" class="img-responsive">
            </div>
          </div>
          <div>
            <div class="side_product_slide">
              <img src="https://woocommerce-427082-1340050.cloudwaysapps.com/wp-content/uploads/2020/06/arival-6.jpg" alt="" class="img-responsive">
            </div>
          </div>
        </div>
      </div>
      </div>
      

</div>
</div>
</div>

