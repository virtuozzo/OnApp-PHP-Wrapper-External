<?php
/**
 * Managing Company Billing Plans
 *
 * Company Billing Plans are created to set prices for the resources so that users know how
 * much they will be charged per unit.
 *
 * @category    API wrapper
 * @package     OnApp
 * @author      Ivan Gavryliuk
 * @copyright   © 2016 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */

/**
 * TODO Add description
 */
define( 'ONAPP_GETRESOURCE_CREATE_COPY3', 'copy' );

/**
 * Managing Company Billing Plans
 *
 * The OnApp_BillingCompany class represents the billing plans. The OnApp class is the parent of the BillingPlan class.
 *
 * The OnApp_BillingCompany class uses the following basic methods:
 * {@link load}, {@link save}, {@link delete}, and {@link getList}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */
class OnApp_BillingCompany extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'company_plan';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'billing/company/plans';

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
                $this->fields = array(
                    'label'          => array(
                        ONAPP_FIELD_MAP           => '_label',
                        ONAPP_FIELD_REQUIRED      => true,
                        ONAPP_FIELD_DEFAULT_VALUE => ''
                    ),
                    'created_at'     => array(
                        ONAPP_FIELD_MAP       => '_created_at',
                        ONAPP_FIELD_TYPE      => 'datetime',
                        ONAPP_FIELD_READ_ONLY => true
                    ),
                    'updated_at'     => array(
                        ONAPP_FIELD_MAP       => '_updated_at',
                        ONAPP_FIELD_TYPE      => 'datetime',
                        ONAPP_FIELD_READ_ONLY => true
                    ),
                    'id'             => array(
                        ONAPP_FIELD_MAP       => '_id',
                        ONAPP_FIELD_TYPE      => 'integer',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'monthly_price'  => array(
                        ONAPP_FIELD_MAP      => '_monthly_price',
                        ONAPP_FIELD_TYPE     => 'integer',
                        ONAPP_FIELD_REQUIRED => true,
                    ),
                    'currency_code'  => array(
                        ONAPP_FIELD_MAP       => '_currency_code',
                        ONAPP_FIELD_TYPE      => 'string',
                        ONAPP_FIELD_REQUIRED  => true,
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'show_price'     => array(
                        ONAPP_FIELD_MAP           => '_show_price',
                        ONAPP_FIELD_TYPE          => 'boolean',
                        ONAPP_FIELD_REQUIRED      => true,
                        ONAPP_FIELD_DEFAULT_VALUE => true,
                        ONAPP_FIELD_READ_ONLY     => true
                    ),
                    'allows_mak'     => array(
                        ONAPP_FIELD_MAP       => '_allows_mak',
                        ONAPP_FIELD_TYPE      => 'boolean',
                        ONAPP_FIELD_READ_ONLY => true
                    ),
                    'allows_kms'     => array(
                        ONAPP_FIELD_MAP       => '_allows_kms',
                        ONAPP_FIELD_TYPE      => 'boolean',
                        ONAPP_FIELD_READ_ONLY => true
                    ),
                    'allows_own'     => array(
                        ONAPP_FIELD_MAP       => '_allows_own',
                        ONAPP_FIELD_TYPE      => 'boolean',
                        ONAPP_FIELD_READ_ONLY => true
                    ),
                    'base_resources' => array(
                        ONAPP_FIELD_MAP       => '_base_resources',
                        ONAPP_FIELD_TYPE      => 'array',
                        ONAPP_FIELD_READ_ONLY => true,
                        ONAPP_FIELD_CLASS     => 'BillingCompany_BaseResource',
                    )
                );
                break;

            case 4.3:
            case 5.0:
                $this->fields = $this->initFields( 4.2 );
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
                break;
            case 5.5:
                $this->fields = $this->initFields( 5.4 );
                break;
            case 6.0:
                $this->fields = $this->initFields( 5.5 );
                break;

            case 6.1:
                $this->fields = $this->initFields( 6.0 );
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

            default:
                $this->fields = $this->initFields( 6.7 );
                break;
        }

        parent::initFields( $version, __CLASS__ );

        return $this->fields;
    }

    function getResource( $action = ONAPP_GETRESOURCE_DEFAULT ) {
        switch ( $action ) {
            case ONAPP_GETRESOURCE_GETLIST_USERS:
                /**
                 * ROUTE :
                 *
                 * @name billing_plan_users
                 * @method GET
                 * @alias  /billing_plans/:billing_plan_id/users(.:format)
                 * @format {:controller=>"users", :action=>"index"}
                 */
                $resource = $this->getResource( ONAPP_GETRESOURCE_LOAD ) . '/plans';
                break;

            case ONAPP_GETRESOURCE_CREATE_COPY3:
                /**
                 * ROUTE :
                 *
                 * @name create_copy_billing_plan
                 * @method POST
                 * @alias  /billing_plans/:id/create_copy(.:format)
                 * @format {:controller=>"internationalization", :action=>"show"}
                 */
                $resource = $this->getResource( ONAPP_GETRESOURCE_LOAD ) . '/create_copy';
                break;

            default:
                /**
                 * ROUTE :
                 *
                 * @name company_billing_plans
                 * @method GET
                 * @alias  billing/company/plans(.:format)
                 * @format {:controller=>"company_billing_plans", :action=>"index"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name company_billing_plans
                 * @method GET
                 * @alias  billing/company/plans:id(.:format)
                 * @format {:controller=>"company_billing_plans", :action=>"show"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name company_billing_plans
                 * @method POST
                 * @alias  billing/company/plans(.:format)
                 * @format {:controller=>"company_billing_plans", :action=>"create"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name company_billing_plans
                 * @method PUT
                 * @alias  billing/company/plans:id(.:format)
                 * @format {:controller=>"company_billing_plans", :action=>"update"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name company_billing_plans
                 * @method DELETE
                 * @alias  billing/company/plans:id(.:format)
                 * @format {:controller=>"company_billing_plans", :action=>"destroy"}
                 */
                $resource = parent::getResource( $action );
        }

        return $resource;
    }
}
