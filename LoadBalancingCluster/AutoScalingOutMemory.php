<?php
/**
 * Manages LoadBalancingCluster AutoScalingOutMemory
 *
 * @category    API wrapper
 * @package     OnApp
 * @subpackage  LoadBalancingCluster
 * @author      Yakubskiy Yuriy
 * @copyright   © 2011 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */

/**
 * Manages OnApp Load Balancing Cluster Auto Scaling Out Memory
 *
 * The OnApp_LoadBalancingCluster_AutoScalingOutMemory class uses no basic methods and is nested of OnApp_LoadBalancingCluster class
 *
 */
class OnApp_LoadBalancingCluster_AutoScalingOutMemory extends AutoScaling {
    public function __construct() {
        parent::__construct();
        $this->className = __CLASS__;
    }
}