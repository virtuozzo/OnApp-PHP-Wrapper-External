<?php
/**
 * Managing Instance Packages
 *
 * Instance Packages are preconfigured CPU/RAM/Disk/Bandwidth packages that can be selected during the VS creation process.
 *
 * @category    API wrapper
 * @package     OnApp
 * @author      Ivan Gavryliuk
 * @copyright   © 2016 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */


/**
 * Managing Instance Packages
 *
 * The OnApp_InstancePackage class represents the Instance Types.
 *
 * The OnApp_InstancePackage class uses the following basic methods:
 * {@link load}, {@link save}, {@link delete}, and {@link getList}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */
class OnApp_InstancePackage extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'instance_package';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'instance_packages';

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
            case 4.3:
                $this->fields = array(
                    'cpus'             => array(
                        ONAPP_FIELD_MAP  => '_cpus',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'created_at'       => array(
                        ONAPP_FIELD_MAP  => '_created_at',
                        ONAPP_FIELD_TYPE => 'datetime',
                    ),
                    'disk_size'        => array(
                        ONAPP_FIELD_MAP  => '_disk_size',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'id'               => array(
                        ONAPP_FIELD_MAP  => '_id',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'label'            => array(
                        ONAPP_FIELD_MAP  => '_label',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'memory'           => array(
                        ONAPP_FIELD_MAP  => '_memory',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'updated_at'       => array(
                        ONAPP_FIELD_MAP  => '_updated_at',
                        ONAPP_FIELD_TYPE => 'datetime',
                    ),
                    'bandwidth'        => array(
                        ONAPP_FIELD_MAP  => '_bandwidth',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'billing_plan_ids' => array(
                        ONAPP_FIELD_MAP  => '_billing_plan_ids',
                        ONAPP_FIELD_TYPE => 'array',
                    )
                );
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
                $this->fields['openstack_id'] = array(
                    ONAPP_FIELD_MAP  => '_openstack_id',
                    ONAPP_FIELD_TYPE => 'string',
                );
                break;
            case 5.5:
                $this->fields = $this->initFields( 5.4 );
                break;
            case 6.0:
                $this->fields = $this->initFields( 5.5 );
                $this->fields['buckets_ids'] = array(
                    ONAPP_FIELD_MAP  => '_buckets_ids',
                    ONAPP_FIELD_TYPE => 'array',
                );
                break;
        }

        parent::initFields( $version, __CLASS__ );

        return $this->fields;
    }

    function getResource( $action = ONAPP_GETRESOURCE_DEFAULT ) {
        switch ( $action ) {
            default:
                /**
                 * ROUTE :
                 *
                 * @name instance_packages
                 * @method GET
                 * @alias  /instance_packages(.:format)
                 * @format {:controller=>"instance_packages", :action=>"index"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name instance_packages
                 * @method GET
                 * @alias  /instance_packages/:id(.:format)
                 * @format {:controller=>"instance_packages", :action=>"show"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name instance_packages
                 * @method POST
                 * @alias  /instance_packages(.:format)
                 * @format {:controller=>"instance_packages", :action=>"create"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name instance_packages
                 * @method PUT
                 * @alias  /instance_packages/:id(.:format)
                 * @format {:controller=>"instance_packages", :action=>"update"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name instance_packages
                 * @method DELETE
                 * @alias  instance_packages/:id(.:format)
                 * @format {:controller=>"instance_packages", :action=>"destroy"}
                 */
                $resource = parent::getResource( $action );
        }

        return $resource;
    }
}