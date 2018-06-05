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
class OnApp_VDCS_EdgeGateway_FirewallService_FirewallRule extends OnApp {
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
    //var $_resource = 'firewall_rules';

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
            case 4.0:
            case 4.1:
            case 4.2:
                $this->fields = array();

                $this->fields['address']              = array(
                    ONAPP_FIELD_MAP  => '_address',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['command']              = array(
                    ONAPP_FIELD_MAP  => '_command',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['created_at']           = array(
                    ONAPP_FIELD_MAP       => '_created_at',
                    ONAPP_FIELD_TYPE      => 'datetime',
                    ONAPP_FIELD_READ_ONLY => true,
                );
                $this->fields['description']          = array(
                    ONAPP_FIELD_MAP  => '_description',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['destination_ip']       = array(
                    ONAPP_FIELD_MAP  => '_destination_ip',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['enable_logging']       = array(
                    ONAPP_FIELD_MAP  => '_enable_logging',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['enabled']              = array(
                    ONAPP_FIELD_MAP  => '_enabled',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['firewall_service_id']  = array(
                    ONAPP_FIELD_MAP  => '_firewall_service_id',
                    ONAPP_FIELD_TYPE => 'integer',
                );
                $this->fields['id']                   = array(
                    ONAPP_FIELD_MAP       => '_id',
                    ONAPP_FIELD_TYPE      => 'integer',
                    ONAPP_FIELD_READ_ONLY => true,
                );
                $this->fields['identifier']           = array(
                    ONAPP_FIELD_MAP  => '_identifier',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['network_interface_id'] = array(
                    ONAPP_FIELD_MAP  => '_network_interface_id',
                    ONAPP_FIELD_TYPE => 'integer',
                );
                $this->fields['port']                 = array(
                    ONAPP_FIELD_MAP  => '_port',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['position']             = array(
                    ONAPP_FIELD_MAP  => '_position',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['protocol']             = array(
                    ONAPP_FIELD_MAP  => '_protocol',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['source_port']          = array(
                    ONAPP_FIELD_MAP  => '_source_port',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['updated_at']           = array(
                    ONAPP_FIELD_MAP       => '_updated_at',
                    ONAPP_FIELD_TYPE      => 'datetime',
                    ONAPP_FIELD_READ_ONLY => true,
                );
                break;
            case 4.3:
            case 5.0:
                $this->fields = $this->initFields( 4.2 );
                break;
            case 5.1:
                $this->fields = $this->initFields( 5.0 );
                break;
            case 5.2:
                $this->fields = $this->initFields( 5.1 );
                break;
            case 5.3:
                $this->fields = $this->initFields( 5.2 );
                break;
            case 5.4:
                $this->fields = $this->initFields( 5.3 );
                break;
            case 5.5:
                $this->fields = $this->initFields( 5.4 );
                break;
            case 6.0:
                $this->fields = $this->initFields( 5.5 );
                break;
        }

        parent::initFields( $version, __CLASS__ );

        return $this->fields;
    }

}