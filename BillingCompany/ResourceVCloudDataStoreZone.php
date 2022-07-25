<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 *  Company Billing Plan Base Resources VCloud Data Store Zone
 *
 * @category    API wrapper
 * @package     OnApp
 * @subpackage  BillingCompany
 * @author      Ivan Gavryliuk
 * @copyright   © 2016 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */

/**
 * The OnApp_BillingCompany_ResourceVCloudDataStoreZone class uses the following basic methods:
 * {@link load}, {@link save}, {@link delete}, and {@link getList}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */
class OnApp_BillingCompany_ResourceVCloudDataStoreZone extends OnApp_BillingCompany_BaseResource {
    /**
     * alias processing the object data
     *
     * @var string
     */
//    var $_resource = 'resource_edge_groups';

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
                $this->fields['resource_class']       = array(
                    ONAPP_FIELD_MAP           => '_resource_class',
                    ONAPP_FIELD_TYPE          => 'string',
                    ONAPP_FIELD_REQUIRED      => true,
                    ONAPP_FIELD_READ_ONLY     => true,
                    ONAPP_FIELD_DEFAULT_VALUE => 'Billing::Company::Resource::VCloud::DataStoreZone',
                );
                $this->fields['limit_free_disk_size'] = array(
                    ONAPP_FIELD_MAP  => '_limit_free_disk_size',
                    ONAPP_FIELD_TYPE => 'integer',
                );
                $this->fields['limit_min_disk_size']  = array(
                    ONAPP_FIELD_MAP  => '_limit_min_disk_size',
                    ONAPP_FIELD_TYPE => 'integer',
                );
                $this->fields['limit_disk_size']      = array(
                    ONAPP_FIELD_MAP  => '_limit_disk_size',
                    ONAPP_FIELD_TYPE => 'integer',
                );
                $this->fields['price_disk_size']      = array(
                    ONAPP_FIELD_MAP  => '_price_disk_size',
                    ONAPP_FIELD_TYPE => 'integer',
                );
                $this->fields['target_id']            = array(
                    ONAPP_FIELD_MAP  => '_target_id',
                    ONAPP_FIELD_TYPE => 'integer',
                );
                $this->fields['target_type']          = array(
                    ONAPP_FIELD_MAP           => '_target_type',
                    ONAPP_FIELD_TYPE          => 'string',
                    ONAPP_FIELD_REQUIRED      => true,
                    ONAPP_FIELD_DEFAULT_VALUE => 'Pack',
                );

                break;
            case 4.3:
                $this->fields = $this->initFields( 4.2 );
                break;
            case 5.0:
                $this->fields                              = $this->initFields( 4.3 );
                $this->fields['limit_free_disk_size_used'] = array(
                    ONAPP_FIELD_MAP  => '_limit_free_disk_size_used',
                    ONAPP_FIELD_TYPE => 'integer',
                );
                $this->fields['limit_min_disk_size_used']  = array(
                    ONAPP_FIELD_MAP  => '_limit_min_disk_size_used',
                    ONAPP_FIELD_TYPE => 'integer',
                );
                $this->fields['limit_disk_size_used']      = array(
                    ONAPP_FIELD_MAP  => '_limit_disk_size_used',
                    ONAPP_FIELD_TYPE => 'integer',
                );
                $this->fields['price_disk_size_used']      = array(
                    ONAPP_FIELD_MAP  => '_price_disk_size_used',
                    ONAPP_FIELD_TYPE => 'integer',
                );
                $this->fields['price_disk_size_unlimited'] = array(
                    ONAPP_FIELD_MAP  => '_price_disk_size_unlimited',
                    ONAPP_FIELD_TYPE => 'integer',
                );
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
        }

        return $this->fields;
    }

}

