<?php
/**
 * Managing High Availability Node
 *
 *
 * @category    API wrapper
 * @package     OnApp
 * @author
 * @copyright   © 2016 OnApp
 * @link        http://www.onapp.com/
 * @docs        https://docs.onapp.com/display/42API/High+Availability+Control+Panel
 * @see         OnApp
 */

/**
 * Managing High Availability Node
 *
 *
 * The Availability class uses the following basic methods:
 * {@link load}, {@link save}, {@link delete}, and {@link getList}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */
class OnApp_Availability_Node extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'availability_node';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'nodes';

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
                    'host_id'    => array(
                        ONAPP_FIELD_MAP  => '_host_id',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'id'         => array(
                        ONAPP_FIELD_MAP  => '_id',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'interface'  => array(
                        ONAPP_FIELD_MAP  => '_interface',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'ip_address' => array(
                        ONAPP_FIELD_MAP  => '_ip_address',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'priority'   => array(
                        ONAPP_FIELD_MAP  => '_priority',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'state'      => array(
                        ONAPP_FIELD_MAP  => '_state',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'updated_at' => array(
                        ONAPP_FIELD_MAP       => '_updated_at',
                        ONAPP_FIELD_TYPE      => 'datetime',
                        ONAPP_FIELD_READ_ONLY => true
                    ),
                    'hostname'   => array(
                        ONAPP_FIELD_MAP  => '_hostname',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'cluster_id' => array(
                        ONAPP_FIELD_MAP  => '_cluster_id',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),

                );
                break;
            case 4.3:
                $this->fields = $this->initFields( 4.2 );
                break;
            case 5.0:
                $this->fields = $this->initFields( 4.3 );
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

    function getResource( $action = ONAPP_GETRESOURCE_DEFAULT ) {
        switch ( $action ) {
            case ONAPP_GETRESOURCE_LOAD:
                /**
                 * @alias  /settings/availability/clusters/:cluster_id/nodes/:id.xml
                 */
                if ( is_null( $this->_id ) && is_null( $this->_obj->_id ) ) {
                    $this->logger->error(
                        'getResource( ' . $action . ' ): argument _id not set.',
                        __FILE__,
                        __LINE__
                    );
                } else {
                    if ( is_null( $this->_id ) ) {
                        $this->_id = $this->_obj->_id;
                    }
                }

                $resource = $this->getResource( ONAPP_GETRESOURCE_DEFAULT ) . '/' . $this->_resource . '/' . $this->_id;
                break;

            default:
                /**
                 * @alias  /settings/availability/clusters/:cluster_id.json
                 */
                if ( is_null( $this->_cluster_id ) && is_null( $this->_obj->_cluster_id ) ) {
                    $this->logger->error(
                        'getResource( ' . $action . ' ): argument _cluster_id not set.',
                        __FILE__,
                        __LINE__
                    );
                } else {
                    if ( is_null( $this->_cluster_id ) ) {
                        $this->_cluster_id = $this->_obj->_cluster_id;
                    }
                }
                $resource = '/settings/availability/clusters/' . $this->_cluster_id;
        }

        return $resource;
    }
}