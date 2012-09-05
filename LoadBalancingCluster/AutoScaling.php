<?php
/**
 * Manages LoadBalancingCluster AutoScaling
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
 * Manages LoadBalancingCluster AutoScaling
 *
 * The OnApp_LoadBalancingCluster_AutoScaling class uses no basic methods and is nested of OnApp_LoadBalancingCluster class
 *
 */
/**
 * Magic properties used for autocomplete
 *
 * @property integer for_minutes
 * @property boolean enabled
 * @property string  created_at
 * @property string  updated_at
 * @property integer id
 * @property integer units
 * @property integer value
 */
class OnApp_LoadBalancingCluster_AutoScaling extends OnApp {
	public function __construct() {
		parent::__construct();
		$this->className = __CLASS__;
	}
}