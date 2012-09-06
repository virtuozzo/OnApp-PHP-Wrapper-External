<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * VM IP Adresses
 *
 * @category    API wrapper
 * @package     OnApp
 * @subpackage  VirtualMachine
 * @author      Vitaliy Kondratyuk
 * @copyright   (c) 2011 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */

/**
 * VM IP Adresses
 *
 * The OnApp_VirtualMachine_IpAddress class doesn't support any basic method.
 *
 */

define( 'ONAPP_GETRESOURCE_JOIN', 'ip_address_join' );

class OnApp_VirtualMachine_IpAddress extends OnApp_IpAddress {
	/**
	 * root tag used in the API request
	 *
	 * @var string
	 */
	protected $rootElement = 'ip_address';

	/**
	 * alias processing the object data
	 *
	 * @var string
	 */
	protected $URLPath = 'ip_addresses';

	/**
	 * Returns the URL Alias of the API Class that inherits the OnApp class
	 *
	 * @param string $action action name
	 *
	 * @return string API resource
	 * @access public
	 */
	protected function getURL( $action = ONAPP_GETRESOURCE_DEFAULT ) {
		switch( $action ) {
			case ONAPP_GETRESOURCE_JOIN:
				$resource = 'virtual_machines/' . $this->_virtual_machine_id . '/' . $this->URLPath;
				$this->logger->debug( 'getURL( ' . $action . ' ): return ' . $resource );
				break;

			default:
				$resource = parent::getURL( $action );
		}
		return $resource;
	}

	/**
	 * Joins another Ip Address to particular virtual machine
	 *
	 * @param integer $ip_address_id        ip address id
	 * @param integer $virtual_machine_id   virtual machine id
	 * @param integer $network_interface_id network interface id
	 */
	function join( $ip_address_id = NULL, $virtual_machine_id = NULL, $network_interface_id = NULL ) {
		if( $virtual_machine_id ) {
			$this->_virtual_machine_id = $virtual_machine_id;
		}
		if( $network_interface_id ) {
			$this->_network_interface_id = $network_interface_id;
		}
		if( $ip_address_id ) {
			$this->_id = $ip_address_id;
		}

		$data = array(
			'root' => 'ip_address_join',
			'data' => array(
				'network_interface_id' => $this->_network_interface_id,
				'ip_address_id'        => $this->_id
			)
		);

		$this->sendPost( ONAPP_GETRESOURCE_JOIN, $data );
	}

	/**
	 * Activates action performed with object
	 *
	 * @param string $action_name the name of action
	 *
	 * @access public
	 */
	function activate( $action_name ) {
		switch( $action_name ) {
			case ONAPP_ACTIVATE_GETLIST:
			case ONAPP_ACTIVATE_LOAD:
			case ONAPP_ACTIVATE_SAVE:
			case ONAPP_ACTIVATE_DELETE:
				exit( 'Call to undefined method ' . __CLASS__ . '::' . $action_name . '()' );
		}
	}
}