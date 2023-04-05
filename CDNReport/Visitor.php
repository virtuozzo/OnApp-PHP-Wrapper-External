<?php

/**
 * Managing CDN Visitor Reports
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
 * Managing CDN Visitor Reports
 *
 * The CDN Admin Reports class represents the CDN Top File.
 * The OnApp_CDNReport_Visitor class is the parent of the OnApp class.
 *
 * The OnApp_CDNReport_Visitor uses the following basic methods:
 * {@link load}, {@link getList}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */
class OnApp_CDNReport_Visitor extends OnApp
{
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'visitors';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'cdn/reports/visitors';

    /**
     * API Fields description
     *
     * @param string|float $version OnApp API version
     * @param string $className current class' name
     *
     * @return array
     */
    public function initFields($version = null, $className = '')
    {
        switch ($version) {
            case 5.4:
                $this->fields = array(
                    'top_five_visitor_countries_line_chart' => array(
                        ONAPP_FIELD_MAP => '_top_five_visitor_countries_line_chart',
                        ONAPP_FIELD_TYPE => 'array',
                        ONAPP_FIELD_CLASS => 'CDNReport_OverviewTopFive_VisitorCountriesLineChart'
                    ),
                    'visitor_country_table' => array(
                        ONAPP_FIELD_MAP => '_visitor_country_table',
                        ONAPP_FIELD_TYPE => 'array',
                        ONAPP_FIELD_CLASS => 'CDNReport_Location_VisitorCountryTable'
                    ),
                );
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

            case 6.6:
                $this->fields = $this->initFields( 6.5 );
                break;

            case 6.7:
                $this->fields = $this->initFields( 6.6 );
                break;

            default:
                $this->fields = $this->initFields( 6.7 );
                break;
        }

        parent::initFields($version, __CLASS__);

        return $this->fields;
    }

    function getResource($action = ONAPP_GETRESOURCE_DEFAULT)
    {
        switch ($action) {
            default:
                $resource = parent::getResource($action);
                break;
        }

        return $resource;
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
    public function getList($url_args = null, $params = null)
    {
        return parent::getList(null, $url_args);
    }


    /**
     * Activates action performed with object
     *
     * @param string $action_name the name of action
     *
     * @access public
     */
    function activateCheck($action_name)
    {
        switch ($action_name) {
            case ONAPP_ACTIVATE_LOAD:
            case ONAPP_ACTIVATE_SAVE:
            case ONAPP_ACTIVATE_DELETE:
                exit('Call to undefined method ' . __CLASS__ . '::' . $action_name . '()');
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


        $data = array(
            'root' => 'visitors',
            'data' => $data
        );

        return $this->sendGet( ONAPP_REQUEST_METHOD_GET, $data );
    }


}
