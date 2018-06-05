<?php

/**
 * Billing Statistics
 *
 * @category    API wrapper
 * @package     OnApp
 * @subpackage
 * @author
 * @copyright   © 2016 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */

/**
 * Billing Statistics
 *
 * The OnApp_Statistic uses the following basic methods:
 * {@link getList}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */
class OnApp_Statistics extends OnApp {
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
    var $_resource = 'billing/dashboard_statistics';

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
            case 5.0:
                $this->fields = array(
                    'cpus' => array(
                        ONAPP_FIELD_MAP       => '_cpus',
                        ONAPP_FIELD_TYPE      => 'array',
                    ),
                    'memory' => array(
                        ONAPP_FIELD_MAP       => '_memory',
                        ONAPP_FIELD_TYPE      => 'array',
                    ),
                    'disk_size' => array(
                        ONAPP_FIELD_MAP       => '_disk_size',
                        ONAPP_FIELD_TYPE      => 'array',
                    ),
                    'iops' => array(
                        ONAPP_FIELD_MAP       => '_iops',
                        ONAPP_FIELD_TYPE      => 'array',
                    ),
                    'bandwidth' => array(
                        ONAPP_FIELD_MAP       => '_bandwidth',
                        ONAPP_FIELD_TYPE      => 'array',
                    ),
                    'smart_servers' => array(
                        ONAPP_FIELD_MAP       => '_smart_servers',
                        ONAPP_FIELD_TYPE      => 'array',
                    ),
                    'baremetal_servers' => array(
                        ONAPP_FIELD_MAP       => '_baremetal_servers',
                        ONAPP_FIELD_TYPE      => 'array',
                    ),
                    'virtual_servers' => array(
                        ONAPP_FIELD_MAP       => '_virtual_servers',
                        ONAPP_FIELD_TYPE      => 'array',
                    ),
                );
                break;
            case 5.1:
                $this->fields = $this->initFields( 5.0 );
                break;
            case 5.2:
                $this->fields = $this->initFields( 5.1 );
                break;
            case 5.3:
                $this->fields = $this->initFields( 5.2 );
                $this->fields['provider_cpu_usage'] = array(
                    ONAPP_FIELD_MAP  => '_provider_cpu_usage',
                    ONAPP_FIELD_TYPE => 'array',
                );
                $this->fields['provider_storage_usage'] = array(
                    ONAPP_FIELD_MAP  => '_provider_storage_usage',
                    ONAPP_FIELD_TYPE => 'array',
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
     * Returns the URL Alias of the API Class that inherits the OnApp class
     *
     * @param string $action action name
     *
     * @return string API resource
     * @access public
     */
    function getResource( $action = ONAPP_GETRESOURCE_DEFAULT ) {
        switch ( $action ) {
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
    public function getStatistics( $stats_for = null, $startdate = null, $enddate = null ) {
        $params = array();
        if ( ! is_null( $stats_for ) ) {
            $params['stats_for'] = array();
            $params['stats_for'][] = $stats_for;
        }
        if ( ! is_null( $startdate ) ) {
            $params['period[startdate]'] = $startdate;
        }
        if ( ! is_null( $enddate ) ) {
            $params['period[enddate]'] = $enddate;
        }

        return $this->sendGet( ONAPP_GETRESOURCE, null, $params );

    }
    function getList( $params = null, $url_args = null ) {
        return $this->getStatistics();
    }


}