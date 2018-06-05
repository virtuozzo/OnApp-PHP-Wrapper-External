<?php

/**
 * Manages Seller Trust Token
 *
 * @category    API wrapper
 * @package     OnApp
 * @subpackage  Federation
 * @author      Ivan Gavryliuk
 * @copyright   © 2016 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */
class OnApp_Federation_SellerToken extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'token';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'federation/hypervisor_zones';

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
                    'hypervisor_group_id' => array(
                        ONAPP_FIELD_MAP  => '_hypervisor_group_id',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'id'                  => array(
                        ONAPP_FIELD_MAP  => '_id',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'receiver'            => array(
                        ONAPP_FIELD_MAP  => '_receiver',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'token'               => array(
                        ONAPP_FIELD_MAP  => '_token',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'used'                => array(
                        ONAPP_FIELD_MAP  => '_used',
                        ONAPP_FIELD_TYPE => 'boolean',
                    ),
                );
                break;
            case 4.3:
                $this->fields = $this->initFields( 4.2 );
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
                break;
            case 5.5:
                $this->fields = $this->initFields( 5.4 );
                break;
            case 6.0:
                $this->fields = $this->initFields( 5.5 );
                break;
        }

        parent::initFields( $version, __CLASS__ );

        return $this->fields;
    }

    function getResource( $action = ONAPP_GETRESOURCE_DEFAULT ) {
        switch ( $action ) {
            case ONAPP_GETRESOURCE_DEFAULT:
                /**
                 * ROUTE :
                 *
                 * @name supplier_tokens
                 * @method GET
                 * @alias   /federation/hypervisor_zones/:hypervisor_zone_id/supplier_tokens(.:format)
                 * @format  {:controller=>"supplier_tokens", :action=>"index"}
                 */
                if ( is_null( $this->_hypervisor_zones_id ) ) {
                    $this->logger->error(
                        'getResource( ' . $action . ' ): argument _hypervisor_zones_id not set.',
                        __FILE__,
                        __LINE__
                    );
                } else {
                    if ( is_null( $this->_hypervisor_zones_id ) ) {
                        $this->_hypervisor_zones_id = $this->_obj->_hypervisor_zones_id;
                    }
                }
                $resource = $this->_resource . '/' . $this->_hypervisor_zones_id . '/supplier_tokens';
                $this->logger->debug( 'getResource( ' . $action . ' ): return ' . $resource );
                break;

            default:
                /**
                 * ROUTE :
                 *
                 * @name supplier_tokens
                 * @method GET
                 * @alias  /federation/hypervisor_zones/:hypervisor_zone_id/supplier_tokens(.:format)
                 * @format {:controller=>"supplier_tokens", :action=>"index"}
                 */
                $resource = parent::getResource( $action );
        }

        return $resource;
    }

}