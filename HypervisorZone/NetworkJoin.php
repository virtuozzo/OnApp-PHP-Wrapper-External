<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Manages Network Zone Joins
 *
 * @category        API wrapper
 * @package         OnApp
 * @subpackage      HypervisorZone
 * @author          Yakubskiy Yuriy
 * @copyright       © 2011 OnApp
 * @link            http://www.onapp.com/
 * @see             OnApp
 */

/**
 * ONAPP_Hypervisor_NetworkJoin
 *
 * This class reprsents the Networks for Hypervisor Zone.
 *
 * The OnApp_Hypervisor_NetworkJoin class uses the following basic methods:
 * {@link save}, {@link delete}, and {@link getList}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */
class OnApp_HypervisorZone_NetworkJoin extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'network_join';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'network_joins';

    /**
     * API Fields description
     *
     * @param string|float $version OnApp API version
     *
     * @return array
     */
    function initFields( $version = null, $className = '' ) {
        switch( $version ) {
            case '2.0':
                $this->fields = array(
                    'id'            => array(
                        ONAPP_FIELD_MAP       => '_id',
                        ONAPP_FIELD_TYPE      => 'integer',
                        ONAPP_FIELD_READ_ONLY => true
                    ),
                    'created_at'    => array(
                        ONAPP_FIELD_MAP       => '_created_at',
                        ONAPP_FIELD_TYPE      => 'datetime',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'updated_at'    => array(
                        ONAPP_FIELD_MAP       => '_updated_at',
                        ONAPP_FIELD_TYPE      => 'datetime',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'network_id'    => array(
                        ONAPP_FIELD_MAP      => '_network_id',
                        ONAPP_FIELD_TYPE     => 'integer',
                        ONAPP_FIELD_REQUIRED => true,
                    ),
                    'interface'     => array(
                        ONAPP_FIELD_MAP       => '_interface',
                        ONAPP_FIELD_READ_ONLY => true,
                        ONAPP_FIELD_REQUIRED  => true,
                    ),
                    'hypervisor_id' => array(
                        ONAPP_FIELD_MAP  => '_hypervisor_id',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                );
                break;

            case '2.1':
                $this->fields                       = $this->initFields( '2.0' );
                $this->fields[ 'target_join_id' ]   = array(
                    ONAPP_FIELD_MAP      => '_target_join_id',
                    ONAPP_FIELD_TYPE     => 'integer',
                    ONAPP_FIELD_REQUIRED => true
                );
                $this->fields[ 'target_join_type' ] = array(
                    ONAPP_FIELD_MAP  => '_target_join_type',
                    ONAPP_FIELD_TYPE => 'string',
                    //ONAPP_FIELD_REQUIRED => true
                );
                break;

            case 2.2:
            case 2.3:
                $this->fields = $this->initFields( 2.1 );
                break;

            case 3.0:
            case 3.1:
            case 3.2:
            case 3.3:
            case 3.4:
            case 3.5:
                $this->fields = $this->initFields( 2.3 );
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
            case ONAPP_GETRESOURCE_DEFAULT:
                /**
                 * ROUTE :
                 *
                 * @name hypervisor_group_network_joins
                 * @method GET
                 * @alias   /settings/hypervisor_zones/:hypervisor_group_id/network_joins(.:format)
                 * @format  {:controller=>"network_joins", :action=>"index"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name
                 * @method POST
                 * @alias    /settings/hypervisor_zones/:hypervisor_group_id/network_joins(.:format)
                 * @format   {:controller=>"network_joins", :action=>"create"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name  hypervisor_group_network_join
                 * @method DELETE
                 * @alias   /settings/hypervisor_zones/:hypervisor_group_id/network_joins/:id(.:format)
                 * @format  {:controller=>"network_joins", :action=>"destroy"}
                 */
                $resource = 'settings/hypervisor_zones/' . $this->_target_join_id . '/' . $this->_resource;
                $this->logger->debug( 'getResource( ' . $action . ' ): return ' . $resource );
                break;

            default:
                $resource = parent::getResource( $action );
                break;
        }

        return $resource;
    }

    /**
     * Gets list of network joins to particular hypervisor zone
     *
     * @param integet hypervisor zone id
     *
     * @return array of newtwork join objects
     */
    function getList( $target_join_id = null, $url_args = null ) {
        if( is_null( $target_join_id ) && ! is_null( $this->_target_join_id ) ) {
            $target_join_id = $this->_target_join_id;
        }

        if( ! is_null( $target_join_id ) ) {
            $this->_target_join_id = $target_join_id;

            return parent::getList();
        }
        else {
            $this->logger->error(
                'getList: argument _target_join_id not set.',
                __FILE__,
                __LINE__
            );
        }
    }
}
