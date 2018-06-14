<?php
/**
 * Network IP Net
 *
 * @category    API wrapper
 * @package     OnApp
 * @author      Ivan Gavryliuk
 * @copyright   © 2017 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */

/**
 *
 * Managing Network IP Net
 *
 * The OnApp_Network_IpNet class uses the following basic methods:
 * {@link load}, {@link save}, {@link delete}, and {@link getList}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */
class OnApp_Network_IpNet extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'ip_net';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'settings/networks';

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
            case 5.4:
                $this->fields = array(
                    'id'              => array(
                        ONAPP_FIELD_MAP  => '_id',
                        ONAPP_FIELD_TYPE => 'integer'
                    ),
                    'network_address' => array(
                        ONAPP_FIELD_MAP  => '_network_address',
                        ONAPP_FIELD_TYPE => 'string'
                    ),
                    'default_gateway' => array(
                        ONAPP_FIELD_MAP  => '_default_gateway',
                        ONAPP_FIELD_TYPE => 'string'
                    ),
                    'network_mask'    => array(
                        ONAPP_FIELD_MAP  => '_network_mask',
                        ONAPP_FIELD_TYPE => 'integer'
                    ),
                    'ipv4'            => array(
                        ONAPP_FIELD_MAP  => '_ipv4',
                        ONAPP_FIELD_TYPE => 'boolean'
                    ),
                    'label'           => array(
                        ONAPP_FIELD_MAP  => '_label',
                        ONAPP_FIELD_TYPE => 'string'
                    ),
                    'created_at'      => array(
                        ONAPP_FIELD_MAP  => '_created_at',
                        ONAPP_FIELD_TYPE => 'datetime'
                    ),
                    'updated_at'      => array(
                        ONAPP_FIELD_MAP  => '_updated_at',
                        ONAPP_FIELD_TYPE => 'datetime'
                    ),
                    'openstack_id'    => array(
                        ONAPP_FIELD_MAP  => '_openstack_id',
                        ONAPP_FIELD_TYPE => 'integer'
                    ),
                    'network'         => array(
                        ONAPP_FIELD_MAP  => '_network',
                        ONAPP_FIELD_TYPE => 'array',
                        ONAPP_FIELD_CLASS=> '',
                    ),
                    'network_id'      => array(
                        ONAPP_FIELD_MAP  => '_network_id',
                        ONAPP_FIELD_TYPE => 'string'
                    ),
                );
                break;
            case 5.5:
                $this->fields = $this->initFields( 5.4 );
                break;
            case 6.0:
                $this->fields = $this->initFields( 5.5 );
                $this->fields['add_default_ip_range'] = array(
                    ONAPP_FIELD_MAP  => '_add_default_ip_range',
                    ONAPP_FIELD_TYPE => 'string',
                );
                break;
        }

        parent::initFields( $version, __CLASS__ );

        return $this->fields;
    }

    function getResource( $action = ONAPP_GETRESOURCE_DEFAULT ) {
        switch ( $action ) {
            case ONAPP_GETRESOURCE_DEFAULT:
                if ( is_null( $this->_network_id ) && is_null( $this->_obj->_network_id ) ) {
                    $this->logger->error(
                        'getResource( ' . $action . ' ): argument _network_id not set.',
                        __FILE__,
                        __LINE__
                    );
                } else {
                    if ( is_null( $this->_network_id ) ) {
                        $this->_network_id = $this->_obj->_network_id;
                    }
                }
                $resource = $this->_resource . '/' . $this->_network_id . '/ip_nets';
                break;


            default:
                /**
                 * ROUTE :
                 *
                 * @name ip_nets
                 * @method GET
                 * @alias  settings/networks/:network_zone_id/ip_nets(.:format)
                 * @format {:controller=>"ip_nets", :action=>"index"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name ip_nets
                 * @method GET
                 * @alias  settings/networks/:network_zone_id/ip_nets/:id(.:format)
                 * @format {:controller=>"ip_nets", :action=>"show"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name ip_nets
                 * @method POST
                 * @alias  settings/networks/:network_zone_id/ip_nets/:id(.:format)
                 * @format {:controller=>"ip_nets", :action=>"create"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name ip_nets
                 * @method PUT
                 * @alias  settings/networks/:network_zone_id/ip_nets/:id(.:format)
                 * @format {:controller=>"ip_nets", :action=>"update"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name ip_nets
                 * @method DELETE
                 * @alias  settings/networks/:network_zone_id/ip_nets/:id(.:format)
                 * @format {:controller=>"ip_nets", :action=>"destroy"}
                 */
                $resource = parent::getResource( $action );
        }

        return $resource;
    }
}