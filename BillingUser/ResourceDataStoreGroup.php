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
 * The OnApp_BillingUser_ResourceDataStoreGroup class uses the following basic methods:
 * {@link load}, {@link save}, {@link delete}, and {@link getList}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */
class OnApp_BillingUser_ResourceDataStoreGroup extends OnApp_BillingUser_BaseResource {
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
    var $_specified_resource_name = 'data_store_group';

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
                    ONAPP_FIELD_DEFAULT_VALUE => 'Resource::DataStoreGroup',
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

                $this->fields['limit']                       = array(
                    ONAPP_FIELD_MAP  => '_limit',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['limit_free']                  = array(
                    ONAPP_FIELD_MAP  => '_limit_free',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['price_on']                    = array(
                    ONAPP_FIELD_MAP  => '_price_on',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['price_off']                   = array(
                    ONAPP_FIELD_MAP  => '_price_off',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['limit_data_read_free']        = array(
                    ONAPP_FIELD_MAP  => '_limit_data_read_free',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['price_data_read']             = array(
                    ONAPP_FIELD_MAP  => '_price_data_read',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['limit_data_written_free']     = array(
                    ONAPP_FIELD_MAP  => '_limit_data_written_free',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['price_data_written']          = array(
                    ONAPP_FIELD_MAP  => '_price_data_written',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['limit_reads_completed_free']  = array(
                    ONAPP_FIELD_MAP  => '_limit_reads_completed_free',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['price_reads_completed']       = array(
                    ONAPP_FIELD_MAP  => '_price_reads_completed',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['limit_writes_completed_free'] = array(
                    ONAPP_FIELD_MAP  => '_limit_writes_completed_free',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['price_writes_completed']      = array(
                    ONAPP_FIELD_MAP  => '_price_writes_completed',
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

        foreach ( array( 'unit', 'price' ) as $field ) {
            unset( $this->fields[ $field ] );
        }

        return $this->fields;
    }

    public function editDiskSizeLimits( $limit = null, $limit_free = null, $price_on = null, $price_off = null ) {
        $dataArray = array();
        if ( $limit != null ) {
            $dataArray['limit'] = $limit;
        }
        if ( $limit_free != null ) {
            $dataArray['limit_free'] = $limit_free;
        }
        if ( $price_on != null ) {
            $dataArray['price_on'] = $price_on;
        }
        if ( $price_off != null ) {
            $dataArray['price_off'] = $price_off;
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

    public function editDataReadLimits( $limit_data_read_free = null, $price_data_read = null ) {
        $dataArray = array();
        if ( $limit_data_read_free != null ) {
            $dataArray['limit_data_read_free'] = $limit_data_read_free;
        }
        if ( $price_data_read != null ) {
            $dataArray['price_data_read'] = $price_data_read;
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

    public function editDataWrittenLimits( $limit_data_written_free = null, $price_data_written = null ) {
        $dataArray = array();
        if ( $limit_data_written_free != null ) {
            $dataArray['limit_data_written_free'] = $limit_data_written_free;
        }
        if ( $price_data_written != null ) {
            $dataArray['price_data_written'] = $price_data_written;
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

    public function editInputRequestsLimits( $limit_reads_completed_free = null, $price_reads_completed = null ) {
        $dataArray = array();
        if ( $limit_reads_completed_free != null ) {
            $dataArray['limit_reads_completed_free'] = $limit_reads_completed_free;
        }
        if ( $price_reads_completed != null ) {
            $dataArray['price_reads_completed'] = $price_reads_completed;
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

    public function editOutputRequestsLimits( $limit_writes_completed_free = null, $price_writes_completed = null ) {
        $dataArray = array();
        if ( $limit_writes_completed_free != null ) {
            $dataArray['limit_writes_completed_free'] = $limit_writes_completed_free;
        }
        if ( $price_writes_completed != null ) {
            $dataArray['price_writes_completed'] = $price_writes_completed;
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

