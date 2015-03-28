<?php
/*
Plugin Name: WP-API-Eloquent
Plugin URI: 
Description: A WordPress Plugin Template  Base on WP_API and Eloquent 
Version: 1.0
Author: zairl23
Author URI: http://www.github.com/zairl23
License: GPL2
*/
/*
Copyright 2015  zairl23  (email : zoobile@gmail.com)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 2, as 
published by the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/
require __DIR__ . '/vendor/autoload.php';

/**
 * Get db from illuminate
 */
require_once __DIR__.'/config/db.php';

if(!class_exists('Wp_Api_Eloquent'))
{
    class Wp_Api_Eloquent
    {
        /**
         * Construct the plugin object
         */
        public function __construct()
        {
            // register actions
        }

       /**
         * Register endpoits
         */
        public function register_routes($routes) 
        {
            $routes['/welcome'] = array(
                        array(array($this, 'get_index'), \WP_JSON_Server::READABLE)
                        //array( array( $this, 'new_post'), WP_JSON_Server::CREATABLE | WP_JSON_Server::ACCEPT_JSON ),
            );

            $routes['check/(?P<key>\w+)'] = array(
                        array(array($this, 'check'), \WP_JSON_Server::READABLE)
                        //array( array( $this, 'new_post'), WP_JSON_Server::CREATABLE | WP_JSON_Server::ACCEPT_JSON ),
             );
                    //$routes['/myplugin/mytypeitems/(?P<id>\d+)'] = array(
                    //    array( array( $this, 'get_post'), WP_JSON_Server::READABLE ),
                    //    array( array( $this, 'edit_post'), WP_JSON_Server::EDITABLE | WP_JSON_Server::ACCEPT_JSON ),
                    //    array( array( $this, 'delete_post'), WP_JSON_Server::DELETABLE ),
                    //);
                    return $routes;
         }

	public function get_index()
	{
              	
                          header("Content-Type: text/html; charset=utf-8");
                          include(plugin_dir_path(__FILE__) . 'index.php');
                          // echo readfile(plugin_dir_path(__FILE__) . 'index.html');
                          exit();
	}

            public function check($key)
            {
                        return $key;
            }

        /**
         * Activate the plugin
         */
        public static function activate()
        {
            // Do nothing
        } 
    
        /**
         * Deactivate the plugin
         */     
        public static function deactivate()
        {
            // Do nothing
        } 
    }
}

if(class_exists('Wp_Api_Eloquent'))
{
    // Installation and uninstallation hooks
    register_activation_hook(__FILE__, array('Wp_Api_Eloquent',  'activate'));
    register_deactivation_hook(__FILE__, array('Wp_Api_Eloquent',  'deactivate'));

    // instantiate the plugin class
    $wp_api_eloquent = new Wp_Api_Eloquent();
}

function wp_api_eloquent_init() 
{
    global $wp_api_eloquent, $home_controller;

    $wp_api_eloquent = new Wp_Api_Eloquent();
    add_filter('json_endpoints',  array($wp_api_eloquent,  'register_routes'));

    // Home
     $home_controller = new \App\Http\HomeController();
     add_filter('json_endpoints',  array($home_controller,  'register_routes'));
}

add_action('wp_json_server_before_serve',  'wp_api_eloquent_init');

?>
