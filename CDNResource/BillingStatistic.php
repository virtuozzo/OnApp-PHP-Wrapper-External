<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * CDN Resource Billing Statistics
 *
 * @category    API wrapper
 * @package     OnApp
 * @subpackage  CDNResource
 * @author      Yakubskiy Yuriy
 * @copyright   © 2012 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */

/**
 * CDN Resource Billing Statistics
 *
 * The OnApp_CDNResource_BillingStatistic uses the following basic methods:
 * {@link getList}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */
class OnApp_CDNResource_BillingStatistic extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'user_hourly_stat';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'billing';

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
            case '2.0':
            case '2.1':
            case '2.2':
                break;

            case '2.3':
                $this->fields = array(
                    'id'                     => array(
                        ONAPP_FIELD_MAP       => '_id',
                        ONAPP_FIELD_TYPE      => 'integer',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'created_at'             => array(
                        ONAPP_FIELD_MAP       => '_created_at',
                        ONAPP_FIELD_TYPE      => 'string',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'updated_at'             => array(
                        ONAPP_FIELD_MAP       => '_updated_at',
                        ONAPP_FIELD_TYPE      => 'string',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'data_cached'            => array(
                        ONAPP_FIELD_MAP       => '_data_cached',
                        ONAPP_FIELD_TYPE      => 'string',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'data_non_cached'        => array(
                        ONAPP_FIELD_MAP       => '_data_non_cached',
                        ONAPP_FIELD_TYPE      => 'string',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'cdn_resource_id'        => array(
                        ONAPP_FIELD_MAP       => '_cdn_resource_id',
                        ONAPP_FIELD_TYPE      => 'integer',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'user_id'                => array(
                        ONAPP_FIELD_MAP       => '_user_id',
                        ONAPP_FIELD_TYPE      => 'integer',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'edge_group_location_id' => array(
                        ONAPP_FIELD_MAP       => '_edge_group_location_id',
                        ONAPP_FIELD_TYPE      => 'integer',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'edge_id'                => array(
                        ONAPP_FIELD_MAP       => '_edge_id',
                        ONAPP_FIELD_TYPE      => 'integer',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'location_id'            => array(
                        ONAPP_FIELD_MAP       => '_location_id',
                        ONAPP_FIELD_TYPE      => 'integer',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'edge_group_id'          => array(
                        ONAPP_FIELD_MAP       => '_edge_group_id',
                        ONAPP_FIELD_TYPE      => 'integer',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                );
                $this->fields = $this->initFields( 2.1 );
                break;

            case 3.0:
            case 3.1:
            case 3.2:
            case 3.3:
                $this->fields = $this->initFields( 2.3 );
                $fields = array(
                    'created_at',
                    'updated_at',
                    'cdn_resource_id',
                    'user_id',
                    'edge_group_location_id',
                    'edge_id',
                    'location_id',
                );
                $this->unsetFields( $fields );

                $this->fields[ 'cost' ] = array(
                    ONAPP_FIELD_MAP  => '_cost',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields[ 'edge_group_label' ] = array(
                    ONAPP_FIELD_MAP  => '_edge_group_label',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields[ 'stat_time' ] = array(
                    ONAPP_FIELD_MAP  => '_stat_time',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields[ 'value' ] = array(
                    ONAPP_FIELD_MAP  => '_value',
                    ONAPP_FIELD_TYPE => 'string',
                );

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
        switch( $action ) {
            case ONAPP_GETRESOURCE_DEFAULT:
                $resource = 'cdn_resources/' . $this->_id . '/' . $this->_resource;
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
     * @param integer $cdn_resource_id CDN Resource id
     *
     * @return mixed an array of Object instances on success. Otherwise false
     * @access public
     */
    public function getList( $cdn_resource_id = null, $url_args = null ) {
        if( is_null( $cdn_resource_id ) && ! is_null( $this->_id ) ) {
            $cdn_resource_id = $this->_id;
        }

        if( ! is_null( $cdn_resource_id ) ) {
            $this->_id = $cdn_resource_id;

            return parent::getList( null, $url_args );
        }
        else {
            $this->logger->error(
                'getList: argument $cdn_resource_id not set.',
                __FILE__,
                __LINE__
            );
        }
    }

    /**
     * Activates action performed with object
     *
     * @param string $action_name the name of action
     *
     * @access public
     */
    function activate( $action_name ) {
        switch( $action_name ) {
            case ONAPP_ACTIVATE_LOAD:
            case ONAPP_ACTIVATE_SAVE:
            case ONAPP_ACTIVATE_DELETE:
                exit( 'Call to undefined method ' . __CLASS__ . '::' . $action_name . '()' );
                break;
        }
    }
}