<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * VM IP Address Joins
 *
 * @category    API wrapper
 * @package     OnApp
 * @subpackage  VirtualMachine
 * @author      Vitaliy Kondratyuk
 * @copyright   (c) 2012 OnApp
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
/**
 * Magic properties used for autocomplete
 *
 * @property integer  $id
 * @property string   $created_at
 * @property string   $updated_at
 * @property integer  $network_interface_id
 * @property integer  $ip_address_id
 * @property integer  $virtual_machine_id
 */
class OnApp_VirtualMachine_IpAddressJoin extends OnApp {
	public static $nestedData = array(
		'ip_address' => 'VirtualMachine_IpAddress',
	);

	/**
	 * root tag used in the API request
	 *
	 * @var string
	 */
	protected $rootElement = 'ip_address_join';

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
	 */
	protected function getURL( $action = ONAPP_GETRESOURCE_DEFAULT ) {
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
				if( ! is_null( $this->URLID ) ) {
					$this->virtual_machine_id = $this->URLID;
				}

				if( is_null( $this->virtual_machine_id ) && is_null( $this->loadedObject->virtual_machine_id ) ) {
					$this->logger->logError(
						'getURL( ' . $action . ' ): property virtual_machine_id not set.',
						__FILE__,
						__LINE__
					);
				}
				else {
					if( is_null( $this->virtual_machine_id ) ) {
						$this->virtual_machine_id = $this->loadedObject->virtual_machine_id;
					}
				}

				$resource = 'virtual_machines/' . $this->virtual_machine_id . '/' . $this->URLPath;
				$this->logger->logDebug( 'getURL( ' . $action . ' ): return ' . $resource );
				unset( $this->virtual_machine_id );
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
	 * @param integer $virtual_machine_id Virtual Machine id
	 * @param mixed   $url_args           additional parameters
	 *
	 * @return mixed an array of Object instances on success. Otherwise false
	 */
	function getList( $virtual_machine_id = null, $url_args = null ) {
		if( is_null( $virtual_machine_id ) && ! is_null( $this->virtual_machine_id ) ) {
			$virtual_machine_id = $this->virtual_machine_id;
		}

		if( ! is_null( $virtual_machine_id ) ) {
			$this->virtual_machine_id = $virtual_machine_id;

			return parent::getList( $virtual_machine_id, $url_args );
		}
		else {
			$this->logger->logError(
				'getList: property virtual_machine_id not set.',
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
	 */
	function load( $id = null, $virtual_machine_id = null ) {
		if( ! is_null( $this->URLID ) ) {
			$this->virtual_machine_id = $this->URLID;
		}

		if( is_null( $virtual_machine_id ) && ! is_null( $this->virtual_machine_id ) ) {
			$virtual_machine_id = $this->virtual_machine_id;
		}

		if( is_null( $id ) && ! is_null( $this->id ) ) {
			$id = $this->id;
		}

		if( is_null( $id ) && isset( $this->loadedObject ) && ! is_null( $this->loadedObject->id ) ) {
			$id = $this->loadedObject->id;
		}

		$this->logger->logMessage( 'load: Load class ( id => ' . $id . ' ).' );

		if( ! is_null( $id ) && ! is_null( $virtual_machine_id ) ) {
			$this->id                 = $id;
			$this->virtual_machine_id = $virtual_machine_id;

			$this->setAPIResource( $this->getURL( ONAPP_GETRESOURCE_LOAD ) );
			$result                = $this->sendRequest( ONAPP_REQUEST_METHOD_GET );
			$this->loadedObject = $result;

			return $result;
		}
		else {
			if( is_null( $id ) ) {
				$this->logger->logError(
					'load: property id not set.',
					__FILE__,
					__LINE__
				);
			}
			else {
				$this->logger->logError(
					'load: property virtual_machine_id not set.',
					__FILE__,
					__LINE__
				);
			}
		}
	}

	public function save() {
		$this->URLID = $this->virtual_machine_id;
		unset( $this->virtual_machine_id );
		parent::save();
	}
}