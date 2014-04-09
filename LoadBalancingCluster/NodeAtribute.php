<?php
/**
 * Manages LoadBalancingCluster Node Atributes
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
 * Manages OnApp Load Balancing Cluster Node Atribute
 *
 * The OnApp_LoadBalancingCluster_NodeAtribute class uses no basic methods and is nested of OnApp_LoadBalancingCluster class
 *
 */
class OnApp_LoadBalancingCluster_NodeAtribute extends OnApp {
    public function __construct() {
        parent::__construct();
        $this->className = __CLASS__;
    }

    /**
     * API Fields description
     *
     * @param string|float $version   OnApp API version
     * @param string       $className current class' name
     *
     * @return array
     */
    public function initFields( $version = null, $className = '' ) {
        switch( $version ) {
            case '2.1':
            case 2.2:
            case 2.3:
                $this->fields = array(
                    'cpus'       => array(
                        ONAPP_FIELD_MAP       => '_cpus',
                        ONAPP_FIELD_TYPE      => 'integer',
                        ONAPP_FIELD_READ_ONLY => true
                    ),
                    'cpu_shares' => array(
                        ONAPP_FIELD_MAP       => '_cpu_shares',
                        ONAPP_FIELD_TYPE      => 'integer',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'memory'     => array(
                        ONAPP_FIELD_MAP       => '_memory',
                        ONAPP_FIELD_TYPE      => 'integer',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'rate_limit' => array(
                        ONAPP_FIELD_MAP       => '_rate_limit',
                        ONAPP_FIELD_TYPE      => 'integer',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                );
                break;

            case 3.0:
            case 3.1:
            case 3.2:
            case 3.3:
                $this->fields = $this->initFields( 2.3 );
                break;
        }

        parent::initFields( $version, __CLASS__ );

        return $this->fields;
    }
}