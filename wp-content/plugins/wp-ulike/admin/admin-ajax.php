<?php
/**
 * Back-end AJAX Functionalities
 * 
 * @package    wp-ulike
 * @author     Alimir 2018
 * @link       https://wpulike.com
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
    die('No Naughty Business Please !');
}

/*******************************************************
  Start AJAX From Here
*******************************************************/

/**
 * AJAX handler to get statistics data
 *
 * @author       	Alimir
 * @since           3.4
 * @return			Void
 */
function wp_ulike_ajax_stats() {

	$nonce  = isset( $_POST['nonce'] ) ? $_POST['nonce'] : '';

	if ( empty( $nonce ) || ! wp_verify_nonce( $nonce, 'wp-ulike-ajax-nonce' ) || ! current_user_can( 'manage_options' ) ) {
		wp_send_json_error( __( 'Error: Something Wrong Happened!', WP_ULIKE_SLUG ) );
	}

	$instance = wp_ulike_stats::get_instance();
	$output   = $instance->get_all_data();

	wp_send_json_success( json_encode( $output ) );

}
add_action( 'wp_ajax_wp_ulike_ajax_stats', 'wp_ulike_ajax_stats' );

/**
 * AJAX handler to store the state of dismissible notices.
 *
 * @author       	Alimir
 * @since           2.9
 * @return			Void
 */
function wp_ulike_ajax_notice_handler() {
    // Store it in the options table
	if ( ! isset( $_POST['nonce'] ) || ! wp_verify_nonce( $_POST['nonce'], 'wp-ulike-notice-dismissed' ) ) {
		wp_send_json_error( __( 'Error: Something Wrong Happened!', WP_ULIKE_SLUG ) );
	} else {
		update_option( 'wp-ulike-notice-dismissed', TRUE );
		wp_send_json_success( __( 'It\'s OK.', WP_ULIKE_SLUG ) );
	}
}
add_action( 'wp_ajax_wp_ulike_dismissed_notice', 'wp_ulike_ajax_notice_handler' );

/**
 * Remove logs from tables
 *
 * @author       	Alimir
 * @since           2.1
 * @return			Void
 */
function wp_ulike_logs_process(){
	// Global wpdb calss
	global $wpdb;
	// Variables
	$id    = isset( $_POST['id'] ) ? $_POST['id'] : '';
	$table = isset( $_POST['table'] ) ? $_POST['table'] : '';
	$nonce = isset( $_POST['nonce'] ) ? $_POST['nonce'] : '';

	if( $id == '' || ! wp_verify_nonce( $nonce, $table . $id ) || ! current_user_can( 'delete_posts' ) ) {
		wp_send_json_error( __( 'Error: Something Wrong Happened!', WP_ULIKE_SLUG ) );
	}

	if( $wpdb->delete( $wpdb->prefix.$table, array( 'id' => $id ) ) ) {
		wp_send_json_success( __( 'It\'s Ok!', WP_ULIKE_SLUG ) );
	} else {
		wp_send_json_error( __( 'Error: Something Wrong Happened!', WP_ULIKE_SLUG ) );
	}

}
add_action('wp_ajax_ulikelogs','wp_ulike_logs_process');
