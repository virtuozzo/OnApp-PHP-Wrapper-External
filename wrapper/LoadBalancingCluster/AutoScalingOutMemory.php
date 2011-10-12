<?php

class OnApp_LoadBalancingCluster_AutoScalingOutMemory extends AutoScaling {
	public function __construct() {
		parent::__construct();
		$this->className = __CLASS__;
	}

}