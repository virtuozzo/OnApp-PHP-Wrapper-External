<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * CDN Resource Origins for API
 *
 * @category    API wrapper
 * @package     OnApp
 * @subpackage  CDNResource
 * @author      Yakubskiy Yuriy
 * @copyright   © 2012 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */

/**
 * CDN Origins For API
 *
 * The OnApp_CDNResource_Origin class doesn't support any basic method.
 *
 */
class OnApp_CDNResource_Origin extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'origin';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'origins_for_api';

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
                $this->fields = array(
                    'key' => array(
                        ONAPP_FIELD_MAP       => '_value',
                        ONAPP_FIELD_TYPE      => 'string',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                );
                break;

            case 3.0:
            case 3.1:
            case 3.2:
            case 3.3:
            case 3.4:
            case 3.5:
            case 4.0:
            case 4.1:
                $this->fields = array(
                    'value' => array(
                        ONAPP_FIELD_MAP       => '_value',
                        ONAPP_FIELD_TYPE      => 'string',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'key'   => array(
                        ONAPP_FIELD_MAP       => '_key',
                        ONAPP_FIELD_TYPE      => 'string',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                );
                break;
        }

        parent::initFields( $version, __CLASS__ );

        return $this->fields;
    }

    /**
     * Activates action performed with object
     *
     * @param string $action_name the name of action
     *
     * @access public
     */
    function activate( $action_name ) {
        switch( $action_name ) {
            case ONAPP_ACTIVATE_GETLIST:
            case ONAPP_ACTIVATE_LOAD:
            case ONAPP_ACTIVATE_SAVE:
            case ONAPP_ACTIVATE_DELETE:
                exit( 'Call to undefined method ' . __CLASS__ . '::' . $action_name . '()' );
                break;
        }
    }
}
