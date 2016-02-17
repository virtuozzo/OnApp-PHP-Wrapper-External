<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Managing Edge Gateways
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
 * Edge Gateways
 *
 */
class OnApp_VDCS_EdgeGateway extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'edge_gateway';

    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'edge_gateways';

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
                        ONAPP_FIELD_READ_ONLY => true
                    ),
                    'created_at'                  => array(
                        ONAPP_FIELD_MAP       => '_created_at',
                        ONAPP_FIELD_TYPE      => 'datetime',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'description'                       => array(
                        ONAPP_FIELD_MAP      => '_description',
                    ),
                    'identifier'                  => array(
                        ONAPP_FIELD_MAP       => '_identifier',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'label'                       => array(
                        ONAPP_FIELD_MAP      => '_label',
                    ),
                    'updated_at'                  => array(
                        ONAPP_FIELD_MAP       => '_updated_at',
                        ONAPP_FIELD_TYPE      => 'datetime',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'vdc_id'                          => array(
                        ONAPP_FIELD_MAP       => '_vdc_id',
                        ONAPP_FIELD_TYPE      => 'integer',
                        ONAPP_FIELD_READ_ONLY => true
                    ),
                );
                break;
            case 4.2:
                $this->fields = $this->initFields( 4.0 );

                //gateway_backing_config can be: compact, full, full-4
                $this->fields[ 'gateway_backing_config' ]         = array(
                    ONAPP_FIELD_MAP       => '_gateway_backing_config',
                    ONAPP_FIELD_TYPE      => 'string',
                );
                $this->fields[ 'ha_enabled' ]         = array(
                    ONAPP_FIELD_MAP       => '_ha_enabled',
                    ONAPP_FIELD_TYPE      => 'boolean',
                );
                $this->fields[ 'status' ]         = array(
                    ONAPP_FIELD_MAP       => '_status',
                    ONAPP_FIELD_TYPE      => 'string',
                );
                $this->fields[ 'use_default_route_for_dns_relay' ]         = array(
                    ONAPP_FIELD_MAP       => '_use_default_route_for_dns_relay',
                    ONAPP_FIELD_TYPE      => 'boolean',
                );
                $this->fields[ 'external_network_ids' ]         = array(
                    ONAPP_FIELD_MAP       => '_external_network_ids',
                    ONAPP_FIELD_TYPE      => 'array',
                );




                break;
        }

        parent::initFields( $version, __CLASS__ );

        return $this->fields;
    }

    function getResource( $action = ONAPP_GETRESOURCE_DEFAULT ) {
        switch( $action ) {
          default:
              $resource = parent::getResource( $action );
              break;
        }

        return $resource;
    }

}