<?php
/**
 * Manages LoadBalancingCluster Node Atributes
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
 * Manages OnApp Load Balancing Cluster Node Atribute
 *
 * The OnApp_LoadBalancingCluster_NodeAtribute class uses no basic methods and is nested of OnApp_LoadBalancingCluster class
 *
 */
class OnApp_LoadBalancingCluster_NodeAtribute extends OnApp {
	/**
	 * Magic properties
	 *
	 * @property integer cpus
	 * @property integer cpu_shares
	 * @property integer memory
	 * @property integer rate_limit
	 */

	public function __construct() {
		parent::__construct();
		$this->className = __CLASS__;
	}
}