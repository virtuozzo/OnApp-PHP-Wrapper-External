<?php

class OnApp_LoadBalancingCluster_AutoScalingOutCpu extends AutoScaling {
	public function __construct() {
		parent::__construct();
		$this->className = __CLASS__;
	}

}