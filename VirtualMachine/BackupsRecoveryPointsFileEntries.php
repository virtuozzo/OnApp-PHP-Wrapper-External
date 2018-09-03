<?php
/**
 * Managing VirtualMachine BackupsRecoveryPointsFileEntries
 * 
 * much they will be charged per unit.
 *
 * @category    API wrapper
 * @package     OnApp
 * @author      Mykola Vuy
 * @copyright   © 2018 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */

/**
 * Managing VirtualMachine BackupsRecoveryPointsFileEntries
 *
 * The OnApp_VirtualMachine_BackupsRecoveryPointsFileEntries class uses the following basic methods:
 * {@link load}, {@link add}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php )
 */

class OnApp_VirtualMachine_BackupsRecoveryPointsFileEntries extends OnApp {
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
    var $_resource = 'backups/recovery_points';

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
            case 6.0:
                $this->fields = array(
                    'file_entry'            => array(
                        ONAPP_FIELD_MAP         => '_file_entry',
                        ONAPP_FIELD_TYPE        => 'array',
                        ONAPP_FIELD_CLASS       => 'VirtualMachine_FileEntriesFields',
                    ),
                    'virtual_machine_id'        => array(
                        ONAPP_FIELD_MAP         => '_virtual_machine_id',
                        ONAPP_FIELD_TYPE        => 'integer',
                        ONAPP_FIELD_READ_ONLY   => true,
                    ),
                    'recovery_point_id'        => array(
                        ONAPP_FIELD_MAP         => '_recovery_point_id',
                        ONAPP_FIELD_TYPE        => 'integer',
                        ONAPP_FIELD_READ_ONLY   => true,
                    ),
                    'paths'                     => array(
                        ONAPP_FIELD_MAP         => '_paths',
                        ONAPP_FIELD_TYPE        => '_array',
                    ),
                );
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
                 * @name VirtualMachine BackupsRecoveryPointsFileEntries
                 * @method GET
                 *
                 * @alias   /virtual_machines/:virtual_machine_id/backups/recovery_points/:recovery_point_id/file_entries(.:format)
                 * @format  {:controller=>"VirtualMachine BackupsRecoveryPointsFileEntries", :action=>"index"}
                 */
                
                /**
                 * ROUTE :
                 *
                 * @name VirtualMachine BackupsRecoveryPointsFileEntries
                 * @method POST
                 *
                 * @alias   /virtual_machines/:virtual_machine_id/backups/recovery_points/:recovery_point_id/file_entries(.:format)
                 * @format  {:controller=>"VirtualMachine BackupsRecoveryPointsFileEntries", :action=>"index"}
                 */
                
                $resource = 'virtual_machines/' . $this->_virtual_machine_id . '/' . $this->_resource . '/' . $this->_recovery_point_id . '/file_entries';
                $this->logger->debug( 'getResource( ' . $action . ' ): return ' . $resource );
                break;
                
            default:
                $resource = parent::getResource( $action );
                break;
        }

        return $resource;
    }
    
    /**
     * The method saves an Object
     *
     * @param  bollean: true - edit | false - create
     * @return void
     */
    public function save() {
        $data = array( 'paths' => $this->_paths );
        
        if ( ! is_null( $data ) && is_array( $data ) ) {
            $data = json_encode($data);
            $this->logger->debug( 'Additional parameters: ' . $data );
        }
        $this->setAPIResource( $this->getResource( ONAPP_GETRESOURCE_DEFAULT ) );
        $response = $this->sendRequest( ONAPP_REQUEST_METHOD_POST, $data );

        $result     = $this->_castResponseToClass( $response );
        $this->_obj = $result;
    }

}
