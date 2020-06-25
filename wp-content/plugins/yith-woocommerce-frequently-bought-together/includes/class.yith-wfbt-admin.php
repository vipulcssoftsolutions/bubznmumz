<?php
/**
 * Admin class
 *
 * @author  YITH
 * @package YITH WooCommerce Frequently Bought Together
 * @version 1.0.0
 */

if ( ! defined( 'YITH_WFBT' ) ) {
	exit;
} // Exit if accessed directly

if ( ! class_exists( 'YITH_WFBT_Admin' ) ) {
	/**
	 * Admin class.
	 * The class manage all the admin behaviors.
	 *
	 * @since 1.0.0
	 */
	class YITH_WFBT_Admin {

		/**
		 * Single instance of the class
		 *
		 * @since 1.0.0
		 * @var \YITH_WFBT_Admin
		 */
		protected static $instance;

		/**
		 * Plugin options
		 *
		 * @since  1.0.0
		 * @var array
		 * @access public
		 */
		public $options = array();

		/**
		 * Plugin version
		 *
		 * @since 1.0.0
		 * @var string
		 */
		public $version = YITH_WFBT_VERSION;

		/**
		 * @var $_panel Panel Object
		 */
		protected $_panel;

		/**
		 * @var $_premium string Premium tab template file name
		 */
		protected $_premium = 'premium.php';

		/**
		 * @var string Premium version landing link
		 */
		protected $_premium_landing = 'https://yithemes.com/themes/plugins/yith-woocommerce-frequently-bought-together/';

		/**
		 * @var string Waiting List panel page
		 */
		protected $_panel_page = 'yith_wfbt_panel';

		/**
		 * Various links
		 *
		 * @since  1.0.0
		 * @var string
		 * @access public
		 */
		public $doc_url = 'https://docs.yithemes.com/yith-woocommerce-frequently-bought-together/';

		/**
		 * Returns single instance of the class
		 *
		 * @since 1.0.0
		 * @return \YITH_WFBT_Admin
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
		 * @access public
		 * @since  1.0.0
		 */
		public function __construct() {

			add_action( 'admin_menu', array( $this, 'register_panel' ), 5 );

			//Add action links
			add_filter( 'plugin_action_links_' . plugin_basename( YITH_WFBT_DIR . '/' . basename( YITH_WFBT_FILE ) ), array( $this, 'action_links' ) );
			add_filter( 'yith_show_plugin_row_meta', array( $this, 'plugin_row_meta' ), 10, 5 );

			// Premium Tab
			add_action( 'yith_wfbt_premium', array( $this, 'premium_tab' ) );

			// add section in product edit page
			add_filter( 'woocommerce_product_data_tabs', array( $this, 'add_bought_together_tab' ), 10, 1 );
			add_action( 'woocommerce_product_data_panels', array( $this, 'add_bought_together_panel' ) );

			// search product
			add_action( 'wp_ajax_yith_ajax_search_product', array( $this, 'yith_ajax_search_product' ) );
			add_action( 'wp_ajax_nopriv_yith_ajax_search_product', array( $this, 'yith_ajax_search_product' ) );
			// save tabs options
			$product_types = apply_filters( 'yith_wfbt_product_types_meta_save', array(
				'simple',
				'variable',
				'grouped',
				'external',
				'rentable',
			) );
			foreach ( $product_types as $product_type ) {
				add_action( 'woocommerce_process_product_meta_' . $product_type, array( $this, 'save_bought_together_tab' ), 10, 1 );
			}
		}

		/**
		 * Action Links
		 *
		 * add the action links to plugin admin page
		 *
		 * @since    1.0
		 * @author   Andrea Grillo <andrea.grillo@yithemes.com>
		 * @param $links | links plugin array
		 *
		 * @return   mixed Array
		 * @return mixed
		 * @use      plugin_action_links_{$plugin_file_name}
		 */
		public function action_links( $links ) {
			$links[] = '<a href="' . admin_url( "admin.php?page={$this->_panel_page}" ) . '">' . __( 'Settings', 'yith-woocommerce-frequently-bought-together' ) . '</a>';
			$links[] = '<a href="' . $this->get_premium_landing_uri() . '" target="_blank">' . __( 'Premium Version', 'yith-woocommerce-frequently-bought-together' ) . '</a>';

			return $links;
		}

		/**
		 * Add a panel under YITH Plugins tab
		 *
		 * @since    1.0
		 * @author   Andrea Grillo <andrea.grillo@yithemes.com>
		 * @use      /Yit_Plugin_Panel class
		 * @return   void
		 * @see      plugin-fw/lib/yit-plugin-panel.php
		 */
		public function register_panel() {

			if ( ! empty( $this->_panel ) ) {
				return;
			}

			$admin_tabs = array(
				'general' => __( 'Settings', 'yith-woocommerce-frequently-bought-together' ),
			);

			if ( ! ( defined( 'YITH_WFBT_PREMIUM' ) && YITH_WFBT_PREMIUM ) ) {
				$admin_tabs['premium'] = __( 'Premium Version', 'yith-woocommerce-frequently-bought-together' );
			}

			$args = array(
				'create_menu_page' => apply_filters( 'yith-wfbt-register-panel-create-menu-page', true ),
				'parent_slug'      => '',
				'page_title'       => _x( 'WooCommerce Frequently Bought Together', 'plugin name in admin page title', 'yith-woocommerce-frequently-bought-together' ),
				'menu_title'       => _x( 'Frequently Bought Together', 'plugin name in admin WP menu', 'yith-woocommerce-frequently-bought-together' ),
				'capability'       => apply_filters( 'yith-wfbt-register-panel-capabilities', 'manage_options' ),
				'parent'           => '',
				'parent_page'      => apply_filters( 'yith-wfbt-register-panel-parent-page', 'yith_plugin_panel' ),
				'page'             => $this->_panel_page,
				'admin-tabs'       => apply_filters( 'yith-wfbt-admin-tabs', $admin_tabs ),
				'options-path'     => YITH_WFBT_DIR . '/plugin-options',
				'class'            => yith_set_wrapper_class(),
				'plugin_slug'      => YITH_WFBT_SLUG,
			);

			/* === Fixed: not updated theme  === */
			if ( ! class_exists( 'YIT_Plugin_Panel_WooCommerce' ) ) {
				require_once( YITH_WFBT_DIR . '/plugin-fw/lib/yit-plugin-panel-wc.php' );
			}

			$this->_panel = new YIT_Plugin_Panel_WooCommerce( $args );
		}

		/**
		 * Premium Tab Template
		 *
		 * Load the premium tab template on admin page
		 *
		 * @since    1.0
		 * @author   Andrea Grillo <andrea.grillo@yithemes.com>
		 * @return   void
		 * @return void
		 */
		public function premium_tab() {
			$premium_tab_template = YITH_WFBT_TEMPLATE_PATH . '/admin/' . $this->_premium;
			if ( file_exists( $premium_tab_template ) ) {
				include_once( $premium_tab_template );
			}

		}

		/**
		 * plugin_row_meta
		 *
		 * add the action links to plugin admin page
		 *
		 * @since    1.0
		 * @author   Andrea Grillo <andrea.grillo@yithemes.com>
		 * @use      plugin_row_meta
		 * @param $plugin_data
		 * @param $status
		 *
		 * @param $plugin_meta
		 * @param $plugin_file
		 * @return   Array
		 */
		public function plugin_row_meta( $new_row_meta_args, $plugin_meta, $plugin_file, $plugin_data, $status ) {

			if ( defined( 'YITH_WFBT_INIT' ) && YITH_WFBT_INIT == $plugin_file ) {
				$new_row_meta_args['slug'] = YITH_WFBT_SLUG;

				if ( defined( 'YITH_WFBT_PREMIUM' ) ) {
					$new_row_meta_args['is_premium'] = true;
				}
			}

			return $new_row_meta_args;
		}

		/**
		 * Add bought together tab in edit product page
		 *
		 * @since  1.0.0
		 *
		 * @author Francesco Licandro <francesco.licandro@yithemes.com>
		 * @param mixed $tabs
		 * @return mixed
		 */
		public function add_bought_together_tab( $tabs ) {

			$tabs['yith-wfbt'] = array(
				'label'  => _x( 'Frequently Bought Together', 'tab in product data box', 'yith-woocommerce-frequently-bought-together' ),
				'target' => 'yith_wfbt_data_option',
				'class'  => array( 'hide_if_grouped', 'hide_if_external', 'hide_if_bundle' ),
			);

			return $tabs;
		}

		/**
		 * Add bought together panel in edit product page
		 *
		 * @since  1.0.0
		 * @author Francesco Licandro <francesco.licandro@yithemes.com>
		 */
		public function add_bought_together_panel() {

			global $post, $product_object;

			$product_id = $post->ID;
			is_null( $product_object ) && $product_object = wc_get_product( $product_id );
			$to_exclude = array( $product_id );

			?>

			<div id="yith_wfbt_data_option" class="panel woocommerce_options_panel">

				<div class="options_group">

					<p class="form-field"><label
							for="yith_wfbt_ids"><?php esc_html_e( 'Select products', 'yith-woocommerce-frequently-bought-together' ); ?></label>
						<?php
						$product_ids = yit_get_prop( $product_object, YITH_WFBT_META, true );
						$product_ids = array_filter( array_map( 'absint', (array) $product_ids ) );
						$json_ids    = array();

						foreach ( $product_ids as $product_id ) {
							$product = wc_get_product( $product_id );
							if ( is_object( $product ) ) {
								$json_ids[ $product_id ] = wp_kses_post( html_entity_decode( $product->get_formatted_name() ) );
							}
						}

						yit_add_select2_fields( array(
							'class'             => 'wc-product-search',
							'style'             => 'width: 50%;',
							'id'                => 'yith_wfbt_ids',
							'name'              => 'yith_wfbt_ids',
							'data-placeholder'  => __( 'Search for a product&hellip;', 'yith-woocommerce-frequently-bought-together' ),
							'data-multiple'     => true,
							'data-action'       => 'yith_ajax_search_product',
							'data-selected'     => $json_ids,
							'value'             => implode( ',', array_keys( $json_ids ) ),
							'custom-attributes' => array(
								'data-exclude' => implode( ',', $to_exclude ),
							),
						) );
						?>
						<img class="help_tip"
							data-tip='<?php esc_html_e( 'Select products for "Frequently bought together" group', 'yith-woocommerce-frequently-bought-together' ) ?>'
							src="<?php echo esc_url( WC()->plugin_url() ); ?>/assets/images/help.png" height="16"
							width="16"/>
					</p>

				</div>

			</div>

			<?php
		}

		/**
		 * Ajax action search product
		 *
		 * @since  1.0.0
		 * @author Francesco Licandro <francesco.licandro@yithemes.com>
		 */
		public function yith_ajax_search_product() {

			ob_start();

			check_ajax_referer( 'search-products', 'security' );

			$term       = (string) wc_clean( stripslashes( $_GET['term'] ) );
			$post_types = array( 'product', 'product_variation' );

			$to_exclude = isset( $_GET['exclude'] ) ? explode( ',', $_GET['exclude'] ) : false;

			if ( empty( $term ) ) {
				die();
			}

			$args = array(
				'post_type'      => $post_types,
				'post_status'    => 'publish',
				'posts_per_page' => -1,
				's'              => $term,
				'fields'         => 'ids',
			);

			if ( $to_exclude ) {
				$args['post__not_in'] = $to_exclude;
			}

			if ( is_numeric( $term ) ) {

				$args2 = array(
					'post_type'      => $post_types,
					'post_status'    => 'publish',
					'posts_per_page' => -1,
					'post__in'       => array( 0, $term ),
					'fields'         => 'ids',
				);

				$args3 = array(
					'post_type'      => $post_types,
					'post_status'    => 'publish',
					'posts_per_page' => -1,
					'post_parent'    => $term,
					'fields'         => 'ids',
				);

				$args4 = array(
					'post_type'      => $post_types,
					'post_status'    => 'publish',
					'posts_per_page' => -1,
					'meta_query'     => array(
						array(
							'key'     => '_sku',
							'value'   => $term,
							'compare' => 'LIKE',
						),
					),
					'fields'         => 'ids',
				);

				$posts = array_unique( array_merge( get_posts( $args ), get_posts( $args2 ), get_posts( $args3 ), get_posts( $args4 ) ) );

			} else {

				$args2 = array(
					'post_type'      => $post_types,
					'post_status'    => 'publish',
					'posts_per_page' => -1,
					'meta_query'     => array(
						array(
							'key'     => '_sku',
							'value'   => $term,
							'compare' => 'LIKE',
						),
					),
					'fields'         => 'ids',
				);

				$posts = array_unique( array_merge( get_posts( $args ), get_posts( $args2 ) ) );

			}

			$found_products = array();

			if ( $posts ) {
				foreach ( $posts as $post ) {
					$current_id = $post;
					$product    = wc_get_product( $post );
					// exclude variable product
					if ( ! $product || $product->is_type( array( 'variable', 'external' ) ) ) {
						continue;
					} elseif ( $product->is_type( 'variation' ) ) {
						$current_id = wp_get_post_parent_id( $post );
						if ( ! wc_get_product( $current_id ) ) {
							continue;
						}
					}

					$found_products[ $post ] = rawurldecode( $product->get_formatted_name() );
				}
			}

			wp_send_json( apply_filters( 'yith_wfbt_ajax_search_product_result', $found_products ) );
		}

		/**
		 * Save options in upselling tab
		 *
		 * @since  1.0.0
		 * @author Francesco Licandro <francesco.licandro@yithemes.com>
		 * @param $post_id
		 */
		public function save_bought_together_tab( $post_id ) {

			// save default variation is product is variable
			$product = wc_get_product( $post_id );
			// save products group
			$products_array = array();
			if ( isset( $_POST['yith_wfbt_ids'] ) ) {
				$products_array = ! is_array( $_POST['yith_wfbt_ids'] ) ? explode( ',', $_POST['yith_wfbt_ids'] ) : $_POST['yith_wfbt_ids'];
				$products_array = array_filter( array_map( 'intval', $products_array ) );
			}
			yit_save_prop( $product, YITH_WFBT_META, $products_array );
		}

		/**
		 * Get the premium landing uri
		 *
		 * @since   1.0.0
		 * @author  Andrea Grillo <andrea.grillo@yithemes.com>
		 * @return  string The premium landing link
		 */
		public function get_premium_landing_uri() {
			return $this->_premium_landing;
		}

	}
}
/**
 * Unique access to instance of YITH_WFBT_Admin class
 *
 * @since 1.0.0
 * @return \YITH_WFBT_Admin
 */
function YITH_WFBT_Admin() {
	return YITH_WFBT_Admin::get_instance();
}