<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Data Stores
 *
 * An operational data store (or "ODS") is a database  designed to integrate data from multiple
 * sources to make analysis and reporting easier. Data stores are core segments of the cloud system.
 * OnApp uses any block based storage, i.e. local disks in hypervisors, an Ethernet SAN like iSCSI / AoE, or hardware (fiber) SAN.
 * OnApp OnApp is configured to control SANs physical and virtual routing.
 * This control enables seamless SAN failover management, including SAN testing, emergency migration and data backup.
 * The minimum requirements for the virtual machine Data Stores are:
 *  - 1TB Block Storage (iSCSI, AoE, Fiber - can even be on a shared SAN)
 *
 * @category    API wrapper
 * @package     OnApp
 * @author      Andrew Yatskovets
 * @copyright   (c) 2011 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */

define( 'ONAPP_GETRESOURCE_DATASTORES_LIST_BY_HYPERVISOR_GROUP_ID', 'hypervisor_zones_data_stores' );

/**
 * Data Stores
 *
 * The DataStore class represents the Data Storages of the OnAPP installation.
 *
 * The OnApp_DataStore class uses the following basic methods:
 * {@link load}, {@link save}, {@link delete}, and {@link getList}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */
/**
 * Magic properties used for autocomplete
 *
 * @property integer  id
 * @property string   created_at
 * @property integer  data_store_size
 * @property string   identifier
 * @property string   label
 * @property integer  local_hypervisor_id
 * @property string   updated_at
 * @property integer  zombie_disks_size
 * @property boolean  enabled
 * @property integer  data_store_group_id
 * @property string   ip
 * @property integer  usage
 * @property mixed    capacity
 */
class OnApp_DataStore extends OnApp {
	/**
	 * root tag used in the API request
	 *
	 * @var string
	 */
	protected $rootElement = 'data_store';

	/**
	 * alias processing the object data
	 *
	 * @var string
	 */
	protected $URLPath = 'settings/data_stores';

	public function __construct() {
		parent::__construct();
		$this->className = __CLASS__;
	}

	protected function getURL( $action = ONAPP_GETRESOURCE_DEFAULT ) {
		switch( $action ) {
			case ONAPP_GETRESOURCE_DATASTORES_LIST_BY_HYPERVISOR_GROUP_ID:
				/**
				 * ROUTE :
				 *
				 * @name hypervisor_group_data_stores
				 * @method GET
				 * @alias  /settings/hypervisor_zones/:hypervisor_group_id/data_stores(.:format)
				 * @format {:action=>"index", :controller=>"data_stores"}
				 */
				$resource = 'settings/hypervisor_zones/' . $this->_hypervisor_group_id . '/data_stores';
				break;

			case ONAPP_GETRESOURCE_DEFAULT:
				/**
				 * ROUTE :
				 *
				 * @name data_stores
				 * @method GET
				 * @alias  /settings/data_stores(.:format)
				 * @format {:controller=>"data_stores", :action=>"index"}
				 */
				/**
				 * ROUTE :
				 *
				 * @name data_store
				 * @method GET
				 * @alias  /settings/data_stores/:id(.:format)
				 * @format {:controller=>"data_stores", :action=>"show"}
				 */
				/**
				 * ROUTE :
				 *
				 * @name
				 * @method POST
				 * @alias   /settings/data_stores(.:format)
				 * @format  {:controller=>"data_stores", :action=>"create"}
				 */
				/**
				 * ROUTE :
				 *
				 * @name
				 * @method PUT
				 * @alias  /settings/data_stores/:id(.:format)
				 * @format {:controller=>"data_stores", :action=>"update"}
				 */
				/**
				 * ROUTE :
				 *
				 * @name
				 * @method DELETE
				 * @alias  /settings/data_stores/:id(.:format)
				 * @format {:controller=>"data_stores", :action=>"destroy"}
				 */
				$resource = parent::getURL( $action );
				break;

			default:
				$resource = parent::getURL( $action );
		}
		return $resource;
	}

	/**
	 * Description
	 *
	 * @param integer $hypervisor_group_id hypervisor_group_id
	 *
	 * @return bool|array
	 */
	function getListByHypervisorGroupId( $hypervisor_group_id ) {
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
		$this->setAPIResource( $this->getURL( ONAPP_GETRESOURCE_DATASTORES_LIST_BY_HYPERVISOR_GROUP_ID ) );

		$response = $this->sendRequest( ONAPP_REQUEST_METHOD_GET );

		$result = $this->castStringToClass( $response );

		if( ! empty( $response[ 'errors' ] ) ) {
			return FALSE;
		}

		$this->inheritedObject = $result;

		return ( is_array( $result ) || ! $result ) ? $result : array( $result );
	}
}