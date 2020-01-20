<?php

/**
 * Fired during plugin activation
 *
 * @link       https://www.workana.com/freelancer/20bd71549fa14e18d066cc10a48ca919?ref=user_dropdown
 * @since      1.0.0
 *
 * @package    We_Have_Contacts
 * @subpackage We_Have_Contacts/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    We_Have_Contacts
 * @subpackage We_Have_Contacts/includes
 * @author     Romina Aliotta <aliottaromina@gmail.com>
 */
class We_Have_Contacts_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	
  
	public static function activate() {

		global $wpdb;

		$table_prefix = $wpdb->prefix;
		$table_name = $table_prefix . "havecontacts";
		$charset_collate = $wpdb->get_charset_collate();

		$sql = "CREATE TABLE $table_name (
			id mediumint(9) NOT NULL AUTO_INCREMENT,
			time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
			name tinytext NOT NULL,
			lastname tinytext NOT NULL,
			email varchar(55) DEFAULT '',
			url_facebook varchar(55) DEFAULT '',
			url_instagram varchar(55) DEFAULT '',
			url_linkedin varchar(55) DEFAULT '',
			PRIMARY KEY  (id)
		  ) $charset_collate;";

    
        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		dbDelta($sql);

		$wpdb->insert(
			$table_name,
			array(
				'time' => current_time('mysql'),
				'name' => 'Name',
				'lastname' => 'lastname',
				'email' => 'example@gmail.com',
				'url_facebook' => 'https://www.facebook.com/#',
				'url_instagram' => 'https://www.instagram.com/#',
				'url_linkedin' => 'https://www.linkedin.com/#'

			)
			);

		flush_rewrite_rules();

		
	}

	

}
