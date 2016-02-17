<?php

/**
 * VM PublishingRule
 *
 * @category    API wrapper
 * @package     OnApp
 * @subpackage  VirtualMachine
 * @author      Ivan Gavryliuk
 * @copyright   © 2016 OnApp
 * @link        https://docs.onapp.com/display/42API/Publishing+Rules
 * @see         OnApp
 */

/**
 * VM PublishingRule
 *
 * The OnApp_VirtualMachine_PublishingRule class uses the following basic methods:
 * {@link load}, {@link save}, {@link delete}, and {@link getList}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */
class OnApp_VirtualMachine_PublishingRule extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'publication';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'publications';

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
            case 3.0:
            case 3.1:
            case 3.2:
            case 3.3:
            case 3.4:
            case 3.5:
            case 4.0:
            case 4.1:
            case 4.2:
                $this->fields = array(
                    'created_at'    => array(
                        ONAPP_FIELD_MAP       => '_created_at',
                        ONAPP_FIELD_TYPE      => 'datetime',
                    ),
                    'customer_network_id'    => array(
                        ONAPP_FIELD_MAP       => '_customer_network_id',
                        ONAPP_FIELD_TYPE      => 'string',
                    ),
                    'id'    => array(
                        ONAPP_FIELD_MAP       => '_id',
                        ONAPP_FIELD_TYPE      => 'integer',
                    ),
                    'is_built'    => array(
                        ONAPP_FIELD_MAP       => '_is_built',
                        ONAPP_FIELD_TYPE      => 'boolean',
                    ),
                    'outside_ip_address_id'    => array(
                        ONAPP_FIELD_MAP       => '_outside_ip_address_id',
                        ONAPP_FIELD_TYPE      => 'string',
                    ),
                    'port'    => array(
                        ONAPP_FIELD_MAP       => '_port',
                        ONAPP_FIELD_TYPE      => 'integer',
                    ),
                    'protocol'    => array(
                        ONAPP_FIELD_MAP       => '_protocol',
                        ONAPP_FIELD_TYPE      => 'string',
                    ),
                    'rule_number'    => array(
                        ONAPP_FIELD_MAP       => '_rule_number',
                        ONAPP_FIELD_TYPE      => 'integer',
                    ),
                    'updated_at'    => array(
                        ONAPP_FIELD_MAP       => '_updated_at',
                        ONAPP_FIELD_TYPE      => 'datetime',
                    ),
                    'virtual_machine_id'    => array(
                        ONAPP_FIELD_MAP       => '_virtual_machine_id',
                        ONAPP_FIELD_TYPE      => 'integer',
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
    function getResource( $action = ONAPP_GETRESOURCE_DEFAULT ) {
        switch( $action ) {
            case ONAPP_GETRESOURCE_DEFAULT:
                /**
                 * ROUTE :
                 *
                 * @name network_interfaces
                 * @method GET
                 * @alias   /network_interfaces(.:format)
                 * @format  {:controller=>"network_interfaces", :action=>"index"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name  network_interface
                 * @method GET
                 * @alias    /network_interfaces/:id(.:format)
                 * @format   {:controller=>"network_interfaces", :action=>"show"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name
                 * @method POST
                 * @alias   /network_interfaces(.:format)
                 * @format  {:controller=>"network_interfaces", :action=>"create"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name
                 * @method PUT
                 * @alias  /network_interfaces/:id(.:format)
                 * @format {:controller=>"network_interfaces", :action=>"update"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name
                 * @method DELETE
                 * @alias   /network_interfaces/:id(.:format)
                 * @format  {:controller=>"network_interfaces", :action=>"destroy"}
                 */
                if( is_null( $this->_virtual_machine_id ) && is_null( $this->_obj->_virtual_machine_id ) ) {
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
}
