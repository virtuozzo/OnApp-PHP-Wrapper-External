<?php

/**
 * VDCS CrossVdcNetworks
 *
 * @category        API wrapper
 * @package         OnApp
 * @subpackage      Settings
 * @author          Mykola Vuy
 * @copyright       © 2019 OnApp
 *
 */

/**
 * VDCS CrossVdcNetworks
 *
 * Use the following API calls to view, assign and delete virtual server recipes in your cloud.
 *
 * The OnApp_VDCS_CrossVdcNetworks class uses the
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */
class OnApp_VDCS_CrossVdcNetworks extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'cross_vdc_network';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'cross_vdc_networks';
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
            case 6.1:
                $this->fields = array(
                    'id'             => array(
                        ONAPP_FIELD_MAP  => '_id',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'label'              => array(
                        ONAPP_FIELD_MAP  => '_label',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'vdc_group_id'             => array(
                        ONAPP_FIELD_MAP  => '_vdc_group_id',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'gateway_cidr'              => array(
                        ONAPP_FIELD_MAP  => '_gateway_cidr',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                );
                break;

            case 6.2:
                $this->fields = $this->initFields( 6.1 );
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

            case 6.7:
                $this->fields = $this->initFields( 6.6 );
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
                 * @name Create Cross VDC Network
                 * @method POST
                 * @alias   /cross_vdc_networks(.:format)
                 * @format  {:controller=>"VDCS_CrossVdcNetworks", :action=>"create"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name Edit Cross VDC Network
                 * @method PUT
                 * @alias  /cross_vdc_networks/:id(.:format)
                 * @format {:controller=>"VDCS_CrossVdcNetworks", :action=>"update"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name Delete Cross VDC Network
                 * @method DELETE
                 * @alias  /cross_vdc_networks/:id(.:format)
                 * @format {:controller=>"blueprint_template_groups", :action=>"destroy"}
                 */
                $resource = parent::getResource( $action );
                break;

        }

        return $resource;
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
            case ONAPP_ACTIVATE_GETLIST:
                exit( 'Call to undefined method ' . __CLASS__ . '::' . $action_name . '()' );
                break;
        }
    }
}
