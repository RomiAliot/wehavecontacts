<?php

/**
 * Register a custom Route for getting the contacts info
 *
 * This class defines all code necessary to create a CUSTOM ROUTE in the wordpress API for the plugin 
 *
 * @since      1.0.0
 * @package    We_Have_Contacts
 * @subpackage We_Have_Contacts/includes
 * @author     Romina Aliotta <aliottaromina@gmail.com>
 */

 class We_Have_Contacts_Localize_script{

    
    protected $scripts;

    public function __construct(){
       
       $this->scripts = [];
      
    }

    public function add_custom_script($handle, $object_name, $args){
        $this->scripts = $this->add_scripts($this->scripts,$handle, $object_name, $args);

    }

    public function add_scripts($scripts, $handle, $object_name, $args){
        $scripts[] = [
           'handle' => $handle,
           'object_name' => $object_name,
           'args'      =>  $args
        ];

        return $scripts;
    }

    public function run(){
        foreach($this->scripts as $script){
            extract($script, EXTR_OVERWRITE);
            wp_localize_script($handle, $object_name , $args );
        }

        


    }

 }