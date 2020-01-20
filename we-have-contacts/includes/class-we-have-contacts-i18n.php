<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://www.workana.com/freelancer/20bd71549fa14e18d066cc10a48ca919?ref=user_dropdown
 * @since      1.0.0
 *
 * @package    We_Have_Contacts
 * @subpackage We_Have_Contacts/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    We_Have_Contacts
 * @subpackage We_Have_Contacts/includes
 * @author     Romina Aliotta <aliottaromina@gmail.com>
 */
class We_Have_Contacts_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'we-have-contacts',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
