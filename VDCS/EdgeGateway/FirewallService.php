<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Managing Edge Gateways Firewall Rules
 *
 *
 * @category    API wrapper
 * @package     OnApp
 * @author
 * @copyright   © 2011 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */


/**
 * Firewall Rule
 *
 */
class OnApp_VDCS_EdgeGateway_FirewallService extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'vcloud_firewall_rule';

    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'firewall_services';

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
            case 4.0:
                $this->fields = array(
                    'id'                          => array(
                        ONAPP_FIELD_MAP       => '_id',
                        ONAPP_FIELD_TYPE      => 'integer',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                );
                break;
            case 4.2:
                $this->fields = $this->initFields( 4.0 );

                $this->fields[ 'firewall_service_id' ]         = array(
                    ONAPP_FIELD_MAP       => '_firewall_service_id',
                    ONAPP_FIELD_TYPE      => 'integer',
                );
                $this->fields[ 'id' ]         = array(
                    ONAPP_FIELD_MAP       => '_id',
                    ONAPP_FIELD_TYPE      => 'integer',
                );
                $this->fields[ 'vcloud_firewall_rule' ] = array(
                    ONAPP_FIELD_MAP       => '_vcloud_firewall_rule',
                    ONAPP_FIELD_TYPE      => 'array',
                    ONAPP_FIELD_CLASS     => 'VDCS_EdgeGateway_FirewallService_FirewallRule',
                );


                $this->fields[ 'address' ]         = array(
                    ONAPP_FIELD_MAP       => '_address',
                    ONAPP_FIELD_TYPE      => 'string',
                );
                $this->fields[ 'command' ]         = array(
                    ONAPP_FIELD_MAP       => '_command',
                    ONAPP_FIELD_TYPE      => 'string',
                );
                $this->fields[ 'created_at' ]         = array(
                    ONAPP_FIELD_MAP       => '_created_at',
                    ONAPP_FIELD_TYPE      => 'datetime',
                    ONAPP_FIELD_READ_ONLY => true,
                );
                $this->fields[ 'description' ]         = array(
                    ONAPP_FIELD_MAP       => '_description',
                    ONAPP_FIELD_TYPE      => 'string',
                );
                $this->fields[ 'destination_ip' ]         = array(
                    ONAPP_FIELD_MAP       => '_destination_ip',
                    ONAPP_FIELD_TYPE      => 'string',
                );
                $this->fields[ 'enable_logging' ]         = array(
                    ONAPP_FIELD_MAP       => '_enable_logging',
                    ONAPP_FIELD_TYPE      => 'string',
                );
                $this->fields[ 'enabled' ]         = array(
                    ONAPP_FIELD_MAP       => '_enabled',
                    ONAPP_FIELD_TYPE      => 'string',
                );
                $this->fields[ 'firewall_service_id' ]         = array(
                    ONAPP_FIELD_MAP       => '_firewall_service_id',
                    ONAPP_FIELD_TYPE      => 'integer',
                );
                $this->fields[ 'id' ]         = array(
                    ONAPP_FIELD_MAP       => '_id',
                    ONAPP_FIELD_TYPE      => 'integer',
                    ONAPP_FIELD_READ_ONLY => true,
                );
                $this->fields[ 'identifier' ]         = array(
                    ONAPP_FIELD_MAP       => '_identifier',
                    ONAPP_FIELD_TYPE      => 'string',
                );
                $this->fields[ 'network_interface_id' ]         = array(
                    ONAPP_FIELD_MAP       => '_network_interface_id',
                    ONAPP_FIELD_TYPE      => 'integer',
                );
                $this->fields[ 'port' ]         = array(
                    ONAPP_FIELD_MAP       => '_port',
                    ONAPP_FIELD_TYPE      => 'string',
                );
                $this->fields[ 'position' ]         = array(
                    ONAPP_FIELD_MAP       => '_position',
                    ONAPP_FIELD_TYPE      => 'string',
                );
                $this->fields[ 'protocol' ]         = array(
                    ONAPP_FIELD_MAP       => '_protocol',
                    ONAPP_FIELD_TYPE      => 'string',
                );
                $this->fields[ 'source_port' ]         = array(
                    ONAPP_FIELD_MAP       => '_source_port',
                    ONAPP_FIELD_TYPE      => 'string',
                );
                $this->fields[ 'updated_at' ]         = array(
                    ONAPP_FIELD_MAP       => '_updated_at',
                    ONAPP_FIELD_TYPE      => 'datetime',
                    ONAPP_FIELD_READ_ONLY => true,
                );

                break;
        }

        parent::initFields( $version, __CLASS__ );

        return $this->fields;
    }

    function getResource( $action = ONAPP_GETRESOURCE_DEFAULT ) {
        switch( $action ) {
            case ONAPP_GETRESOURCE_ADD:
            case ONAPP_GETRESOURCE_LIST:
            case ONAPP_GETRESOURCE_DEFAULT:
                /**
                 * ROUTE :
                 *
                 * @name
                 * @method DELETE
                 * @alias    /firewall_services/:firewall_service_id/firewall_rules(.:format)
                 * @format    {:controller=>"edge_gateways", :action=>"destroy"}
                 */
                if( is_null( $this->_firewall_service_id ) && is_null( $this->_obj->_firewall_service_id ) ) {
                    $this->logger->error(
                        'getResource( ' . $action . ' ): argument _firewall_service_id not set.',
                        __FILE__,
                        __LINE__
                    );
                }
                else {
                    if( is_null( $this->_firewall_service_id ) ) {
                        $this->_firewall_service_id = $this->_obj->_firewall_service_id;
                    }
                }

                $resource = '/' . $this->_resource . '/' . $this->_firewall_service_id . '/' . 'firewall_rules';
                break;
            default:
                $resource = parent::getResource( $action );
                break;
        }

        return $resource;
    }

    function getList( $firewall_service_id = null, $url_args = null ) {
        if( is_null($firewall_service_id) ) {
            return false;
        }

        if( $firewall_service_id ) {
            $this->_firewall_service_id = $firewall_service_id;
        }

        return parent::getList();
    }


}