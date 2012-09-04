<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Configuring Network
 *
 * With OnApp you can create complex networks between virtual machines residing on a
 * single host or across multiple installations of OnApp for production deployments or
 * development and testing purposes. Configure each virtual machine with one or more
 * virtual NICs, each with its own IP and MAC address, to make virtual machines act like
 * physical machines. We take care that each customer has their own VLAN. This provides
 * customers with their own Virtual network which provides network isolation and thus
 * security. Nobody but you will see your traffic, even if they are located on the same physical
 * server. There is a possibility to modify network configurations without changing actual
 * cabling and switch setups.
 *
 * Each virtual server has at least one network interface card, so network traffic can flow into
 * and out of your server. All servers are given static IP addresses. You don't need to worry
 * about that address changing. You can tie your domain names to these IP addresses.
 *
 * @category    API wrapper
 * @package     OnApp
 * @author      Andrew Yatskovets
 * @copyright   (c) 2011 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */

define( 'ONAPP_GETRESOURCE_IP_ADDRESSES', 'ip_addresses' );

define( 'ONAPP_GETRESOURCE_NETWORKS_LIST_BY_HYPERVISOR_GROUP_ID', 'networks_list_by_hypervisor_group_id' );

/**
 * Configuring Network
 *
 * This class represents the Networks added to your system.
 *
 * The OnApp_Network class uses the following basic methods:
 * {@link load} and {@link getList}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */
class OnApp_Network extends OnApp {
	/**
	 * Magic properties
	 *
	 * @property integer  id
	 * @property datetime created_at
	 * @property identifier
	 * @property label
	 * @property datetime updated_at
	 * @property integer  vlan
	 * @property integer  network_group_id
	 */

	/**
	 * root tag used in the API request
	 *
	 * @var string
	 */
	protected $rootElement = 'network';

	/**
	 * alias processing the object data
	 *
	 * @var string
	 */
	protected $URLPath = 'settings/networks';

	public function __construct() {
		parent::__construct();
		$this->className = __CLASS__;
	}

	function getURL( $action = ONAPP_GETRESOURCE_DEFAULT ) {
		switch( $action ) {
			case ONAPP_GETRESOURCE_NETWORKS_LIST_BY_HYPERVISOR_GROUP_ID:
				/**
				 * ROUTE :
				 *
				 * @name hypervisor_group_networks
				 * @method GET
				 * @alias  /settings/hypervisor_zones/:hypervisor_group_id/networks(.:format)
				 * @format {:controller=>"networks", :action=>"index"}
				 */
				$resource = 'settings/hypervisor_zones/' . $this->_hypervisor_group_id . '/networks';
				break;

			case ONAPP_GETRESOURCE_IP_ADDRESSES:
				/**
				 * ROUTE :
				 *
				 * @name network_ip_addresses
				 * @method GET
				 * @alias  /settings/networks/:network_id/ip_addresses(.:format)
				 * @format {:controller=>"ip_addresses", :action=>"index"}
				 */
				$resource = $this->_resource . '/' . $this->_id . '/ip_address';
				break;

			default:
				/**
				 * ROUTE :
				 *
				 * @name networks
				 * @method GET
				 * @alias  /settings/networks(.:format)
				 * @format {:controller=>"networks", :action=>"index"}
				 */
				/**
				 * ROUTE :
				 *
				 * @name network
				 * @method GET
				 * @alias   /settings/networks/:id(.:format)
				 * @format  {:controller=>"networks", :action=>"show"}
				 */
				$resource = parent::getURL( $action );
		}
		return $resource;
	}

	/**
	 * Gets list of networks by hypervisor group id
	 *
	 * @param integer|null $hypervisor_group_id hypervisor group id
	 *
	 * @return bool|mixed
	 */
	function getListByHypervisorGroupId( $hypervisor_group_id = NULL ) {
		if( $hypervisor_group_id ) {
			$this->_hypervisor_group_id = $hypervisor_group_id;
		}
		else {
			$this->logger->error(
				'getListByHypervisorGroupId: argument _hypervisor_group_id not set.',
				__FILE__,
				__LINE__
			);
		}

		$this->setAPIResource( $this->getURL( ONAPP_GETRESOURCE_NETWORKS_LIST_BY_HYPERVISOR_GROUP_ID ) );

		$response = $this->sendRequest( ONAPP_REQUEST_METHOD_GET );

		if( ! empty( $response[ 'errors' ] ) ) {
			$this->errors = $response[ 'errors' ];
			return FALSE;
		}

		$result     = $this->castStringToClass( $response );
		$this->_obj = $result;

		return ( is_array( $result ) || ! $result ) ? $result : array( $result );
	}

	function activate( $action_name ) {
		switch( $action_name ) {
			case ONAPP_ACTIVATE_SAVE:
			case ONAPP_ACTIVATE_DELETE:
				exit( 'Call to undefined method ' . __CLASS__ . '::' . $action_name . '()' );
		}
	}
}