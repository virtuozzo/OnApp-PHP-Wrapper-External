<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Network Joins
 *
 * @todo        Add description
 *
 * @category    API wrapper
 * @package     OnApp
 * @subpackage  Hypervisor
 * @author      Vitaliy Kondratyuk
 * @copyright   (c) 2011 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */

/**
 * ONAPP_Hypervisor_NetworkJoin
 *
 * This class reprsents the Networks for Hypervisor.
 *
 * The OnApp_Hypervisor_NetworkJoin class uses the following basic methods:
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
 * @property integer  $network_id
 * @property integer  $hypervisor_id
 * @property string   $interface
 * @property integer  $target_join_id
 * @property string   $target_join_type
 */
class OnApp_Hypervisor_NetworkJoin extends OnApp {
	/**
	 * root tag used in the API request
	 *
	 * @var string
	 */
	protected $rootElement = 'network_join';

	/**
	 * alias processing the object data
	 *
	 * @var string
	 */
	protected $URLPath = 'network_joins';

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
				 * @name hypervisor_network_joins
				 * @method GET
				 * @alias   /settings/hypervisors/:hypervisor_id/network_joins(.:format)
				 * @format  {:controller=>"network_joins", :action=>"index"}
				 */
				/**
				 * ROUTE :
				 *
				 * @name
				 * @method POST
				 * @alias   /settings/hypervisors/:hypervisor_id/network_joins(.:format)
				 * @format  {:controller=>"network_joins", :action=>"create"}
				 */
				/**
				 * ROUTE :
				 *
				 * @name  hypervisor_network_join
				 * @method DELETE
				 * @alias   /settings/hypervisors/:hypervisor_id/network_joins/:id(.:format)
				 * @format  {:controller=>"network_joins", :action=>"destroy"}
				 */
				if( is_null( $this->_hypervisor_id ) && is_null( $this->inheritedObject->_hypervisor_id ) ) {
					$this->logger->error(
						'getURL( ' . $action . ' ): property hypervisor_id not set.',
						__FILE__,
						__LINE__
					);
				}
				else {
					if( is_null( $this->_hypervisor_id ) ) {
						$this->_hypervisor_id = $this->inheritedObject->_hypervisor_id;
					}
				}
				$resource = 'settings/hypervisors/' . $this->hypervisor_id . '/' . $this->URLPath;
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
	 * @param integer $hypervisor_id Hypervisor ID
	 *
	 * @return mixed an array of Object instances on success. Otherwise false
	 * @access public
	 */
	function getList( $hypervisor_id = null, $url_args = null ) {
		if( is_null( $hypervisor_id ) && ! is_null( $this->_hypervisor_id ) ) {
			$hypervisor_id = $this->_hypervisor_id;
		}

		if( ! is_null( $hypervisor_id ) ) {
			$this->_hypervisor_id = $hypervisor_id;
			return parent::getList( $hypervisor_id, $url_args );
		}
		else {
			$this->logger->error(
				'getList: property hypervisor_id not set.',
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
	 * @param integer $id            Network Join ID
	 * @param integer $hypervisor_id Hypervisor ID
	 *
	 * @return mixed serialized Object instance from API
	 * @access public
	 */
	function load( $id = null, $hypervisor_id = null ) {
		if( is_null( $hypervisor_id ) && ! is_null( $this->_hypervisor_id ) ) {
			$hypervisor_id = $this->_hypervisor_id;
		}

		if( is_null( $id ) && ! is_null( $this->_id ) ) {
			$id = $this->_id;
		}

		if( is_null( $id ) &&
			isset( $this->inheritedObject ) &&
			! is_null( $this->inheritedObject->_id )
		) {
			$id = $this->inheritedObject->_id;
		}

		$this->logger->add( 'load: Load class ( id => ' . $id . ' ).' );

		if( ! is_null( $id ) && ! is_null( $hypervisor_id ) ) {
			$this->_id            = $id;
			$this->_hypervisor_id = $hypervisor_id;

			$this->setAPIResource( $this->getURL( ONAPP_GETRESOURCE_LOAD ) );

			$response = $this->sendRequest( ONAPP_REQUEST_METHOD_GET );

			$result = $this->castResponseToClass( $response );

			$this->inheritedObject = $result;

			return $result;
		}
		else {
			if( is_null( $id ) ) {
				$this->logger->error(
					'load: property id not set.',
					__FILE__,
					__LINE__
				);
			}
			else {
				$this->logger->error(
					'load: property hypervisor_id not set.',
					__FILE__,
					__LINE__
				);
			}
		}
	}
}