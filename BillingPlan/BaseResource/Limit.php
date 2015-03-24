<?php

/**
 * Manages Billing Plan Base Resource Limits
 *
 * @category    API wrapper
 * @package     OnApp
 * @subpackage  BillingPlan_BaseResource
 * @author      Andrew Yatskovets
 * @copyright   © 2011 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */
class OnApp_BillingPlan_BaseResource_Limit extends OnApp {
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
                    'limit_free' => array(
                        ONAPP_FIELD_MAP       => '_limit_free',
                        ONAPP_FIELD_TYPE      => 'integer',
                        ONAPP_FIELD_READ_ONLY => true
                    ),
                    'limit'      => array(
                        ONAPP_FIELD_MAP       => '_limit',
                        ONAPP_FIELD_TYPE      => 'integer',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                );
                break;

            case 2.2:
            case 2.3:
            case 3.0:
                $this->fields = $this->initFields( 2.1 );
                break;

            case 3.1:
            case 3.2:
            case 3.3:
            case 3.4:
            case 3.5:
                $this->fields                              = $this->initFields( 2.3 );
                $this->fields[ 'id' ]                      = array(
                    ONAPP_FIELD_MAP => '_id',
                );
                $this->fields[ 'billing_plan_id' ]         = array(
                    ONAPP_FIELD_MAP => 'billing_plan_id',
                );
                $this->fields[ 'limit_free_cpu' ]          = array(
                    ONAPP_FIELD_MAP => 'limit_free_cpu',
                );
                $this->fields[ 'limit_free_cpu_share' ]    = array(
                    ONAPP_FIELD_MAP => 'limit_free_cpu_share',
                );
                $this->fields[ 'limit_free_memory' ]       = array(
                    ONAPP_FIELD_MAP => 'limit_free_memory',
                );
                $this->fields[ 'limit_cpu' ]               = array(
                    ONAPP_FIELD_MAP => 'limit_cpu',
                );
                $this->fields[ 'limit_cpu_share' ]         = array(
                    ONAPP_FIELD_MAP => 'limit_cpu_share',
                );
                $this->fields[ 'limit_memory' ]            = array(
                    ONAPP_FIELD_MAP => 'limit_memory',
                );
                $this->fields[ 'limit_default_cpu' ]       = array(
                    ONAPP_FIELD_MAP => 'limit_default_cpu',
                );
                $this->fields[ 'limit_default_cpu_share' ] = array(
                    ONAPP_FIELD_MAP => 'limit_default_cpu_share',
                );
                $this->fields[ 'limit_rate' ]              = array(
                    ONAPP_FIELD_MAP => 'limit_rate',
                );
                $this->fields[ 'limit_ip' ]                = array(
                    ONAPP_FIELD_MAP => 'limit_ip',
                );
                $this->fields[ 'limit' ]                   = array(
                    ONAPP_FIELD_MAP => 'limit',
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
            case ONAPP_GETRESOURCE_EDIT:
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
                if( is_null( $this->billing_plan_id ) && is_null( $this->_obj->billing_plan_id ) ) {
                    $this->logger->error(
                        'getResource( ' . $action . ' ): argument _billing_plan_id not set.',
                        __FILE__,
                        __LINE__
                    );
                }
                else {
                    if( is_null( $this->billing_plan_id ) ) {
                        $this->billing_plan_id = $this->obj->_billing_plan_id;
                    }
                }

                $resource = 'billing_plans/' . $this->billing_plan_id . '/' . $this->_resource . '/' . $this->_id;
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
}