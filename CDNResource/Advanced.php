<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * CDN Resource Advanced Details
 *
 * @category        API wrapper
 * @package         OnApp
 * @subpackage      CDNResource
 * @author          Yakubskiy Yuriy
 * @copyright       © 2012 OnApp
 * @link            http://www.onapp.com/
 * @see             OnApp
 */

/**
 * CDN Resource Advanced Details
 *
 * The OnApp_CDNResource_Advanced uses the following basic methods:
 * {@link getList}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */
class OnApp_CDNResource_Advanced extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'cdn_resource';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'advanced';

    /**
     * Activates action performed with object
     *
     * @param string $action_name the name of action
     *
     * @access public
     */
    function activate( $action_name ) {
        switch( $action_name ) {
            case ONAPP_ACTIVATE_DELETE:
                exit( 'OnApp wrapper :: Call to undefined method ' . __CLASS__ . '::' . $action_name . '()' );
                break;
        }
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

            return parent::getList();
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
            case ONAPP_GETRESOURCE_LOAD:
                $resource = 'cdn_resources/' . $this->_id . '/' . $this->_resource;
                $this->logger->debug( 'getResource( ' . $action . ' ): return ' . $resource );
                break;
            case ONAPP_GETRESOURCE_EDIT:
            case ONAPP_GETRESOURCE_SAVE:
                $resource = 'cdn_resources/' . $this->_id;
                $this->logger->debug( 'getResource( ' . $action . ' ): return ' . $resource );
                break;
            default:
                $resource = parent::getResource( $action );
                break;
        }
        return $resource;
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
            case '2.3':
                $this->fields = array(
                    'id'                         => array(
                        ONAPP_FIELD_MAP       => '_id',
                        ONAPP_FIELD_TYPE      => 'integer',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'countries'                  => array(
                        ONAPP_FIELD_MAP       => '_countries',
                        ONAPP_FIELD_TYPE      => '_array',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'hotlink_policy'             => array(
                        ONAPP_FIELD_MAP       => '_hotlink_policy',
                        ONAPP_FIELD_TYPE      => 'string',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'ip_access_policy'           => array(
                        ONAPP_FIELD_MAP       => '_ip_access_policy',
                        ONAPP_FIELD_TYPE      => 'string',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'country_access_policy'      => array(
                        ONAPP_FIELD_MAP       => '_country_access_policy',
                        ONAPP_FIELD_TYPE      => 'string',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'passwords'                  => array(
                        ONAPP_FIELD_MAP       => '_passwords',
                        ONAPP_FIELD_TYPE      => 'string',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'domains'                    => array(
                        ONAPP_FIELD_MAP       => '_domains',
                        ONAPP_FIELD_TYPE      => 'string',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'cache_expiry'               => array(
                        ONAPP_FIELD_MAP       => '_cache_expiry',
                        ONAPP_FIELD_TYPE      => 'integer',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'publisher_name'             => array(
                        ONAPP_FIELD_MAP       => '_publisher_name',
                        ONAPP_FIELD_TYPE      => 'string',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'password_on'                => array(
                        ONAPP_FIELD_MAP       => '_password_on',
                        ONAPP_FIELD_TYPE      => 'boolean',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'url_signing_on'             => array(
                        ONAPP_FIELD_MAP       => '_url_signing_on',
                        ONAPP_FIELD_TYPE      => 'boolean',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'password_unauthorized_html' => array(
                        ONAPP_FIELD_MAP       => '_password_unauthorized_html',
                        ONAPP_FIELD_TYPE      => 'string',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'ip_addresses'               => array(
                        ONAPP_FIELD_MAP       => '_ip_addresses',
                        ONAPP_FIELD_TYPE      => 'string',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'url_signing_key'            => array(
                        ONAPP_FIELD_MAP       => '_url_signing_key',
                        ONAPP_FIELD_TYPE      => 'string',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                );
                break;

            case 3.0:
            case 3.1:
            case 3.2:
            case 3.3:
                $this->fields = $this->initFields( 2.3 );
                $this->fields[ 'secondary_hostnames' ] = array(
                    ONAPP_FIELD_MAP  => '_secondary_hostnames',
                    ONAPP_FIELD_TYPE => '_array',
                );
                $this->fields[ 'flv_pseudo_on' ] = array(
                    ONAPP_FIELD_MAP  => '_flv_pseudo_on',
                    ONAPP_FIELD_TYPE => 'boolean',
                );
                $this->fields[ 'mp4_pseudo_on' ] = array(
                    ONAPP_FIELD_MAP  => '_mp4_pseudo_on',
                    ONAPP_FIELD_TYPE => 'boolean',
                );
                $this->fields[ 'ssl_on' ] = array(
                    ONAPP_FIELD_MAP  => '_ssl_on',
                    ONAPP_FIELD_TYPE => 'boolean',
                );
                $this->fields[ 'ignore_set_cookie_on' ] = array(
                    ONAPP_FIELD_MAP  => '_ignore_set_cookie_on',
                    ONAPP_FIELD_TYPE => 'boolean',
                );
                $this->fields[ 'http_bot_blocked' ] = array(
                    ONAPP_FIELD_MAP  => 'http_bot_blocked',
                    ONAPP_FIELD_TYPE => 'boolean',
                );
                $this->fields[ 'limit_rate' ] = array(
                    ONAPP_FIELD_MAP => 'limit_rate',
                );
                $this->fields[ 'limit_rate_after' ] = array(
                    ONAPP_FIELD_MAP => 'limit_rate_after',
                );
                $this->fields[ 'proxy_cache_key' ] = array(
                    ONAPP_FIELD_MAP => 'proxy_cache_key',
                );
                $this->fields[ 'proxy_read_time_out' ] = array(
                    ONAPP_FIELD_MAP => 'proxy_read_time_out',
                );
                $this->fields[ 'proxy_connect_time_out' ] = array(
                    ONAPP_FIELD_MAP => 'proxy_connect_time_out',
                );
                $this->fields[ 'secure_wowza_on' ] = array(
                    ONAPP_FIELD_MAP  => '_secure_wowza_on',
                    ONAPP_FIELD_TYPE => 'boolean',
                );
                $this->fields[ 'secure_wowza_token' ] = array(
                    ONAPP_FIELD_MAP  => '_secure_wowza_token',
                    ONAPP_FIELD_TYPE => 'string',
                );
                break;
        }

        parent::initFields( $version, __CLASS__ );

        return $this->fields;
    }

    function load( $id = null ) {
        $return = parent::load( $id );

        $this->_id = $id;

        return $return;
    }

    function save() {
        $passowrd = $this->fields[ 'passwords' ];
        unset( $this->fields[ 'passwords' ] );

        if( is_null( $this->_countries ) && isset( $this->_obj ) ) {
            $this->_countries = $this->_obj->_countries;
        }
        elseif( is_null( $this->_countries ) ) {
            $this->_countries = array( '' );
        }

        if( is_null( $this->_secondary_hostnames ) && isset( $this->_obj ) && count( $this->_obj->_secondary_hostnames ) != 0 ) {
            $this->_secondary_hostnames = $this->_obj->_secondary_hostnames;
        }
        else {
            $this->_secondary_hostnames = array( '' );
        }

        $return = parent::save();

        $this->fields[ 'passwords' ] = $passowrd;

        return $return;
    }
}