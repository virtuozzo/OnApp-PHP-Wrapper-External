<?php
/**
 * Manages LoadBalancingCluster AutoScalingInCpu
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
 * Manages OnApp Load Balancing Cluster Auto Scaling In Cpu
 *
 * The OnApp_LoadBalancingCluster_AutoScaling class uses no basic methods and is nested of OnApp_LoadBalancingCluster class
 *
 */
class OnApp_LoadBalancingCluster_AutoScalingInCpu extends AutoScaling {
    public function __construct() {
        parent::__construct();
        $this->className = __CLASS__;
    }
}