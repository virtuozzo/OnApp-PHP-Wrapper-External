<?php

/**
 * Settings BackupServersIntegratedStorage
 *
 * @category        API wrapper
 * @package         OnApp
 * @subpackage      Settings
 * @author          Mykola Vuy
 * @copyright       © 2019 OnApp
 *
 */

/**
 * Settings BackupServersIntegratedStorage
 *
 * Use the following API calls to view, assign and delete virtual server recipes in your cloud.
 *
 * The OnApp_Settings_BackupServersIntegratedStorage class uses the
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */
class OnApp_Settings_BackupServersIntegratedStorage extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'integrated_storage_settings';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'integrated_storage_settings';
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
                    'backup_server_id'          => array(
                        ONAPP_FIELD_MAP  => '_backup_server_id',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'bonding_mode'              => array(
                        ONAPP_FIELD_MAP  => '_bonding_mode',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'mtu'                       => array(
                        ONAPP_FIELD_MAP  => '_mtu',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'vlan'                      => array(
                        ONAPP_FIELD_MAP  => '_vlan',
                        ONAPP_FIELD_TYPE => 'integer',
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

            case 6.5:
                $this->fields = $this->initFields( 6.4 );
                break;

            case 6.6:
                $this->fields = $this->initFields( 6.5 );
                break;

            case 6.7:
                $this->fields = $this->initFields( 6.6 );
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
                 * @name Get Integrated Storage Settings Details
                 * @method GET
                 * @alias   /settings/backup_servers/:backup_server_id/integrated_storage_settings(.:format)
                 */
                /**
                 * ROUTE :
                 *
                 * @name Edit Integrated Storage Settings
                 * @method PUT
                 * @alias   /settings/backup_servers/:backup_server_id/integrated_storage_settings(.:format)
                 */
                if ( is_null( $this->_backup_server_id ) ) {
                    $this->logger->error(
                        'getResource( ' . $action . ' ): argument _backup_server_id not set.',
                        __FILE__,
                        __LINE__
                    );
                }

                $resource = 'settings/backup_servers/' . $this->_backup_server_id . '/' . $this->_resource;
                break;

            default:
                $resource = parent::getResource( $action );
                break;
        }

        return $resource;
    }

    public function save()
    {
        $dataArray = array();
        if ( $this->_bonding_mode != null ) {
            $dataArray['bonding_mode'] = $this->_bonding_mode;
        }
        if ( $this->_mtu != null ) {
            $dataArray['mtu'] = $this->_mtu;
        }
        if ( $this->_vlan != null ) {
            $dataArray['vlan'] = $this->_vlan;
        }

        $data = array(
            'root' => $this->_tagRoot,
            'data' => $dataArray,
        );

        $this->sendPut( ONAPP_GETRESOURCE_DEFAULT, $data );
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
            case ONAPP_ACTIVATE_DELETE:
                exit( 'Call to undefined method ' . __CLASS__ . '::' . $action_name . '()' );
                break;
        }
    }

}
