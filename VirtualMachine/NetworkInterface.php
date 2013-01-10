<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * VM Network Interface
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
 * VM Network Interface
 *
 * The OnApp_VirtualMachine_NetworkInterface class uses the following basic methods:
 * {@link load}, {@link save}, {@link delete}, and {@link getList}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */
/**
 * Magic properties used for autocomplete
 *
 * @property integer     $id
 * @property string      $label
 * @property string      $created_at
 * @property string      $updated_at
 * @property mixed       $usage
 * @property boolean     $primary
 * @property string      $usage_month_rolled_at
 * @property string      $mac_address
 * @property string      $usage_last_reset_at
 * @property integer     $rate_limit
 * @property string      $identifier
 * @property integer     $network_join_id
 * @property integer     $virtual_machine_id
 * @property string      $default_firewall_rule
 */
class OnApp_VirtualMachine_NetworkInterface extends OnApp {
	/**
	 * root tag used in the API request
	 *
	 * @var string
	 */
	protected $rootElement = 'network_interface';

	/**
	 * alias processing the object data
	 *
	 * @var string
	 */
	protected $URLPath = 'network_interfaces';

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
				 * @name network_interfaces
				 * @method GET
				 * @alias   /network_interfaces(.:format)
				 * @format  {:controller=>"network_interfaces", :action=>"index"}
				 */
				/**
				 * ROUTE :
				 *
				 * @name  network_interface
				 * @method GET
				 * @alias    /network_interfaces/:id(.:format)
				 * @format   {:controller=>"network_interfaces", :action=>"show"}
				 */
				/**
				 * ROUTE :
				 *
				 * @name
				 * @method POST
				 * @alias   /network_interfaces(.:format)
				 * @format  {:controller=>"network_interfaces", :action=>"create"}
				 */
				/**
				 * ROUTE :
				 *
				 * @name
				 * @method PUT
				 * @alias  /network_interfaces/:id(.:format)
				 * @format {:controller=>"network_interfaces", :action=>"update"}
				 */
				/**
				 * ROUTE :
				 *
				 * @name
				 * @method DELETE
				 * @alias   /network_interfaces/:id(.:format)
				 * @format  {:controller=>"network_interfaces", :action=>"destroy"}
				 */
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
	public function getList( $virtual_machine_id = null, $url_args = null ) {
		if( is_null( $virtual_machine_id ) && ! is_null( $this->virtual_machine_id ) ) {
			$virtual_machine_id = $this->virtual_machine_id;
		}

		if( is_null( $virtual_machine_id ) &&
			isset( $this->loadedObject ) &&
			! is_null( $this->loadedObject->virtual_machine_id )
		) {
			$virtual_machine_id = $this->loadedObject->virtual_machine_id;
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
	 * @param integer $id                 Network Interface id
	 * @param integer $virtual_machine_id Virtual Machine id
	 *
	 * @return mixed serialized Object instance from API
	 */
	public function load( $id = null, $virtual_machine_id = null ) {
		if( is_null( $virtual_machine_id ) && ! is_null( $this->virtual_machine_id ) ) {
			$virtual_machine_id = $this->virtual_machine_id;
		}

		if( is_null( $virtual_machine_id ) &&
			isset( $this->loadedObject ) &&
			! is_null( $this->loadedObject->virtual_machine_id )
		) {
			$virtual_machine_id = $this->loadedObject->virtual_machine_id;
		}

		if( is_null( $id ) && ! is_null( $this->id ) ) {
			$id = $this->id;
		}

		if( is_null( $id ) &&
			isset( $this->loadedObject ) &&
			! is_null( $this->loadedObject->id )
		) {
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

	/**
	 * The method saves an Object to your account
	 *
	 * After sending an API request to create an object or change the data in
	 * the existing object, the method checks the response and loads the
	 * exisitng object with the new data.
	 *
	 * @return void
	 */
	public function save() {
		if( isset( $this->id ) ) {
			$obj = $this->editObject();
			$this->load();
		}
		else {
			parent::save();
		}
	}
}