<?php

/**
 * SysadminTools IpHistoryReports
 *
 * @category        API wrapper
 * @package         OnApp
 * @subpackage      Settings
 * @author          Mykola Vuy
 * @copyright       © 2019 OnApp
 *
 */

/**
 * SysadminTools_IpHistoryReports
 *
 * Use the following API calls to view, assign and delete virtual server recipes in your cloud.
 *
 * The OnApp_SysadminTools_IpHistoryReports class uses the
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */
class OnApp_SysadminTools_IpHistoryReports extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = '';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'sysadmin_tools/ip_history/reports';
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
            case 6.1:
                $this->fields = array(
                    'ip_address'              => array(
                        ONAPP_FIELD_MAP  => '_ip_address',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'period'                       => array(
                        ONAPP_FIELD_MAP  => '_period',
                        ONAPP_FIELD_TYPE => '_array',
                    ),
                );
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
        $show_log_msg = true;
        switch ( $action ) {
            case ONAPP_GETRESOURCE_DEFAULT:
                /**
                 * ROUTE :
                 *
                 * GET/sysadmin_tools/ip_history/reports.json
                 *
                 * @name Get Integrated Storage Settings Details
                 * @method GET
                 * @alias   /sysadmin_tools/ip_history/reports(.:format)
                 */

                $resource = $this->_resource;
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
    function activateCheck( $action_name ) {
        switch ( $action_name ) {
            case ONAPP_ACTIVATE_LOAD:
            case ONAPP_ACTIVATE_SAVE:
            case ONAPP_ACTIVATE_DELETE:
                exit( 'Call to undefined method ' . __CLASS__ . '::' . $action_name . '()' );
                break;
        }
    }

}
