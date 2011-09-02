<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Managing Load Balancers
 *
 *
 * @category	API WRAPPER
 * @package		OnApp
 * @subpackage	LoadBalancer
 * @author		Yakubskiy Yuriy
 * @copyright	(c) 2011 OnApp
 * @link		http://www.onapp.com/
 * @see			OnApp
 */

/**
 * Load Balancers
 *
 * The Load Balancer class represents the Load Balancers of the OnAPP installation.
 *
 * The ONAPP_VirtualMachine class uses the following basic methods:
 * {@link getList} and {@link load}.
 *
 */
class OnApp_LoadBalancer extends OnApp_VirtualMachine {

    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'load_balancer';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'load_balancers';

    public function __construct() {
        parent::__construct();
        $this->className = __CLASS__;
    }

    /**
     * Activates action performed with object
     *
     * @param string $action_name the name of action
     *
     * @access public
     */
    function activate($action_name) {
        switch ($action_name) {
            case ONAPP_ACTIVATE_SAVE:
                exit('Call to undefined method ' . __CLASS__ . '::' . $action_name . '()');
                break;
        }
    }

}