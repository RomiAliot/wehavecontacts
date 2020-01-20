<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://www.linkedin.com/in/romina-aliotta/?locale=en_US
 * @since             1.0.0
 * @package           We_Have_Contacts
 *
 * @wordpress-plugin
 * Plugin Name:       WE HAVE CONTACTS
 * Plugin URI:        https://www.linkedin.com/in/romina-aliotta/
 * Description:       This is a Wordpress plugin to manage contacts data and display them in the                            front-end of the site with a table and using simple shortcode.
 * Version:           1.0.0
 * Author:            Romina Aliotta
 * Author URI:        https://www.linkedin.com/in/romina-aliotta/
 * License:           GNU GENERAL PUBLIC LICENSE  v3.0
 * License URI:       https://www.gnu.org/licenses/gpl-3.0.html
 * Text Domain:       we-have-contacts
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}
define( 'WHC_PLUGIN_DIR_URL', plugin_dir_url( __FILE__ ) );

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'WE_HAVE_CONTACTS_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-we-have-contacts-activator.php
 */
function activate_we_have_contacts() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-we-have-contacts-activator.php';
	We_Have_Contacts_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-we-have-contacts-deactivator.php
 */
function deactivate_we_have_contacts() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-we-have-contacts-deactivator.php';
	We_Have_Contacts_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_we_have_contacts' );
register_deactivation_hook( __FILE__, 'deactivate_we_have_contacts' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-we-have-contacts.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_we_have_contacts() {

	$plugin = new We_Have_Contacts();
	$plugin->run();

}
run_we_have_contacts();
