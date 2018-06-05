<?php
/**
 * Managing Federation
 *
 * @category    API wrapper
 * @package     OnApp
 * @author
 * @copyright   © 2011 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */


/**
 *
 */
define( 'ONAPP_GETRESOURCE_FEDERATION_WITH_HZONEID', 'federation_with_hzoneid' );

/**
 *
 */
define( 'ONAPP_GETRESOURCE_FEDERATION_WITH_FEDERATION_ID', 'federation_with_federation_id' );

/**
 *
 */
define( 'ONAPP_GETRESOURCE_ADD_ZONE_TO_FEDERATION', 'add_zone_to_federation' );

/**
 *
 */
define( 'ONAPP_GETRESOURCE_ENABLE_FEDERATED_ZONE', 'enable_federated_zone' );

/**
 *
 */
define( 'ONAPP_GETRESOURCE_DISABLE_FEDERATED_ZONE', 'disable_federated_zone' );

/**
 *
 */
define( 'ONAPP_GETRESOURCE_REMOVE_FEDERATED_ZONE', 'remove_federated_zone' );

/**
 *
 */
define( 'ONAPP_GETRESOURCE_GET_UNSUBSCRIBED', 'get_unsubscribed' );

/**
 *
 */
define( 'ONAPP_GETRESOURCE_GET_SUBSCRIBED', 'get_subscribed' );

/**
 *
 */
define( 'ONAPP_GETRESOURCE_SUBSCRIBE', 'subscribe' );

/**
 *
 */
define( 'ONAPP_GETRESOURCE_UNSUBSCRIBE', 'unsubscribe' );

/**
 *
 */
define( 'ONAPP_GETRESOURCE_SUSPEND', 'suspend' );

/**
 *
 */
define( 'ONAPP_GETRESOURCE_UNSUSPEND', 'unsuspend' );

/**
 *
 */
define( 'ONAPP_GETRESOURCE_FEDERATION_REPORT_VS_PROBLEM', 'report_vs_problem' );

/**
 *
 */
define( 'ONAPP_GETRESOURCE_MAKE_PUBLIC', 'make_public' );

/**
 *
 */
define( 'ONAPP_GETRESOURCE_MAKE_PRIVATE', 'make_private' );

/**
 * Federation
 *
 * The Federation class represents the Federation of the OnAPP installation.
 *
 * The OnApp_Federation class uses the following basic methods:
 * {@link getList}.
 *
 * For full fields reference and curl request details visit: ( https://docs.onapp.com/display/federation/Federation+API )
 */
class OnApp_Federation extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    //var $_tagRoot = 'federation_hypervisor_zone';
    var $_tagRoot = 'hypervisor_zone';

    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'federation/hypervisor_zones';

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
            case 3.4:
            case 3.5:
            case 4.0:
            case 4.1:
                $this->fields = array(
                    'hypervisor_zones_id'         => array(
                        ONAPP_FIELD_MAP  => '_hypervisor_zones_id',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'data_store_zone_label'       => array(
                        ONAPP_FIELD_MAP  => '_data_store_zone_label',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    //data_store_zone_pricing_attributes
                    'data_store_zone_pricing'     => array(
                        ONAPP_FIELD_MAP   => '_data_store_zone_pricing',
                        ONAPP_FIELD_TYPE  => 'array',
                        ONAPP_FIELD_CLASS => 'Federation_DataStoreZonePricing',
                    ),
                    'data_store_zone_pricing_attributes'     => array(
                        ONAPP_FIELD_MAP   => '_data_store_zone_pricing_attributes',
                        ONAPP_FIELD_TYPE  => 'array',
                        ONAPP_FIELD_CLASS => 'Federation_DataStoreZonePricing',
                    ),
                    'description'                 => array(
                        ONAPP_FIELD_MAP  => '_description',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'hypervisor_type'             => array(
                        ONAPP_FIELD_MAP  => '_hypervisor_type',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    //compute resource_zone_pricing_attributes
                    'hypervisor_zone_pricing'     => array(
                        ONAPP_FIELD_MAP   => '_hypervisor_zone_pricing',
                        ONAPP_FIELD_TYPE  => 'array',
                        ONAPP_FIELD_CLASS => 'Federation_HypervisorZonePricing',
                    ),
                    'hypervisor_zone_pricing_attributes'     => array(
                        ONAPP_FIELD_MAP   => '_hypervisor_zone_pricing_attributes',
                        ONAPP_FIELD_TYPE  => 'array',
                        ONAPP_FIELD_CLASS => 'Federation_HypervisorZonePricing',
                    ),
                    'label'                       => array(
                        ONAPP_FIELD_MAP  => '_label',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'network_zone_label'          => array(
                        ONAPP_FIELD_MAP  => '_network_zone_label',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    //network_zone_pricing_attributes
                    'network_zone_pricing'        => array(
                        ONAPP_FIELD_MAP   => '_network_zone_pricing',
                        ONAPP_FIELD_TYPE  => 'array',
                        ONAPP_FIELD_CLASS => 'Federation_NetworkZonePricing',
                    ),
                    'network_zone_pricing_attributes'        => array(
                        ONAPP_FIELD_MAP   => '_network_zone_pricing_attributes',
                        ONAPP_FIELD_TYPE  => 'array',
                        ONAPP_FIELD_CLASS => 'Federation_NetworkZonePricing',
                    ),
                    'template_group_id'           => array(
                        ONAPP_FIELD_MAP  => '_template_group_id',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    //user_virtual_server_pricing_attributes
                    'user_virtual_server_pricing' => array(
                        ONAPP_FIELD_MAP   => '_user_virtual_server_pricing',
                        ONAPP_FIELD_TYPE  => 'array',
                        ONAPP_FIELD_CLASS => 'Federation_UserVirtualServerPricing',
                    ),
                    'federation_id'               => array(
                        ONAPP_FIELD_MAP  => '_federation_id',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                );
                break;
            case 4.2:
                $this->fields                       = $this->initFields( 4.1 );
                $this->fields['network_zone_id']    = array(
                    ONAPP_FIELD_MAP  => '_network_zone_id',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['data_store_zone_id'] = array(
                    ONAPP_FIELD_MAP  => '_data_store_zone_id',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['provider_name']      = array(
                    ONAPP_FIELD_MAP  => '_provider_name',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['seller_page_url']    = array(
                    ONAPP_FIELD_MAP  => '_seller_page_url',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['country']            = array(
                    ONAPP_FIELD_MAP  => '_country',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['city']               = array(
                    ONAPP_FIELD_MAP  => '_city',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['uptime_percentage']  = array(
                    ONAPP_FIELD_MAP  => '_uptime_percentage',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['cpu_score']          = array(
                    ONAPP_FIELD_MAP  => '_cpu_score',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['cpu_index']          = array(
                    ONAPP_FIELD_MAP  => '_cpu_index',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['bandwidth_score']    = array(
                    ONAPP_FIELD_MAP  => '_bandwidth_score',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['bandwidth_index']    = array(
                    ONAPP_FIELD_MAP  => '_bandwidth_index',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['disk_score']         = array(
                    ONAPP_FIELD_MAP  => '_disk_score',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['disk_index']         = array(
                    ONAPP_FIELD_MAP  => '_disk_index',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['cloud_index']        = array(
                    ONAPP_FIELD_MAP  => '_cloud_index',
                    ONAPP_FIELD_TYPE => 'string',
                );

                $this->fields['hypervisor_group_label']     = array(
                    ONAPP_FIELD_MAP  => '_hypervisor_group_label',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['hypervisor_label']           = array(
                    ONAPP_FIELD_MAP  => '_hypervisor_label',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['data_store_group_label']     = array(
                    ONAPP_FIELD_MAP  => '_data_store_group_label',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['data_store_label']           = array(
                    ONAPP_FIELD_MAP  => '_data_store_label',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['network_group_label']        = array(
                    ONAPP_FIELD_MAP  => '_network_group_label',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['network_label']              = array(
                    ONAPP_FIELD_MAP  => '_network_label',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['image_template_group_label'] = array(
                    ONAPP_FIELD_MAP  => '_image_template_group_label',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['vm_identifier']              = array(
                    ONAPP_FIELD_MAP  => '_vm_identifier',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['private']              = array(
                    ONAPP_FIELD_MAP  => '_private',
                    ONAPP_FIELD_TYPE => 'string',
                );
                break;

            case 4.3:
            case 5.0:
                $this->fields = $this->initFields( 4.2 );
                $this->fields['latitude']              = array(
                    ONAPP_FIELD_MAP  => '_latitude',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['longitude']              = array(
                    ONAPP_FIELD_MAP  => '_longitude',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['tier']              = array(
                    ONAPP_FIELD_MAP  => '_tier',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['tier_options']              = array(
                    ONAPP_FIELD_MAP  => '_tier_options',
                    ONAPP_FIELD_TYPE => 'array',
                    ONAPP_FIELD_CLASS => 'Federation_TierOptions',
                );
                $this->fields['tier_options_attributes']              = array(
                    ONAPP_FIELD_MAP  => '_tier_options_attributes',
                    ONAPP_FIELD_TYPE => 'array',
                    ONAPP_FIELD_CLASS => 'Federation_TierOptions',
                );
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
                $this->fields['certificates'] = array(
                    ONAPP_FIELD_MAP  => '_certificates',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['tier_bandwidth_index'] = array(
                    ONAPP_FIELD_MAP  => '_tier_bandwidth_index',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['tier_cloud_index'] = array(
                    ONAPP_FIELD_MAP  => '_tier_cloud_index',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['tier_cpu_index'] = array(
                    ONAPP_FIELD_MAP  => '_tier_cpu_index',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['tier_disk_index'] = array(
                    ONAPP_FIELD_MAP  => '_tier_disk_index',
                    ONAPP_FIELD_TYPE => 'string',
                );
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

    function getResource( $action = ONAPP_GETRESOURCE_DEFAULT ) {
        switch ( $action ) {
            case ONAPP_GETRESOURCE_FEDERATION_WITH_HZONEID:
                if ( is_null( $this->_hypervisor_zones_id ) ) {
                    $this->logger->error(
                        'getResource( ' . $action . ' ): argument _hypervisor_zones_id not set.',
                        __FILE__,
                        __LINE__
                    );
                }
                $resource = $this->getResource() . '/' . $this->_hypervisor_zones_id;
                break;

            case ONAPP_GETRESOURCE_FEDERATION_WITH_FEDERATION_ID:
                if ( is_null( $this->_federation_id ) ) {
                    $this->logger->error(
                        'getResource( ' . $action . ' ): argument _federation_id not set.',
                        __FILE__,
                        __LINE__
                    );
                }
                $resource = $this->getResource() . '/' . $this->_federation;
                break;

            case ONAPP_GETRESOURCE_ADD_ZONE_TO_FEDERATION:
                /**
                 * @alias   /federation/hypervisor_zones/:hypervisor_zones_id/add(.:format)
                 */
                $resource = $this->getResource( ONAPP_GETRESOURCE_FEDERATION_WITH_HZONEID ) . '/add';
                break;

            case ONAPP_GETRESOURCE_ENABLE_FEDERATED_ZONE:
                /**
                 * @alias   /federation/hypervisor_zones/:hypervisor_zones_id/activate(.:format)
                 */
                $resource = $this->getResource( ONAPP_GETRESOURCE_FEDERATION_WITH_HZONEID ) . '/activate';
                break;

            case ONAPP_GETRESOURCE_DISABLE_FEDERATED_ZONE:
                /**
                 * @alias   /federation/hypervisor_zones/:hypervisor_zones_id/deactivate(.:format)
                 */
                $resource = $this->getResource( ONAPP_GETRESOURCE_FEDERATION_WITH_HZONEID ) . '/deactivate';
                break;

            case ONAPP_GETRESOURCE_REMOVE_FEDERATED_ZONE:
                /**
                 * @alias   /federation/hypervisor_zones/:hypervisor_zones_id/remove(.:format)
                 */
                $resource = $this->getResource( ONAPP_GETRESOURCE_FEDERATION_WITH_HZONEID ) . '/remove';
                break;

            case ONAPP_GETRESOURCE_GET_UNSUBSCRIBED:
                /**
                 * @alias   /federation/hypervisor_zones/unsubscribed(.:format)
                 */
                $resource = $this->getResource() . '/unsubscribed';
                break;

            case ONAPP_GETRESOURCE_LIST:
            case ONAPP_GETRESOURCE_GET_SUBSCRIBED:
                /**
                 * @alias   /federation/hypervisor_zones/subscribed(.:format)
                 */
                $resource = $this->getResource() . '/subscribed';
                break;

            case ONAPP_GETRESOURCE_SUBSCRIBE:
                /**
                 * @alias   /federation/hypervisor_zones/:federation_id/add(.:format)
                 */
                $resource = $this->getResource( ONAPP_GETRESOURCE_FEDERATION_WITH_FEDERATION_ID ) . '/subscribe';
                break;

            case ONAPP_GETRESOURCE_UNSUBSCRIBE:
                /**
                 * @alias   /federation/hypervisor_zones/:hypervisor_zones_id/add(.:format)
                 */
                $resource = $this->getResource( ONAPP_GETRESOURCE_FEDERATION_WITH_HZONEID ) . '/unsubscribe';
                break;

            case ONAPP_GETRESOURCE_SUSPEND:
                /**
                 * @alias   /federation/hypervisor_zones/:hypervisor_zones_id/add(.:format)
                 */
                $resource = $this->getResource( ONAPP_GETRESOURCE_FEDERATION_WITH_HZONEID ) . '/close';
                break;

            case ONAPP_GETRESOURCE_UNSUSPEND:
                /**
                 * @alias   /federation/hypervisor_zones/:hypervisor_zones_id/add(.:format)
                 */
                $resource = $this->getResource( ONAPP_GETRESOURCE_FEDERATION_WITH_HZONEID ) . '/open';
                break;
            case ONAPP_GETRESOURCE_FEDERATION_REPORT_VS_PROBLEM:
                /**
                 * @alias   /federation/virtual_machines/:vm_identifier/report_a_problem(.:format)
                 */
                if ( is_null( $this->_vm_identifier ) ) {
                    $this->logger->error(
                        'getResource( ' . $action . ' ): argument _vm_identifier not set.',
                        __FILE__,
                        __LINE__
                    );
                }
                $resource = '/federation/virtual_machines/' . $this->_vm_identifier . '/report_a_problem';
                break;
            case ONAPP_GETRESOURCE_MAKE_PUBLIC:
                /**
                 * @alias   /federation/hypervisor_zones/:hypervisor_zones_id/make_public.json(.:format)
                 */
                $resource = $this->getResource( ONAPP_GETRESOURCE_FEDERATION_WITH_HZONEID ) . '/make_public';
                break;
            case ONAPP_GETRESOURCE_MAKE_PRIVATE:
                /**
                 * @alias   /federation/hypervisor_zones/:hypervisor_zones_id/make_private.json(.:format)
                 */
                $resource = $this->getResource( ONAPP_GETRESOURCE_FEDERATION_WITH_HZONEID ) . '/make_private';
                break;
            default:
                /**
                 * ROUTE :
                 *
                 * @name /federation/hypervisor_zones/unsubscribed
                 * @method GET
                 * @alias   /federation/hypervisor_zones/unsubscribed(.:format)
                 * @format  {:controller=>"/federation/hypervisor_zones/unsubscribed", :action=>"index"}
                 */
                $resource = parent::getResource( $action );
                break;
        }

        return $resource;
    }


    /**
     * Add Zone to Federation
     *
     * @access public
     */
    function addZoneToFederation( $hypervisor_zones_id = null ) {
        if ( ! is_null( $hypervisor_zones_id ) ) {
            $this->_hypervisor_zones_id = $hypervisor_zones_id;
        }
        $data = $this->getSerializedDataToSend();
        $this->sendPost( ONAPP_GETRESOURCE_ADD_ZONE_TO_FEDERATION, $data );
    }

    /**
     * Enable Federated Zone
     *
     * @access public
     */
    function activate( $hypervisor_zones_id = null ) {
        if ( ! is_null( $hypervisor_zones_id ) ) {
            $this->_hypervisor_zones_id = $hypervisor_zones_id;
        }
        $this->sendPost( ONAPP_GETRESOURCE_ENABLE_FEDERATED_ZONE );
    }

    /**
     * Disable Federated Zone
     *
     * @access public
     */
    function deactivate( $hypervisor_zones_id = null ) {
        if ( ! is_null( $hypervisor_zones_id ) ) {
            $this->_hypervisor_zones_id = $hypervisor_zones_id;
        }
        $this->sendPost( ONAPP_GETRESOURCE_DISABLE_FEDERATED_ZONE );
    }

    /**
     * Remove Zone from Federation
     *
     * @access public
     */
    function remove( $hypervisor_zones_id = null ) {
        if ( ! is_null( $hypervisor_zones_id ) ) {
            $this->_hypervisor_zones_id = $hypervisor_zones_id;
        }
        $this->sendDelete( ONAPP_GETRESOURCE_REMOVE_FEDERATED_ZONE );
    }

    function getListUnsubscribed( $query = null ) {
        if ( ! is_null( $query ) ) {
            $url_args['q'] = urlencode( $query );
        }
        $result = $this->sendGet( ONAPP_GETRESOURCE_GET_UNSUBSCRIBED, null, $url_args );

        if ( ! is_null( $this->getErrorsAsArray() ) ) {
            return false;
        } else {
            if ( ! is_array( $result ) && ! is_null( $result ) ) {
                $result = array( $result );
            }

            return $result;
        }
    }

    function getListSubscribed() {
        $result = $this->sendGet( ONAPP_GETRESOURCE_GET_SUBSCRIBED );

        if ( ! is_null( $this->getErrorsAsArray() ) ) {
            return false;
        } else {
            if ( ! is_array( $result ) && ! is_null( $result ) ) {
                $result = array( $result );
            }

            return $result;
        }
    }

    function getList( $params = null, $url_args = null ) {
        return $this->getListSubscribed();
    }

    /**
     * Subscribe to Federated Zone
     *
     * @access public
     */
    function subscribe( $federation_id = null ) {
        if ( ! is_null( $federation_id ) ) {
            $this->_federation_id = $federation_id;
        }

        $data = 'hypervisor_zone_namer[hypervisor_group_label]=' . urlencode( $this->_hypervisor_group_label );
        $data .= '&hypervisor_zone_namer[hypervisor_label]=' . urlencode( $this->_hypervisor_label );
        $data .= '&hypervisor_zone_namer[data_store_group_label]=' . urlencode( $this->_data_store_group_label );
        $data .= '&hypervisor_zone_namer[data_store_label]=' . urlencode( $this->_data_store_label );
        $data .= '&hypervisor_zone_namer[network_group_label]=' . urlencode( $this->_network_group_label );
        $data .= '&hypervisor_zone_namer[network_label]=' . urlencode( $this->_network_label );
        $data .= '&hypervisor_zone_namer[image_template_group_label]=' . urlencode( $this->_image_template_group_label );

        $contentTypeOld                            = $this->options[ ONAPP_OPTION_API_CONTENT ];
        $this->options[ ONAPP_OPTION_API_CONTENT ] = 'application/x-www-form-urlencoded';
        $this->sendPost( ONAPP_GETRESOURCE_SUBSCRIBE, $data );
        $this->options[ ONAPP_OPTION_API_CONTENT ] = $contentTypeOld;

    }

    /**
     * Unsubscribe from Federated Zone
     *
     * @access public
     */
    function unsubscribe( $hypervisor_zones_id = null ) {
        if ( ! is_null( $hypervisor_zones_id ) ) {
            $this->_hypervisor_zones_id = $hypervisor_zones_id;
        }
        $this->sendDelete( ONAPP_GETRESOURCE_UNSUBSCRIBE );
    }

    /**
     * Suspend Zone
     *
     * @access public
     */
    function suspend( $hypervisor_zones_id = null ) {
        if ( ! is_null( $hypervisor_zones_id ) ) {
            $this->_hypervisor_zones_id = $hypervisor_zones_id;
        }
        $this->sendPut( ONAPP_GETRESOURCE_SUSPEND );
    }

    /**
     * Unsuspend Zone
     *
     * @access public
     */
    function unsuspend( $hypervisor_zones_id = null ) {
        if ( ! is_null( $hypervisor_zones_id ) ) {
            $this->_hypervisor_zones_id = $hypervisor_zones_id;
        }
        $this->sendPut( ONAPP_GETRESOURCE_UNSUSPEND );
    }

    /**
     * Report a Problem with a VS
     *
     * @access public
     */
    function reportAProblem( $body = null ) {
        if ( is_null( $body ) ) {
            $this->logger->debug( 'argument body not set' );

            return false;
        }

        $data = 'federation_problem[body]=' . urlencode( $body );

        $contentTypeOld                            = $this->options[ ONAPP_OPTION_API_CONTENT ];
        $this->options[ ONAPP_OPTION_API_CONTENT ] = 'application/x-www-form-urlencoded';
        $this->sendPost( ONAPP_GETRESOURCE_FEDERATION_REPORT_VS_PROBLEM, $data );
        $this->options[ ONAPP_OPTION_API_CONTENT ] = $contentTypeOld;

    }

    /**
     * Switch Private Zone to Public
     *
     * @access public
     */
    function makePublic( $hypervisor_zones_id = null ) {
        if ( ! is_null( $hypervisor_zones_id ) ) {
            $this->_hypervisor_zones_id = $hypervisor_zones_id;
        }
        $this->sendPut( ONAPP_GETRESOURCE_MAKE_PUBLIC );
    }

    /**
     * Switch Public Zone to Private
     *
     * @access public
     */
    function makePrivate( $hypervisor_zones_id = null ) {
        if ( ! is_null( $hypervisor_zones_id ) ) {
            $this->_hypervisor_zones_id = $hypervisor_zones_id;
        }
        $this->sendPut( ONAPP_GETRESOURCE_MAKE_PRIVATE );
    }

}


