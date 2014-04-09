<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Managing Load Balancing Clusters
 *
 *
 * @category    API wrapper
 * @package     OnApp
 * @author      Yakubskiy Yuriy
 * @copyright   © 2011 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */
define( 'ONAPP_GETRESOURCE_GETLIST_BY_USER_ID', 'get_list_by_user_id' );

/**
 * Load Balancing Clusters
 *
 * The Virtual Machine class represents the Virtual Machines of the OnAPP installation.
 *
 * The OnApp_VirtualMachine class uses the following basic methods:
 * {@link load}, {@link save}, {@link delete}, and {@link getList}.
 *
 * Couldn't edit LoadBalancingCluster Ticket #2496
 * In json _tagRoot = 'cluster'       Ticket #2495
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */
class OnApp_LoadBalancingCluster extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'load_balancing_cluster';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'load_balancing_clusters';

    /**
     * API Fields description
     *
     * @param string|float $version OnApp API version
     *
     * @return array
     */
    public function initFields( $version ) {
        switch( $version ) {
            case '2.1':
            case '2.2':
                $this->fields = array(
                    'name'                   => array(
                        ONAPP_FIELD_MAP      => '_name',
                        ONAPP_FIELD_TYPE     => 'string',
                        ONAPP_FIELD_REQUIRED => true,
                    ),
                    'created_at'             => array(
                        ONAPP_FIELD_MAP       => '_created_at',
                        ONAPP_FIELD_TYPE      => 'string',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'port'                   => array(
                        ONAPP_FIELD_MAP      => '_port',
                        ONAPP_FIELD_TYPE     => 'integer',
                        ONAPP_FIELD_REQUIRED => true,
                    ),
                    'config'                 => array(
                        ONAPP_FIELD_MAP       => '_config',
                        ONAPP_FIELD_TYPE      => 'array',
                        ONAPP_FIELD_READ_ONLY => true,
                        ONAPP_FIELD_CLASS     => 'LoadBalancingCluster_Config',
                    ),
                    'load_balancer_id'       => array(
                        ONAPP_FIELD_MAP       => '_load_balancer_id',
                        ONAPP_FIELD_TYPE      => 'integer',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'load_balancer_password' => array(
                        ONAPP_FIELD_MAP       => '_load_balancer_password',
                        ONAPP_FIELD_TYPE      => 'string',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'updated_at'             => array(
                        ONAPP_FIELD_MAP       => '_updated_at',
                        ONAPP_FIELD_TYPE      => 'string',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'id'                     => array(
                        ONAPP_FIELD_MAP       => '_id',
                        ONAPP_FIELD_TYPE      => 'integer',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'load_balancer'          => array(
                        ONAPP_FIELD_MAP       => '_load_balancer',
                        ONAPP_FIELD_TYPE      => 'array',
                        ONAPP_FIELD_READ_ONLY => true,
                        ONAPP_FIELD_CLASS     => 'LoadBalancer',
                    ),
                    'user_id'                => array(
                        ONAPP_FIELD_MAP       => '_user_id',
                        ONAPP_FIELD_TYPE      => 'integer',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'nodes'                  => array(
                        ONAPP_FIELD_MAP       => '_nodes',
                        ONAPP_FIELD_TYPE      => 'array',
                        ONAPP_FIELD_READ_ONLY => true,
                        ONAPP_FIELD_CLASS     => 'LoadBalancingCluster_Node',
                    ),
                    'cluster_type'           => array(
                        ONAPP_FIELD_MAP      => '_cluster_type',
                        ONAPP_FIELD_TYPE     => 'string',
                        ONAPP_FIELD_REQUIRED => true,
                    ),
                    'identifier'             => array(
                        ONAPP_FIELD_MAP       => '_identifier',
                        ONAPP_FIELD_TYPE      => 'string',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'node_attributes'        => array(
                        ONAPP_FIELD_MAP       => '_node_attributes',
                        ONAPP_FIELD_TYPE      => 'array',
                        ONAPP_FIELD_READ_ONLY => true,
                        ONAPP_FIELD_CLASS     => 'LoadBalancingCluster_NodeAtribute',
                    ),
                    'image_template_id'      => array(
                        ONAPP_FIELD_MAP       => '_image_template_id',
                        ONAPP_FIELD_TYPE      => 'integer',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                );
                break;

            case '2.3':
                $this->fields = $this->initFields( 2.2 );
                $this->fields[ 'auto_scaling_out_cpu' ] = array(
                    ONAPP_FIELD_MAP      => '_auto_scaling_out_cpu',
                    ONAPP_FIELD_TYPE     => 'array',
                    ONAPP_FIELD_REQUIRED => 'LoadBalancingCluster_AutoScalingOutCpu',
                );
                $this->fields[ 'auto_scaling_out_memory' ] = array(
                    ONAPP_FIELD_MAP      => '_auto_scaling_out_memory',
                    ONAPP_FIELD_TYPE     => 'array',
                    ONAPP_FIELD_REQUIRED => 'LoadBalancingCluster_AutoScalingOutMemory',
                );
                $this->fields[ 'auto_scaling_in_cpu' ] = array(
                    ONAPP_FIELD_MAP      => '_auto_scaling_in_cpu',
                    ONAPP_FIELD_TYPE     => 'array',
                    ONAPP_FIELD_REQUIRED => 'LoadBalancingCluster_AutoScalingInCpu',
                );
                $this->fields[ 'auto_scaling_in_memory' ] = array(
                    ONAPP_FIELD_MAP      => '_auto_scaling_in_memory',
                    ONAPP_FIELD_TYPE     => 'array',
                    ONAPP_FIELD_REQUIRED => 'LoadBalancingCluster_AutoScalingInMemory',
                );
                break;

            case 3.0:
            case 3.1:
            case 3.2:
            case 3.3:
                $this->fields = $this->initFields( 2.3 );
                break;
        }

        parent::initFields( $version, __CLASS__ );

        return $this->fields;
    }

    function getResource( $action = ONAPP_GETRESOURCE_DEFAULT ) {
        switch( $action ) {
            case ONAPP_GETRESOURCE_GETLIST_BY_USER_ID:

                /**
                 * ROUTE :
                 *
                 * @name user_load_balancing_clusters
                 * @method GET
                 * @alias  /users/:user_id/load_balancing_clusters(.:format)
                 * @format {:controller=>"load_balancing_clusters", :action=>"index"}
                 */
                $resource = 'users/' . $this->_user_id . '/load_balancing_clusters';
                break;

            default:
                /**
                 * ROUTE :
                 *
                 * @name load_balancing_clusters
                 * @method GET
                 * @alias   /load_balancing_clusters(.:format)
                 * @format  {:controller=>"load_balancing_clusters", :action=>"index"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name load_balancing_cluster
                 * @method GET
                 * @alias  /load_balancing_clusters/:id(.:format)
                 * @format {:controller=>"load_balancing_clusters", :action=>"show"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name
                 * @method POST
                 * @alias  /load_balancing_clusters(.:format)
                 * @format {:controller=>"load_balancing_clusters", :action=>"create"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name
                 * @method PUT
                 * @alias  /load_balancing_clusters/:id(.:format)
                 * @format {:controller=>"load_balancing_clusters", :action=>"update"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name
                 * @method DELETE
                 * @alias  /load_balancing_clusters/:id(.:format)
                 * @format {:controller=>"load_balancing_clusters", :action=>"destroy"}
                 */
                $resource = parent::getResource( $action );
                break;
        }

        return $resource;
    }

    /**
     * Creates or edits Load Balancing Cluster
     *
     * @return mixed API query response
     */
    function save() {
        $this->fields[ 'load_balancer_attributes' ] = array(
            ONAPP_FIELD_MAP => '_load_balancer_attributes',
        );
        $this->fields[ 'load_balancing_cluster_load_balancer_attributes' ] = array(
            ONAPP_FIELD_MAP => '_load_balancing_cluster_load_balancer_attributes',
        );
        $this->fields[ 'auto_scaling_out_memory_attributes' ] = array(
            ONAPP_FIELD_MAP => '_auto_scaling_out_memory_attributes',
        );
        $this->fields[ 'auto_scaling_out_cpu_attributes' ] = array(
            ONAPP_FIELD_MAP => '_auto_scaling_out_cpu_attributes',
        );
        $this->fields[ 'auto_scaling_in_memory_attributes' ] = array(
            ONAPP_FIELD_MAP => '_auto_scaling_in_memory_attributes',
        );
        $this->fields[ 'auto_scaling_in_cpu_attributes' ] = array(
            ONAPP_FIELD_MAP => '_auto_scaling_in_cpu_attributes',
        );
        $this->fields[ 'available_vms' ] = array(
            ONAPP_FIELD_MAP => '_available_vms',
        );
        $this->fields[ 'image_template_id' ] = array(
            ONAPP_FIELD_MAP => '_image_template_id',
        );

        parent::save();
        $this->initFields( $this->getAPIVersion() );

        return $result;
    }

    /**
     * Gets list of clusters by user id
     *
     * @param integer|null $user_id user id
     *
     * @return bool|mixed
     */
    function getListByUserId( $user_id = null ) {
        if( $user_id ) {
            $this->_user_id = $user_id;
        }
        else {
            $this->logger->error(
                'getListByUserId: argument _user_id not set.',
                __FILE__,
                __LINE__
            );
        }

        $this->setAPIResource( $this->getResource( ONAPP_GETRESOURCE_GETLIST_BY_USER_ID ) );

        $response = $this->sendRequest( ONAPP_REQUEST_METHOD_GET );

        if( ! empty( $response[ 'errors' ] ) ) {
            $this->errors = $response[ 'errors' ];

            return false;
        }

        $result = $this->castStringToClass( $response );
        $this->_obj = $result;

        return ( is_array( $result ) || ! $result ) ? $result : array( $result );
    }
}