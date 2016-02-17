<?php
/**
 * Managing Customer Network
 *
 * @category    API wrapper
 * @package     OnApp
 * @author
 * @copyright   © 2016 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */


/**
 * Managing Customer Network
 *
 * The OnApp_CustomerNetwork class represents the Customer Network.
 *
 * The OnApp_CustomerNetwork class uses the following basic methods:
 * {@link load}, {@link save}, {@link delete}, and {@link getList}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */
class OnApp_CustomerNetwork extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'customer_network';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'customer_networks';

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
            case 2.0:
            case 2.1:
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
                    'created_at' => array(
                        ONAPP_FIELD_MAP  => '_created_at',
                        ONAPP_FIELD_TYPE => 'datetime',
                    ),
                    'updated_at' => array(
                        ONAPP_FIELD_MAP  => '_updated_at',
                        ONAPP_FIELD_TYPE => 'datetime',
                    ),
                    'id'         => array(
                        ONAPP_FIELD_MAP  => '_id',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'user_id'         => array(
                        ONAPP_FIELD_MAP  => '_user_id',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'prefix_size'       => array(
                        ONAPP_FIELD_MAP  => '_prefix_size',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'is_nated'       => array(
                        ONAPP_FIELD_MAP  => '_is_nated',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'default_nat_rule_number'       => array(
                        ONAPP_FIELD_MAP  => '_default_nat_rule_number',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'default_outside_ip_address_id'       => array(
                        ONAPP_FIELD_MAP  => '_default_outside_ip_address_id',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'identifier'       => array(
                        ONAPP_FIELD_MAP  => '_identifier',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'ip_address_pool_id'       => array(
                        ONAPP_FIELD_MAP  => '_ip_address_pool_id',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'label'       => array(
                        ONAPP_FIELD_MAP  => '_label',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'vlan'       => array(
                        ONAPP_FIELD_MAP  => '_vlan',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'network_group_id'       => array(
                        ONAPP_FIELD_MAP  => '_network_group_id',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'hypervisor_id'       => array(
                        ONAPP_FIELD_MAP  => '_hypervisor_id',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                );
                break;
        }

        parent::initFields( $version, __CLASS__ );

        return $this->fields;
    }

    function getResource( $action = ONAPP_GETRESOURCE_DEFAULT ) {
        switch ( $action ) {
            case ONAPP_GETRESOURCE_LIST:
                /**
                 * @alias  /customer_networks.json
                 * @alias  /users/:user_id/customer_networks.json
                 */
                $resourceAdd = '';
                if( ! is_null( $this->_id ) ) {
                    $resourceAdd = 'users/' . $this->_id . '/';
                }
                $resource = $resourceAdd . $this->_resource;
                break;
            case ONAPP_GETRESOURCE_ADD:
                /**
                 * @alias  /users/:user_id/customer_networks.json
                 */
                if( is_null( $this->_user_id ) && is_null( $this->_obj->_user_id ) ) {
                    $this->logger->error(
                        'getResource( ' . $action . ' ): argument _user_id not set.',
                        __FILE__,
                        __LINE__
                    );
                }
                else {
                    if( is_null( $this->_user_id ) ) {
                        $this->_user_id = $this->_obj->_user_id;
                    }
                }
                $resource = 'users/' . $this->_user_id . '/' . $this->_resource;;
                break;
            default:
                /**
                 * @alias  /customer_networks/:id.json
                 */
                $resource = parent::getResource( $action );
        }

        return $resource;
    }

    public function save(){
        $data = array(
            'root' => $this->_tagRoot,
            'data' => array(
                'default_outside_ip_address' => array(
                    'hypervisor_id' => $this->_hypervisor_id,
                ),
                'ip_address_pool_id' => $this->_ip_address_pool_id,
                'label' => $this->_label,
                'prefix_size' => $this->_prefix_size,
                'network_group_id' => $this->_network_group_id,
                'is_nated' => $this->_is_nated,
            ),
        );
        $this->sendPost( ONAPP_GETRESOURCE_ADD, $data );

    }

    function getList( $user_id = null, $url_args = null ) {
        if( is_null( $user_id ) && ! is_null( $this->_user_id ) ) {
            $user_id = $this->_user_id;
        }

        if( ! is_null( $user_id ) ) {
            $this->_user_id = $user_id;

            return parent::getList();
        }
        else {
            $this->logger->error(
                'getList: argument _user_id not set.',
                __FILE__,
                __LINE__
            );
        }
    }

}