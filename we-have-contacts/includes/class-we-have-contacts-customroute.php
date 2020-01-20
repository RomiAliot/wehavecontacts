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

 class We_Have_Contacts_Add_Custom_Route {

    protected $namespace;
    protected $routes;

    public function __construct(){
       $this->namespace = "wehavecontacts/v1";
       $this->routes = [];
      
    }

    public function add_custom_routes($routename, $args ){
        $this->routes = $this->add_routes($this->routes, $this->namespace, $routename , $args);

    }

    public function add_routes($routes, $namespace, $routename ,$args){
        $routes[] = [
           'namespace' => $this->namespace,
           'routename' => $routename,
           'args'      =>  $args 
        ];

        return $routes;
    }

    public function run(){
        foreach($this->routes as $route){
            extract($route, EXTR_OVERWRITE);
            register_rest_route($namespace, $routename , $args );
            //var_dump($routes);
            
        }

        


    }

 }