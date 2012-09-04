<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Managing Hypervisors
 *
 * In computing, a hypervisor, also called virtual machine monitor (VMM), allows
 * multiple operating systems to run concurrently on a host computer - a feature
 * called hardware virtualization. The hypervisor presents the guest operating
 * systems with a virtual platform  and monitors the execution of the guest
 * operating systems. In that way, multiple operating systems, including
 * multiple instances of the same operating system, can share hardware
 * resources.
 * In OnApp the Hypervisor servers:
 *    - Provide the system resources, such as CPU, memory, and network
 *    - Control the virtual differentiation of entities, such as machines and corresponding application data being delivered to cloud-hosted applications
 *    - Take care of secure virtualization and channeling of storage, data communications and machine processing
 *    - Can be located at different geographical zones
 *    - Can have different CPU and RAM
 *
 * @category    API wrapper
 * @package     OnApp
 * @author      Andrew Yatskovets
 * @copyright   (c) 2011 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */

/**
 *
 *
 */
define( 'ONAPP_GETRESOURCE_HYPERVISORS_BY_HYPERVISOR_GROUP_ID', 'hypervisors' );
/**
 *
 *
 */
define( 'ONAPP_GETRESOURCE_HYPERVISOR_REBOOT', 'hypervisor_reboot' );

/**
 * Hypervisors
 *
 * This class represents the Hypervisors of your OnApp installation. The OnApp class is the parent of the Hypervisors class.
 *
 * The OnApp_Hypervisor class uses the following basic methods:
 * {@link load}, {@link save}, {@link delete}, and {@link getList}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */
class OnApp_Hypervisor extends OnApp {
	/**
	 * Magic properties
	 *
	 * @property integer  id
	 * @property datetime called_in_at
	 * @property datetime created_at
	 * @property integer  failure_count
	 * @property yaml     health
	 * @property ip_address
	 * @property label
	 * @property boolean  locked
	 * @property integer  memory_overhead
	 * @property boolean  online
	 * @property boolean  spare
	 * @property datetime updated_at
	 * @property yaml     xen_info
	 * @property boolean  enabled
	 * @property integer  hypervisor_group_id
	 * @property string   hypervisor_type
	 * @property integer  cpu_cores
	 * @property integer  free_memory
	 * @property integer  total_cpus
	 * @property integer  total_memory
	 * @property integer  used_cpu_resources
	 * @property integer  memory_allocated_by_running_vms
	 * @property integer  total_memory_allocated_by_vms
	 * @property boolean  disable_failover
	 * @property string   redis_password
	 * @property array    free_disk_space
	 */

	/**
	 * root tag used in the API request
	 *
	 * @var string
	 */
	protected $_tagRoot = 'hypervisor';

	/**
	 * alias processing the object data
	 *
	 * @var string
	 */
	protected $_resource = 'settings/hypervisors';

	public function __construct() {
		parent::__construct();
		$this->className = __CLASS__;
	}

	function getResource( $action = ONAPP_GETRESOURCE_DEFAULT ) {
		switch( $action ) {
			case ONAPP_GETRESOURCE_HYPERVISORS_BY_HYPERVISOR_GROUP_ID:
				/**
				 * ROUTE :
				 *
				 * @name hypervisor_group_hypervisors
				 * @method GET
				 * @alias  /settings/hypervisor_zones/:hypervisor_group_id/hypervisors(.:format)
				 * @format {:controller=>"hypervisors", :action=>"index"}
				 */
				$resource = 'settings/hypervisor_zones/' . $this->_hypervisor_group_id . '/hypervisors';
				break;

			case ONAPP_GETRESOURCE_DEFAULT:
				/**
				 * ROUTE :
				 *
				 * @name hypervisors
				 * @method GET
				 * @alias  /settings/hypervisors(.:format)
				 * @format {:controller=>"settings_hypervisors", :action=>"index"}
				 */
				/**
				 * ROUTE :
				 *
				 * @name hypervisor
				 * @method GET
				 * @alias   /settings/hypervisors/:id(.:format)
				 * @format  {:controller=>"settings_hypervisors", :action=>"show"}
				 */
				/**
				 * ROUTE :
				 *
				 * @name
				 * @method POST
				 * @alias   /settings/hypervisors(.:format)
				 * @format  {:controller=>"settings_hypervisors", :action=>"create"}
				 */
				/**
				 * ROUTE :
				 *
				 * @name
				 * @method PUT
				 * @alias  /settings/hypervisors/:id(.:format)
				 * @format {:controller=>"settings_hypervisors", :action=>"update"}
				 */
				/**
				 * ROUTE :
				 *
				 * @name
				 * @method DELETE
				 * @alias   /settings/hypervisors/:id(.:format)
				 * @format  {:controller=>"settings_hypervisors", :action=>"destroy"}
				 */
				$resource = parent::getResource( $action );
				break;
			case ONAPP_GETRESOURCE_HYPERVISOR_REBOOT:
				/**
				 * ROUTE :
				 *
				 * @name reboot_hypervisor
				 * @method POST
				 * @alias   /settings/hypervisors/:id/reboot(.:format)
				 * @format  {:action=>"reboot", :controller=>"settings_hypervisors"}
				 */
				$resource = $this->_resource . '/' . $this->_id . '/reboot';
				break;

			default:
				$resource = parent::getResource( $action );
				break;
		}

		return $resource;
	}

	/**
	 * Gets Hypervisors List by hypervisor group id
	 *
	 * @param integer|null $group_id hypervisor group id
	 *
	 * @return bool|mixed
	 */
	function GetListByGroupId( $group_id = NULL ) {
		if( $group_id ) {
			$this->_hypervisor_group_id = $group_id;
		}
		else {
			$this->logger->error(
				'GetListByGroupId: argument _group_id not set.',
				__FILE__,
				__LINE__
			);
		}

		$this->setAPIResource( $this->getResource( ONAPP_GETRESOURCE_HYPERVISORS_BY_HYPERVISOR_GROUP_ID ) );

		$response = $this->sendRequest( ONAPP_REQUEST_METHOD_GET );

		if( ! empty( $response[ 'errors' ] ) ) {
			$this->errors = $response[ 'errors' ];
			return false;
		}

		$result     = $this->castStringToClass( $response );
		$this->_obj = $result;

		return ( is_array( $result ) || ! $result ) ? $result : array( $result );
	}

	/**
	 * Reboots hypervisor
	 *
	 * @param integer $hypervisor_id hypervisor id
	 *
	 * @return void
	 *
	 */
	function reboot( $hypervisor_id ) {
		if( $hypervisor_id ) {
			$this->_id = $hypervisor_id;
		}
		else {
			$this->logger->error(
				'reboot: argument _hypervisor_id not set.',
				__FILE__,
				__LINE__
			);
		}

		$data = array(
			'root' => 'tmp_holder',
			'data' => array(
				'confirm' => '1',
			),
		);

		$this->sendPost( ONAPP_GETRESOURCE_HYPERVISOR_REBOOT, $data );
	}

	function save() {
		if( $this->_id ) {
			$this->fields[ 'hypervisor_group_id' ][ ONAPP_FIELD_REQUIRED ] = false;
		}

		return parent::save();
	}
}