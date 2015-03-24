<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * User IP Adresses
 *
 * @todo        write description
 *
 * @category    API wrapper
 * @package     OnApp
 * @subpackage  User
 * @author      Vitaliy Kondratyuk
 * @copyright   © 2011 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */

/**
 * User IP Adresses
 *
 * The OnApp_User_UsedIpAddress class doesn't support any basic method.
 *
 */
class OnApp_User_UsedIpAddress extends OnApp_IpAddress {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'used_ip_address';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = '';

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
            case '2.0':
            case '2.1':
            case 2.2:
            case 2.3:
                $this->fields = array(
                    'id'                 => array(
                        ONAPP_FIELD_MAP       => '_id',
                        ONAPP_FIELD_TYPE      => 'integer',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'created_at'         => array(
                        ONAPP_FIELD_MAP       => '_created_at',
                        ONAPP_FIELD_TYPE      => 'datetime',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'updated_at'         => array(
                        ONAPP_FIELD_MAP       => '_updated_at',
                        ONAPP_FIELD_TYPE      => 'datetime',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'address'            => array(
                        ONAPP_FIELD_MAP       => '_address',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'netmask'            => array(
                        ONAPP_FIELD_MAP       => '_netmask',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'broadcast'          => array(
                        ONAPP_FIELD_MAP       => '_broadcast',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'network_address'    => array(
                        ONAPP_FIELD_MAP       => '_network_address',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'gateway'            => array(
                        ONAPP_FIELD_MAP       => '_gateway',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'network_id'         => array(
                        ONAPP_FIELD_MAP       => '_network_id',
                        ONAPP_FIELD_TYPE      => 'integer',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'disallowed_primary' => array(
                        ONAPP_FIELD_MAP       => '_disallowed_primary',
                        ONAPP_FIELD_TYPE      => 'boolean',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'free'               => array(
                        ONAPP_FIELD_MAP       => '_free',
                        ONAPP_FIELD_TYPE      => 'boolean',
                        ONAPP_FIELD_READ_ONLY => true,
                    )
                );
                break;

            case 3.0:
            case 3.1:
            case 3.2:
            case 3.3:
            case 3.4:
            case 3.5:
                $this->fields = $this->initFields( 2.3 );
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