<?php
/**
 * API Factory Wrapper for OnApp
 *
 * This API provides an interface to onapp.com allowing common virtual machine
 * and account management tasks
 *
 * @category    Factory
 * @package     OnApp
 * @author      Andrew Yatskovets
 * @copyright   (c) 2012 OnApp
 * @link        http://www.onapp.com/
 */
class OnApp_Factory extends OnApp {
	/**
	 * Object constructor
	 *
	 * @param string      $hostname
	 * @param string      $username
	 * @param string      $password
	 * @param string|null $proxy
	 */
	public function __construct( $hostname, $username, $password, $proxy = null ) {
		parent::__construct();
		$this->auth( $hostname, $username, $password );
	}

	/**
	 * Craft new object
	 *
	 * @param string $name  class name
	 *
	 * @return OnApp instance of class
	 */
	public function factory( $name ) {
		$class_name = 'OnApp_' . $name;
		$result = new $class_name();
		$result->options = $this->options;
		return $result;
	}
}