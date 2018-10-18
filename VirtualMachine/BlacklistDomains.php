<?php
/**
 * Managing VirtualMachine BlacklistDomains
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
 * Managing VirtualMachine BlacklistDomains
 *
 * The OnApp_VirtualMachine_BlacklistDomains class uses the following basic methods:
 * {@link getList}, {@link edit}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php )
 */

class OnApp_VirtualMachine_BlacklistDomains extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'blacklist_domains';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'blacklist_domains';

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
                    'blacklist_domain'      => array(
                        ONAPP_FIELD_MAP     => '_blacklist_domain',
                        ONAPP_FIELD_TYPE    => 'string',
                    ),
                    'hostname_blacklists'   => array(
                        ONAPP_FIELD_MAP     => '_hostname_blacklists',
                        ONAPP_FIELD_TYPE    => '_array',
                    ),
                    'virtual_machine_id'    => array(
                        ONAPP_FIELD_MAP     => '_virtual_machine_id',
                        ONAPP_FIELD_TYPE    => 'integer',
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
                 * @name VirtualMachine BlacklistDomains
                 * @method GET
                 * 
                 * @alias   /virtual_machines/:virtual_machine_id/blacklist_domains(.:format)
                 * @format  {:controller=>"VirtualMachine BackupsResources", :action=>"index"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name VirtualMachine BlacklistDomains
                 * @method PUT
                 *
                 * @alias   /virtual_machines/:virtual_machine_id/blacklist_domains(.:format)
                 * @format  {:controller=>"VirtualMachine BackupsResources", :action=>"edit"}
                 */
                if ( !isset( $this->_virtual_machine_id ) && empty( $this->_virtual_machine_id ) ) {
                    $this->logger->error(
                        "getResource($action): argument _virtual_machine_id not set.",
                        __FILE__,
                        __LINE__
                    );
                }
                $resource = 'virtual_machines/' . $this->_virtual_machine_id . '/' . $this->_resource;
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
     * @return void
     */
    public function save() {
        
        if ( !isset( $this->_hostname_blacklists ) ) {
            $this->logger->error(
                "save(): argument _hostname_blacklists not set.",
                __FILE__,
                __LINE__
            );
        }
        
        $data = array(
            'root'        => $this->_tagRoot,
            'data'        => array(
                'hostname_blacklists'   => $this->_hostname_blacklists,
            ),
        );
        
        $this->sendPut( ONAPP_GETRESOURCE_DEFAULT, $data );
    }
}
