<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * VM IP Address Joins
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
 * VM IP Address Joins
 *
 * The OnApp_VirtualMachine_IpAddressJoin uses the following basic methods:
 * {@link load}, {@link save}, {@link delete}, and {@link getList}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */
class OnApp_VirtualMachine_IpAddressJoin extends OnApp {
	/**
	 * Magic properties
	 *
	 * @property integer  id
	 * @property datetime created_at
	 * @property datetime updated_at
	 * @property integer  network_interface_id
	 * @property integer  ip_address_id
	 */

	public static $nestedData = array(
		'ip_address' => 'VirtualMachine_IpAddress',
	);

	/**
	 * root tag used in the API request
	 *
	 * @var string
	 */
	protected $_tagRoot = 'ip_address_join';

	/**
	 * alias processing the object data
	 *
	 * @var string
	 */
	protected $_resource = 'ip_addresses';

	public function __construct() {
		parent::__construct();
		$this->className = __CLASS__;
	}

	/**
	 * Returns the URL Alias of the API Class that inherits the OnApp class
	 *
	 * @param string $action action name
	 *
	 * @return string API resource
	 * @access public
	 */
	function getResource( $action = ONAPP_GETRESOURCE_DEFAULT ) {
		switch( $action ) {
			case ONAPP_GETRESOURCE_DEFAULT:
				/**
				 * ROUTE :
				 *
				 * @name virtual_machine_ip_address_joins
				 * @method GET
				 * @alias   /virtual_machines/:virtual_machine_id/ip_addresses(.:format)
				 * @format  {:controller=>"ip_address_joins", :action=>"index"}
				 */
				/**
				 * ROUTE :
				 *
				 * @name virtual_machine_ip_address_join
				 * @method GET
				 * @alias    /virtual_machines/:virtual_machine_id/ip_addresses/:id(.:format)
				 * @format   {:controller=>"ip_address_joins", :action=>"show"}
				 */
				/**
				 * ROUTE :
				 *
				 * @name
				 * @method POST
				 * @alias    /virtual_machines/:virtual_machine_id/ip_addresses(.:format)
				 * @format   {:controller=>"ip_address_joins", :action=>"create"}
				 */
				/**
				 * ROUTE :
				 *
				 * @name
				 * @method DELETE
				 * @alias   /virtual_machines/:virtual_machine_id/ip_addresses/:id(.:format)
				 * @format  {:controller=>"ip_address_joins", :action=>"destroy"}
				 */
				if( is_null( $this->_virtual_machine_id ) && is_null( $this->_obj->_virtual_machine_id ) ) {
					$this->logger->error(
						"getResource($action): argument _virtual_machine_id not set.",
						__FILE__,
						__LINE__
					);
				}
				else {
					if( is_null( $this->_virtual_machine_id ) ) {
						$this->_virtual_machine_id = $this->_obj->_virtual_machine_id;
					}
				}

				$resource = 'virtual_machines/' . $this->_virtual_machine_id . '/' . $this->_resource;
				$this->logger->debug( 'getResource( ' . $action . ' ): return ' . $resource );
				break;

			default:
				$resource = parent::getResource( $action );
				break;
		}

		return $resource;
	}

	/**
	 * Sends an API request to get the Objects. After requesting,
	 * unserializes the received response into the array of Objects
	 *
	 * @param integer $virtual_machine_id Virtual Machine id
	 *
	 * @return mixed an array of Object instances on success. Otherwise false
	 * @access public
	 */
	function getList( $virtual_machine_id = null, $url_args = null ) {
		if( is_null( $virtual_machine_id ) && ! is_null( $this->_virtual_machine_id ) ) {
			$virtual_machine_id = $this->_virtual_machine_id;
		}

		if( ! is_null( $virtual_machine_id ) ) {
			$this->_virtual_machine_id = $virtual_machine_id;

			return parent::getList( $virtual_machine_id, $url_args );
		}
		else {
			$this->logger->error(
				'getList: argument _virtual_machine_id not set.',
				__FILE__,
				__LINE__
			);
		}
	}

	/**
	 * Sends an API request to get the Object after sending,
	 * unserializes the response into an object
	 *
	 * The key field Parameter ID is used to load the Object. You can re-set
	 * this parameter in the class inheriting OnApp class.
	 *
	 * @param integer $id                 IP Address Join id
	 * @param integer $virtual_machine_id Virtual Machine id
	 *
	 * @return mixed serialized Object instance from API
	 * @access public
	 */
	function load( $id = null, $virtual_machine_id = null ) {
		if( is_null( $virtual_machine_id ) && ! is_null( $this->_virtual_machine_id ) ) {
			$virtual_machine_id = $this->_virtual_machine_id;
		}

		if( is_null( $id ) && ! is_null( $this->_id ) ) {
			$id = $this->_id;
		}

		if( is_null( $id ) &&
			isset( $this->_obj ) &&
			! is_null( $this->_obj->_id )
		) {
			$id = $this->_obj->_id;
		}

		$this->logger->add( "load: Load class ( id => '$id')." );

		if( ! is_null( $id ) && ! is_null( $virtual_machine_id ) ) {
			$this->_id                 = $id;
			$this->_virtual_machine_id = $virtual_machine_id;

			$this->setAPIResource( $this->getResource( ONAPP_GETRESOURCE_LOAD ) );

			$response = $this->sendRequest( ONAPP_REQUEST_METHOD_GET );

			$result = $this->_castResponseToClass( $response );

			$this->_obj = $result;

			return $result;
		}
		else {
			if( is_null( $id ) ) {
				$this->logger->error(
					'load: argument _id not set.',
					__FILE__,
					__LINE__
				);
			}
			else {
				$this->logger->error(
					'load: argument _virtual_machine_id not set.',
					__FILE__,
					__LINE__
				);
			}
		}
	}
}