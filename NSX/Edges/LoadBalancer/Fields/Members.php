<?php

/**
 * NSX Edges LoadBalancer Fields Members
 *
 * @category        API wrapper
 * @package         OnApp
 * @author          Mykola Vuy
 * @copyright       © 2019 OnApp
 */

/**
 * NSX_Edges_LoadBalancer_Fields_Members
 *
 * Use the following API calls to view, assign and delete virtual server recipes in your cloudю
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */
class OnApp_NSX_Edges_LoadBalancer_Fields_Members extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'members';

    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = '';

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
            case 6.2:
                $this->fields = array(
                    'label'                 => array(
                        ONAPP_FIELD_MAP     => '_label',
                        ONAPP_FIELD_TYPE    => 'string',
                    ),
                    'ip_address'            => array(
                        ONAPP_FIELD_MAP     => '_ip_address',
                        ONAPP_FIELD_TYPE    => 'string',
                    ),
                    'monitor_port'          => array(
                        ONAPP_FIELD_MAP     => '_monitor_port',
                        ONAPP_FIELD_TYPE    => 'string',
                    ),
                    'port'                  => array(
                        ONAPP_FIELD_MAP     => '_port',
                        ONAPP_FIELD_TYPE    => 'string',
                    ),
                    'enabled'               => array(
                        ONAPP_FIELD_MAP     => '_enabled',
                        ONAPP_FIELD_TYPE    => 'boolean',
                    ),
                    'weight'                => array(
                        ONAPP_FIELD_MAP     => '_weight',
                        ONAPP_FIELD_TYPE    => 'string',
                    ),
                    'max_conn'              => array(
                        ONAPP_FIELD_MAP     => '_max_conn',
                        ONAPP_FIELD_TYPE    => 'string',
                    ),
                    'min_conn'              => array(
                        ONAPP_FIELD_MAP     => '_min_conn',
                        ONAPP_FIELD_TYPE    => 'string',
                    ),
                );
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
    function activateCheck( $action_name ) {
        switch ( $action_name ) {
            case ONAPP_ACTIVATE_GETLIST:
            case ONAPP_ACTIVATE_LOAD:
            case ONAPP_ACTIVATE_SAVE:
            case ONAPP_ACTIVATE_DELETE:
                exit( 'Call to undefined method ' . __CLASS__ . '::' . $action_name . '()' );
                break;
        }
    }
}
