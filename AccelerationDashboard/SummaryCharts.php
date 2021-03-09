<?php

/**
 * AccelerationDashboard SummaryCharts
 *
 * @category        API wrapper
 * @package         OnApp
 * @author          Mykola Vuy
 * @copyright       © 2020 OnApp
 */

/**
 * AccelerationDashboard_SummaryCharts
 *
 * Use the following API calls to view, assign and delete virtual server recipes in your cloud.
 *
 * The OnApp_NSX_Edges class uses the following basic method:
 * {@link getList}.
 *
 * @example: $obj->getList(null, ['start_date' => '2020-03-16', 'end_date' => '2020-03-31', 'frequency' => '1'])
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */
class OnApp_AccelerationDashboard_SummaryCharts extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'summary_chart';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'acceleration_dashboard/summary_charts';
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
            case 6.3:
                $this->fields = array(
                    'timestamp'                 => array(
                        ONAPP_FIELD_MAP     => '_timestamp',
                        ONAPP_FIELD_TYPE    => 'integer',
                    ),
                    'website_count'             => array(
                        ONAPP_FIELD_MAP     => '_website_count',
                        ONAPP_FIELD_TYPE    => 'integer',
                    ),
                );
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

    /**
     * Returns the URL Alias of the API Class that inherits the OnApp class
     *
     * @param string $action action name
     *
     * @return string API resource
     * @access public
     */
     public function getResource( $action = ONAPP_GETRESOURCE_DEFAULT ) {
        switch ( $action ) {
            case ONAPP_GETRESOURCE_DEFAULT:
                /**
                 * ROUTE :
                 *
                 * @name Get Summary Charts
                 * @method GET
                 * @alias  /acceleration_dashboard/summary_charts(.:format)
                 * @format {:controller=>"AccelerationDashboard_SummaryCharts", :action=>"index"}
                 */

                $resource = $this->_resource;
                $this->logger->debug( 'getResource( ' . $action . ' ): return ' . $resource );
                break;

            default:
                $resource = parent::getResource( $action );
                break;
        }

        return $resource;
    }

    /**
     * Activates action performed with object
     *
     * @param string $action_name the name of action
     *
     * @access public
     */
    public function activateCheck( $action_name ) {
        switch ( $action_name ) {
            case ONAPP_ACTIVATE_LOAD:
            case ONAPP_ACTIVATE_SAVE:
            case ONAPP_ACTIVATE_DELETE:
                exit( 'Call to undefined method ' . __CLASS__ . '::' . $action_name . '()' );
                break;
        }
    }
}
