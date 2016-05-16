<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * User NetworkZones
 *
 * @category    API wrapper
 * @package     OnApp
 * @subpackage  User
 * @author      Ivan Gavryliuk
 * @copyright   © 2016 OnApp
 * @link        https://docs.onapp.com/display/42API/Get+List+of+User+Network+Zones
 * @see         OnApp
 */

/**
 * User OnApp_User_NetworkZone
 *
 * The OnApp_User_NetworkZone class support only gelList().
 *
 */
class OnApp_User_NetworkZone extends OnApp_NetworkZone {

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