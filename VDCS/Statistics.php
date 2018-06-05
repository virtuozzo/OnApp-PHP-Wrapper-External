<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * User Statistics
 *
 * @todo        write description
 *
 * @category    API wrapper
 * @package     OnApp
 * @subpackage  User
 * @author      Yakubskiy Yuriy
 * @copyright   © 2011 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */

/**
 * User IP User Statistics
 *
 *  The OnApp_User_Statistics class uses the following basic methods:
 *  {@link getList}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */
class OnApp_VDCS_Statistics extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'vdc_stat';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'statistics';

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
            case 4.1:
            case 4.2:
                $this->fields = array(
                    'id'             => array(
                        ONAPP_FIELD_MAP  => '_id',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'company_id'     => array(
                        ONAPP_FIELD_MAP  => '_company_id',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'vdc_id'         => array(
                        ONAPP_FIELD_MAP  => '_vdc_id',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'cost'           => array(
                        ONAPP_FIELD_MAP  => '_cost',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'currency_code'  => array(
                        ONAPP_FIELD_MAP  => '_currency_code',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'stat_time'      => array(
                        ONAPP_FIELD_MAP  => '_stat_time',
                        ONAPP_FIELD_TYPE => 'datetime',
                    ),
                    'created_at'     => array(
                        ONAPP_FIELD_MAP  => '_created_at',
                        ONAPP_FIELD_TYPE => 'datetime',
                    ),
                    'updated_at'     => array(
                        ONAPP_FIELD_MAP  => '_updated_at',
                        ONAPP_FIELD_TYPE => 'datetime',
                    ),
                    'vdc_model_type' => array(
                        ONAPP_FIELD_MAP  => '_vdc_model_type',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'status'         => array(
                        ONAPP_FIELD_MAP  => '_status',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                );
                break;
            case 4.3:
                $this->fields                       = $this->initFields( 4.2 );
                $this->fields['data_stores']        = array(
                    ONAPP_FIELD_MAP  => '_data_stores',
                    ONAPP_FIELD_TYPE => 'array',
                );
                $this->fields['network_interfaces'] = array(
                    ONAPP_FIELD_MAP  => '_network_interfaces',
                    ONAPP_FIELD_TYPE => 'array',
                );
                $this->fields['resource_elements']  = array(
                    ONAPP_FIELD_MAP  => '_resource_elements',
                    ONAPP_FIELD_TYPE => 'array',
                );
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

    /**
     * Returns the URL Alias of the API Class that inherits the OnApp class
     *
     * @param string $action action name
     *
     * @return string API resource
     * @access public
     */
    function getResource( $action = ONAPP_GETRESOURCE_DEFAULT ) {
        switch ( $action ) {
            case ONAPP_GETRESOURCE_DEFAULT:
                /**
                 * ROUTE :
                 *
                 * @name user_vm_stats
                 * @method GET
                 * @alias   /users/:user_id/vm_stats(.:format)
                 * @format  {:controller=>"vm_stats", :action=>"index"}
                 */
                if ( is_null( $this->_vdc_id ) && is_null( $this->_obj->_vdc_id ) ) {
                    $this->logger->error(
                        "getResource($action): argument _vdc_id not set.",
                        __FILE__,
                        __LINE__
                    );
                } else {
                    if ( is_null( $this->_vdc_id ) ) {
                        $this->_vdc_id = $this->_obj->_vdc_id;
                    }
                }
                $resource = 'vdcs/' . $this->_vdc_id . '/' . $this->_resource;
                $this->logger->debug( 'getResource( ' . $action . ' ): return ' . $resource );
                break;

            default:
                $resource = parent::getResource( $action );
                break;
        }

        return $resource;
    }

    /**
     * Sends an API request to get the Objects. After requesting,
     * unserializes the received response into the array of Objects
     *
     * @param integer $vdc_id User ID
     *
     * @return mixed an array of Object instances on success. Otherwise false
     * @access public
     */
    function getList( $vdc_id = null, $url_args = null ) {
        if ( is_null( $vdc_id ) && ! is_null( $this->_vdc_id ) ) {
            $vdc_id = $this->_vdc_id;
        }

        if ( ! is_null( $vdc_id ) ) {
            $this->_vdc_id = $vdc_id;

            return parent::getList( null, $url_args );
        } else {
            $this->logger->error(
                'getList: argument _vdc_id not set.',
                __FILE__,
                __LINE__
            );
        }
    }
}