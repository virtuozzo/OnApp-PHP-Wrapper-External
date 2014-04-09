<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Managing Edge Groups
 *
 * @category    API wrapper
 * @package     OnApp
 * @author      Yakubskiy Yuriy
 * @copyright   © 2011 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */

/**
 *
 *
 */
define( 'ONAPP_GETRESOURCE_EDGE_GROUP_ASSIGN_LOCATION', 'edge_group_assign_location' );

/**
 *
 *
 */
define( 'ONAPP_GETRESOURCE_EDGE_GROUP_UNASSIGN_LOCATION', 'edge_group_unassign_location' );

/**
 * Managing Edge Groups
 *
 * The Edge Group class represents the Edge groups.
 * The OnApp_EdgeGroup class is the parent of the OnApp class.
 *
 * The OnApp_EdgeGroup uses the following basic methods:
 * {@link load}, {@link save}, {@link delete}, and {@link getList}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */
class OnApp_EdgeGroup extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'edge_group';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'edge_groups';

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
            case '2.3':
                $this->fields = array(
                    'label'               => array(
                        ONAPP_FIELD_MAP           => '_label',
                        ONAPP_FIELD_REQUIRED      => true,
                        ONAPP_FIELD_DEFAULT_VALUE => ''
                    ),
                    'created_at'          => array(
                        ONAPP_FIELD_MAP       => '_created_at',
                        ONAPP_FIELD_TYPE      => 'datetime',
                        ONAPP_FIELD_READ_ONLY => true
                    ),
                    'updated_at'          => array(
                        ONAPP_FIELD_MAP       => '_updated_at',
                        ONAPP_FIELD_TYPE      => 'datetime',
                        ONAPP_FIELD_READ_ONLY => true
                    ),
                    'id'                  => array(
                        ONAPP_FIELD_MAP       => '_id',
                        ONAPP_FIELD_TYPE      => 'integer',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'assigned_locations'  => array(
                        ONAPP_FIELD_MAP   => '_assigned_locations',
                        ONAPP_FIELD_TYPE  => 'array',
                        ONAPP_FIELD_CLASS => 'EdgeGroup_AssignedLocation'

                    ),
                    'available_locations' => array(
                        ONAPP_FIELD_MAP   => '_available_locations',
                        ONAPP_FIELD_TYPE  => 'array',
                        ONAPP_FIELD_CLASS => 'EdgeGroup_AvailableLocation'
                    ),
                );
                break;

            case 3.0:
            case 3.1:
            case 3.2:
            case 3.3:
                $this->fields = $this->initFields( 2.3 );
                $this->fields[ 'cdn_reference' ] = array(
                    ONAPP_FIELD_MAP  => 'cdn_reference',
                    ONAPP_FIELD_TYPE => 'integer',
                );
                $this->fields[ 'aflexi_id' ] = array(
                    ONAPP_FIELD_MAP  => 'aflexi_id',
                    ONAPP_FIELD_TYPE => 'integer',
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
            case ONAPP_GETRESOURCE_EDGE_GROUP_ASSIGN_LOCATION:
                /**
                 * TODO: ADD ROUTE
                 *
                 *
                 *
                 *
                 */
                $resource = $this->getResource() . '/' . $this->_id . '/assign';
                break;

            case ONAPP_GETRESOURCE_EDGE_GROUP_UNASSIGN_LOCATION:
                /**
                 * TODO: ADD ROUTE
                 *
                 *
                 *
                 *
                 */
                $resource = $this->getResource() . '/' . $this->_id . '/unassign';
                break;

            default:
                $resource = parent::getResource( $action );
                break;
        }

        $this->logger->debug( 'getResource( ' . $action . ' ): return ' . $resource );

        return $resource;
    }

    function assign_location( $edge_group_id, $location_id ) {
        if( $edge_group_id ) {
            $this->_id = $edge_group_id;
        }
        else {
            $this->logger->error(
                'assign: argument edge_group_id not set.',
                __FILE__,
                __LINE__
            );
        }

        if( ! $location_id ) {
            $this->logger->error(
                'assign: argument location_id not set.',
                __FILE__,
                __LINE__
            );
        }

        $data = array(
            'root' => 'tmp_holder',
            'data' => array(
                'location' => $location_id,
            ),
        );

        $this->sendPost( ONAPP_GETRESOURCE_EDGE_GROUP_ASSIGN_LOCATION, $data );
    }

    /**
     *
     * @param <type> $edge_group_id
     * @param <type> $location_id
     */
    function unassign_location( $edge_group_id, $location_id ) {
        if( $edge_group_id ) {
            $this->_id = $edge_group_id;
        }
        else {
            $this->logger->error(
                'assign: argument edge_group_id not set.',
                __FILE__,
                __LINE__
            );
        }

        if( ! $location_id ) {
            $this->logger->error(
                'assign: argument location_id not set.',
                __FILE__,
                __LINE__
            );
        }

        $data = array(
            'root' => 'tmp_holder',
            'data' => array(
                'location' => $location_id,
            ),
        );

        $this->sendPost( ONAPP_GETRESOURCE_EDGE_GROUP_UNASSIGN_LOCATION, $data );
    }
}