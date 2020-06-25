<?php
/**
 * Main class
 *
 * @author  YITH
 * @package YITH WooCommerce Frequently Bought Together Premium
 * @version 1.0.0
 */

if ( ! defined( 'YITH_WFBT' ) ) {
	exit;
} // Exit if accessed directly

if ( ! class_exists( 'YITH_WFBT' ) ) {
	/**
	 * YITH WooCommerce Frequently Bought Together Premium
	 *
	 * @since 1.0.0
	 */
	class YITH_WFBT {

		/**
		 * Single instance of the class
		 *
		 * @since 1.0.0
		 * @var \YITH_WFBT
		 */
		protected static $instance;

		/**
		 * Action add to cart group
		 *
		 * @since 1.0.0
		 * @var \YITH_WFBT
		 */
		public $actionadd = 'yith_bought_together';

		/**
		 * Plugin version
		 *
		 * @since 1.0.0
		 * @var string
		 */
		public $version = YITH_WFBT_VERSION;


		/**
		 * Returns single instance of the class
		 *
		 * @since 1.0.0
		 * @return \YITH_WFBT
		 */
		public static function get_instance() {
			if ( is_null( self::$instance ) ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		/**
		 * Constructor
		 *
		 * @since 1.0.0
		 * @return mixed YITH_WFBT_Admin | YITH_WFBT_Frontend
		 */
		public function __construct() {

			// Load Plugin Framework
			add_action( 'plugins_loaded', array( $this, 'plugin_fw_loader' ), 15 );

			// Class admin
			if ( $this->is_admin() ) {
				// require admin class
				require_once 'class.yith-wfbt-admin.php';
				// admin class
				YITH_WFBT_Admin();
			} else {
				// require frontend class
				require_once 'class.yith-wfbt-frontend.php';
				// the class
				YITH_WFBT_Frontend();
			}

			add_action( 'wp_loaded', array( $this, 'add_group_to_cart' ), 20 );
			// register Gutenberg Block
			add_action( 'init', array( $this, 'register_gutenberg_block' ), 10 );
		}

		/**
		 * Load Plugin Framework
		 *
		 * @since  1.0
		 * @access public
		 * @author Andrea Grillo <andrea.grillo@yithemes.com>
		 * @return void
		 */
		public function plugin_fw_loader() {
			if ( ! defined( 'YIT_CORE_PLUGIN' ) ) {
				global $plugin_fw_data;
				if ( ! empty( $plugin_fw_data ) ) {
					$plugin_fw_file = array_shift( $plugin_fw_data );
					require_once $plugin_fw_file;
				}
			}
		}

		/**
		 * Check if is admin
		 *
		 * @since  1.1.0
		 * @access public
		 * @author Francesco Licandro
		 * @return boolean
		 */
		public function is_admin() {
			$context_check = isset( $_REQUEST['context'] ) && $_REQUEST['context'] == 'frontend';
			$is_admin      = is_admin() && ! ( defined( 'DOING_AJAX' ) && DOING_AJAX && $context_check );
			return apply_filters( 'yith_wfbt_check_is_admin', $is_admin );
		}

		/**
		 * Add upselling group to cart
		 *
		 * @since  1.0.0
		 * @author Francesco Licandro <francesco.licandro@yithemes.com>
		 */
		public function add_group_to_cart() {

			if ( ! ( isset( $_REQUEST['action'] ) && $_REQUEST['action'] == $this->actionadd && wp_verify_nonce( $_REQUEST['_wpnonce'], $this->actionadd ) ) ) {
				return;
			}

			wc_nocache_headers();

			$products_added = $message = array();
			$offered        = $_POST['offeringID'];

			if ( empty( $offered ) ) {
				return;
			}

			$main_product = isset( $_POST['yith-wfbt-main-product'] ) ? intval( $_POST['yith-wfbt-main-product'] ) : $_POST['offeringID'][0];

			foreach ( $offered as $id ) {

				$product = wc_get_product( $id );

				$attr         = array();
				$variation_id = '';

				if ( $product->is_type( 'variation' ) ) {
					$attr         = $product->get_variation_attributes();
					$variation_id = $product->get_id();
					$product_id   = yit_get_base_product_id( $product );
				} else {
					$product_id = yit_get_prop( $product, 'id', true );
				}

				$cart_item_key = WC()->cart->add_to_cart( $product_id, 1, $variation_id, $attr );
				if ( $cart_item_key ) {
					$products_added[ $cart_item_key ] = $variation_id ? $variation_id : $product_id;
					$message[ $product_id ]           = 1;
				}
			}

			do_action( 'yith_wfbt_group_added_to_cart', $products_added, $main_product, $offered );

			if ( ! empty( $message ) ) {
				wc_add_to_cart_message( $message );
			}

			if ( get_option( 'woocommerce_cart_redirect_after_add' ) == 'yes' ) {
				$url = function_exists( 'wc_get_cart_url' ) ? wc_get_cart_url() : WC()->cart->get_cart_url();
			} else {
				//redirect to product page
				$url = remove_query_arg( array( 'action', '_wpnonce' ) );
			}

			wp_redirect( esc_url( $url ) );
			exit;

		}

		/**
		 * Register plugin Gutenberg block
		 *
		 * @since  1.3.7
		 * @author Francesco Licandro
		 * @return void
		 */
		public function register_gutenberg_block() {
			$block = array(
				'ywfbt-blocks' => array(
					'title'          => _x( 'Frequently Bought Form', '[gutenberg]: block name', 'yith-woocommerce-frequently-bought-together' ),
					'description'    => _x( 'With this block you can print a product "frequently bought together" form.', '[gutenberg]: block description', 'yith-woocommerce-frequently-bought-together' ),
					'shortcode_name' => 'ywfbt_form',
					'do_shortcode'   => false,
					'attributes'     => array(
						'product_id' => array(
							'type'    => 'text',
							'label'   => _x( 'Add the product id (leave blank to get global product value)', '[gutenberg]: attributes description', 'yith-woocommerce-frequently-bought-together' ),
							'default' => '',
						),
					),
				),
			);

			yith_plugin_fw_gutenberg_add_blocks( $block );
		}
	}
}

/**
 * Unique access to instance of YITH_WFBT class
 *
 * @since 1.0.0
 * @return \YITH_WFBT
 */
function YITH_WFBT() {
	return YITH_WFBT::get_instance();
}