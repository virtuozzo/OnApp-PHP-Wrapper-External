<?php
/**
 * Location Groups
 *
 * Location groups allow manage the Compute resource, Data store, Backup server and Network zones in geographically dispersed locations in the same cloud.
 * Currently, this enables you to host CDN Edge Servers and Storage Servers in remote locations using a single Control panel.
 *
 * @category    API wrapper
 * @package     OnApp
 * @author      Ivan Gavryliuk
 * @copyright   © 2016 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */

/**
 *
 * Managing Location Group
 *
 * The OnApp_LocationGroup class uses the following basic methods:
 * {@link load}, {@link save}, {@link delete}, and {@link getList}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */
class OnApp_LocationGroup extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'location_group';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'settings/location_groups';

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
            case 3.0:
            case 3.1:
            case 3.2:
            case 3.3:
            case 3.4:
            case 3.5:
            case 4.0:
            case 4.1:
                $this->fields = array(
                    'city'         => array(
                        ONAPP_FIELD_MAP       => '_city',
                        ONAPP_FIELD_TYPE      => 'string'
                    ),
                    'country' => array(
                        ONAPP_FIELD_MAP       => '_country',
                        ONAPP_FIELD_TYPE      => 'string'
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
                    'id'      => array(
                        ONAPP_FIELD_MAP       => '_id',
                        ONAPP_FIELD_TYPE      => 'integer'
                    ),
                );
                break;
            case 4.2:
                $this->fields = $this->initFields( 4.1 );
                $this->fields[ 'federated' ]    = array(
                    ONAPP_FIELD_MAP       => '_federated',
                    ONAPP_FIELD_TYPE      => 'boolean',
                );
                $this->fields[ 'cdn_enabled' ]    = array(
                    ONAPP_FIELD_MAP       => '_cdn_enabled',
                    ONAPP_FIELD_TYPE      => 'boolean',
                );
                $this->fields[ 'federation_id' ]    = array(
                    ONAPP_FIELD_MAP       => '_federation_id',
                    ONAPP_FIELD_TYPE      => 'string',
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
                 * @name location_groups
                 * @method GET
                 * @alias  /settings/location_groups(.:format)
                 * @format {:controller=>"billing_plans", :action=>"index"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name location_groups
                 * @method GET
                 * @alias  /settings/location_groups/:id(.:format)
                 * @format {:controller=>"billing_plans", :action=>"show"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name location_groups
                 * @method POST
                 * @alias  /settings/location_groups(.:format)
                 * @format {:controller=>"billing_plans", :action=>"create"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name location_groups
                 * @method PUT
                 * @alias  /settings/location_groups/:id(.:format)
                 * @format {:controller=>"billing_plans", :action=>"update"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name location_groups
                 * @method DELETE
                 * @alias  /settings/location_groups/:id(.:format)
                 * @format {:controller=>"billing_plans", :action=>"destroy"}
                 */
                $resource = parent::getResource( $action );
        }

        return $resource;
    }
}