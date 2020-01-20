<?php

/**
 * Register all menus and submenus of the plugin
 *
 * This class defines all code necessary to create a MENU PAGE in the admin panel for manage the plugin.
 *
 * @since      1.0.0
 * @package    We_Have_Contacts
 * @subpackage We_Have_Contacts/includes
 * @author     Romina Aliotta <aliottaromina@gmail.com>
 */

 class We_Have_Contacts_Add_Menu_Page {

      protected $menus;
      protected $submenus;

      public function __construct(){
          $this->menus = [];
          $this->submenus = [];
      }


      /**
	 * Add a new menu to the array ($this->menus) and register in WordPress.
	 *
	 * @since    1.0.0
     * @access   public
     * 
	 * @param    string    $pageTitle       
	 * @param    string    $menuTitle        
	 * @param    string    $capability       
	 * @param    string    $menuSlug         
	 * @param    callable  $functionName     
	 * @param    string    $iconUrl          
	 * @param    int       $position         
	 */
    public function add_menu_page( $pageTitle, $menuTitle, $capability, $menuSlug, $functionName, $iconUrl = '', $position = null){

         $this->menus = $this->add_menu( $this->menus, $pageTitle, $menuTitle, $capability, $menuSlug, $functionName, $iconUrl, $position);

    }

    private function add_menu($menus, $pageTitle, $menuTitle, $capability, $menuSlug, $functionName, $iconUrl, $position) {

        $menus[] = [
            'pageTitle'   => $pageTitle,
            'menuTitle'   => $menuTitle,
            'capability'  => $capability,
            'menuSlug'    => $menuSlug,
            'functionName'=> $functionName,
            'iconUrl'     => $iconUrl,
            'position'    => $position
        ];

        return $menus;

    
    }

    public function run(){
        foreach($this->menus as $menus){
            extract($menus, EXTR_OVERWRITE);
            add_menu_page($pageTitle, $menuTitle, $capability, $menuSlug, $functionName, $iconUrl, $position);
        }
    }

    

 }