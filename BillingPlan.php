<?php
/**
 * Managing Billing Plans
 *
 * Billing Plans are created to set prices for the resources so that users know how
 * much they will be charged per unit.
 *
 * @category    API wrapper
 * @package     OnApp
 * @author      Lev Bartashevsky
 * @copyright   © 2011 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */

/**
 * TODO Add description
 */
define( 'ONAPP_GETRESOURCE_GETLIST_USERS', 'users' );

/**
 * TODO Add description
 */
define( 'ONAPP_GETRESOURCE_CREATE_COPY', 'copy' );

/**
 * Managing Billing Plans
 *
 * The OnApp_BillingPlan class represents the billing plans. The OnApp class is the parent of the BillingPlan class.
 *
 * The OnApp_BillingPlan class uses the following basic methods:
 * {@link load}, {@link save}, {@link delete}, and {@link getList}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */
class OnApp_BillingPlan extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'billing_plan';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'billing_plans';

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
            case 2.0:
            case 2.1:
            case 2.2:
            case 2.3:
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
                    'base_resources' => array(
                        ONAPP_FIELD_MAP       => '_base_resources',
                        ONAPP_FIELD_TYPE      => 'array',
                        ONAPP_FIELD_READ_ONLY => true,
                        ONAPP_FIELD_CLASS     => 'BillingPlan_BaseResource',
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
                );
                break;

            case 3.0:
                $this->fields = $this->initFields( 2.3 );
                break;

            case 3.1:
            case 3.2:
            case 3.3:
                $this->fields = $this->initFields( 2.3 );
                $this->fields[ 'default_base_resources' ] = array(
                    ONAPP_FIELD_MAP       => 'default_base_resources',
                    //ONAPP_FIELD_TYPE      => 'array',
                    ONAPP_FIELD_TYPE      => 'string',
                    ONAPP_FIELD_READ_ONLY => true,
                    ONAPP_FIELD_CLASS     => 'BillingPlan_BaseResource',
                );
                break;
        }

        parent::initFields( $version, __CLASS__ );

        return $this->fields;
    }

    function getResource( $action = ONAPP_GETRESOURCE_DEFAULT ) {
        switch( $action ) {
            case ONAPP_GETRESOURCE_GETLIST_USERS:
                /**
                 * ROUTE :
                 *
                 * @name billing_plan_users
                 * @method GET
                 * @alias  /billing_plans/:billing_plan_id/users(.:format)
                 * @format {:controller=>"users", :action=>"index"}
                 */
                $resource = $this->getResource( ONAPP_GETRESOURCE_LOAD ) . '/users';
                break;

            case ONAPP_GETRESOURCE_CREATE_COPY:
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
                 * @name billing_plans
                 * @method GET
                 * @alias  /billing_plans(.:format)
                 * @format {:controller=>"billing_plans", :action=>"index"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name billing_plan
                 * @method GET
                 * @alias  /billing_plans/:id(.:format)
                 * @format {:controller=>"billing_plans", :action=>"show"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name billing_plans
                 * @method POST
                 * @alias  /billing_plans(.:format)
                 * @format {:controller=>"billing_plans", :action=>"create"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name
                 * @method PUT
                 * @alias  /billing_plans/:id(.:format)
                 * @format {:controller=>"billing_plans", :action=>"update"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name
                 * @method DELETE
                 * @alias  billing_plans/:id(.:format)
                 * @format {:controller=>"billing_plans", :action=>"destroy"}
                 */
                $resource = parent::getResource( $action );
        }

        return $resource;
    }

    function users() {
        $this->logger->add( 'getList: Get Users list.' );

        $this->setAPIResource( $this->getResource( ONAPP_GETRESOURCE_GETLIST_USERS ) );

        $response = $this->sendRequest( ONAPP_REQUEST_METHOD_GET );

        if( ! empty( $response[ 'errors' ] ) ) {
            $this->errors = $response[ 'errors' ];

            return false;
        }

        $class = new ONAPP_User();

        $class->logger = $this->logger;

        $class->options = $this->options;

        $class->logger->setTimezone();

        $class->_ch = $this->_ch;

        $class->initFields( $this->getAPIVersion() );

        $result = $class->castStringToClass( $response );

        return $result;
    }

    function create_copy() {
        $this->logger->add( 'getList: Create Billing plan copy' );

        $this->setAPIResource( $this->getResource( ONAPP_GETRESOURCE_CREATE_COPY ) );

        $data = '';

        $response = $this->sendRequest( ONAPP_REQUEST_METHOD_POST, $data );

        $result = $this->castStringToClass( $response );

        return $result;
    }
}