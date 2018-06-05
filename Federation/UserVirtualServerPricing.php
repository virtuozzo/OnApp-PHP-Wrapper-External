<?php

/**
 * Manages User Virtual Server Pricing
 *
 * @category    API wrapper
 * @package     OnApp
 * @subpackage  Federation
 * @author      Bohdan Zemlyanskyi
 * @copyright   © 2011 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */
class OnApp_Federation_UserVirtualServerPricing extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'user_virtual_server_pricing';
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
                $this->fields = array(
                    'auto_scaling'              => array(
                        ONAPP_FIELD_MAP  => '_auto_scaling',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'auto_scaling_max'          => array(
                        ONAPP_FIELD_MAP  => '_auto_scaling_max',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'backup_disk_size'          => array(
                        ONAPP_FIELD_MAP  => '_backup_disk_size',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'backup_disk_size_max'      => array(
                        ONAPP_FIELD_MAP  => '_backup_disk_size_max',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'template_backup_store'     => array(
                        ONAPP_FIELD_MAP  => '_template_backup_store',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'template_backup_store_max' => array(
                        ONAPP_FIELD_MAP  => '_template_backup_store_max',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'template_disk_size'        => array(
                        ONAPP_FIELD_MAP  => '_template_disk_size',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'template_disk_size_max'    => array(
                        ONAPP_FIELD_MAP  => '_template_disk_size_max',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'backup'                    => array(
                        ONAPP_FIELD_MAP  => '_backup',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'template'                  => array(
                        ONAPP_FIELD_MAP  => '_template',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'backup_max'                => array(
                        ONAPP_FIELD_MAP  => '_backup_max',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'template_max'              => array(
                        ONAPP_FIELD_MAP  => '_template_max',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                );
                break;
            case 4.3:
                $this->fields = $this->initFields( 4.2 );
                break;
            case 5.0:
                $this->fields = $this->initFields( 4.3 );
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