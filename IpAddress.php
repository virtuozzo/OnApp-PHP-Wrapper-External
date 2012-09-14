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
/**
 * Magic properties used for autocomplete
 *
 * @property integer  $id
 * @property string   $created_at
 * @property string   $updated_at
 * @property string   $address
 * @property string   $netmask
 * @property string   $broadcast
 * @property string   $network_address
 * @property string   $gateway
 * @property integer  $network_id
 * @property boolean  $free
 * @property boolean  $disallowed_primary
 * @property integer  $user_id
 */
class OnApp_IpAddress extends OnApp {
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
				if( is_null( $this->_network_id ) && is_null( $this->inheritedObject->_network_id ) ) {
					$this->logger->logErrorMessage(
						'getURL( ' . $action . '): property network_id not set.',
						__FILE__,
						__LINE__
					);
				}
				else {
					if( is_null( $this->_network_id ) ) {
						$this->_network_id = $this->inheritedObject->_network_id;
					}
				}

				$resource = 'settings/networks/' . $this->_network_id . '/' . $this->URLPath;
				$this->logger->logDebugMessage( 'getURL( ' . $action . ' ): return ' . $resource );
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
	function getList( $network_id = null, $url_args = null ) {
		if( is_null( $network_id ) && ! is_null( $this->network_id ) ) {
			$network_id = $this->network_id;
		}

		if( ! is_null( $network_id ) ) {
			$this->network_id = $network_id;
			return parent::getList( $network_id, $url_args );
		}
		else {
			$this->logger->logErrorMessage(
				'getList: property network_id not set.',
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
	function load( $id = null, $network_id = null ) {
		if( is_null( $network_id ) && ! is_null( $this->_network_id ) ) {
			$network_id = $this->_network_id;
		}

		if( is_null( $id ) && ! is_null( $this->_id ) ) {
			$id = $this->_id;
		}

		if( is_null( $id ) && isset( $this->inheritedObject ) && ! is_null( $this->inheritedObject->_id ) ) {
			$id = $this->inheritedObject->_id;
		}

		$this->logger->logMessage( 'load: Load class ( id => "' . $id . '").' );

		if( ! is_null( $id ) && ! is_null( $network_id ) ) {
			$this->_id         = $id;
			$this->_network_id = $network_id;

			$this->setAPIResource( $this->getURL( ONAPP_GETRESOURCE_LOAD ) );

			$result                = $this->sendRequest( ONAPP_REQUEST_METHOD_GET );
			$this->inheritedObject = $result;

			return $result;
		}
		else {
			if( is_null( $id ) ) {
				$this->logger->logErrorMessage( 'load: property id not set.', __FILE__, __LINE__ );
			}
			else {
				$this->logger->logErrorMessage( 'load: property network_id not set.', __FILE__, __LINE__ );
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
			$obj = $this->editObject();

			if( isset( $obj ) && ! isset( $obj->errors ) ) {
				$this->load();
			}
		}
	}
}