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
	wp_enqueue_script( 'frontend-custom', get_stylesheet_directory_uri() . '/assets/js/frontendwoo.js', array("jquery"));
	
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



// Woocommerce rating stars always
//add_filter('woocommerce_product_get_rating_html', 'your_get_rating_html', 10, 2);
function your_get_rating_html($rating_html, $rating) {
        if ( $rating > 0 ) {
            $title = sprintf( __( 'Rated %s out of 5', 'woocommerce' ), $rating );
        } else {
            $title = 'Not yet rated';
            $rating = 0;
        }

        $rating_html  = '<div class="star-rating" title="' . $title . '">';
        $rating_html .= '<span style="width:' . ( ( $rating / 5 ) * 100 ) . '%"><strong class="rating">' . $rating . '</strong> ' . __( 'out of 5', 'woocommerce' ) . '</span>';
        $rating_html .= '</div>';
        return $rating_html;
}


add_action('woocommerce_after_shop_loop_item_title','change_loop_ratings_location', 2 );
function change_loop_ratings_location(){
    remove_action('woocommerce_after_shop_loop_item_title','woocommerce_template_loop_rating', 5 );
    add_action('woocommerce_after_shop_loop_item_title','woocommerce_template_loop_rating', 15 );
}

add_filter( 'woocommerce_product_get_rating_html', 'loop_product_get_rating_html', 20, 3 );
function loop_product_get_rating_html( $html, $rating, $count ){
    if ( 0 < $rating && ! is_product() ) {
        global $product;
        $rating_cnt = array_sum($product->get_rating_counts());
        $count_html = ' <div class="count-rating">(' . $rating_cnt .')</div>';

        $html       = '<div class="container-rating"><div class="star-rating">';
        $html      .= wc_get_star_rating_html( $rating, $count );
        $html      .= '</div>' . $count_html . '</div>';
    }
    return $html;
}


add_shortcode('product_slider_with_category','product_slider_with_category');
function product_slider_with_category($atts){
    ob_start();
    
             $productcategory = $atts['category'];
             $productlimit = $atts['limit'];
             $sliderheading = $atts['slider_heading'];
             if($productcategory == 'new-arrivals'){
                 $args = array( 
                 'post_type' => 'product', 
                 'posts_per_page' => $productlimit, 
                 'orderby' => 'asc',
                 'date_query'    => array(
                          'column'  => 'post_date',
                          'after'   => '-'.get_field('product_publish_days','option').' days'
                     )
                  );
              }else{
                   $args = array( 
                   'post_type' => 'product', 
                   'posts_per_page' => $productlimit, 
                   'product_cat' => $productcategory, 
                   'orderby' => 'asc',
                   );
              }
                $loop = new WP_Query( $args );
             if($loop->post_count >= 6){
        ?>	
        <div class="new_Arivals_sec">
                <h2 class="text-center"><?php echo $sliderheading; ?></h2>
                <div class="new_arival_outer">
                    <?php
                while ( $loop->have_posts() ) : $loop->the_post(); global $product; ?>
                    <div class="new-arival_box text-center">
                        <div class="product_detail">
                                                  <?php
            $product_publish_date = strtotime(get_the_date('Y-m-d', $loop->post->ID));  
            $current_date = strtotime(date('Y-m-d'));
            $diff = abs($product_publish_date - $current_date);
            $years = floor($diff / (365*60*60*24));  
            $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));  
            $days = floor(($diff - $years * 365*60*60*24 -  
            $months*30*60*60*24)/ (60*60*24));
                            ?>
                            <h6 class="exclusive_tag"><?php if($days <= get_field('product_publish_days','option')){ echo 'Exclusive'; } ?></h6>
                            <div class="liking text-right">
                                <?php echo do_shortcode('[yith_wcwl_add_to_wishlist]') ?>
                            </div>
                            <div class="arival_img">
                                <a href="<?php echo get_permalink( $loop->post->ID ) ?>"> <?php if (has_post_thumbnail( $loop->post->ID )){ echo '<img src="'.get_the_post_thumbnail_url($loop->post->ID, 'full').'" class="img-responsive" />'; }else{ echo '<img src="'.woocommerce_placeholder_img_src().'" alt="Placeholder" width="300px" height="300px" class="img-responsive" />'; } ?></a>
                            </div>
                            <h4 class="sale_name">
                             <?php if($days <= get_field('product_publish_days','option')){ echo 'Exclusive'; } ?>
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
                                    $variations = get_posts($args);
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
        }
                 
  $content = ob_get_clean();
   return $content;
}


add_shortcode('blog_sec_on_home_page','blog_sec_on_home_page');
function blog_sec_on_home_page(){
	ob_start();
            ?>
            <div class="blog_area">
                    <h2>FROM OUR BLOG</h2>
                    <div class="blog_outer">
                      
                            <?php	
                $args = array(
                    'post_type' => 'post',
                    'posts_per_page' => 4
                );

                $post_query = new WP_Query($args);

                if($post_query->have_posts() ) {
                    while($post_query->have_posts() ) {
                        $post_query->the_post();
                        ?>
                            <div class="blog_post">
							    <div class="blog-post-inner">
								<div class="blog-post-inner-img">
									<img src="<?php the_post_thumbnail_url('full'); ?>"/>
								</div>
								<div class="blog-post-inner-cont">
                                <h4><i class="fa fa-calendar"></i><?php echo get_the_date( get_option('date_format') ); ?></h4>
                                <h3><?php the_title(); ?></h3>
                                <?php the_excerpt(); ?>
                                <h5>CATEGORY: <?php the_category(); ?></h5>
                                <div class="text-center">
                                    <a href="<?php the_permalink(); ?>" class="empty_btn">Read More</a>
                                </div>
								</div>
								</div>
                            </div>
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


// 2. add RRP price field on product variation 
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
 
// 2. Save RRP price on product variation save
 
add_action( 'woocommerce_save_product_variation', 'rrp_price_save_custom_field_variations', 10, 2 );
function rrp_price_save_custom_field_variations( $variation_id, $i ) {
    $custom_field = $_POST['rrp_price'][$i];
    if ( isset( $custom_field ) ) update_post_meta( $variation_id, 'rrp_price', esc_attr( $custom_field ) );
}
 
// 3. Store RRP price value into variation data
add_filter( 'woocommerce_available_variation', 'rrp_price_add_custom_field_variation_data' );
function rrp_price_add_custom_field_variation_data( $variations ) {
    $variations['rrp_price'] = get_post_meta( $variations[ 'variation_id' ], 'rrp_price', true );
    return $variations;
}


// Add the opening div to the img on product loop
add_action( 'woocommerce_before_shop_loop_item_title', 'add_img_wrapper_start', 5, 2 );
function add_img_wrapper_start() {
    echo '<div class="arival_img"><a href="'.get_the_permalink().'">';
}

// Close the div that we just added to the img on product loop
add_action( 'woocommerce_before_shop_loop_item_title', 'add_img_wrapper_close', 12, 2 );
function add_img_wrapper_close() {
    echo '</a></div>';
}


add_action('woocommerce_cstom_banner','woocommerce_cstom_banner');
function woocommerce_cstom_banner(){
	$args = array('delimiter' => ' <i class="fa fa-angle-right" aria-hidden="true"></i>'); ?>
        <div class="inner_banner">
          <div class="container">
              <?php  woocommerce_breadcrumb( $args );  ?>
            <?php 
                $banner_section = get_field('banner_section','option');
                if($banner_section){
                $img_atts = wp_get_attachment_image_src( $banner_section['banner_image'], 'full' );
                $img_src = $img_atts[0];    
              ?>  
              <div class="inner_banner_outer">
                <img src="<?php echo $img_src; ?>" alt="" class="img-responsive">
                <div class="inner_banner_content">
                  <?php echo $banner_section['banner_content']; ?>
                </div>
              </div>
            <?php } ?>
          </div>
        </div>
<?php
}


add_action('shop_page_description','shop_page_description');
function shop_page_description(){
   $content_after_product_loop = get_field('content_after_product_loop','option');
    if($content_after_product_loop){
    ?>
        <div class="col-md-12 col-xs-12">
            <div class="">
                <div class="product_info2">
                    <?php echo $content_after_product_loop; ?>
                </div>
            </div>
        </div>
    <?php
    }
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
            <div class="">
                <div class="inner_banner">
                        <?php  woocommerce_breadcrumb( $args );  ?>
                </div>
            </div>
        </div>
       <?php 
         $cart_page_banner = get_field('cart_page_banner','option'); 
         if($cart_page_banner){
             $img_atts = wp_get_attachment_image_src( $cart_page_banner, 'full' );
             $img_src = $img_atts[0]; 
        ?>
        <div class="cart_banner_outer">
                <div class="cart_inner_banner">
                    <img src="<?php echo $img_src; ?>" alt="" class="img-responsive">
                </div>
        </div>
       <?php } ?>
        <div class="cart_header">
                <h2 class="pull-left">My shopping bag</h2>
                <a href="<?php echo wc_get_checkout_url(); ?>" class="pull-right blue_btn">Proceed to checkout</a>
        </div>
<?php } 
  



/*code for adding variations on the shop,category page and product sider loop*/
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
        return '<div class="woocommerce custom-class-on-loop">' . ob_get_clean() . '</div>';
}
add_shortcode( 'add_to_cart_form', 'add_to_cart_form_shortcode' );

/* Below this line code by helper */

/****************** Change Default sorting name on the shop page ********************/
function skyverge_change_default_sorting_name( $catalog_orderby ) {
    $catalog_orderby = str_replace("Default sorting", "Sort by", $catalog_orderby);
    return $catalog_orderby;
}
add_filter( 'woocommerce_catalog_orderby', 'skyverge_change_default_sorting_name' );
add_filter( 'woocommerce_default_catalog_orderby_options', 'skyverge_change_default_sorting_name' );
add_action( 'woocommerce_before_shop_loop', 'woocommerce_pagination', 10 );
add_action( 'woocommerce_after_shop_loop', 'woocommerce_result_count', 20 );
add_action( 'woocommerce_after_shop_loop', 'woocommerce_catalog_ordering', 20 );



/**************** Show category before product title on single product page ****************/
add_action( 'woocommerce_before_shop_loop_item_title', 'category_single_product', 25 );
function category_single_product(){
    $product_cats = wp_get_post_terms( get_the_ID(), 'product_cat' );
    if ( $product_cats && ! is_wp_error ( $product_cats ) ){
        $single_cat = array_shift( $product_cats ); ?>
        <h4 class="sale_name"><?php echo $single_cat->name; ?></h4>
<?php }
}

 /******************************FIND OUT MORE - ADD TO WISHLIST**************************************/
function content_after_addtocart_button(){
echo '<div class="shipping_note">
              <img src="https://woocommerce-427082-1340050.cloudwaysapps.com/wp-content/uploads/2020/06/truck_icon.png" alt="">
             Free Shipping Availaible. <a href="#">FIND OUT MORE</a>
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
              </div>
           </div><?php
}
add_action( 'woocommerce_after_add_to_cart_form', 'content_after_addtocart_button' );


add_action( 'template_redirect', 'custom_track_product_view');
function custom_track_product_view() {
    if ( ! is_singular( 'product' ) ) {
        return;
    }
    global $post;
    if ( empty( $_COOKIE['woocommerce_recently_viewed'] ) )
        $viewed_products = array();
    else
        $viewed_products = (array) explode( '|', $_COOKIE['woocommerce_recently_viewed'] );
    if ( ! in_array( $post->ID, $viewed_products ) ) {
        $viewed_products[] = $post->ID;
    }
    if ( sizeof( $viewed_products ) > 15 ) {
        array_shift( $viewed_products );
    }
    // Store for session only
    wc_setcookie( 'woocommerce_recently_viewed', implode( '|', $viewed_products ) );
}
add_shortcode( 'recently_viewed_products', 'bbloomer_recently_viewed_shortcode' );
 
function bbloomer_recently_viewed_shortcode() {
   $viewed_products = ! empty( $_COOKIE['woocommerce_recently_viewed'] ) ? (array) explode( '|', wp_unslash( $_COOKIE['woocommerce_recently_viewed'] ) ) : array();
   $viewed_products = array_reverse( array_filter( array_map( 'absint', $viewed_products ) ) );
 
   if ( empty( $viewed_products ) ) return;
   $product_ids = implode( ",", $viewed_products );
   $product_ids_arr = explode(",",$product_ids); 
   $output = "";    
  if(count($product_ids_arr) >1 ){    
      $output .= '<div class="recent_view">
        <div class="container">
            <h2 class="text-center">RECENTLY VIEWED</h2>
            <div class="row new_arival_outer">';
      $i=0;
//       echo'<pre>';
// print_r($product_ids_arr);
//       echo'</pre>';
       foreach($product_ids_arr as $product_id){    
          $i++; 
           $imgs = wp_get_attachment_image_src( get_post_thumbnail_id($product_id));
                $output .=  '<div class="col-md-3 col-sm-3 col-xs-6 new-arival_box">
                        <div class="recent_prdct_box">
                            <a href="'.get_the_permalink($product_id).'"><img src="'.$imgs[0].'" alt="" class="img-responsive">
                        </div>
                    </div>';
        //    if($i == 4){
        //        break;
        //    }
       }
        $output .= '</div></div></div>'; 
  }                                         
   return $output;
}

 /******************************RECENTLY VIEWD**************************************/
add_action( 'woocommerce_after_single_product_summary', 'add_my_text', 20 );
function add_my_text() {
	  comments_template();
    echo do_shortcode('[recently_viewed_products]');
}


add_action('new_arrival_single_product_hook','new_arrival_single_product_hook');
function new_arrival_single_product_hook(){
    global $product;      
        $product_publish_date = strtotime(get_the_date('Y-m-d', get_the_ID()));  
        $current_date = strtotime(date('Y-m-d'));
        $diff = abs($product_publish_date - $current_date);
        $years = floor($diff / (365*60*60*24));  
        $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));  
        $days = floor(($diff - $years * 365*60*60*24 -  
             $months*30*60*60*24)/ (60*60*24));  
        ?>
        <h4 class="sale_name"><?php if($days <= get_field('product_publish_days','option')){ echo 'New Arrivals'; } ?></h4>   
<?php 
}

add_action('brand_single_product_hook','brand_single_product_hook');
function brand_single_product_hook(){
    $brand_name = wp_get_post_terms( get_the_ID(), 'product_brand' );
    if ( $brand_name && ! is_wp_error ( $brand_name ) ){
    $single_brand = array_shift( $brand_name );
    ?>
        <h5 class="arival_brand text-center"><?php echo $single_brand->name; ?></h5>
    <?php
    }
}

/*************************************breadcrumbs on single product page**********************************************/

add_action( 'woocommerce_before_single_product', 'breadcrumbs_single_page', 20 );
function breadcrumbs_single_page() {

   $args = array('delimiter' => ' <i class="fa fa-angle-right" aria-hidden="true"></i>');
   
?>
<div class="breadcrumbs">
    <div class="inner_banner">
     <?php  woocommerce_breadcrumb( $args ); ?>
  </div>
</div><?php
}


add_filter( 'woocommerce_product_tabs', 'my_shipping_tab' );
function my_shipping_tab( $tabs ) {
    // Adds the new tab
    $tabs['shipping'] = array(
        'title'     => __( 'Shipping & Delivery', 'child-theme' ),
        'priority'  => 50,
        'callback'  => 'my_shipping_tab_callback'
    );
    return $tabs;
}

function my_shipping_tab_callback() {
	// The new tab content
	echo '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>';

}

add_filter( 'woocommerce_product_tabs', 'my_return_tab' );
function my_return_tab( $tabs ) {
    // Adds the new tab
    $tabs['return'] = array(
        'title'     => __( 'Return', 'child-theme' ),
        'priority'  => 50,
        'callback'  => 'my_return_tab_callback'
    );
    return $tabs;
}

function my_return_tab_callback() {
	// The new tab content
	echo '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>';

}

add_filter( 'woocommerce_product_tabs', 'rename_description_tab' );
function rename_description_tab( $tabs ) {
	$tabs['description']['title'] = 'Details';
	return $tabs;
}


add_filter( 'woocommerce_product_tabs', 'rename_additional_info_tab' );
 
function rename_additional_info_tab( $tabs ) {
	$tabs['additional_information']['title'] = 'Instruction';
	return $tabs;
 
}

add_filter( 'woocommerce_product_tabs', '_remove_reviews_tab', 98 );
function _remove_reviews_tab( $tabs ) {
  unset( $tabs[ 'reviews' ] );
  return $tabs;
}

if( function_exists('acf_add_options_page') ) {
    $args = array(
          'page_title' => 'Theme Settings',
          'menu_title' => 'Theme Settings',
          'icon_url' => 'dashicons-schedule'
          //other args
      );
    acf_add_options_page($args);

}

add_action( 'woocommerce_checkout_order_review', 'reordering_checkout_order_review', 1 );
function reordering_checkout_order_review(){
    remove_action('woocommerce_checkout_order_review','woocommerce_checkout_payment', 20 );
    add_action( 'woocommerce_checkout_order_review', 'custom_checkout_payment', 8 );
    add_action( 'woocommerce_checkout_order_review', 'custom_checkout_place_order', 20 );
}

function custom_checkout_payment() {
    $checkout = WC()->checkout();
    if ( WC()->cart->needs_payment() ) {
        $available_gateways = WC()->payment_gateways()->get_available_payment_gateways();
        WC()->payment_gateways()->set_current_gateway( $available_gateways );
    } else {
        $available_gateways = array();
    }

    if ( ! is_ajax() ) {
        // do_action( 'woocommerce_review_order_before_payment' );
    }
    ?>
    <div id="payment" class="woocommerce-checkout-payment-gateways">
        <?php if ( WC()->cart->needs_payment() ) : ?>
            <ul class="wc_payment_methods payment_methods methods">
                <?php
                if ( ! empty( $available_gateways ) ) {
                    foreach ( $available_gateways as $gateway ) {
                        wc_get_template( 'checkout/payment-method.php', array( 'gateway' => $gateway ) );
                    }
                } else {
                    echo '<li class="woocommerce-notice woocommerce-notice--info woocommerce-info">';
                    echo apply_filters( 'woocommerce_no_available_payment_methods_message', WC()->customer->get_billing_country() ? esc_html__( 'Sorry, it seems that there are no available payment methods for your state. Please contact us if you require assistance or wish to make alternate arrangements.', 'woocommerce' ) : esc_html__( 'Please fill in your details above to see available payment methods.', 'woocommerce' ) ) . '</li>'; // @codingStandardsIgnoreLine
                }
                ?>
            </ul>
        <?php 
        do_action('add_custom_coupon_form');
    endif; ?>
    </div>
    <?php
}

function custom_checkout_place_order() {
    $checkout          = WC()->checkout();
    $order_button_text = apply_filters( 'woocommerce_order_button_text', __( 'Place order', 'woocommerce' ) );
    ?>
    <div id="payment-place-order" class="woocommerce-checkout-place-order">
        <div class="form-row place-order">
            <noscript>
                <?php esc_html_e( 'Since your browser does not support JavaScript, or it is disabled, please ensure you click the <em>Update Totals</em> button before placing your order. You may be charged more than the amount stated above if you fail to do so.', 'woocommerce' ); ?>
                <br/><button type="submit" class="button alt" name="woocommerce_checkout_update_totals" value="<?php esc_attr_e( 'Update totals', 'woocommerce' ); ?>"><?php esc_html_e( 'Update totals', 'woocommerce' ); ?></button>
            </noscript>
            <?php do_action( 'woocommerce_review_order_before_submit' ); ?>

            <?php echo apply_filters( 'woocommerce_order_button_html', '<button type="submit" class="button alt" name="woocommerce_checkout_place_order" id="place_order" value="' . esc_attr( $order_button_text ) . '" data-value="' . esc_attr( $order_button_text ) . '">' . esc_html( $order_button_text ) . '</button>' ); // @codingStandardsIgnoreLine ?>
            <?php wc_get_template( 'checkout/terms.php' ); ?>
            <?php do_action( 'woocommerce_review_order_after_submit' ); ?>

            <?php wp_nonce_field( 'woocommerce-process_checkout', 'woocommerce-process-checkout-nonce' ); ?>
        </div>
    </div>
    <?php
    if ( ! is_ajax() ) {
        do_action( 'woocommerce_review_order_after_payment' );
    }
}

add_action( 'add_custom_coupon_form', 'add_custom_coupon_form');
function add_custom_coupon_form(){
?>
<div class="promo_box_coupon">
        <input type="text" name="couponcode" class="pull-left" placeholder="Enter Voucher or Gift Card">
        <input type="button" value="APPLY CODE" class="coun-code-btn pink_btn pull-left">
    </div>
<?php
}

add_filter( 'woocommerce_order_button_text', 'woo_custom_order_button_text' ); 
function woo_custom_order_button_text() {
    return __( 'Place Your Order', 'woocommerce' ); 
}


function terms_and_conditions_default_checked_wc_terms( $terms_is_checked ) {
	return true;
}
add_filter( 'woocommerce_terms_is_checked', 'terms_and_conditions_default_checked_wc_terms', 10 );
add_filter( 'woocommerce_terms_is_checked_default', 'terms_and_conditions_default_checked_wc_terms', 10 );


