<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Billing Plan Base Resources
 *
 * @category    API wrapper
 * @package     OnApp
 * @subpackage  BillingUser
 * @author      Andrew Yatskovets
 * @copyright   © 2014 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */

/**
 * The OnApp_BillingUser_ResourceNetworkGroup class uses the following basic methods:
 * {@link load}, {@link save}, {@link delete}, and {@link getList}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */
class OnApp_BillingUser_ResourceNetworkGroup extends OnApp_BillingUser_BaseResource {
    /**
     * alias processing the object data
     *
     * @var string
     */
//    var $_resource = 'resource_edge_groups';

    /**
     * specified resource name for getList
     *
     * @var string
     */
    var $_specified_resource_name = 'network_group';

    /**
     * API Fields description
     *
     * @param string|float $version OnApp API version
     * @param string $className current class' name
     *
     * @return array
     */
    public function initFields( $version = null, $className = '' ) {
        parent::initFields( $version, __CLASS__ );

        switch ( $version ) {
            case '2.0':
            case '2.1':
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
                $this->fields['resource_class'] = array(
                    ONAPP_FIELD_MAP           => '_resource_class',
                    ONAPP_FIELD_TYPE          => 'string',
                    ONAPP_FIELD_REQUIRED      => true,
                    ONAPP_FIELD_READ_ONLY     => true,
                    ONAPP_FIELD_DEFAULT_VALUE => 'Resource::NetworkGroup',
                );

                $this->fields['in_master_zone'] = array(
                    ONAPP_FIELD_MAP  => '_in_master_zone',
                    ONAPP_FIELD_TYPE => 'string',
                );

                $this->fields['master'] = array(
                    ONAPP_FIELD_MAP  => '_master',
                    ONAPP_FIELD_TYPE => 'boolean',
                );

                $this->fields['target_type'] = array(
                    ONAPP_FIELD_MAP           => '_target_type',
                    ONAPP_FIELD_TYPE          => 'string',
                    ONAPP_FIELD_REQUIRED      => true,
                    ONAPP_FIELD_DEFAULT_VALUE => 'Pack',
                );

                $this->fields['limit_ip']                 = array(
                    ONAPP_FIELD_MAP  => '_limit_ip',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['limit_ip_free']            = array(
                    ONAPP_FIELD_MAP  => '_limit_ip_free',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['price_ip_on']              = array(
                    ONAPP_FIELD_MAP  => '_price_ip_on',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['price_ip_off']             = array(
                    ONAPP_FIELD_MAP  => '_price_ip_off',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['limit_rate']               = array(
                    ONAPP_FIELD_MAP  => '_limit_rate',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['limit_rate_free']          = array(
                    ONAPP_FIELD_MAP  => '_limit_rate_free',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['price_rate_on']            = array(
                    ONAPP_FIELD_MAP  => '_price_rate_on',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['price_rate_off']           = array(
                    ONAPP_FIELD_MAP  => '_price_rate_off',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['limit_data_received_free'] = array(
                    ONAPP_FIELD_MAP  => '_limit_data_received_free',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['price_data_received']      = array(
                    ONAPP_FIELD_MAP  => '_price_data_received',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['limit_data_sent_free']     = array(
                    ONAPP_FIELD_MAP  => '_limit_data_sent_free',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['price_data_sent']          = array(
                    ONAPP_FIELD_MAP  => '_price_data_sent',
                    ONAPP_FIELD_TYPE => 'string',
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

        $this->fields['id'][ ONAPP_FIELD_REQUIRED ] = false;

        foreach ( array( 'unit', 'limit', 'limit_free', 'price', 'price_on', 'price_off' ) as $field ) {
            unset( $this->fields[ $field ] );
        }

        return $this->fields;
    }

    public function editIPAddressLimits( $limit_ip = null, $limit_ip_free = null, $price_ip_on = null, $price_ip_off = null ) {
        $dataArray = array();
        if ( $limit_ip != null ) {
            $dataArray['limit_ip'] = $limit_ip;
        }
        if ( $limit_ip_free != null ) {
            $dataArray['limit_ip_free'] = $limit_ip_free;
        }
        if ( $price_ip_on != null ) {
            $dataArray['price_ip_on'] = $price_ip_on;
        }
        if ( $price_ip_off != null ) {
            $dataArray['price_ip_off'] = $price_ip_off;
        }

        if ( !is_countable($dataArray) || count( $dataArray ) == 0 ) {
            return false;
        }
        $data = array(
            'root' => 'resource',
            'data' => $dataArray,
        );
        $this->sendPut( ONAPP_GETRESOURCE_LOAD, $data );
    }

    public function editPortSpeedLimits( $limit_rate = null, $limit_rate_free = null, $price_rate_on = null, $price_rate_off = null ) {
        $dataArray = array();
        if ( $limit_rate != null ) {
            $dataArray['limit_rate'] = $limit_rate;
        }
        if ( $limit_rate_free != null ) {
            $dataArray['limit_rate_free'] = $limit_rate_free;
        }
        if ( $price_rate_on != null ) {
            $dataArray['price_rate_on'] = $price_rate_on;
        }
        if ( $price_rate_off != null ) {
            $dataArray['price_rate_off'] = $price_rate_off;
        }

        if ( !is_countable($dataArray) || count( $dataArray ) == 0 ) {
            return false;
        }
        $data = array(
            'root' => 'resource',
            'data' => $dataArray,
        );
        $this->sendPut( ONAPP_GETRESOURCE_LOAD, $data );
    }

    public function editDataReceivedLimits( $limit_data_received_free = null, $price_data_received = null ) {
        $dataArray = array();
        if ( $limit_data_received_free != null ) {
            $dataArray['limit_data_received_free'] = $limit_data_received_free;
        }
        if ( $price_data_received != null ) {
            $dataArray['price_data_received'] = $price_data_received;
        }

        if ( !is_countable($dataArray) || count( $dataArray ) == 0 ) {
            return false;
        }
        $data = array(
            'root' => 'resource',
            'data' => $dataArray,
        );
        $this->sendPut( ONAPP_GETRESOURCE_LOAD, $data );
    }

    public function editDataSentLimits( $limit_data_sent_free = null, $price_data_sent = null ) {
        $dataArray = array();
        if ( $limit_data_sent_free != null ) {
            $dataArray['limit_data_sent_free'] = $limit_data_sent_free;
        }
        if ( $price_data_sent != null ) {
            $dataArray['price_data_sent'] = $price_data_sent;
        }

        if ( !is_countable($dataArray) || count( $dataArray ) == 0 ) {
            return false;
        }
        $data = array(
            'root' => 'resource',
            'data' => $dataArray,
        );
        $this->sendPut( ONAPP_GETRESOURCE_LOAD, $data );
    }

}

