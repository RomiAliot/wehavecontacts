<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://www.workana.com/freelancer/20bd71549fa14e18d066cc10a48ca919?ref=user_dropdown
 * @since      1.0.0
 *
 * @package    We_Have_Contacts
 * @subpackage We_Have_Contacts/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    We_Have_Contacts
 * @subpackage We_Have_Contacts/admin
 * @author     Romina Aliotta <aliottaromina@gmail.com>
 */



class We_Have_Contacts_Admin {

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
	 * Add menu pages
	 */
	private $build_menu;
	/**
	 * Add route
	 */
	protected $custom_route;

	protected $args;
	protected $args_2;
	protected $args_1;
	protected $actual;
	protected $args_3;
	
	/**
	 * Add localize script
	 */

	 protected $add_script;
	 protected $args_script;
	
	 /**
	 * Add route class
	 */
	protected $add_routes;
   

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		$this->args = [];
		$this->args_2 = [];
		$this->args_3 = [];
		$this->args_1 = [];
		$this->actual = [];
		$this->args_script = [];
		$this->build_menu = New We_Have_Contacts_Add_Menu_Page();
		$this->custom_route = New We_Have_Contacts_Add_Custom_Route();
		$this->add_script = New We_Have_Contacts_Localize_script();

	}

	/**
	 * Register the stylesheets for the admin area.
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

		/*if( $hook != 'toplabel_page_whc_data'){
			return;
		}*/

		wp_enqueue_style( $this->plugin_name, WHC_PLUGIN_DIR_URL . 'dist/css/admin.css', array(), $this->version , 'all' );
		wp_enqueue_style( 'material-icons', 'https://fonts.googleapis.com/icon?family=Material+Icons' );
		wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css?family=Montserrat+Alternates:300,400,500,700,800,900|Montserrat:400,500,600,700,800&display=swap');

	}

	/**
	 * Register the JavaScript for the admin area.
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
		
		wp_enqueue_script( $this->plugin_name, WHC_PLUGIN_DIR_URL . 'dist/js/admin.js', array( 'jquery' ), $this->version, true );
		wp_enqueue_script( 'sweetalert','https://cdn.jsdelivr.net/npm/sweetalert2@9', array( 'jquery' ), $this->version, true );

	
	}

	/**
	 * Add a localize script.
	 *
	 * @since    1.0.0
	 */

	public function add_localize_script(){

		   $this->$args_script = [
			'nonce' => wp_create_nonce( 'wp_rest' ),
			'base_url' => rest_url('/wehavecontacts/v1/contacts'),
		   ];

			$this->add_script-> add_custom_script(
				$this->plugin_name,
				'contacts_data',
				$this->$args_script
			);
	

		    $this->add_script->run();
	
		  
	 }

	/**
	 * Add menu pages.
	 *
	 * @since    1.0.0
	 */

	public function add_menu_page(){

		$this->build_menu->add_menu_page(
			__('WHContacts', ' we-have-contacts'),
			__('WHContacts', ' we-have-contacts'),
			'manage_options',
			'whc_data',
			[$this, 'controler_display_menu'],
			'dashicons-id',
			22
		);

		$this->build_menu->run();
	
		

	}

	public function controler_display_menu(){
		
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/we-have-contacts-admin-display.php';
	}

	/**
	 * Add Custom Routes.
	 *
	 * @since    1.0.0
	 */

	 public function add_custom_route(){

		// This Route is for creating contacts 
		 
		$this->args_3 = [
			'methods'  => WP_REST_Server::CREATABLE,
			'callback' => [$this, 'adding_custom_route_3'],
			'arg'    => array( 
				'sanitize_callback' => 'absint',
				'permission_callback' => function(){
					return is_user_logged_in();
			    }
			)
		 ];

		// This Route is for deleting contacts 
		 
		$this->args = [
			'methods'  => WP_REST_Server::DELETABLE,
			'callback' => [$this, 'adding_custom_route_2'],
			'arg'    => array( 
				'sanitize_callback' => 'absint'
			)
		 ];
		 // This Route is for updating contacts 
		 
		$this->args_1 = [
			'methods'  => WP_REST_Server::EDITABLE,
			'callback' => [$this, 'adding_custom_route_1'],
			'arg'    => array( 
				'sanitize_callback' => 'absint',
			    'permission_callback' => function(){
				return is_user_logged_in();
				}
			)
		 ];

		// This Route is for getting all contacts 	

		 $this->args_2 = [
			'methods'  => WP_REST_Server::READABLE,
			'callback' => [$this, 'adding_custom_route'],
			'arg'    => array( 
				'permission_callback' => function(){
					return is_user_logged_in();
				}

			)
		 ];
			
		    $this->custom_route->add_custom_routes(
				'contacts',
				$this->args_3
	        );
		 
			$this->custom_route->add_custom_routes(
				'contacts',
				$this->args_2
			);

			$this->custom_route->add_custom_routes(
				'contacts',
				$this->args
			);

			$this->custom_route->add_custom_routes(
				'contacts',
				$this->args_1
			);
		 
		 $this->custom_route->run(); 
		 
	 }

	  // This Route is for getting all contacts 

	  public function adding_custom_route(){

		global $wpdb;
		
		
		$table = "{$wpdb->prefix}havecontacts";
		$row= "$parameters";
		$sql = " SELECT * FROM $table";
		
		
		$results = $wpdb->query($wpdb->prepare($sql));
		
			if($results !== false){
				if($results != 0){
				$contacts = array(
					'allContacts' => $wpdb->last_result,
								
				);
				
				
				}else{
					echo " No contacts found";
				}
			
			}else {
				echo "there was an error please try again";
			}
			
		return $contacts;
	}

//This Route is for update a contact

	public function adding_custom_route_1(WP_REST_Request $request){

	
		global $wpdb;
		//data
		$id = $request['id'];
		$name = $request['name'];
		$lastname = $request['lastname'];
		$email = $request['email'];
		$facebook = $request['facebook'];
		$linkedin = $request['linkedin'];
		$instagram = $request['instagram'];
		
		$table = "{$wpdb->prefix}havecontacts";
		$sql= "UPDATE $table
			SET name = '$name',
				lastname = '$lastname',
				url_facebook = '$facebook',
				url_instagram = '$instagram',
				url_linkedin = '$linkedin',
				email = '$email'
			WHERE id = $id";
		
		$results = $wpdb->query($wpdb->prepare($sql));
		
		if($results !== false){
		
			$congrats = "updated";
		
		}else{
			echo "there was an error, try again";
		}

		return $congrats;
		
	}


//This Route is for deleting contacts

	public function adding_custom_route_2(WP_REST_Request $request){

	
		global $wpdb;
		
		$parameters = $request['id'];
		$morepar = $request['mensaje'];
		$table = "{$wpdb->prefix}havecontacts";
		$row= "$parameters";
		$sql = " DELETE FROM $table WHERE id = $row";
	
		
		$results = $wpdb->query($wpdb->prepare($sql));
		
		if($results !== false){

			$congrats= array( 
				'parms'    => $morepar
			);
		
			}else{
				echo " No contacts found";

		}
	
		return $congrats;
	
	}


// this route is for adding new contacts

	public function adding_custom_route_3(WP_REST_request $request){

		global $wpdb;
		
		// data
	$name = $request['name'];
	$lastname = $request['lastname'];
	$email = $request['email'];
	$facebook = $request['facebook'];
	$instagram = $request ['instagram'];
	$linkedin = $request['linkedin'];
	
		$table = "{$wpdb->prefix}havecontacts";
		$sql = "INSERT INTO $table
				(name, lastname, url_facebook, url_instagram, url_linkedin, email)
				VALUES
				('$name', '$lastname', '$facebook', '$linkedin', '$instagram', '$email')";
		
		$results = $wpdb->query($wpdb->prepare($sql));
	
		if($results !== false){
			$congrats = "new contact!";
		}else{
			echo "there was an error";
		}
	
		return $contacts;
	
	}
  

}


