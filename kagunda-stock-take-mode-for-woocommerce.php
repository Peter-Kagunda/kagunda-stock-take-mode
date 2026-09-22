<?php
/**
 * Plugin Name:       Stock Take Mode for WooCommerce
 * Plugin URI:        https://peterkagunda.com
 * Description:       Temporarily pause purchasing on your WooCommerce store during inventory counts, with a countdown banner, waitlist capture, and automatic re-open notifications.
 * Version:           1.0.1
 * Requires at least: 6.0
 * Requires PHP:      7.4
 * Requires Plugins:  woocommerce
 * Author:            Peter Kagunda
 * Author URI:        https://peterkagunda.com/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       kagunda-stock-take-mode-for-woocommerce
 * WC requires at least: 8.0
 * WC tested up to:   11.1
 *
 * @package Kagunda_Stock_Take_Mode_For_WooCommerce
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'KAGSTM_VERSION', '1.0.1' );
define( 'KAGSTM_PLUGIN_FILE', __FILE__ );
define( 'KAGSTM_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );
define( 'KAGSTM_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'KAGSTM_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

require_once KAGSTM_PLUGIN_DIR . 'includes/class-kagstm-logger.php';
require_once KAGSTM_PLUGIN_DIR . 'includes/class-kagstm-settings.php';
require_once KAGSTM_PLUGIN_DIR . 'includes/class-kagstm-waitlist.php';
require_once KAGSTM_PLUGIN_DIR . 'includes/class-kagstm-import-export.php';
require_once KAGSTM_PLUGIN_DIR . 'includes/class-kagstm-core.php';
require_once KAGSTM_PLUGIN_DIR . 'includes/class-kagstm-admin.php';

add_action( 'before_woocommerce_init', 'kagstm_declare_features_compatibility' );
/**
 * Declare compatibility with WooCommerce's HPOS and cart/checkout blocks.
 */
function kagstm_declare_features_compatibility() {
	if ( class_exists( '\Automattic\WooCommerce\Utilities\FeaturesUtil' ) ) {
		\Automattic\WooCommerce\Utilities\FeaturesUtil::declare_compatibility( 'custom_order_tables', KAGSTM_PLUGIN_FILE, true );
		\Automattic\WooCommerce\Utilities\FeaturesUtil::declare_compatibility( 'cart_checkout_blocks', KAGSTM_PLUGIN_FILE, true );
	}
}

register_deactivation_hook( __FILE__, 'kagstm_deactivate' );
/**
 * Clean up scheduled events on deactivation. Settings are kept.
 */
function kagstm_deactivate() {
	wp_clear_scheduled_hook( 'kagstm_check_state' );
	wp_clear_scheduled_hook( 'kagstm_process_broadcast_queue' );
	update_option( 'kagstm_last_known_state', 'inactive' );
}

register_activation_hook( __FILE__, 'kagstm_activate' );
/**
 * Re-schedule state checks on activation.
 */
function kagstm_activate() {
	KAGSTM_Core::instance()->schedule_events();
}

KAGSTM_Waitlist::init();
KAGSTM_Core::instance();
KAGSTM_Admin::instance();
