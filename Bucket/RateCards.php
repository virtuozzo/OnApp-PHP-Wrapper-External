<?php
/**
 * Managing Bucket Rate Cards
 *
 * Bucket Rate Cards are created to set prices for the resources so that users know how
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
 * Managing Bucket Rate Cards
 *
 * The OnApp_BillingBucket_RateCards class represents the billing plans. The OnApp class is the parent of the BillingBucket_RateCards class.
 *
 * The OnApp_BillingBucket_RateCards class uses the following basic methods:
 * {@link save}, {@link delete}, and {@link getList}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php )
 */
class OnApp_Bucket_RateCards extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'rate_card';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'rate_cards';

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
                    'bucket_id'         => array(
                        ONAPP_FIELD_MAP           => '_bucket_id',
                        ONAPP_FIELD_TYPE          => 'integer',
                        ONAPP_FIELD_READ_ONLY     => true,
                    ),
                    'server_type'       => array(
                        ONAPP_FIELD_MAP           => '_server_type',
                        ONAPP_FIELD_TYPE          => 'string',
                    ),
                    'timing_strategy'   => array(
                        ONAPP_FIELD_MAP           => '_timing_strategy',
                        ONAPP_FIELD_TYPE          => 'string',
                    ),
                    'target_id'         => array(
                        ONAPP_FIELD_MAP           => '_target_id',
                        ONAPP_FIELD_TYPE          => 'integer',
                        ONAPP_FIELD_READ_ONLY     => true,
                    ),
                    'target_name'       => array(
                        ONAPP_FIELD_MAP           => '_target_name',
                        ONAPP_FIELD_TYPE          => 'string',
                    ),
                    'type'              => array(
                        ONAPP_FIELD_MAP           => '_type',
                        ONAPP_FIELD_TYPE          => 'string',
                    ),
                    'prices'            => array(
                        ONAPP_FIELD_MAP           => '_prices',
                        ONAPP_FIELD_CLASS         => 'OnApp_Bucket_RateCards_Prices',
                    ),
                    'apply_to_all_resources_in_the_bucket'        => array(
                        ONAPP_FIELD_MAP           => '_apply_to_all_resources_in_the_bucket',
                        ONAPP_FIELD_TYPE          => 'string',
                    ),
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
    public function getResource( $action = ONAPP_GETRESOURCE_DEFAULT ) {
        switch ( $action ) {
            case ONAPP_GETRESOURCE_DEFAULT:
                /**
                 * ROUTE :
                 *
                 * @name billing/buckets
                 * @method GET
                 * @alias   /billing/buckets/:bucket_id/rate_cards
                 * @format  {:controller=>"BillingBucket_RateCards", :action=>"index"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name billing/buckets
                 * @method POST
                 * @alias   /billing/buckets/:bucket_id/rate_cards
                 * @format {:controller=>"BillingBucket_RateCards", :action=>"create"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name billing/buckets
                 * @method PUT
                 * @alias  /billing/buckets/:bucket_id/rate_cards
                 * @format {:controller=>"BillingBucket_RateCards", :action=>"update"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name billing/buckets
                 * @method DELETE
                 * @alias   /billing/buckets/:bucket_id/rate_cards
                 * @format {:controller=>"BillingBucket_RateCards", :action=>"destroy"}
                 */
                if ( is_null( $this->_bucket_id ) && is_null( $this->_obj->_bucket_id ) ) {
                    $this->logger->error(
                        "getResource($action): argument _bucket_id not set.",
                        __FILE__,
                        __LINE__
                    );
                } else {
                    if ( is_null( $this->_bucket_id ) ) {
                        $this->_bucket_id = $this->_obj->_bucket_id;
                    }
                }
                $resource = 'billing/buckets/' . $this->_bucket_id . '/' . $this->_resource;
                $this->logger->debug( 'getResource( ' . $action . ' ): return ' . $resource );
                break;

            default:
                $resource = parent::getResource( $action );
                break;
        }

        return $resource;
    }

     /**
     * The method saves an Object
     *
     * @param  bollean: true - edit | false - create
     * @return void
     */
    public function save( $flag = false ) {
        
        if ( !isset( $this->_type ) && empty( $this->_type ) ) {
            $this->logger->error(
                "save: argument _type not set.",
                __FILE__,
                __LINE__
            );
        }
        
        if ( !isset( $this->_server_type ) && empty( $this->_server_type ) ) {
            $this->logger->error(
                "save: argument _server_type not set.",
                __FILE__,
                __LINE__
            );
        }
        
        if ( !isset( $this->_target_id ) ) {
            $this->logger->error(
                "save: argument _target_id not set.",
                __FILE__,
                __LINE__
            );
        }
        
        if ( !isset( $this->_prices ) ) {
            $this->logger->error(
                "save: argument _prices not set.",
                __FILE__,
                __LINE__
            );
        }
        
        $data = array(
            'root'        => $this->_tagRoot,
            'data'        => array(
                'bucket_id'   => $this->_bucket_id,
                'target_id'   => $this->_target_id,
                'type'        => $this->_type,
                'server_type' => $this->_server_type,
                'prices'      => $this->_prices,
            ),
        );
        if (isset($this->_apply_to_all_resources_in_the_bucket) && !is_null($this->_apply_to_all_resources_in_the_bucket)) {
            $data['data']['apply_to_all_resources_in_the_bucket'] = $this->_apply_to_all_resources_in_the_bucket;
        }
        
        if ( $flag ) {
            $this->sendPut( ONAPP_GETRESOURCE_DEFAULT, $data );
        } else {
            $this->sendPost( ONAPP_GETRESOURCE_DEFAULT, $data );
        }
    }
    
    public function delete() {
        if ( !isset( $this->_type ) && empty( $this->_type ) ) {
            $this->logger->error(
                "delete: argument _type not set.",
                __FILE__,
                __LINE__
            );
        }
        
        if ( !isset( $this->_server_type ) && empty( $this->_server_type ) ) {
            $this->logger->error(
                "delete: argument _server_type not set.",
                __FILE__,
                __LINE__
            );
        }
        
        if ( !isset( $this->_target_id ) ) {
            $this->logger->error(
                "delete: argument _target_id not set.",
                __FILE__,
                __LINE__
            );
        }
        
        $data = array(
            'root'        => $this->_tagRoot,
            'data'        => array(
                'bucket_id'   => $this->_bucket_id,
                'target_id'   => $this->_target_id,
                'type'        => $this->_type,
                'server_type' => $this->_server_type,
            ),
        );
        
        $this->sendDelete( ONAPP_GETRESOURCE_DEFAULT, $data );
    }
    
}
