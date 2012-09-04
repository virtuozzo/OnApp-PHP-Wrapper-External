<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Managing IP Addresses
 *
 * @category    API wrapper
 * @package     OnApp
 * @author      Vitaliy Kondratyuk
 * @copyright   (c) 2011 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */

/**
 * IP Addresses
 *
 * The OnApp_IpAddress class uses the following basic methods:
 * {@link load}, {@link save}, {@link delete}, and {@link getList}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */
class OnApp_IpAddress extends OnApp {
	/**
	 * Magic properties
	 *
	 * @property integer  id
	 * @property datetime created_at
	 * @property datetime updated_at
	 * @property address
	 * @property netmask
	 * @property broadcast
	 * @property network_address
	 * @property gateway
	 * @property integer  network_id
	 * @property boolean  free
	 * @property boolean  disallowed_primary
	 * @property integer  user_id
	 */

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
	function getURL( $action = ONAPP_GETRESOURCE_DEFAULT ) {
		switch( $action ) {
			case ONAPP_GETRESOURCE_DEFAULT:
				/**
				 * ROUTE :
				 *
				 * @name network_ip_addresses
				 * @method GET
				 * @alias  /settings/networks/:network_id/ip_addresses(.:format)
				 * @format {:controller=>"ip_addresses", :action=>"index"}
				 */
				/**
				 * ROUTE :
				 *
				 * @name network_ip_address
				 * @method GET
				 * @alias  /settings/networks/:network_id/ip_addresses/:id(.:format)
				 * @format {:controller=>"ip_addresses", :action=>"show"}
				 */
				/**
				 * ROUTE :
				 *
				 * @name
				 * @method POST
				 * @alias  /settings/networks/:network_id/ip_addresses(.:format)
				 * @format {:controller=>"ip_addresses", :action=>"create"}
				 */
				/**
				 * ROUTE :
				 *
				 * @name
				 * @method PUT
				 * @alias  /settings/networks/:network_id/ip_addresses/:id(.:format)
				 * @format {:controller=>"ip_addresses", :action=>"update"}
				 */
				/**
				 * ROUTE :
				 *
				 * @name
				 * @method DELETE
				 * @alias  /settings/networks/:network_id/ip_addresses/:id(.:format)
				 * @format {:controller=>"ip_addresses", :action=>"destroy"}
				 */
				if( is_null( $this->_network_id ) && is_null( $this->_obj->_network_id ) ) {
					$this->logger->error(
						"getURL($action): argument _network_id not set.",
						__FILE__,
						__LINE__
					);
				}
				else {
					if( is_null( $this->_network_id ) ) {
						$this->_network_id = $this->_obj->_network_id;
					}
				}

				$resource = 'settings/networks/' . $this->_network_id . '/' . $this->_resource;
				$this->logger->debug( 'getURL( ' . $action . ' ): return ' . $resource );
				break;

			default:
				$resource = parent::getURL( $action );
		}

		return $resource;
	}

	/**
	 * Sends an API request to get the Objects. After requesting,
	 * unserializes the received response into the array of Objects
	 *
	 * @param integer $network_id Network ID
	 *
	 * @return mixed an array of Object instances on success. Otherwise false
	 * @access public
	 */
	function getList( $network_id = NULL, $url_args = NULL ) {
		if( is_null( $network_id ) && ! is_null( $this->_network_id ) ) {
			$network_id = $this->_network_id;
		}

		if( ! is_null( $network_id ) ) {
			$this->_network_id = $network_id;

			return parent::getList( $network_id, $url_args );
		}
		else {
			$this->logger->error(
				'getList: argument _network_id not set.',
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
	function load( $id = NULL, $network_id = NULL ) {
		if( is_null( $network_id ) && ! is_null( $this->_network_id ) ) {
			$network_id = $this->_network_id;
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

		if( ! is_null( $id ) && ! is_null( $network_id ) ) {
			$this->_id         = $id;
			$this->_network_id = $network_id;

			$this->setAPIResource( $this->getURL( ONAPP_GETRESOURCE_LOAD ) );

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
					'load: argument _network_id not set.',
					__FILE__,
					__LINE__
				);
			}
		}
	}

	/**
	 * The method saves an Object to your account
	 *
	 * After sending an API request to create an object or change the data in
	 * the existing object, the method checks the response and loads the
	 * exisitng object with the new data.
	 *
	 * @return void
	 * @access public
	 */
	function save() {
		if( isset( $this->_id ) ) {
			$obj = $this->_edit();

			if( isset( $obj ) && ! isset( $obj->errors ) ) {
				$this->load();
			}
		}
	}
}