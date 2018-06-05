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
 * The OnApp_BillingUser_ResourceInstanceType class uses the following basic methods:
 * {@link load}, {@link save}, {@link delete}, and {@link getList}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */
class OnApp_BillingUser_ResourceInstanceType extends OnApp_BillingUser_BaseResource {
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
    var $_specified_resource_name = 'instance_type';

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
                    ONAPP_FIELD_DEFAULT_VALUE => 'Billing::Resource::InstanceType',
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
                    ONAPP_FIELD_DEFAULT_VALUE => 'InstanceType',
                );

                $this->fields['hypervisor_group_ids']     = array(
                    ONAPP_FIELD_MAP  => '_hypervisor_group_ids',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['data_store_group_ids']     = array(
                    ONAPP_FIELD_MAP  => '_data_store_group_ids',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['network_group_ids']        = array(
                    ONAPP_FIELD_MAP  => '_network_group_ids',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['price_overused_bandwidth'] = array(
                    ONAPP_FIELD_MAP  => '_price_overused_bandwidth',
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

}

