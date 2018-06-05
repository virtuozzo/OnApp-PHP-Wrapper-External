<?php

/**
 * Managing CDN Cache Statistic
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
 * Managing CDN Cache Statistic
 *
 * The CDN Overview Report class represents the CDN Cache Statistic.
 * The OnApp_CDNCacheStatistic class is the parent of the OnApp class.
 *
 * The CDNCacheStatistic uses the following basic methods:
 * {@link load}, {@link getList}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */
class OnApp_CDNReport_CacheStatistic extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'cache_statistics';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'cdn/reports/cache_statistics';

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
                    'cache_statistic_line_chart' => array(
                        ONAPP_FIELD_MAP  => '_cache_statistic_line_chart',
                        ONAPP_FIELD_TYPE => 'array',
                        ONAPP_FIELD_CLASS => 'CDNReport_CacheStatistic_LineChart'
                    ),
                    'cache_statistic_table'      => array(
                        ONAPP_FIELD_MAP  => '_cache_statistic_table',
                        ONAPP_FIELD_TYPE => 'array',
                        ONAPP_FIELD_CLASS => 'CDNReport_CacheStatistic_Table'
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

        if ( $this->_frequency ) {
            $data['frequency'] = $this->_frequency;
        } else {
            $this->logger->error(
                'getList: argument _frequency not set.',
                __FILE__,
                __LINE__
            );
        }
        if ( $this->_start_date ) {
            $data['start_date'] = $this->_start_date;
        } else {
            $this->logger->error(
                'getList: argument _start_date not set.',
                __FILE__,
                __LINE__
            );
        }
        if ( $this->_end_date ) {
            $data['end_date'] = $this->_end_date;
        } else {
            $this->logger->error(
                'getList: argument _end_date not set.',
                __FILE__,
                __LINE__
            );
        }
        if ( $this->_filter_type ) {
            $data['filter_type'] = $this->_filter_type;
        } else {
            $this->logger->error(
                'getList: argument _filter_type not set.',
                __FILE__,
                __LINE__
            );
        }
        if ( $this->_entity_id ) {
            $data['entity_id'] = $this->_entity_id;
        }


        $data = array(
            'root' => 'cache_statistics',
            'data' => $data
        );

        return $this->sendGet( ONAPP_REQUEST_METHOD_GET, $data );
    }
}
