<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://www.workana.com/freelancer/20bd71549fa14e18d066cc10a48ca919?ref=user_dropdown
 * @since      1.0.0
 *
 * @package    We_Have_Contacts
 * @subpackage We_Have_Contacts/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    We_Have_Contacts
 * @subpackage We_Have_Contacts/public
 * @author     Romina Aliotta <aliottaromina@gmail.com>
 */
class We_Have_Contacts_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
	   


	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in We_Have_Contacts_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The We_Have_Contacts_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, WHC_PLUGIN_DIR_URL . 'dist/css/public.css', array(), $this->version , 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in We_Have_Contacts_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The We_Have_Contacts_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, WHC_PLUGIN_DIR_URL . 'dist/js/public.js', array( 'jquery' ), $this->version, false );

	}

	public function whc_shortcode(){
		
		global $wpdb;
		$table = "{$wpdb->prefix}havecontacts";
		$sql = $wpdb->prepare("SELECT * FROM $table");
		$results = $wpdb->get_results($sql);


		//print_r($results);
        if ($results !== ''){

			$output = "
			<table id='whc-table-shortcode'>
			<thead>
				<tr>
				<th>Name</th> 
				<th>Last Name </th> 
				<th>E-mail </th>
				<th>Facebook </th>
				<th>LinkedIn </th>
				<th>Instagram</th> 
				</tr>
			</thead>
			<tbody>
			";

			foreach($results as $result ){
				$name = $result->name;
				$lastname = $result->lastname;
				$email = $result->email;
				$facebook = $result->url_facebook;
				$linkedin = $result->url_linkedin;
				$instagram = $result->url_instagram;

				$output .= "
					
					<tr>
						<td>$name</td> 
						<td>$lastname</td> 
						<td>$email</td> 
						<td>$facebook</td> 
						<td>$linkedin</td> 
						<td>$instagram</td> 
					</tr>
				
				";

			}

		}else {
			echo "No contacts found, please add contacts first to show in the front-end";
		};

		$output .= "
		</tbody>
		</table>";
		
		return $output;
	}

}
