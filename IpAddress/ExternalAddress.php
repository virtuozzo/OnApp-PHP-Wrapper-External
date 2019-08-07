<?php
/**
 * Managing IpAddress ExternalAddress
 * 
 * much they will be charged per unit.
 *
 * @category    API wrapper
 * @package     OnApp
 * @author      Mykola Vuy
 * @copyright   © 2019 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */
/**
 * Managing IpAddress ExternalAddress
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php )
 */

class OnApp_IpAddress_ExternalAddress extends OnApp {
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'external_address';

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
                    'external_address'  => array(
                        ONAPP_FIELD_MAP         => '_external_address',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                );

                break;
        }

        parent::initFields( $version, __CLASS__ );

        return $this->fields;
    }

    function getResource( $action = ONAPP_GETRESOURCE_DEFAULT ) {
        if ( is_null( $this->_ip_address_id ) && is_null( $this->_obj->_ip_address_id ) ) {
            $this->logger->error(
                'getResource( ' . $action . ' ): argument virtual_router_id not set.',
                __FILE__,
                __LINE__
            );
        } else {
            if ( is_null( $this->_ip_address_id ) ) {
                $this->_ip_address_id = $this->_obj->_ip_address_id;
            }
        }

        switch ( $action ) {
            case ONAPP_GETRESOURCE_DEFAULT:
                /**
                 * ROUTE :
                 *
                 * @name IpAddress ExternalAddress
                 * @method GET
                 *
                 * @alias  /ip_addresses/:ip_address_id/external_address(.:format)
                 * @format {:controller=>"IpAddress_ExternalAddress", :action=>"index"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name IpAddress ExternalAddress
                 * @method PUT
                 *
                 * @alias  /ip_addresses/:ip_address_id/external_address(.:format)
                 * @format {:controller=>"IpAddress_ExternalAddress", :action=>"index"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name IpAddress ExternalAddress
                 * @method DELETE
                 *
                 * @alias  /ip_addresses/:ip_address_id/external_address(.:format)
                 * @format {:controller=>"IpAddress_ExternalAddress", :action=>"index"}
                 */

                $resource = 'ip_addresses/' . $this->_ip_address_id . '/' . $this->_resource;
                break;

            default:
                $resource = parent::getResource( $action );
                break;
        }

        return $resource;
    }

    public function save()
    {
        if (is_null( $this->_external_address )) {
            $this->logger->error(
                'save: argument $_external_address not set.',
                __FILE__,
                __LINE__
            );
        }

        $data = array(
            'external_address' => $this->_external_address
        );

        $dataJSON = json_encode($data);
        $this->setAPIResource( $this->getResource( ONAPP_GETRESOURCE_DEFAULT ) );
        $response = $this->sendRequest( ONAPP_REQUEST_METHOD_PUT, $dataJSON );

        $result     = $this->_castResponseToClass( $response );
        $this->_obj = $result;
    }

    public function delete()
    {
        $data = array(
            'external_address' => null
        );

        $dataJSON = json_encode($data);
        $this->setAPIResource( $this->getResource( ONAPP_GETRESOURCE_DEFAULT ) );
        $response = $this->sendRequest( ONAPP_REQUEST_METHOD_DELETE, $dataJSON );

        $result     = $this->_castResponseToClass( $response );
        $this->_obj = $result;
    }

}