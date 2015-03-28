<?php namespace App\Http;

class HomeController {

	/**
	 * Constructor
	 *
	 */
	public function __construct()
	{
		# code...
	}

	/**
	 * Register the  routes
	 *
	 * @param array $routes Existing routes
	 * @return  array Modified routes
	 */
	public function register_routes($routes)
	{
		$routes['/home/show'] = array(
			array(array($this, 'show'), \WP_JSON_Server::READABLE)
			//array( array( $this, 'new_post'), WP_JSON_Server::CREATABLE | WP_JSON_Server::ACCEPT_JSON ),
		);

		//$routes['/myplugin/mytypeitems/(?P<id>\d+)'] = array(
		//    array( array( $this, 'get_post'), WP_JSON_Server::READABLE ),
		//    array( array( $this, 'edit_post'), WP_JSON_Server::EDITABLE | WP_JSON_Server::ACCEPT_JSON ),
		//    array( array( $this, 'delete_post'), WP_JSON_Server::DELETABLE ),
		//);

		// Add more custom routes here
		return $routes;
	}

	/**
	 *  Show home
	 *  
	 * @return string
	 */
	public function show()
	{
		echo 'This is HomeController show action!';
		exit();
	}

}