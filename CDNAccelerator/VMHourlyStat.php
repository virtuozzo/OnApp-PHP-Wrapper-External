<?php
/**
 * API calls for managing accelerator's vm stat.
 *
 * @category    API wrapper
 * @package     OnApp
 * @author
 * @copyright   © 2016 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */

/**
 * Managing Accelerator's vm stat
 *
 * The OnApp_CDNAccelerator_VMHourlyStat class uses the following basic methods:
 * {@link load}, {@link save}, {@link delete}, and {@link getList}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */
class OnApp_CDNAccelerator_VMHourlyStat extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'vm_hourly_stat';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'vm_stats';

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
            case 2.0:
            case 2.1:
            case 2.2:
            case 2.3:
            case 3.0:
            case 3.1:
            case 3.2:
            case 3.3:
            case 3.4:
            case 3.5:
            case 4.0:
            case 4.1:
            case 4.2:
                $this->fields = array(
                    'created_at'	=> array(
                        ONAPP_FIELD_MAP => '_created_at',
                        ONAPP_FIELD_TYPE => 'datetime',
                    ),
                    'currency_code'	=> array(
                        ONAPP_FIELD_MAP => '_currency_code',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'id'	=> array(
                        ONAPP_FIELD_MAP => '_id',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'stat_time'	=> array(
                        ONAPP_FIELD_MAP => '_stat_time',
                        ONAPP_FIELD_TYPE => 'datetime',
                    ),
                    'updated_at'	=> array(
                        ONAPP_FIELD_MAP => '_updated_at',
                        ONAPP_FIELD_TYPE => 'datetime',
                    ),
                    'user_id'	=> array(
                        ONAPP_FIELD_MAP => '_user_id',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'virtual_machine_id'	=> array(
                        ONAPP_FIELD_MAP => '_virtual_machine_id',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'vm_billing_stat_id'	=> array(
                        ONAPP_FIELD_MAP => '_vm_billing_stat_id',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'billing_stats'	=> array(
                        ONAPP_FIELD_MAP => '_billing_stats',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'total_cost'	=> array(
                        ONAPP_FIELD_MAP => '_total_cost',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'vm_resources_cost'	=> array(
                        ONAPP_FIELD_MAP => '_vm_resources_cost',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'usage_cost'	=> array(
                        ONAPP_FIELD_MAP => '_usage_cost',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'booted'	=> array(
                        ONAPP_FIELD_MAP => '_booted',
                        ONAPP_FIELD_TYPE => 'boolean',
                    ),
                );
                break;
        }

        parent::initFields( $version, __CLASS__ );

        return $this->fields;
    }

    function getResource( $action = ONAPP_GETRESOURCE_DEFAULT ) {
        switch( $action ) {
            case ONAPP_GETRESOURCE_DEFAULT:
                /**
                 * ROUTE :
                 *
                 * @name disks
                 * @method GET
                 * @alias   /accelerators/:virtual_machine_id/disks(.:format)
                 * @format  {:controller=>"disks", :action=>"index"}
                 */
                if( is_null( $this->_virtual_machine_id ) ) {
                    $this->logger->error(
                        'getResource( ' . $action . ' ): argument _virtual_machine_id not set.',
                        __FILE__,
                        __LINE__
                    );
                }
                $resource = 'accelerators/' . $this->_virtual_machine_id . '/' . $this->_resource;
                break;

            default:
                /**
                 * ROUTE :
                 *
                 * @name disks
                 * @method GET
                 * @alias  accelerators/:virtual_machine_id/disks(.:format)
                 * @format {:controller=>"disks", :action=>"index"}
                 */
                $resource = parent::getResource( $action );
        }

        return $resource;
    }

    function getList( $virtual_machine_id = null, $url_args = null ) {
        if( is_null( $virtual_machine_id ) && ! is_null( $this->_virtual_machine_id ) ) {
            $virtual_machine_id = $this->_virtual_machine_id;
        }

        if( ! is_null( $virtual_machine_id ) ) {
            $this->_virtual_machine_id = $virtual_machine_id;

            return parent::getList(null, $url_args);
        }
        else {
            $this->logger->error(
                'getList: argument _virtual_machine_id not set.',
                __FILE__,
                __LINE__
            );
        }
    }

}