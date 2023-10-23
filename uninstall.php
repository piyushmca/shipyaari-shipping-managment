<?php 
/**
 * Shipyaari Uninstall
 *
 * Uninstalling Shipyaari deletes tables,order status and options.
 *
 * @author      Shipyaari
 * @category    Core
 * @package     Shipyaari/Uninstaller
 * @version     1.0.0
 */

if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
  exit;
}
global $wpdb, $wp_version;

  // Tables.
  $wpdb->query( "DROP TABLE IF EXISTS {$wpdb->prefix}shipyaari_pickup_pincode" );
  $wpdb->query( "DROP TABLE IF EXISTS {$wpdb->prefix}shipyaari_tracking_info" );
  $wpdb->query( "DROP TABLE IF EXISTS {$wpdb->prefix}shipyaari_credentials" );

// Clear any cached data that has been removed
  wp_cache_flush();
?>