<?php
/**
 * Manages LoadBalancingCluster Config
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
 * Manages OnApp Load Balancing Cluster Config
 *
 * The OnApp_LoadBalancingCluster_Config class uses no basic methods and is nested of OnApp_LoadBalancingCluster class
 *
 */
/**
 * Magic properties used for autocomplete
 *
 * @property integer $max_node_amount
 * @property integer $min_node_amount
 */
class OnApp_LoadBalancingCluster_Config extends OnApp {
	public function __construct() {
		parent::__construct();
		$this->className = __CLASS__;
	}
}