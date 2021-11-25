<?php

/**
 * NSX Edges Nat Service
 *
 * @category        API wrapper
 * @package         OnApp
 * @author          Mykola Vuy
 * @copyright       © 2019 OnApp
 */

/**
 * NSX_Edges_Nat_Service
 *
 * Use the following API calls to view, assign and delete virtual server recipes in your cloud.
 *
 * The OnApp_NSX_Edges_Nat_Service class uses the following basic methods:
 * {@link getList} and {@link save}
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */
class OnApp_NSX_Edges_Nat_Service extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'nsx_nat_service';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'nat/service';
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
            case 6.2:
                $this->fields = array(
                    'id'                => array(
                        ONAPP_FIELD_MAP         => '_id',
                        ONAPP_FIELD_TYPE        => 'integer',
                        ONAPP_FIELD_READ_ONLY   => true,
                    ),
                    'enabled'           => array(
                        ONAPP_FIELD_MAP         => '_enabled',
                        ONAPP_FIELD_TYPE        => 'boolean',
                    ),
                    'edge_id'           => array(
                        ONAPP_FIELD_MAP         => '_edge_id',
                        ONAPP_FIELD_TYPE        => 'integer',
                        ONAPP_FIELD_READ_ONLY   => true,
                    ),
                    'created_at'        => array(
                        ONAPP_FIELD_MAP         => '_created_at',
                        ONAPP_FIELD_TYPE        => 'datetime',
                        ONAPP_FIELD_READ_ONLY   => true,
                    ),
                    'updated_at'        => array(
                        ONAPP_FIELD_MAP         => '_updated_at',
                        ONAPP_FIELD_TYPE        => 'datetime',
                        ONAPP_FIELD_READ_ONLY   => true,
                    ),
                    'locked'            => array(
                        ONAPP_FIELD_MAP         => '_locked',
                        ONAPP_FIELD_TYPE        => 'boolean',
                        ONAPP_FIELD_READ_ONLY   => true,
                    ),
                    'nat_rules'         => array(
                        ONAPP_FIELD_MAP         => '_nat_rules',
                        ONAPP_FIELD_TYPE        => 'array',
                        ONAPP_FIELD_CLASS       => 'OnApp_NSX_Edges_Nat_Rules',
                    ),
                );
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
        switch ( $action ) {
            case ONAPP_GETRESOURCE_DEFAULT:
                /**
                 * ROUTE :
                 *
                 * @name Get NAT Service Details
                 * @method GET
                 * @alias  /nsx/edges/:edge_id/nat/service(.:format)
                 * @format {:controller=>"NSX_Edges_Nat_Service", :action=>"index"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name Edit NAT Service
                 * @method PUT
                 * @alias  /nsx/edges/:edge_id/nat/service(.:format)
                 * @format {:controller=>"NSX_Edges_Nat_Service", :action=>"save"}
                 */
                if ( is_null( $this->_edge_id ) && is_null( $this->_obj->_edge_id ) ) {
                    $this->logger->error(
                        "getResource($action): argument _edge_id not set.",
                        __FILE__,
                        __LINE__
                    );
                } else {
                    if ( is_null( $this->_edge_id ) ) {
                        $this->_edge_id = $this->_obj->_edge_id;
                    }
                }

                $resource = 'nsx/edges/' . $this->_edge_id . '/' . $this->_resource;
                $this->logger->debug( 'getResource( ' . $action . ' ): return ' . $resource );
                break;

            default:
                $resource = parent::getResource( $action );
                break;
        }

        return $resource;
    }

    public function save()
    {
        $data = array(
            'root' => $this->_tagRoot,
            'data' => array(
                'enabled' => $this->_enabled,
                'nat_rules' => $this->_nat_rules,
            )
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
