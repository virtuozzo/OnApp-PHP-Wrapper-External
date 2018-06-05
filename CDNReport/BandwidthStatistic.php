<?php

/**
 * Managing CDN Bandwidth Statistics
 *
 *
 * @category    API wrapper
 * @package     OnApp
 * @author      Ivan Gavryliuk
 * @copyright   © 2017 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */

/**
 * Managing CDN Bandwidth Statistics
 *
 * The CDN Bandwidth Statistics class represents the CDN Bandwidth Statistics.
 * The OnApp_CDNReport_BandwidthStatistic class is the parent of the OnApp class.
 *
 * The CDNReport_BandwidthStatistic uses the following basic methods:
 * {@link load}, {@link getList}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */
class OnApp_CDNReport_BandwidthStatistic extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'stats';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'cdn/reports/bandwidth_statistics';

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
            case 5.3:
                $this->fields = array(
                    'stat' => array(
                        ONAPP_FIELD_MAP  => '_stats',
                        ONAPP_FIELD_TYPE => 'array',
                    ),
                );
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
     * Sends an API request to get the Objects. After requesting,
     * unserializes the received response into the array of Objects
     *
     * @param array $url_args [start, end, type, resource_type, resources[] ]
     *
     * @return mixed an array of Object instances on success. Otherwise false
     * @access public
     */
    public function getList( $url_args = null, $params = null ) {
        return parent::getList( null, $url_args );
    }

    /**
     * Activates action performed with object
     *
     * @param string $action_name the name of action
     *
     * @access public
     */
    function activateCheck( $action_name ) {
        switch ( $action_name ) {
            case ONAPP_ACTIVATE_LOAD:
            case ONAPP_ACTIVATE_SAVE:
            case ONAPP_ACTIVATE_DELETE:
                exit( 'Call to undefined method ' . __CLASS__ . '::' . $action_name . '()' );
                break;
        }
    }

    public function overview() {
        $data = array();

        if ( $this->_start ) {
            $data['start'] = $this->_start;
        } else {
            $this->logger->error(
                'getList: argument _start not set.',
                __FILE__,
                __LINE__
            );
        }
        if ( $this->_end ) {
            $data['end'] = $this->_end;
        } else {
            $this->logger->error(
                'getList: argument _end not set.',
                __FILE__,
                __LINE__
            );
        }
        if ( $this->_locations ) {
            $data['locations'] = $this->_locations;
        }
        if ( $this->_resources ) {
            $data['resources'] = $this->_resources;
        }
        if ( $this->_group_by ) {
            $data['group_by'] = $this->_group_by;
        }
        if ( $this->_type ) {
            $data['type'] = $this->_type;
        } else {
            $this->logger->error(
                'getList: argument _type not set.',
                __FILE__,
                __LINE__
            );
        }


        $data = array(
            'root' => 'bandwidth',
            'data' => $data
        );

        return $this->sendGet( ONAPP_REQUEST_METHOD_GET, $data );
    }

}
