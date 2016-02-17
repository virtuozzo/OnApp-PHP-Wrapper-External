<?php

/**
 * Manages Billing Plan Base Resource Prices
 *
 * @category    API wrapper
 * @package     OnApp
 * @subpackage  BillingUser_BaseResource
 * @author      Andrew Yatskovets
 * @copyright   © 2011 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */
class OnApp_BillingUser_BaseResource_Price extends OnApp {
    var $_tagRoot = 'prices';

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
            case '2.0':
            case '2.1':
                $this->fields = array(
                    'price_on'  => array(
                        ONAPP_FIELD_MAP       => '_price_on',
                        ONAPP_FIELD_TYPE      => 'integer',
                        ONAPP_FIELD_READ_ONLY => true
                    ),
                    'price_off' => array(
                        ONAPP_FIELD_MAP       => '_price_off',
                        ONAPP_FIELD_TYPE      => 'integer',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'price'     => array(
                        ONAPP_FIELD_MAP       => '_price',
                        ONAPP_FIELD_TYPE      => 'integer',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                );
                break;

            case 2.2:
            case 2.3:
                $this->fields = $this->initFields( 2.1 );
                break;

            case 3.0:
            case 3.1:
            case 3.2:
            case 3.3:
            case 3.4:
            case 3.5:
            case 4.0:
            case 4.1:
            case 4.2:
                $this->fields = $this->initFields( 2.3 );
                $this->fields[ 'price_data_read' ]                   = array(
                    ONAPP_FIELD_MAP => '_price_data_read',
                );
                $this->fields[ 'price_data_written' ]                   = array(
                    ONAPP_FIELD_MAP => '_price_data_written',
                );
                $this->fields[ 'price_reads_completed' ]                   = array(
                    ONAPP_FIELD_MAP => '_price_reads_completed',
                );
                $this->fields[ 'price_writes_completed' ]                   = array(
                    ONAPP_FIELD_MAP => '_price_writes_completed',
                );
                $this->fields[ 'price_rate_on' ]                   = array(
                    ONAPP_FIELD_MAP => '_price_rate_on',
                );
                $this->fields[ 'price_rate_off' ]                   = array(
                    ONAPP_FIELD_MAP => '_price_rate_off',
                );
                $this->fields[ 'price_ip_on' ]                   = array(
                    ONAPP_FIELD_MAP => '_price_ip_on',
                );
                $this->fields[ 'price_ip_off' ]                   = array(
                    ONAPP_FIELD_MAP => '_price_ip_off',
                );
                $this->fields[ 'price_data_sent' ]                   = array(
                    ONAPP_FIELD_MAP => '_price_data_sent',
                );
                $this->fields[ 'price_data_received' ]                   = array(
                    ONAPP_FIELD_MAP => '_price_data_received',
                );
                $this->fields[ 'price_backup' ]                   = array(
                    ONAPP_FIELD_MAP => '_price_backup',
                );
                $this->fields[ 'price_backup_disk_size' ]                   = array(
                    ONAPP_FIELD_MAP => '_price_backup_disk_size',
                );
                $this->fields[ 'price_template' ]                   = array(
                    ONAPP_FIELD_MAP => '_price_template',
                );
                $this->fields[ 'price_template_disk_size' ]                   = array(
                    ONAPP_FIELD_MAP => '_price_template_disk_size',
                );
                $this->fields[ 'price_overused_bandwidth' ]                   = array(
                    ONAPP_FIELD_MAP => '_price_overused_bandwidth',
                );

                break;
        }

        parent::initFields( $version, __CLASS__ );

        return $this->fields;
    }
}