<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Billing Plan Base Resources
 *
 * @category    API wrapper
 * @package     OnApp
 * @subpackage  BillingPlan
 * @author      Yakubskiy Yuriy
 * @copyright   © 2011 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */

/**
 * The OnApp_BillingPlan_BaseResource uses the following basic methods:
 * {@link load}, {@link save}, {@link delete}, and {@link getList}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */
class OnApp_BillingPlan_BaseResource extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'base_resource';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'base_resources';

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
            case '2.1':
                $this->fields = array(
                    'id'              => array(
                        ONAPP_FIELD_MAP       => '_id',
                        ONAPP_FIELD_TYPE      => 'integer',
                        ONAPP_FIELD_READ_ONLY => true,
                        ONAPP_FIELD_REQUIRED  => true
                    ),
                    'label'           => array(
                        ONAPP_FIELD_MAP       => '_label',
                        ONAPP_FIELD_TYPE      => 'string',
                        ONAPP_FIELD_READ_ONLY => true
                    ),
                    'created_at'      => array(
                        ONAPP_FIELD_MAP       => '_created_at',
                        ONAPP_FIELD_TYPE      => 'datetime',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'updated_at'      => array(
                        ONAPP_FIELD_MAP       => '_updated_at',
                        ONAPP_FIELD_TYPE      => 'datetime',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'limits'          => array(
                        ONAPP_FIELD_MAP       => '_limits',
                        ONAPP_FIELD_READ_ONLY => true,
                        ONAPP_FIELD_TYPE      => 'array',
                        ONAPP_FIELD_CLASS     => 'BillingPlan_BaseResource_Limit',
                    ),
                    'billing_plan_id' => array(
                        ONAPP_FIELD_MAP       => '_billing_plan_id',
                        ONAPP_FIELD_TYPE      => 'integer',
                        ONAPP_FIELD_READ_ONLY => true,
                        ONAPP_FIELD_REQUIRED  => true,
                    ),
                    'unit'            => array(
                        ONAPP_FIELD_MAP       => '_unit',
                        ONAPP_FIELD_READ_ONLY => true,
                        ONAPP_FIELD_REQUIRED  => true,
                    ),
                    'resource_name'   => array(
                        ONAPP_FIELD_MAP       => '_resource_name',
                        ONAPP_FIELD_TYPE      => 'string',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'prices'          => array(
                        ONAPP_FIELD_MAP       => '_prices',
                        ONAPP_FIELD_READ_ONLY => true,
                        ONAPP_FIELD_TYPE      => 'array',
                        ONAPP_FIELD_CLASS     => 'BillingPlan_BaseResource_Price',
                    ),
                    'limit'           => array(
                        ONAPP_FIELD_MAP      => '_limit',
                        ONAPP_FIELD_TYPE     => 'string',
                        ONAPP_FIELD_REQUIRED => true,
                    ),
                    'limit_type'      => array(
                        ONAPP_FIELD_MAP      => '_limit_type',
                        ONAPP_FIELD_TYPE     => 'string',
                        ONAPP_FIELD_REQUIRED => true,
                    ),
                    'limit_free'      => array(
                        ONAPP_FIELD_MAP      => '_limit_free',
                        ONAPP_FIELD_TYPE     => 'string',
                        ONAPP_FIELD_REQUIRED => true,
                    ),
                    'price'           => array(
                        ONAPP_FIELD_MAP      => '_price',
                        ONAPP_FIELD_TYPE     => 'string',
                        ONAPP_FIELD_REQUIRED => true,
                    ),
                    'price_on'        => array(
                        ONAPP_FIELD_MAP      => '_price_on',
                        ONAPP_FIELD_TYPE     => 'string',
                        ONAPP_FIELD_REQUIRED => true,
                    ),
                    'price_off'       => array(
                        ONAPP_FIELD_MAP      => '_price_off',
                        ONAPP_FIELD_TYPE     => 'string',
                        ONAPP_FIELD_REQUIRED => true,
                    ),
                    'resource_class'  => array(
                        ONAPP_FIELD_MAP           => '_resource_class',
                        ONAPP_FIELD_TYPE          => 'string',
                        ONAPP_FIELD_REQUIRED      => true,
                        ONAPP_FIELD_DEFAULT_VALUE => 'Resource::CpuShare'
                    ),
                    'limit_type'      => array(
                        ONAPP_FIELD_MAP      => '_limit_type',
                        ONAPP_FIELD_TYPE     => 'string',
                        ONAPP_FIELD_REQUIRED => true,
                    ),
                );
                break;

            case 2.2:
            case 2.3:
                $this->fields                = $this->initFields( 2.1 );
                $this->fields[ 'target_id' ] = array(
                    ONAPP_FIELD_MAP       => '_target_id',
                    ONAPP_FIELD_TYPE      => 'integer',
                    ONAPP_FIELD_READ_ONLY => true
                );
                break;

            case 3.0:
            case 3.1:
            case 3.2:
            case 3.3:
            case 3.4:
            case 3.5:
            case 4.0:
            case 4.1:
                $this->fields                  = $this->initFields( 2.3 );
                $this->fields[ 'is_default' ]  = array(
                    ONAPP_FIELD_MAP  => 'is_default',
                    ONAPP_FIELD_TYPE => 'boolean',
                );
                $this->fields[ 'use_default' ] = array(
                    ONAPP_FIELD_MAP  => 'use_default',
                    ONAPP_FIELD_TYPE => 'boolean',
                );
                $this->fields[ 'preferences' ] = array(
                    ONAPP_FIELD_MAP  => 'preferences',
                    ONAPP_FIELD_TYPE => 'string',
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
        $show_log_msg = true;
        switch( $action ) {
            case ONAPP_GETRESOURCE_DEFAULT:
                /**
                 * ROUTE :
                 *
                 * @name billing_plan_base_resources
                 * @method GET
                 * @alias   /billing_plans/:billing_plan_id/base_resources(.:format)
                 * @format  {:controller=>"base_resources", :action=>"index"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name billing_plan_base_resource
                 * @method GET
                 * @alias    /billing_plans/:billing_plan_id/base_resources/:id(.:format)
                 * @format   {:controller=>"base_resources", :action=>"show"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name
                 * @method POST
                 * @alias   /billing_plans/:billing_plan_id/base_resources(.:format)
                 * @format  {:controller=>"base_resources", :action=>"create"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name
                 * @method PUT
                 * @alias  /billing_plans/:billing_plan_id/base_resources/:id(.:format)
                 * @format {:controller=>"base_resources", :action=>"update"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name
                 * @method DELETE
                 * @alias   /billing_plans/:billing_plan_id/base_resources/:id(.:format)
                 * @format  {:controller=>"base_resources", :action=>"destroy"}
                 */
                if( is_null( $this->_billing_plan_id ) && is_null( $this->_obj->_billing_plan_id ) ) {
                    $this->logger->error(
                        'getResource( ' . $action . ' ): argument _billing_plan_id not set.',
                        __FILE__,
                        __LINE__
                    );
                }
                else {
                    if( is_null( $this->_billing_plan_id ) ) {
                        $this->_billing_plan_id = $this->_obj->_billing_plan_id;
                    }
                }

                $resource = 'billing_plans/' . $this->_billing_plan_id . '/' . $this->_resource;
                break;

            default:
                $resource     = parent::getResource( $action );
                $show_log_msg = false;
                break;
        }

        if( $show_log_msg ) {
            $this->logger->debug( 'getResource( ' . $action . ' ): return ' . $resource );
        }

        return $resource;
    }

    /**
     * Sends an API request to get the Objects. After requesting,
     * unserializes the received response into the array of Objects
     *
     * @param integer $virtual_machine_id Virtual Machine id
     *
     * @return mixed an array of Object instances on success. Otherwise false
     * @access public
     */
    function getList( $billing_plan_id = null, $url_args = null ) {
        if( is_null( $billing_plan_id ) && ! is_null( $this->_billing_plan_id ) ) {
            $billing_plan_id = $this->_billing_plan_id;
        }

        if( ! is_null( $billing_plan_id ) ) {
            $this->_billing_plan_id = $billing_plan_id;

            return parent::getList();
        }
        else {
            $this->logger->error(
                'getList: argument _billing_plan_id not set.',
                __FILE__,
                __LINE__
            );
        }
    }

    /**
     * The method saves an Object to your account
     *
     * After sending an API request to create an object or change the data in
     * the existing object, the method checks the response and loads the
     * exisitng object with the new data.
     *
     * This method can be closed for read only objects of the inherited class
     * <code>
     *    function save() {
     *        $this->logger->error(
     *            "Call to undefined method ".__CLASS__."::save()",
     *            __FILE__,
     *            __LINE__
     *        );
     *    }
     * </code>
     *
     * @return void
     * @access public
     */
    function save() {
        if( is_null( $this->_limit ) ) {
            $this->_limit = isset( $this->_limits->_limit )
                ? $this->_limits->_limit : (
                isset( $this->_obj->_limits->_limit )
                    ? $this->_obj->_limits->_limit
                    : ''
                );
        }

        if( is_null( $this->_limit_free ) ) {
            $this->_limit_free = isset( $this->_limits->_limit_free )
                ? $this->_limits->_limit_free : (
                isset( $this->_obj->_limits->_limit_free )
                    ? $this->_obj->_limits->_limit_free
                    : ''
                );
        }

        if( is_null( $this->_price_on ) ) {
            $this->_price_on = isset( $this->_prices->_price_on )
                ? $this->_prices->_price_on : (
                isset( $this->_obj->_prices->_price_on ) ?
                    $this->_obj->_prices->_price_on
                    : ''
                );
        }

        if( is_null( $this->_price_off ) ) {
            $this->_price_off = isset( $this->_limits->_price_off )
                ? $this->_prices->_price_off : (
                isset( $this->_obj->_prices->_price_off )
                    ? $this->_obj->_prices->_price_off
                    : ""
                );
        }

        if( is_null( $this->_price ) ) {
            $this->_price = isset( $this->_limits->_price )
                ? $this->_prices->_price
                : ( isset( $this->_obj->_prices->_price )
                    ? $this->_obj->_prices->_price
                    : '' );
        }

        return parent::save();
    }
}