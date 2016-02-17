<?php
/**
 * Managing Control Panel Maintenance Status
 *
 * To view the status of Control Panel maintenance use the following API call.
 *
 * @category    API wrapper
 * @package     OnApp
 * @author      Ivan Gavryliuk
 * @copyright   © 2016 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */

/**
 * TODO Add description
 */
define( 'ONAPP_ENABLE', 'enable' );

/**
 * TODO Add description
 */
define( 'ONAPP_DISABLE', 'disable' );


/**
 * Managing Control Panel Maintenance Status
 *
 * The Maintenances class uses the following basic methods:
 * {@link load}, {@link save}, and {@link getList}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */
class OnApp_Maintenance extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'maintenance_mode';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'sysadmin_tools/maintenance_mode';

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
            case 2.0:
            case 2.1:
            case 2.2:
            case 2.3:
            case 3.0:
            case 3.1:
            case 3.2:
            case 3.3:
            case 3.4:
            case 3.5:
            case 4.0:
            case 4.1:
                $this->fields = array(
                    'status'          => array(
                        ONAPP_FIELD_MAP           => '_status',
                        ONAPP_FIELD_TYPE          => 'string',
                        ONAPP_FIELD_REQUIRED      => true,
                    )
                );
            break;
            case 4.2:
                $this->fields                             = $this->initFields( 4.1 );
                break;
        }

        parent::initFields( $version, __CLASS__ );

        return $this->fields;
    }

    function getResource( $action = ONAPP_GETRESOURCE_DEFAULT ) {
        switch( $action ) {
            case ONAPP_ENABLE:
                /**
                 * ROUTE :
                 *
                 * @name maintenance_mode
                 * @method PUT
                 * @alias   /sysadmin_tools/maintenance_mode/enable(.:format)
                 */
                $resource = $this->getResource( ONAPP_GETRESOURCE_LOAD ) . '/enable';
                break;

            case ONAPP_DISABLE:
                /**
                 * ROUTE :
                 *
                 * @name maintenance_mode
                 * @method PUT
                 * @alias  /sysadmin_tools/maintenance_mode/disable(.:format)
                 */
                $resource = $this->getResource( ONAPP_GETRESOURCE_LOAD ) . '/disable';
                break;

            default:
                /**
                 * ROUTE :
                 *
                 * @name maintenance_mode
                 * @method GET
                 * @alias  sysadmin_tools/maintenance_mode(.:format)
                 * @format {:controller=>"billing_plans", :action=>"index"}
                 */
                $resource = parent::getResource( $action );
        }

        return $resource;
    }

    function enable() {
        $this->sendPut(ONAPP_ENABLE);
    }

    function disable() {
        $this->sendPut(ONAPP_DISABLE);
    }
}