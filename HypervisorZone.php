<?php
/**
 * Hypervisor Zone
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
 * Managing Hypervisor Zones
 *
 * The OnApp_HypervisorZone class uses the following basic methods:
 * {@link load}, {@link save}, {@link delete}, and {@link getList}.
 *
 * The OnApp_HypervisorZone class represents virtual machine hypervisor groups.
 * The OnApp class is a parent of ONAPP_HypervisorZone class.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */
class OnApp_HypervisorZone extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'hypervisor_group';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'settings/hypervisor_zones';

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

            case '2.1':
                $this->fields = $this->initFields( '2.0' );
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

    function getResource( $action = ONAPP_GETRESOURCE_DEFAULT ) {
        return parent::getResource( $action );
        /**
         * ROUTE :
         *
         * @name hypervisor_groups
         * @method GET
         * @alias  /settings/hypervisor_zones(.:format)
         * @format {:controller=>"hypervisor_groups", :action=>"index"}
         */
        /**
         * ROUTE :
         *
         * @name hypervisor_group
         * @method GET
         * @alias   /settings/hypervisor_zones/:id(.:format)
         * @format  {:controller=>"hypervisor_groups", :action=>"show"}
         */
        /**
         * ROUTE :
         *
         * @name
         * @method POST
         * @alias   /settings/hypervisor_zones(.:format)
         * @format  {:controller=>"hypervisor_groups", :action=>"create"}
         */
        /**
         * ROUTE :
         *
         * @name
         * @method PUT
         * @alias  /settings/hypervisor_zones/:id(.:format)
         * @format {:controller=>"hypervisor_groups", :action=>"update"}
         */
        /**
         * ROUTE :
         *
         * @name
         * @method DELETE
         * @alias    /settings/hypervisor_zones/:id(.:format)
         * @format   {:controller=>"hypervisor_groups", :action=>"destroy"}
         */
    }
}
