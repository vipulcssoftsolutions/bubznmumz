<?php
add_action( 'wp_enqueue_scripts', 'enqueue_twentyten_child' );
function enqueue_twentyten_child()
{
      wp_enqueue_style('twentyten-css', './twentyten/style.css' );
      wp_enqueue_style('twentyten-child-css', './twentyten-child/style.css');
      wp_enqueue_script('twentyten-child-js', './twentyten-child/js/script.js', array( 'jquery' ), '1.0', true );
}


function bubznmumz_widgets_init() {
	// Area 1, located at the top of the sidebar.
	register_sidebar(
		array(
			'name'          => __( 'Primary Widget Area', 'bubznmumz' ),
			'id'            => 'primary-widget-area',
			'description'   => __( 'Add widgets here to appear in your sidebar.', 'bubznmumz' ),
			'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
			'after_widget'  => '</li>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);

	// Area 2, located below the Primary Widget Area in the sidebar. Empty by default.
	register_sidebar(
		array(
			'name'          => __( 'Secondary Widget Area', 'bubznmumz' ),
			'id'            => 'secondary-widget-area',
			'description'   => __( 'An optional secondary widget area, displays below the primary widget area in your sidebar.', 'bubznmumz' ),
			'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
			'after_widget'  => '</li>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);

	// Area 3, located in the footer. Empty by default.
	register_sidebar(
		array(
			'name'          => __( 'First Footer Widget Area', 'bubznmumz' ),
			'id'            => 'first-footer-widget-area',
			'description'   => __( 'An optional widget area for your site footer.', 'bubznmumz' ),
			'before_widget' => '',
			'after_widget'  => '',
			'before_title'  => '<h2>',
			'after_title'   => '</h2>',
		)
	);

	// Area 4, located in the footer. Empty by default.
	register_sidebar(
		array(
			'name'          => __( 'Second Footer Widget Area', 'bubznmumz' ),
			'id'            => 'second-footer-widget-area',
			'description'   => __( 'An optional widget area for your site footer.', 'bubznmumz' ),
			'before_widget' => '',
			'after_widget'  => '',
			'before_title'  => '<h2>',
			'after_title'   => '</h2>',
		)
	);

	// Area 5, located in the footer. Empty by default.
	register_sidebar(
		array(
			'name'          => __( 'Third Footer Widget Area', 'bubznmumz' ),
			'id'            => 'third-footer-widget-area',
			'description'   => __( 'An optional widget area for your site footer.', 'bubznmumz' ),
			'before_widget' => '',
			'after_widget'  => '',
			'before_title'  => '<h2>',
			'after_title'   => '</h2>',
		)
	);

	// Area 6, located in the footer. Empty by default.
	register_sidebar(
		array(
			'name'          => __( 'Fourth Footer Widget Area', 'bubznmumz' ),
			'id'            => 'fourth-footer-widget-area',
			'description'   => __( 'An optional widget area for your site footer.', 'bubznmumz' ),
			'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
			'after_widget'  => '</li>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);
	
	register_sidebar(
		array(
			'name'          => __( 'Fifth Footer Widget Area', 'bubznmumz' ),
			'id'            => 'fifth-footer-widget-area',
			'description'   => __( 'An optional widget area for your site footer.', 'bubznmumz' ),
			'before_widget' => '',
			'after_widget'  => '',
			'before_title'  => '<h3>',
			'after_title'   => '</h3>',
		)
	);
}
/** Register sidebars by running bubznmumz_widgets_init() on the widgets_init hook. */
add_action( 'widgets_init', 'bubznmumz_widgets_init' );


function bubznmumz_scripts_styles() {
	// Theme block stylesheet.
	wp_enqueue_style('slick_css', get_stylesheet_directory_uri().'/assets/css/slick.css');
    wp_enqueue_style('slick-theme', get_stylesheet_directory_uri().'/assets/css/slick-theme.css');
    wp_enqueue_style( 'bootstrap-style', get_stylesheet_directory_uri() . '/assets/css/bootstrap.css');
    wp_enqueue_style('montsereat','https://fonts.googleapis.com/css?family=Montserrat:100,300,400,500,600,700,800,900|Open+Sans:300,400,600,700');
    wp_enqueue_style('font-awsome','https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css');
    wp_enqueue_style('font-open-sans','https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,800');    
	wp_enqueue_style('custom_css', get_stylesheet_directory_uri().'/assets/css/style.css');
    wp_enqueue_style('media', get_stylesheet_directory_uri().'/assets/css/media.css');
    wp_enqueue_style('theme-style', get_stylesheet_directory_uri() . '/style.css');
	
	wp_enqueue_script('jQuery', 'https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js'); 
	wp_enqueue_script('jquery_ui_min_js','https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js');
	wp_enqueue_script('bootstrap-js',get_stylesheet_directory_uri().'/assets/js/bootstrap.js');
    wp_enqueue_script('js-equalheight',get_stylesheet_directory_uri().'/assets/js/jquery.equalheights.js'); 
	wp_enqueue_script('slick-min-js', get_stylesheet_directory_uri().'/assets/js/slick.min.js');
	wp_enqueue_script('bootstrap-slider-js', get_stylesheet_directory_uri().'/assets/js/bootstrap-slider.min.js');
    wp_enqueue_script('custom-js',get_stylesheet_directory_uri().'/assets/js/custom.js');
	
	
}
add_action( 'wp_enqueue_scripts', 'bubznmumz_scripts_styles' );



// custom menu display location
function wpb_custom_new_menu() {
  register_nav_menu('primary-theme-menu',__( 'primary theme menu' ));
  register_nav_menu('top-menu',__( 'Top menu' ));

}
add_action( 'init', 'wpb_custom_new_menu' );



/**
 * Create Shortcode for WooCommerce Cart Menu Item
 */
add_shortcode ('woo_cart_but', 'woo_cart_but' );
function woo_cart_but() {
    ob_start();
        $cart_count = WC()->cart->cart_contents_count; // Set variable for cart item count
        $cart_url = wc_get_cart_url(); // Set Cart URL
        ?>
        <a class="menu-item cart-contents" href="<?php echo $cart_url; ?>" title="My Basket">
            <img src="<?php echo site_url(); ?>/wp-content/uploads/2020/06//cart_icon.png" alt="" class="img-responsive pull-left">
            <?php
                if ( $cart_count > 0 ) {
               ?>
            <span><?php echo $cart_count; ?></span>
            <?php
                }
                ?>
        </a>
        <?php	        
    return ob_get_clean();
}


/**
 * Add AJAX Shortcode when cart contents update
 */
add_filter( 'woocommerce_add_to_cart_fragments', 'woo_cart_but_count' );
function woo_cart_but_count( $fragments ) {
    ob_start();
        $cart_count = WC()->cart->cart_contents_count;
        $cart_url = wc_get_cart_url();

        ?>
        <a class="cart-contents menu-item" href="<?php echo $cart_url; ?>" title="<?php _e( 'View your shopping cart' ); ?>">
                              <img src="<?php echo site_url(); ?>/wp-content/uploads/2020/06//cart_icon.png" alt="" class="img-responsive pull-left">

        <?php
        if ( $cart_count > 0 ) {
            ?>
            <span class="cart-contents-count"><?php echo $cart_count; ?></span>
            <?php            
        }
            ?></a>
        <?php
        $fragments['a.cart-contents'] = ob_get_clean(); 
    return $fragments;
}



add_shortcode('featured_item_section_on_home_page','featured_item_section_on_home_page');
function featured_item_section_on_home_page(){
    ob_start();
        ?>	
         <!--********************************New Arivals Start****************************-->
        <div class="new_Arivals_sec">
            <div class="container">
                <h2 class="text-center">Featured Items</h2>
                <div class="new_arival_outer">
                    <?php
         $args = array( 'post_type' => 'product', 'posts_per_page' => 6, 'product_cat' => 'new-arrivals', 'orderby' => 'rand' );
                $loop = new WP_Query( $args );
                while ( $loop->have_posts() ) : $loop->the_post(); global $product; ?>
                    <div class="new-arival_box text-center">
                        <div class="product_detail">
                            <h6 class="exclusive_tag">Exclusive</h6>
                            <div class="liking text-right">
                                <i class="fa fa-heart-o" aria-hidden="true"></i>
                            </div>
                            <div class="arival_img">
                                <a href="<?php echo get_permalink( $loop->post->ID ) ?>"> <?php if (has_post_thumbnail( $loop->post->ID )){ echo '<img src="'.get_the_post_thumbnail_url($loop->post->ID, 'full').'" class="img-responsive" />'; }else{ echo '<img src="'.woocommerce_placeholder_img_src().'" alt="Placeholder" width="300px" height="300px" class="img-responsive" />'; } ?></a></div>
                            <h4 class="sale_name">New arrivals</h4>
                            <h3 class="arrival_name text-center"><?php the_title(); ?></h3>
                            <h5 class="arival_brand text-center">Fisher</h5>
                            <div class="arival-price text-center">
                                <?php echo $product->get_price_html(); ?>
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
                            <div class="hidden_content">
                                <div class="size_box">
                                    <div class="radio_label_box">
                                        <input type="radio" name="size" id="3m">
                                        <label for="3m">3M</label>
                                    </div>
                                    <div class="radio_label_box">
                                        <input type="radio" name="size" id="5m">
                                        <label for="5m">5M</label>
                                    </div>
                                    <div class="radio_label_box">
                                        <input type="radio" name="size" id="7m">
                                        <label for="7m">7M</label>
                                    </div>
                                    <div class="radio_label_box">
                                        <input type="radio" name="size" id="9m">
                                        <label for="9m">9M</label>
                                    </div>
                                    <div class="radio_label_box">
                                        <input type="radio" name="size" id="10m">
                                        <label for="10m">10M</label>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <?php woocommerce_template_loop_add_to_cart( $loop->post, $product ); ?>
                            </div>
                        </div>
                    </div>
                    <?php endwhile; ?>
                    <?php wp_reset_query(); ?>
                </div>
            </div>
        </div>
        <?php	
  $content = ob_get_clean();
   return $content;
}


add_shortcode('new_arrivals_section_on_home_page','new_arrivals_section_on_home_page');
function new_arrivals_section_on_home_page(){
  ob_start();
?>	
 <!--********************************New Arivals Start****************************-->
 <div class="new_Arivals_sec">
     <div class="container">
         <h2 class="text-center">New Arrivals</h2>
         <div class="new_arival_outer">
             <?php
 $args = array( 'post_type' => 'product', 'posts_per_page' => 6, 'product_cat' => 'new-arrivals', 'orderby' => 'rand' );
        $loop = new WP_Query( $args );
        while ( $loop->have_posts() ) : $loop->the_post(); global $product; ?>
             <div class="new-arival_box text-center">
                 <div class="product_detail">
                     <h6 class="exclusive_tag">Exclusive</h6>
                     <div class="liking text-right">
                         <i class="fa fa-heart-o" aria-hidden="true"></i>
                     </div>
                     <div class="arival_img">
                         <a href="<?php echo get_permalink( $loop->post->ID ) ?>"> <?php if (has_post_thumbnail( $loop->post->ID )){ echo '<img src="'.get_the_post_thumbnail_url($loop->post->ID, 'full').'" class="img-responsive" />'; }else{ echo '<img src="'.woocommerce_placeholder_img_src().'" alt="Placeholder" width="300px" height="300px" class="img-responsive" />'; } ?></a></div>
                     <h4 class="sale_name">New arrivals</h4>
                     <h3 class="arrival_name text-center"><?php the_title(); ?></h3>
                     <h5 class="arival_brand text-center">Fisher</h5>
                     <div class="arival-price text-center">
                         <?php echo $product->get_price_html(); ?>
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
                     <div class="hidden_content">
                         <div class="size_box">
                             <div class="radio_label_box">
                                 <input type="radio" name="size" id="3m">
                                 <label for="3m">3M</label>
                             </div>
                             <div class="radio_label_box">
                                 <input type="radio" name="size" id="5m">
                                 <label for="5m">5M</label>
                             </div>
                             <div class="radio_label_box">
                                 <input type="radio" name="size" id="7m">
                                 <label for="7m">7M</label>
                             </div>
                             <div class="radio_label_box">
                                 <input type="radio" name="size" id="9m">
                                 <label for="9m">9M</label>
                             </div>
                             <div class="radio_label_box">
                                 <input type="radio" name="size" id="10m">
                                 <label for="10m">10M</label>
                             </div>
                             <div class="clearfix"></div>
                         </div>
                      <?php  ?>
                         <?php woocommerce_template_loop_add_to_cart( $loop->post, $product ); ?>
                     </div>
                 </div>
             </div>
             <?php endwhile; ?>
             <?php wp_reset_query(); ?>
         </div>
     </div>
 </div>
<?php	
        $content = ob_get_clean();
        return $content;
}

add_shortcode('blog_sec_on_home_page','blog_sec_on_home_page');
function blog_sec_on_home_page(){
	ob_start();
            ?>
            <div class="blog_area">
                <div class="container">
                    <h2>FROM OUR BLOG</h2>
                    <div class="blog_outer">
                        <div>
                            <?php	
                $args = array(
                    'post_type' => 'post',
                    'posts_per_page' => 3
                );

                $post_query = new WP_Query($args);

                if($post_query->have_posts() ) {
                    while($post_query->have_posts() ) {
                        $post_query->the_post();
                        ?>
                            <div class="blog_post" style="background-image:url(<?php the_post_thumbnail_url('full'); ?>)">
                                <h4><?php echo get_the_date( get_option('date_format') ); ?></h4>
                                <h3><?php the_title(); ?></h3>
                                <p><?php the_excerpt(); ?> </p>
                                <h5>CATEGORY: <?php the_category(); ?></h5>
                                <div class="text-center">
                                    <a href="<?php the_permalink(); ?>" class="empty_btn">Read More</a>
                                </div>
                            </div>
                        </div>
                        <div>
                            <?php
                        }
                      wp_reset_query(); 
                    }	
            ?>
                        </div>
                    </div>
            <?php	
    $content = ob_get_clean();
    return $content;
}


add_action( 'woocommerce_variation_options_pricing', 'rrp_price_add_custom_field_to_variations', 10, 3 );
function rrp_price_add_custom_field_to_variations( $loop, $variation_data, $variation ) {
        echo '<div class="options_group form-row">';	
                woocommerce_wp_text_input( array(
                'id' => 'rrp_price[' . $loop . ']',
                'class' => 'short rrp',
                'label' => __( 'RRP Price', 'woocommerce' ),
                'value' => get_post_meta( $variation->ID, 'rrp_price', true )
                )
                );
        echo '</div>';
}
 
// 2. Save custom field on product variation save
 
add_action( 'woocommerce_save_product_variation', 'rrp_price_save_custom_field_variations', 10, 2 );
function rrp_price_save_custom_field_variations( $variation_id, $i ) {
    $custom_field = $_POST['rrp_price'][$i];
    if ( isset( $custom_field ) ) update_post_meta( $variation_id, 'rrp_price', esc_attr( $custom_field ) );
}
 
// 3. Store custom field value into variation data
add_filter( 'woocommerce_available_variation', 'rrp_price_add_custom_field_variation_data' );
function rrp_price_add_custom_field_variation_data( $variations ) {
    $variations['rrp_price'] = get_post_meta( $variations[ 'variation_id' ], 'rrp_price', true );
    return $variations;
}


// Add the opening div to the img
add_action( 'woocommerce_before_shop_loop_item_title', 'add_img_wrapper_start', 5, 2 );
function add_img_wrapper_start() {
    echo '<div class="arival_img">';
}

// Close the div that we just added
add_action( 'woocommerce_before_shop_loop_item_title', 'add_img_wrapper_close', 12, 2 );
function add_img_wrapper_close() {
    echo '</div>';
}


add_action('woocommerce_cstom_banner','woocommerce_cstom_banner');
function woocommerce_cstom_banner(){
	$args = array('delimiter' => ' <i class="fa fa-angle-right" aria-hidden="true"></i>'); ?>
        <div class="inner_banner">
          <div class="container">
              <?php  woocommerce_breadcrumb( $args );  ?>
              <div class="inner_banner_outer">
                <img src="https://woocommerce-427082-1340050.cloudwaysapps.com/wp-content/uploads/2020/06/inner_banner.jpg" alt="" class="img-responsive">
                <div class="inner_banner_content">
                  <h2>SHOP PRODUCTS</h2>
                  <p>Perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rab illo  et quasi architecto beatae vitae dicta sunt explicabo.</p>
                </div>
              </div>
          </div>
        </div>
<?php
}


add_action('shop_page_description','shop_page_description');
function shop_page_description(){?>
    <div class="col-md-12 col-xs-12">
        <div class="">
            <div class="product_info2">
                <h2>Men’s Jackets</h2>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s <br> <br>
                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500sLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500sLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s

                </p>
            </div>
        </div>
    </div>
<?php
}


/**
* Show the product title in the product loop. By default this is an H2.
*/
if ( ! function_exists('woocommerce_template_loop_product_title') ) {
    function woocommerce_template_loop_product_title() {
        echo '<h3 class=”arrival_name text-center”>' . get_the_title() . '</h3>';
    }
}

add_action('woocommerce_before_cart','content_before_Cart');
function content_before_Cart(){
	$args = array('delimiter' => ' <i class="fa fa-angle-right" aria-hidden="true"></i>');                   
?>                 
<div class="breadcrumbs">
    <div class="container">
        <div class="inner_banner">
            <div class="container">
                <?php  woocommerce_breadcrumb( $args );  ?>
            </div>
        </div>
    </div>
</div>                      
 <div class="cart_banner_outer">
        <div class="container">
          <div class="cart_inner_banner">
            <img src="<?php echo site_url(); ?>/wp-content/uploads/2020/06/cart_banner.jpg" alt="" class="img-responsive">
          </div>
        </div>
 </div>
<div class="cart_header">
        <div class="container">
          <h2 class="pull-left">My shopping bag</h2>
          <a href="#" class="pull-right blue_btn">Proceed to checkout</a>
        </div>
      </div> 
<?php } 
  
function add_to_cart_form_shortcode( $atts ) {
        if ( empty( $atts ) ) {
            return '';
        }

        if ( ! isset( $atts['id'] ) && ! isset( $atts['sku'] ) ) {
            return '';
        }

        $args = array(
            'posts_per_page'      => 1,
            'post_type'           => 'product',
            'post_status'         => 'publish',
            'ignore_sticky_posts' => 1,
            'no_found_rows'       => 1,
        );

        if ( isset( $atts['sku'] ) ) {
            $args['meta_query'][] = array(
                'key'     => '_sku',
                'value'   => sanitize_text_field( $atts['sku'] ),
                'compare' => '=',
            );

            $args['post_type'] = array( 'product', 'product_variation' );
        }

        if ( isset( $atts['id'] ) ) {
            $args['p'] = absint( $atts['id'] );
        }

        $single_product = new WP_Query( $args );

        $preselected_id = '0';


        if ( isset( $atts['sku'] ) && $single_product->have_posts() && 'product_variation' === $single_product->post->post_type ) {

            $variation = new WC_Product_Variation( $single_product->post->ID );
            $attributes = $variation->get_attributes();


            $preselected_id = $single_product->post->ID;


            $args = array(
                'posts_per_page'      => 1,
                'post_type'           => 'product',
                'post_status'         => 'publish',
                'ignore_sticky_posts' => 1,
                'no_found_rows'       => 1,
                'p'                   => $single_product->post->post_parent,
            );

            $single_product = new WP_Query( $args );
        ?>
            <script type="text/javascript">
                jQuery( document ).ready( function( $ ) {
                    var $variations_form = $( '[data-product-page-preselected-id="<?php echo esc_attr( $preselected_id ); ?>"]' ).find( 'form.variations_form' );
                    <?php foreach ( $attributes as $attr => $value ) { ?>
                        $variations_form.find( 'select[name="<?php echo esc_attr( $attr ); ?>"]' ).val( '<?php echo esc_js( $value ); ?>' );
                    <?php } ?>
                });
            </script>
        <?php
        }

        $single_product->is_single = true;
        ob_start();
        global $wp_query;

        $previous_wp_query = $wp_query;

        $wp_query          = $single_product;

        wp_enqueue_script( 'wc-single-product' );
        while ( $single_product->have_posts() ) {
            $single_product->the_post()
            ?>
            <div class="single-product" data-product-page-preselected-id="<?php echo esc_attr( $preselected_id ); ?>">
                <?php woocommerce_template_single_add_to_cart(); ?>
            </div>
            <?php
        }

        $wp_query = $previous_wp_query;

        wp_reset_postdata();
        return '<div class="woocommerce">' . ob_get_clean() . '</div>';
}
add_shortcode( 'add_to_cart_form', 'add_to_cart_form_shortcode' );



/* Below this line code by helper */

function skyverge_change_default_sorting_name( $catalog_orderby ) {
    $catalog_orderby = str_replace("Default sorting", "Sort by", $catalog_orderby);
    return $catalog_orderby;
}
add_filter( 'woocommerce_catalog_orderby', 'skyverge_change_default_sorting_name' );
add_filter( 'woocommerce_default_catalog_orderby_options', 'skyverge_change_default_sorting_name' );
add_action( 'woocommerce_before_shop_loop', 'woocommerce_pagination', 10 );
add_action( 'woocommerce_after_shop_loop', 'woocommerce_result_count', 20 );
add_action( 'woocommerce_after_shop_loop', 'woocommerce_catalog_ordering', 20 );




add_action( 'woocommerce_before_shop_loop_item_title', 'category_single_product', 25 );
function category_single_product(){
    $product_cats = wp_get_post_terms( get_the_ID(), 'product_cat' );
    if ( $product_cats && ! is_wp_error ( $product_cats ) ){
        $single_cat = array_shift( $product_cats ); ?>
        <h4 class="sale_name"><?php echo $single_cat->name; ?></h4>
<?php }
}


add_action( 'woocommerce_single_product_summary', 'wpa89819_wc_single_product', 2 );
function wpa89819_wc_single_product(){
    $product_cats = wp_get_post_terms( get_the_ID(), 'product_cat' );
    if ( $product_cats && ! is_wp_error ( $product_cats ) ){
        $single_cat = array_shift( $product_cats ); ?>
        <div class="product_full_dtail">
        <h4 class="sale_name"><?php echo $single_cat->name; ?></h4>
        </div>
<?php }
}


add_action( 'woocommerce_before_variations_form', 'so_43922864_add_content', 15 );
function so_43922864_add_content(){
     global $product;
     echo '<div class="availebility pull-left">Availability: <span>' . $product->get_stock_quantity() .'</span></div>';
    if ( $product->get_sku() ) {
    	echo '<div class="prdct_code pull-left">SKU : ' . $product->get_sku() . '</div>' ;       
    }
       /// Get price
}

 /******************************FIND OUT MORE - ADD TO WISHLIST**************************************/
function content_after_addtocart_button() {
echo ' <br><br><div class="shipping_note">
              <img src="https://woocommerce-427082-1340050.cloudwaysapps.com/wp-content/uploads/2020/06/truck_icon.png" alt="">
              This product qualifies for our Free Shipping offer. <a href="#">FIND OUT MORE</a>
            </div>';
            ?>
            <div class="social_btns">
              <button class="wishlist_btn"><?php
            echo do_shortcode("[yith_wcwl_add_to_wishlist]");
            ?> </button>
            <div class="pull-right">
                <button class="save_btn"><i class="fa fa-pinterest-p" aria-hidden="true"></i>SAVE</button>
                <button class="like_btn"><i class="fa fa-thumbs-up" aria-hidden="true"></i>LIKE</button>
                <button class="tweet_btn"><i class="fa fa-twitter" aria-hidden="true"></i>TWEET</button>
              </div></div><?php
}
add_action( 'woocommerce_after_add_to_cart_button', 'content_after_addtocart_button' );

 /******************************RECENTLY VIEWD**************************************/
add_action( 'woocommerce_after_single_product_summary', 'add_my_text', 20 );
function add_my_text() {
  ?>
    <div class="recent_view">
        <div class="container">
            <h2 class="text-center">RECENTLY VIEWED</h2>
            <div class="row">
                <div class="col-md-3 col-sm-3 col-xs-6">
                    <div class="recent_prdct_box">
                        <img src="https://woocommerce-427082-1340050.cloudwaysapps.com/wp-content/uploads/2020/06/arival-3.jpg" alt="" class="img-responsive">
                    </div>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-6">
                    <div class="recent_prdct_box">
                        <img src="https://woocommerce-427082-1340050.cloudwaysapps.com/wp-content/uploads/2020/06/arival-4.jpg" alt="" class="img-responsive">
                    </div>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-6">
                    <div class="recent_prdct_box">
                        <img src="https://woocommerce-427082-1340050.cloudwaysapps.com/wp-content/uploads/2020/06/arival-5.jpg" alt="" class="img-responsive">
                    </div>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-6">
                    <div class="recent_prdct_box">
                        <img src="https://woocommerce-427082-1340050.cloudwaysapps.com/wp-content/uploads/2020/06/arival-6.jpg" alt="" class="img-responsive">
                    </div>
                </div>
            </div>
        </div>
    </div>
  <?php
}



add_shortcode('featured_item_section_other_shoppers','featured_item_section_other_shoppers');
function featured_item_section_other_shoppers(){
			ob_start();

?>	
 <!--********************************New Arivals Start****************************-->
 <div class="new_Arivals_sec">
     <div class="container">
         <h2 class="text-center">OTHER SHOPPERS PICKED THESE, TOO</h2>
         <div class="new_arival_outer">
             <?php
 $args = array( 'post_type' => 'product', 'posts_per_page' => 6, 'product_cat' => 'new-arrivals', 'orderby' => 'rand' );
        $loop = new WP_Query( $args );
        while ( $loop->have_posts() ) : $loop->the_post(); global $product; ?>
             <div class="new-arival_box text-center">
                 <div class="product_detail">
                     <h6 class="exclusive_tag">Exclusive</h6>
                     <div class="liking text-right">
                         <i class="fa fa-heart-o" aria-hidden="true"></i>
                     </div>
                     <div class="arival_img">
                         <a href="<?php echo get_permalink( $loop->post->ID ) ?>"> <?php if (has_post_thumbnail( $loop->post->ID )){ echo '<img src="'.get_the_post_thumbnail_url($loop->post->ID, 'full').'" class="img-responsive" />'; }else{ echo '<img src="'.woocommerce_placeholder_img_src().'" alt="Placeholder" width="300px" height="300px" class="img-responsive" />'; } ?></a></div>
                     <h4 class="sale_name">New arrivals</h4>
                     <h3 class="arrival_name text-center"><?php the_title(); ?></h3>
                     <h5 class="arival_brand text-center">Fisher</h5>
                     <div class="arival-price text-center">
                         <?php echo $product->get_price_html(); ?>
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
                     <div class="hidden_content">
                         <div class="size_box">
                             <div class="radio_label_box">
                                 <input type="radio" name="size" id="3m">
                                 <label for="3m">3M</label>
                             </div>
                             <div class="radio_label_box">
                                 <input type="radio" name="size" id="5m">
                                 <label for="5m">5M</label>
                             </div>
                             <div class="radio_label_box">
                                 <input type="radio" name="size" id="7m">
                                 <label for="7m">7M</label>
                             </div>
                             <div class="radio_label_box">
                                 <input type="radio" name="size" id="9m">
                                 <label for="9m">9M</label>
                             </div>
                             <div class="radio_label_box">
                                 <input type="radio" name="size" id="10m">
                                 <label for="10m">10M</label>
                             </div>
                             <div class="clearfix"></div>
                         </div>
                         <?php woocommerce_template_loop_add_to_cart( $loop->post, $product ); ?>
                     </div>
                 </div>
             </div>
             <?php endwhile; ?>
             <?php wp_reset_query(); ?>
         </div>
     </div>
 </div>
<?php	
  $content = ob_get_clean();
   return $content;
}


add_shortcode('full_information_accordin','full_information_accordin');
function full_information_accordin(){	?>
    <div class="prdct_full_info" id="prdct_full_info">
        <div class="container">
            <div class="prdct_info_inner">
                <div class="panel-group" id="prdct_dtl_list">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#prdct_dtl_list" href="#detail">
                                    Details</a>
                            </h4>
                        </div>
                        <div id="detail" class="panel-collapse collapse in">
                            <div class="panel-body">Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                                sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad
                                minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
                                commodo consequat.</div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#prdct_dtl_list" href="#instruction">
                                    Instruction</a>
                            </h4>
                        </div>
                        <div id="instruction" class="panel-collapse collapse">
                            <div class="panel-body">Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                                sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad
                                minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
                                commodo consequat.</div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#prdct_dtl_list" href="#delivery">
                                    Shipping & Delivery</a>
                            </h4>
                        </div>
                        <div id="delivery" class="panel-collapse collapse">
                            <div class="panel-body">Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                                sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad
                                minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
                                commodo consequat.</div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#prdct_dtl_list" href="#return">
                                    Return</a>
                            </h4>
                        </div>
                        <div id="return" class="panel-collapse collapse">
                            <div class="panel-body">Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                                sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad
                                minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
                                commodo consequat.</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
	<?php
}


add_action( 'woocommerce_after_single_product_summary', 'enfold_customization_extra_product_content', 15 );
function enfold_customization_extra_product_content() {
    echo do_shortcode("[featured_item_section_other_shoppers]");
    echo do_shortcode("[full_information_accordin]");
}



