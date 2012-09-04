<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Managing Load Balancing Clusters
 *
 *
 * @category    API wrapper
 * @package     OnApp
 * @author      Yakubskiy Yuriy
 * @copyright   (c) 2011 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */
define( 'ONAPP_GETRESOURCE_GETLIST_BY_USER_ID', 'get_list_by_user_id' );

/**
 * Load Balancing Clusters
 *
 * The Virtual Machine class represents the Virtual Machines of the OnAPP installation.
 *
 * The OnApp_VirtualMachine class uses the following basic methods:
 * {@link load}, {@link save}, {@link delete}, and {@link getList}.
 *
 * Couldn't edit LoadBalancingCluster Ticket #2496
 * In json _tagRoot = 'cluster'       Ticket #2495
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */
class OnApp_LoadBalancingCluster extends OnApp {
	/**
	 * Magic properties
	 *
	 * @property string  name
	 * @property string  created_at
	 * @property integer port
	 * @property integer load_balancer_id
	 * @property string  load_balancer_password
	 * @property string  updated_at
	 * @property integer id
	 * @property integer user_id
	 * @property string  cluster_type
	 * @property string  identifier
	 * @property integer image_template_id
	 */

	public static $nestedData = array(
		'config'                  => 'LoadBalancingCluster_Config',
		'load_balancer'           => 'LoadBalancer',
		'nodes'                   => 'LoadBalancingCluster_Node',
		'node_attributes'         => 'LoadBalancingCluster_NodeAtribute',
		'auto_scaling_out_cpu'    => 'LoadBalancingCluster_AutoScalingOutCpu',
		'auto_scaling_out_memory' => 'LoadBalancingCluster_AutoScalingOutMemory',
		'auto_scaling_in_cpu'     => 'LoadBalancingCluster_AutoScalingInCpu',
		'auto_scaling_in_memory'  => 'LoadBalancingCluster_AutoScalingInMemory',
	);

	/**
	 * root tag used in the API request
	 *
	 * @var string
	 */
	protected $_tagRoot = 'load_balancing_cluster';

	/**
	 * alias processing the object data
	 *
	 * @var string
	 */
	protected $_resource = 'load_balancing_clusters';

	public function __construct() {
		parent::__construct();
		$this->className = __CLASS__;
	}

	function getResource( $action = ONAPP_GETRESOURCE_DEFAULT ) {
		switch( $action ) {
			case ONAPP_GETRESOURCE_GETLIST_BY_USER_ID:

				/**
				 * ROUTE :
				 *
				 * @name user_load_balancing_clusters
				 * @method GET
				 * @alias  /users/:user_id/load_balancing_clusters(.:format)
				 * @format {:controller=>"load_balancing_clusters", :action=>"index"}
				 */
				$resource = 'users/' . $this->_user_id . '/load_balancing_clusters';
				break;

			default:
				/**
				 * ROUTE :
				 *
				 * @name load_balancing_clusters
				 * @method GET
				 * @alias   /load_balancing_clusters(.:format)
				 * @format  {:controller=>"load_balancing_clusters", :action=>"index"}
				 */
				/**
				 * ROUTE :
				 *
				 * @name load_balancing_cluster
				 * @method GET
				 * @alias  /load_balancing_clusters/:id(.:format)
				 * @format {:controller=>"load_balancing_clusters", :action=>"show"}
				 */
				/**
				 * ROUTE :
				 *
				 * @name
				 * @method POST
				 * @alias  /load_balancing_clusters(.:format)
				 * @format {:controller=>"load_balancing_clusters", :action=>"create"}
				 */
				/**
				 * ROUTE :
				 *
				 * @name
				 * @method PUT
				 * @alias  /load_balancing_clusters/:id(.:format)
				 * @format {:controller=>"load_balancing_clusters", :action=>"update"}
				 */
				/**
				 * ROUTE :
				 *
				 * @name
				 * @method DELETE
				 * @alias  /load_balancing_clusters/:id(.:format)
				 * @format {:controller=>"load_balancing_clusters", :action=>"destroy"}
				 */
				$resource = parent::getResource( $action );
				break;
		}

		return $resource;
	}

	/**
	 * Creates or edits Load Balancing Cluster
	 *
	 * @return mixed API query response
	 */
	function save() {
		$this->fields[ 'load_balancer_attributes' ]                        = array(
			ONAPP_FIELD_MAP => '_load_balancer_attributes',
		);
		$this->fields[ 'load_balancing_cluster_load_balancer_attributes' ] = array(
			ONAPP_FIELD_MAP => '_load_balancing_cluster_load_balancer_attributes',
		);
		$this->fields[ 'auto_scaling_out_memory_attributes' ]              = array(
			ONAPP_FIELD_MAP => '_auto_scaling_out_memory_attributes',
		);
		$this->fields[ 'auto_scaling_out_cpu_attributes' ]                 = array(
			ONAPP_FIELD_MAP => '_auto_scaling_out_cpu_attributes',
		);
		$this->fields[ 'auto_scaling_in_memory_attributes' ]               = array(
			ONAPP_FIELD_MAP => '_auto_scaling_in_memory_attributes',
		);
		$this->fields[ 'auto_scaling_in_cpu_attributes' ]                  = array(
			ONAPP_FIELD_MAP => '_auto_scaling_in_cpu_attributes',
		);
		$this->fields[ 'available_vms' ]                                   = array(
			ONAPP_FIELD_MAP => '_available_vms',
		);
		$this->fields[ 'image_template_id' ]                               = array(
			ONAPP_FIELD_MAP => '_image_template_id',
		);

		parent::save();
		$this->initFields( $this->getAPIVersion() );

		return $result;
	}

	/**
	 * Gets list of clusters by user id
	 *
	 * @param integer|null $user_id user id
	 *
	 * @return bool|mixed
	 */
	function getListByUserId( $user_id = NULL ) {
		if( $user_id ) {
			$this->_user_id = $user_id;
		}
		else {
			$this->logger->error(
				'getListByUserId: argument _user_id not set.',
				__FILE__,
				__LINE__
			);
		}

		$this->setAPIResource( $this->getResource( ONAPP_GETRESOURCE_GETLIST_BY_USER_ID ) );

		$response = $this->sendRequest( ONAPP_REQUEST_METHOD_GET );

		if( ! empty( $response[ 'errors' ] ) ) {
			$this->errors = $response[ 'errors' ];
			return false;
		}

		$result     = $this->castStringToClass( $response );
		$this->_obj = $result;

		return ( is_array( $result ) || ! $result ) ? $result : array( $result );
	}
}