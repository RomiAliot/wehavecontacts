<?php

/**
 * Fired when the plugin is uninstalled.
 *
 * When populating this file, consider the following flow
 * of control:
 *
 * - This method should be static
 * - Check if the $_REQUEST content actually is the plugin name
 * - Run an admin referrer check to make sure it goes through authentication
 * - Verify the output of $_GET makes sense
 * - Repeat with other user roles. Best directly by using the links/query string parameters.
 * - Repeat things for multisite. Once for a single site in the network, once sitewide.
 *
 * This file may be updated more in future version of the Boilerplate; however, this is the
 * general skeleton and outline for how the file should work.
 *
 * For more information, see the following discussion:
 * https://github.com/tommcfarlin/WordPress-Plugin-Boilerplate/pull/123#issuecomment-28541913
 *
 * @link       https://www.workana.com/freelancer/20bd71549fa14e18d066cc10a48ca919?ref=user_dropdown
 * @since      1.0.0
 *
 * @package    We_Have_Contacts
 */

// If uninstall not called from WordPress, then exit.
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}
// if user has not permission to manage plugin activation
if ( ! current_user_can( 'activate_plugins' ) ) {
	return;
}else {
	global $wpdb;
	$table_prefix= $wpdb->prefix;
	$table_name = $table_prefix . "havecontacts";
	$sql = "DROP TABLE IF EXISTS $table_name";
	$result = $wpdb->query($wpdb->prepare($sql));
}