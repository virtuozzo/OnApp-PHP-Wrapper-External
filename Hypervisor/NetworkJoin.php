<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Network Joins
 *
 * @todo        Add description
 *
 * @category    API wrapper
 * @package     OnApp
 * @subpackage  Hypervisor
 * @author      Vitaliy Kondratyuk
 * @copyright   © 2011 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */

/**
 * ONAPP_Hypervisor_NetworkJoin
 *
 * This class reprsents the Networks for Hypervisor.
 *
 * The OnApp_Hypervisor_NetworkJoin class uses the following basic methods:
 * {@link load}, {@link save}, {@link delete}, and {@link getList}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */
class OnApp_Hypervisor_NetworkJoin extends OnApp {
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
     * @param string|float $version   OnApp API version
     * @param string       $className current class' name
     *
     * @return array
     */
    public function initFields( $version = null, $className = '' ) {
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
                    'hypervisor_id' => array(
                        ONAPP_FIELD_MAP       => '_hypervisor_id',
                        ONAPP_FIELD_TYPE      => 'integer',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'interface'     => array(
                        ONAPP_FIELD_MAP       => '_interface',
                        ONAPP_FIELD_READ_ONLY => true,
                        ONAPP_FIELD_REQUIRED  => true,
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
                    ONAPP_FIELD_MAP      => '_target_join_type',
                    ONAPP_FIELD_TYPE     => 'string',
                    ONAPP_FIELD_REQUIRED => true
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
            case 4.0:
            case 4.1:
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
                 * @name hypervisor_network_joins
                 * @method GET
                 * @alias   /settings/hypervisors/:hypervisor_id/network_joins(.:format)
                 * @format  {:controller=>"network_joins", :action=>"index"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name
                 * @method POST
                 * @alias   /settings/hypervisors/:hypervisor_id/network_joins(.:format)
                 * @format  {:controller=>"network_joins", :action=>"create"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name  hypervisor_network_join
                 * @method DELETE
                 * @alias   /settings/hypervisors/:hypervisor_id/network_joins/:id(.:format)
                 * @format  {:controller=>"network_joins", :action=>"destroy"}
                 */
                if( is_null( $this->_hypervisor_id ) && is_null( $this->_obj->_hypervisor_id ) ) {
                    $this->logger->error(
                        'getResource( ' . $action . ' ): argument _hypervisor_id not set.',
                        __FILE__,
                        __LINE__
                    );
                }
                else {
                    if( is_null( $this->_hypervisor_id ) ) {
                        $this->_hypervisor_id = $this->_obj->_hypervisor_id;
                    }
                }
                $resource = 'settings/hypervisors/' . $this->_hypervisor_id . '/' . $this->_resource;
                $this->logger->debug( 'getResource( ' . $action . ' ): return ' . $resource );
                break;

            default:
                $resource = parent::getResource( $action );
                break;
        }

        return $resource;
    }

    /**
     * Sends an API request to get the Objects. After requesting,
     * unserializes the received response into the array of Objects
     *
     * @param integer $hypervisor_id Hypervisor ID
     *
     * @return mixed an array of Object instances on success. Otherwise false
     * @access public
     */
    function getList( $hypervisor_id = null, $url_args = null ) {
        if( is_null( $hypervisor_id ) && ! is_null( $this->_hypervisor_id ) ) {
            $hypervisor_id = $this->_hypervisor_id;
        }

        if( ! is_null( $hypervisor_id ) ) {
            $this->_hypervisor_id = $hypervisor_id;

            return parent::getList();
        }
        else {
            $this->logger->error(
                'getList: argument _hypervisor_id not set.',
                __FILE__,
                __LINE__
            );
        }
    }

    /**
     * Sends an API request to get the Object after sending,
     * unserializes the response into an object
     *
     * The key field Parameter ID is used to load the Object. You can re-set
     * this parameter in the class inheriting OnApp class.
     *
     * @param integer $id            Network Join ID
     * @param integer $hypervisor_id Hypervisor ID
     *
     * @return mixed serialized Object instance from API
     * @access public
     */
    function load( $id = null, $hypervisor_id = null ) {
        if( is_null( $hypervisor_id ) && ! is_null( $this->_hypervisor_id ) ) {
            $hypervisor_id = $this->_hypervisor_id;
        }

        if( is_null( $id ) && ! is_null( $this->_id ) ) {
            $id = $this->_id;
        }

        if( is_null( $id ) &&
            isset( $this->_obj ) &&
            ! is_null( $this->_obj->_id )
        ) {
            $id = $this->_obj->_id;
        }

        $this->logger->add( 'load: Load class ( id => ' . $id . ' ).' );

        if( ! is_null( $id ) && ! is_null( $hypervisor_id ) ) {
            $this->_id            = $id;
            $this->_hypervisor_id = $hypervisor_id;

            $this->setAPIResource( $this->getResource( ONAPP_GETRESOURCE_LOAD ) );

            $response = $this->sendRequest( ONAPP_REQUEST_METHOD_GET );

            $result = $this->_castResponseToClass( $response );

            $this->_obj = $result;

            return $result;
        }
        else {
            if( is_null( $id ) ) {
                $this->logger->error(
                    'load: argument _id not set.',
                    __FILE__,
                    __LINE__
                );
            }
            else {
                $this->logger->error(
                    'load: argument _hypervisor_id not set.',
                    __FILE__,
                    __LINE__
                );
            }
        }
    }
}
