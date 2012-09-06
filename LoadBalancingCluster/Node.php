<?php
/**
 * Manages LoadBalancingCluster Nodes
 *
 * @category    API wrapper
 * @package     OnApp
 * @subpackage  LoadBalancingCluster
 * @author      Yakubskiy Yuriy
 * @copyright   (c) 2011 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */

/**
 * Manages OnApp Load Balancing Cluster Node
 *
 * The OnApp_LoadBalancingCluster_Node class uses no basic methods and is nested of OnApp_LoadBalancingCluster class
 *
 */
/**
 * Magic properties used for autocomplete
 *
 * @property integer $cluster_id
 * @property integer $ip_address_id
 * @property string  $updated_at
 * @property string  $created_at
 * @property integer $id
 * @property integer $virtual_machine_id
 */
class OnApp_LoadBalancingCluster_Node extends OnApp {
	/**
	 * root tag used in the API request
	 *
	 * @var string
	 */
	protected $rootElement = 'load_balancing_cluster_node';

	public function __construct() {
		parent::__construct();
		$this->className = __CLASS__;
	}
}