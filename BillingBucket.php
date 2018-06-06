<?php
/**
 * Managing Billing Bucket
 *
 * Billing Bucket are created to set prices for the resources so that users know how
 * much they will be charged per unit.
 *
 * @category    API wrapper
 * @package     OnApp
 * @author      Mykola Vuy
 * @copyright   © 2018 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */

/**
 * @var
 */
define( 'ONAPP_BILLINGBACKET_CLONE', 'clone' );

/**
 * Managing Billing Bucket
 *
 * The OnApp_BillingBucket class represents the billing plans. The OnApp class is the parent of the BillingBucket class.
 *
 * The OnApp_BillingBucket class uses the following basic methods:
 * {@link load}, {@link save}, {@link delete}, and {@link getList}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php )
 */

class OnApp_BillingBucket extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'bucket';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'billing/buckets';

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
            case 6.0:
                $this->fields = array(
                    'id'                    => array(
                        ONAPP_FIELD_MAP           => '_id',
                        ONAPP_FIELD_TYPE          => 'integer',
                        ONAPP_FIELD_READ_ONLY     => true,
                    ),
                    'label'                 => array(
                        ONAPP_FIELD_MAP           => '_label',
                        ONAPP_FIELD_TYPE          => 'string',
                        ONAPP_FIELD_REQUIRED      => true,
                        ONAPP_FIELD_DEFAULT_VALUE => ''
                    ),
                    'created_at'            => array(
                        ONAPP_FIELD_MAP           => '_created_at',
                        ONAPP_FIELD_TYPE          => 'datetime',
                        ONAPP_FIELD_READ_ONLY     => true
                    ),
                    'updated_at'            => array(
                        ONAPP_FIELD_MAP           => '_updated_at',
                        ONAPP_FIELD_TYPE          => 'datetime',
                        ONAPP_FIELD_READ_ONLY     => true
                    ),
                    'currency_code'         => array(
                        ONAPP_FIELD_MAP           => '_currency_code',
                        ONAPP_FIELD_TYPE          => 'string',
                        ONAPP_FIELD_READ_ONLY     => true,
                    ),
                    'show_price'            => array(
                        ONAPP_FIELD_MAP           => '_show_price',
                        ONAPP_FIELD_TYPE          => 'boolean',
                        ONAPP_FIELD_REQUIRED      => true,
                        ONAPP_FIELD_DEFAULT_VALUE => true,
                        ONAPP_FIELD_READ_ONLY     => true
                    ),
                    'monthly_price'         => array(
                        ONAPP_FIELD_MAP           => '_monthly_price',
                        ONAPP_FIELD_TYPE          => 'integer',
                    ),
                    'allows_mak'            => array(
                        ONAPP_FIELD_MAP           => '_allows_mak',
                        ONAPP_FIELD_TYPE          => 'boolean',
                        ONAPP_FIELD_READ_ONLY     => true
                    ),
                    'allows_kms'            => array(
                        ONAPP_FIELD_MAP           => '_allows_kms',
                        ONAPP_FIELD_TYPE          => 'boolean',
                        ONAPP_FIELD_READ_ONLY     => true
                    ),
                    'allows_own'            => array(
                        ONAPP_FIELD_MAP           => '_allows_own',
                        ONAPP_FIELD_TYPE          => 'boolean',
                        ONAPP_FIELD_READ_ONLY     => true
                    ),
                    'type'                  => array(
                        ONAPP_FIELD_MAP           => '_type',
                        ONAPP_FIELD_TYPE          => 'string',
                    ),
                    'associated_with_users' => array(
                        ONAPP_FIELD_MAP           => '_associated_with_users',
                        ONAPP_FIELD_TYPE          => 'integer',
                    ), 
                );
                break;
        }
        parent::initFields( $version, __CLASS__ );

        return $this->fields;
    }
    
    function getResource( $action = ONAPP_GETRESOURCE_DEFAULT ) {
        switch ( $action ) {
            
            case ONAPP_BILLINGBACKET_CLONE:
                /**
                 * ROUTE :
                 *
                 * @name BillingBucket
                 * @method POST
                 * @alias  /billing/buckets/:id/clone(.:format)
                 * @format {:controller=>"BillingBucket", :action=>"clone"}
                 */
                $resource = $this->_resource . '/' . $this->_id . '/' . ONAPP_BILLINGBACKET_CLONE;
                break;
            
            default:
                /**
                 * ROUTE :
                 *
                 * @name BillingBucket
                 * @method GET
                 * @alias  /billing/buckets(.:format)
                 * @format {:controller=>"BillingBucket", :action=>"index"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name BillingBucket
                 * @method GET
                 * @alias  /billing/buckets/:id(.:format)
                 * @format {:controller=>"BillingBucket", :action=>"show"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name BillingBucket
                 * @method POST
                 * @alias  /billing/buckets(.:format)
                 * @format {:controller=>"BillingBucket", :action=>"create"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name BillingBucket
                 * @method PUT
                 * @alias  /billing/buckets/:id(.:format)
                 * @format {:controller=>"BillingBucket", :action=>"update"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name BillingBucket
                 * @method DELETE
                 * @alias  /billing/buckets/:id(.:format)
                 * @format {:controller=>"BillingBucket", :action=>"destroy"}
                 */
                $resource = parent::getResource( $action );
        }

        return $resource;
    }
    
    public function bucketClone($id){
        if ( ! is_null( $id ) ) {
            $this->_id = $id;
        } else {
            $this->logger->error(
                'getResource( Bucket Clone ): argument _id not set.',
                __FILE__,
                __LINE__
            );
        }
        $this->sendPost( ONAPP_BILLINGBACKET_CLONE );
    }
    
}
