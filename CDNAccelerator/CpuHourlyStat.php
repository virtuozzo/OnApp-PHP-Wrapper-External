<?php
/**
 * API calls for managing accelerator's cpu stat.
 *
 * @category    API wrapper
 * @package     OnApp
 * @author
 * @copyright   © 2016 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */

/**
 * Managing Accelerator's cpu stat
 *
 * The OnApp_CDNAccelerator_CpuHourlyStat class uses the following basic methods:
 * {@link load}, {@link save}, {@link delete}, and {@link getList}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */
class OnApp_CDNAccelerator_CpuHourlyStat extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'cpu_hourly_stat';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'cpu_usage';

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
                    'cpu_time'           => array(
                        ONAPP_FIELD_MAP  => 'cpu_time',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'created_at'         => array(
                        ONAPP_FIELD_MAP  => '_created_at',
                        ONAPP_FIELD_TYPE => 'datetime',
                    ),
                    'id'                 => array(
                        ONAPP_FIELD_MAP  => '_id',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'stat_time'          => array(
                        ONAPP_FIELD_MAP  => '_stat_time',
                        ONAPP_FIELD_TYPE => 'datetime',
                    ),
                    'updated_at'         => array(
                        ONAPP_FIELD_MAP  => '_updated_at',
                        ONAPP_FIELD_TYPE => 'datetime',
                    ),
                    'user_id'            => array(
                        ONAPP_FIELD_MAP  => '_user_id',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'virtual_machine_id' => array(
                        ONAPP_FIELD_MAP  => '_virtual_machine_id',
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

    function getResource( $action = ONAPP_GETRESOURCE_DEFAULT ) {
        switch ( $action ) {
            case ONAPP_GETRESOURCE_DEFAULT:
                /**
                 * ROUTE :
                 *
                 * @name disks
                 * @method GET
                 * @alias   /accelerators/:virtual_machine_id/disks(.:format)
                 * @format  {:controller=>"disks", :action=>"index"}
                 */
                if ( is_null( $this->_virtual_machine_id ) ) {
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
        if ( is_null( $virtual_machine_id ) && ! is_null( $this->_virtual_machine_id ) ) {
            $virtual_machine_id = $this->_virtual_machine_id;
        }

        if ( ! is_null( $virtual_machine_id ) ) {
            $this->_virtual_machine_id = $virtual_machine_id;

            return parent::getList();
        } else {
            $this->logger->error(
                'getList: argument _virtual_machine_id not set.',
                __FILE__,
                __LINE__
            );
        }
    }

}