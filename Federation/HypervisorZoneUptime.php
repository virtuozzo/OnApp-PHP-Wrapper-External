<?php

/**
 * Manages Zone Uptime Graph
 *
 * @category    API wrapper
 * @package     OnApp
 * @subpackage  Federation
 * @author
 * @copyright   © 2011 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */
class OnApp_Federation_HypervisorZoneUptime extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'hypervisor_zone_uptime';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'uptime';

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
                    'date'              => array(
                        ONAPP_FIELD_MAP  => '_date',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'uptime_percentage' => array(
                        ONAPP_FIELD_MAP  => '_uptime_percentage',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'federation_id'     => array(
                        ONAPP_FIELD_MAP  => '_federation_id',
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

            case 6.1:
                $this->fields = $this->initFields( 6.0 );
                break;

            case 6.2:
                $this->fields = $this->initFields( 6.1 );
                break;

            case 6.3:
                $this->fields = $this->initFields( 6.2 );
                break;

            case 6.4:
                $this->fields = $this->initFields( 6.3 );
                break;

            case 6.5:
                $this->fields = $this->initFields( 6.4 );
                break;
        }

        parent::initFields( $version, __CLASS__ );

        return $this->fields;
    }

    function getResource( $action = ONAPP_GETRESOURCE_DEFAULT ) {
        switch ( $action ) {
            case ONAPP_GETRESOURCE_LIST:
                if ( is_null( $this->_federation_id ) ) {
                    $this->logger->error(
                        'getResource( ' . $action . ' ): argument _federation_id not set.',
                        __FILE__,
                        __LINE__
                    );
                }
                $resource = '/federation/hypervisor_zones/' . $this->_federation_id . '/' . $this->_resource;
                break;

            default:
                $resource = parent::getResource( $action );
                break;
        }

        return $resource;
    }

    function getList( $federation_id = null, $url_args = null ) {
        if ( ! is_null( $federation_id ) ) {
            $this->_federation_id = $federation_id;
        }

        return parent::getList();
    }


}