<?php
/**
 * Manages LoadBalancingCluster AutoScaling
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
 * Manages LoadBalancingCluster AutoScaling
 *
 * The OnApp_LoadBalancingCluster_AutoScaling class uses no basic methods and is nested of OnApp_LoadBalancingCluster class
 *
 */
class OnApp_LoadBalancingCluster_AutoScaling extends OnApp {
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
            case '2.2':
            case '2.3':
                $this->fields = array(
                    'for_minutes' => array(
                        ONAPP_FIELD_MAP  => '_for_minutes',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'enabled'     => array(
                        ONAPP_FIELD_MAP  => '_enabled',
                        ONAPP_FIELD_TYPE => 'boolean',
                    ),
                    'created_at'  => array(
                        ONAPP_FIELD_MAP       => '_created_at',
                        ONAPP_FIELD_TYPE      => 'string',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'updated_at'  => array(
                        ONAPP_FIELD_MAP       => '_updated_at',
                        ONAPP_FIELD_TYPE      => 'string',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'id'          => array(
                        ONAPP_FIELD_MAP       => '_id',
                        ONAPP_FIELD_TYPE      => 'integer',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'units'       => array(
                        ONAPP_FIELD_MAP  => '_units',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'value'       => array(
                        ONAPP_FIELD_MAP  => '_value',
                        ONAPP_FIELD_TYPE => 'integer',
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