<?php
/**
 * Network Zone
 *
 * @todo        Add description
 *
 * @category    API wrapper
 * @package     OnApp
 * @author      Andrew Yatskovets
 * @copyright   © 2011 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */

/**
 *
 * Managing Network Zones
 *
 * The OnApp_NetworkZone class uses the following basic methods:
 * {@link load}, {@link save}, {@link delete}, and {@link getList}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */
class OnApp_NetworkZone extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'network_group';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'settings/network_zones';

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
            case '2.1':
            case 2.2:
            case 2.3:
                $this->fields = array(
                    'id'         => array(
                        ONAPP_FIELD_MAP       => '_id',
                        ONAPP_FIELD_TYPE      => 'integer',
                        ONAPP_FIELD_READ_ONLY => true
                    ),
                    'created_at' => array(
                        ONAPP_FIELD_MAP       => '_created_at',
                        ONAPP_FIELD_TYPE      => 'datetime',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'updated_at' => array(
                        ONAPP_FIELD_MAP       => '_updated_at',
                        ONAPP_FIELD_TYPE      => 'datetime',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'label'      => array(
                        ONAPP_FIELD_MAP       => '_label',
                        ONAPP_FIELD_TYPE      => 'string',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                );
                break;

            case 3.0:
            case 3.1:
                $this->fields            = $this->initFields( 2.3 );
                $this->fields[ 'location_group_id' ]    = array(
                    ONAPP_FIELD_MAP       => '_location_group_id',
                    ONAPP_FIELD_TYPE      => 'boolean',
                );
                break;
            case 3.2:
            case 3.3:
            case 3.4:
            case 3.5:
            case 4.0:
            case 4.1:
            case 4.2:
                $this->fields = $this->initFields( 3.1 );
                $this->fields[ 'preconfigured_only' ]    = array(
                    ONAPP_FIELD_MAP       => '_preconfigured_only',
                    ONAPP_FIELD_TYPE      => 'boolean',
                );
                $this->fields[ 'closed' ]    = array(
                    ONAPP_FIELD_MAP       => '_closed',
                    ONAPP_FIELD_TYPE      => 'boolean',
                );
                $this->fields[ 'draas_id' ]    = array(
                    ONAPP_FIELD_MAP       => '_draas_id',
                    ONAPP_FIELD_TYPE      => 'integer',
                );
                $this->fields[ 'federation_enabled' ]    = array(
                    ONAPP_FIELD_MAP       => '_federation_enabled',
                    ONAPP_FIELD_TYPE      => 'boolean',
                );
                $this->fields[ 'federation_id' ]    = array(
                    ONAPP_FIELD_MAP       => '_federation_id',
                    ONAPP_FIELD_TYPE      => 'integer',
                );
                $this->fields[ 'hypervisor_id' ]    = array(
                    ONAPP_FIELD_MAP       => '_hypervisor_id',
                    ONAPP_FIELD_TYPE      => 'integer',
                );
                $this->fields[ 'identifier' ]    = array(
                    ONAPP_FIELD_MAP       => '_identifier',
                    ONAPP_FIELD_TYPE      => 'string',
                );
                $this->fields[ 'traded' ]    = array(
                    ONAPP_FIELD_MAP       => '_traded',
                    ONAPP_FIELD_TYPE      => 'boolean',
                );

            break;
        }

        parent::initFields( $version, __CLASS__ );

        return $this->fields;
    }

    function getResource( $action = ONAPP_GETRESOURCE_DEFAULT ) {
        switch( $action ) {
            default:
                /**
                 * ROUTE :
                 *
                 * @name network_zone
                 * @method GET
                 * @alias  /settings/network_zones(.:format)
                 * @format {:controller=>"billing_plans", :action=>"index"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name network_zone
                 * @method GET
                 * @alias  /settings/network_zones/:id(.:format)
                 * @format {:controller=>"billing_plans", :action=>"show"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name network_zone
                 * @method POST
                 * @alias  /settings/network_zones(.:format)
                 * @format {:controller=>"billing_plans", :action=>"create"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name network_zone
                 * @method PUT
                 * @alias  /settings/network_zones/:id(.:format)
                 * @format {:controller=>"billing_plans", :action=>"update"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name network_zone
                 * @method DELETE
                 * @alias  /settings/network_zones/:id(.:format)
                 * @format {:controller=>"billing_plans", :action=>"destroy"}
                 */
                $resource = parent::getResource( $action );
        }

        return $resource;
    }
}