<?php

/**
 * @category    API wrapper
 * @package     OnApp
 * @author
 * @subpackage  CDNResource
 * @copyright   © 2016 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */
class OnApp_CDNResource_HTTPCachingRules extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'rule';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'http_caching_rules';

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
            case 4.3:
                $this->fields = array(
                    'cdn_resource_id' => array(
                        ONAPP_FIELD_MAP  => '_cdn_resource_id',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'id'              => array(
                        ONAPP_FIELD_MAP  => '_id',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'name'            => array(
                        ONAPP_FIELD_MAP  => '_name',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'conditions'      => array(
                        ONAPP_FIELD_MAP  => '_conditions',
                        ONAPP_FIELD_TYPE => 'array',
                    ),
                    'actions'         => array(
                        ONAPP_FIELD_MAP  => '_actions',
                        ONAPP_FIELD_TYPE => 'array',
                    ),
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
                $resource = 'cdn_resources/' . $this->_cdn_resource_id . '/' . $this->_resource;
                $this->logger->debug( 'getResource( ' . $action . ' ): return ' . $resource );
                break;
            case ONAPP_GETRESOURCE_LOAD:
                $resource = $this->getResource() . '/' . $this->_id;
                $this->logger->debug( 'getResource( ' . $action . ' ): return ' . $resource );
                break;
            default:
                $resource = parent::getResource( $action );
                break;
        }

        return $resource;
    }

    /**
     * Add HTTP Caching Rule
     *
     * @param $name
     * @param array $conditions
     * @param array $actions
     * @param $cdn_resource_id
     *
     */
    function addRule( $name, $conditions, $actions, $cdn_resource_id = null ) {
        if ( ! is_null( $cdn_resource_id ) ) {
            $this->_cdn_resource_id = $cdn_resource_id;
        }

        if ( ! $this->_cdn_resource_id ) {
            $this->logger->error(
                'addRule: argument _cdn_resource_id not set.',
                __FILE__,
                __LINE__
            );
        }

        if ( ! is_array( $conditions ) ) {
            $this->logger->error(
                'addRule: argument conditions is not array.',
                __FILE__,
                __LINE__
            );
        }

        if ( ! is_array( $actions ) ) {
            $this->logger->error(
                'addRule: argument actions is not array.',
                __FILE__,
                __LINE__
            );
        }

        $data = array(
            'root' => $this->_tagRoot,
            'data' => array(
                'name'       => $name,
                'conditions' => $conditions,
                'actions'    => $actions,
            ),
        );

        $this->sendPost( ONAPP_GETRESOURCE_DEFAULT, $data );
    }

    /**
     * edit HTTP Caching Rule
     *
     * @param $name
     * @param array $conditions
     * @param array $actions
     * @param $cdn_resource_id
     * @param $id
     *
     */
    function editRule( $name, $conditions, $actions, $cdn_resource_id = null, $id = null ) {
        if ( ! is_null( $cdn_resource_id ) ) {
            $this->_cdn_resource_id = $cdn_resource_id;
        }

        if ( ! is_null( $id ) ) {
            $this->_id = $id;
        }

        if ( ! $this->_cdn_resource_id ) {
            $this->logger->error(
                'addRule: argument _cdn_resource_id not set.',
                __FILE__,
                __LINE__
            );
        }

        if ( ! $this->_id ) {
            $this->logger->error(
                'addRule: argument _id not set.',
                __FILE__,
                __LINE__
            );
        }

        if ( ! is_array( $conditions ) ) {
            $this->logger->error(
                'addRule: argument conditions is not array.',
                __FILE__,
                __LINE__
            );
        }

        if ( ! is_array( $actions ) ) {
            $this->logger->error(
                'addRule: argument actions is not array.',
                __FILE__,
                __LINE__
            );
        }

        $data = array(
            'root' => $this->_tagRoot,
            'data' => array(
                'name'       => $name,
                'conditions' => $conditions,
                'actions'    => $actions,
            ),
        );


        $this->sendPut( ONAPP_GETRESOURCE_LOAD, $data );
    }

}
