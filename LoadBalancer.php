<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Managing Load Balancers
 *
 *
 * @category    API wrapper
 * @package     OnApp
 * @author      Yakubskiy Yuriy
 * @copyright   © 2011 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */

/**
 * Load Balancers
 *
 * The Load Balancer class represents the Load Balancers of the OnAPP installation.
 *
 * The OnApp_LoadBalancer class uses the following basic methods:
 * {@link getList} and {@link load}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
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

    /**
     * Activates action performed with object
     *
     * @param string $action_name the name of action
     *
     * @access public
     */
    function activate( $action_name ) {
        switch( $action_name ) {
            case ONAPP_ACTIVATE_SAVE:
                exit( 'Call to undefined method ' . __CLASS__ . '::' . $action_name . '()' );
                break;
        }
    }
}