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
<h5 class="arival_brand text-center">Fisher</h5>

<div class="arival-price text-center">
<?php if ( $price_html = $product->get_price_html() ) : ?>
	<span class="price"><?php echo $price_html; ?></span>
<?php endif; ?>
</div>
<div class="rrp_price">
RRP: $30.00
</div>
<div class="arival_rating text-center">
<ul class="list-inline">
<li><i class="fa fa-star-o filled" aria-hidden="true"></i></li>
<li><i class="fa fa-star-o filled" aria-hidden="true"></i></li>
<li><i class="fa fa-star-o filled" aria-hidden="true"></i></li>
<li><i class="fa fa-star-o filled" aria-hidden="true"></i></li>
<li><i class="fa fa-star-o" aria-hidden="true"></i></li>
<li><span>(2)</span></li>
</ul>
</div>
