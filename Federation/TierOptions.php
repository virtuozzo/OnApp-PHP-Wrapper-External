<?php

/**
 * Manages Tier Options
 *
 * @category    API wrapper
 * @package     OnApp
 * @subpackage  Federation
 * @author
 * @copyright   © 2016 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */
class OnApp_Federation_TierOptions extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'tier_options';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'federation/hypervisor_zones';

    /**
     * API Fields description
     *
     * @param string|float $version OnApp API version
     * @param string $className current class' name
     *
     * @return array
     */
    public function initFields( $version = null, $className = '' ) {
        switch ( $version ) {
            case 3.4:
            case 3.5:
            case 4.0:
            case 4.1:
            case 4.2:
            case 4.3:
            case 5.0:
                $this->fields = array(
                    'ha'                  => array(
                        ONAPP_FIELD_MAP  => '_ha',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'sla'                 => array(
                        ONAPP_FIELD_MAP  => '_sla',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'storage_performance' => array(
                        ONAPP_FIELD_MAP  => '_storage_performance',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'backups'             => array(
                        ONAPP_FIELD_MAP  => '_backups',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'templates'           => array(
                        ONAPP_FIELD_MAP  => '_templates',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'windows_license'     => array(
                        ONAPP_FIELD_MAP  => '_windows_license',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'ddos_protection'     => array(
                        ONAPP_FIELD_MAP  => '_ddos_protection',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'ipv6'                => array(
                        ONAPP_FIELD_MAP  => '_ipv6',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'dns'                 => array(
                        ONAPP_FIELD_MAP  => '_dns',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'replication'         => array(
                        ONAPP_FIELD_MAP  => '_replication',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                );
                break;
            case 5.1:
                $this->fields = $this->initFields( 5.0 );
                break;
            case 5.2:
                $this->fields = $this->initFields( 5.1 );
                break;
            case 5.3:
                $this->fields = $this->initFields( 5.2 );
                break;
            case 5.4:
                $this->fields = $this->initFields( 5.3 );
                break;
            case 5.5:
                $this->fields = $this->initFields( 5.4 );
                break;
            case 6.0:
                $this->fields = $this->initFields( 5.5 );
                break;
        }

        parent::initFields( $version, __CLASS__ );

        return $this->fields;
    }

}