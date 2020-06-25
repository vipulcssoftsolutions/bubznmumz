<?php
/**
 * Template for displaying the footer
 *
 * Contains the closing of the id=main div and all content
 * after. Calls sidebar-footer.php for bottom widgets.
 *
 * @package WordPress
 * @subpackage twentyten
 * @since twentyten 1.0
 */
?>
<footer>
<div class="container">
<div class="row">
<div class="col-md-2 col-sm-4 col-xs-12">
<?php dynamic_sidebar('first-footer-widget-area'); ?>	
</div>
<div class="col-md-2 col-sm-4 col-xs-12">
<?php dynamic_sidebar('second-footer-widget-area'); ?>	
</div>
<div class="col-md-2 col-sm-4 col-xs-12">
<?php dynamic_sidebar('third-footer-widget-area'); ?>	

</div>
<div class="col-md-6 col-sm-12 col-xs-12">
<div class="stay_touch">
<h2>Stay in touch</h2>
<p>Subscribe to our newsletter and get a <strong>$10 voucher</strong> for your next purchase* </p>
<form>
<input type="email" placeholder="Enter Your email address...">
<button>SUBMIT</button>
</form>

<?php dynamic_sidebar('fifth-footer-widget-area'); ?>	

</div>
</div>
</div>
<div class="top_brands">
<h2>Our Top Brands</h2>
<ul>
<?php
$terms = get_terms( array(
    'taxonomy' => 'product_brand',
    'hide_empty' => false,
) );

foreach ( $terms as $term ) {
     echo "<li><a href='".site_url()."/brand/".$term->slug."'>" . $term->name . "</li>";
}
?>
<span class="clearfix"></span>
</ul>
</div>
</div>
</footer>
<div class="copyright text-center">
<div class="container">
BUBznMUMZ © 2020 All RIGHTS ARE RESERVED.
</div>
</div>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/js/bootstrap.js"></script>
<script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/js/jquery.mCustomScrollbar.concat.min.js"></script>
<script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/js/jquery.equalheights.js"></script>
<script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/js/slick.min.js"></script>
<script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/js/bootstrap-slider.min.js"></script>
<script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/js/custom.js"></script>

<?php wp_footer(); ?>

</body>
</html>
