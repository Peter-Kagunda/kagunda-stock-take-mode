<?php
/**
 * Uninstall handler for Stock Take Mode for WooCommerce.
 *
 * Runs only when the plugin is deleted from the Plugins screen (never on
 * deactivation), and removes every option, transient and scheduled event
 * this plugin created.
 *
 * @package Kagunda_Stock_Take_Mode_For_WooCommerce
 */

if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}

/**
 * Delete plugin data for the current site.
 */
function kagstm_uninstall_delete_data() {
	global $wpdb;

	// Every option this plugin owns starts with "kagstm_". Transients are stored as "_transient_kagstm_*".
	$patterns = array(
		$wpdb->esc_like( 'kagstm_' ) . '%',
		$wpdb->esc_like( '_transient_kagstm_' ) . '%',
		$wpdb->esc_like( '_transient_timeout_kagstm_' ) . '%',
	);

	foreach ( $patterns as $pattern ) {
		$wpdb->query( $wpdb->prepare( "DELETE FROM {$wpdb->options} WHERE option_name LIKE %s", $pattern ) ); // phpcs:ignore WordPress.DB.DirectDatabaseQuery.DirectQuery, WordPress.DB.DirectDatabaseQuery.NoCaching -- one-off cleanup on uninstall.
	}

	// Legacy option names used before the plugin's pre-release rename.
	$legacy_options = array(
		'wc_stm_enabled',
		'wc_stm_start_datetime',
		'wc_stm_end_datetime',
		'wc_stm_message',
		'wc_stm_button_behavior',
		'wc_stm_button_text',
		'wc_stm_bg_color',
		'wc_stm_text_color',
		'wc_stm_custom_css',
		'wc_stm_clear_cart',
		'wc_stm_show_countdown',
		'wc_stm_enable_waitlist',
		'wc_stm_admin_alerts',
		'wc_stm_broadcast_complete',
		'wc_stm_broadcast_subject',
		'wc_stm_broadcast_body',
		'wc_stm_bypass_roles',
		'wc_stm_product_exceptions',
		'wc_stm_last_known_state',
		'wc_stm_stat_blocked_attempts',
		'wc_stm_subscriber_waitlist_v2',
	);
	foreach ( $legacy_options as $option ) {
		delete_option( $option );
	}

	wp_clear_scheduled_hook( 'kagstm_check_state' );
	wp_clear_scheduled_hook( 'kagstm_process_broadcast_queue' );
}

if ( is_multisite() ) {
	$kagstm_uninstall_site_ids = get_sites( array( 'fields' => 'ids' ) );
	foreach ( $kagstm_uninstall_site_ids as $kagstm_uninstall_site_id ) {
		switch_to_blog( $kagstm_uninstall_site_id );
		kagstm_uninstall_delete_data();
		restore_current_blog();
	}
} else {
	kagstm_uninstall_delete_data();
}
