<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Billing Plan Base Resources
 *
 * @category    API wrapper
 * @package     OnApp
 * @subpackage  BillingPlan
 * @author      Andrew Yatskovets
 * @copyright   © 2014 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */

/**
 * The OnApp_BillingPlan_ResourceIpAddress class uses the following basic methods:
 * {@link load}, {@link save}, {@link delete}, and {@link getList}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */
class OnApp_BillingPlan_ResourceHypervisorGroup extends OnApp_BillingPlan_BaseResource {
    /**
     * alias processing the object data
     *
     * @var string
     */
//    var $_resource = 'resource_edge_groups';

    /**
     * API Fields description
     *
     * @param string|float $version   OnApp API version
     * @param string       $className current class' name
     *
     * @return array
     */
    public function initFields( $version = null, $className = '' ) {
        parent::initFields( $version, __CLASS__ );

        $this->fields[ 'resource_class' ] = array(
            ONAPP_FIELD_MAP           => '_resource_class',
            ONAPP_FIELD_TYPE          => 'string',
            ONAPP_FIELD_REQUIRED      => true,
            ONAPP_FIELD_READ_ONLY     => true,
            ONAPP_FIELD_DEFAULT_VALUE => 'Resource::HypervisorGroup'
        );

        $this->fields[ 'target_type' ] = array(
            ONAPP_FIELD_MAP           => '_target_type',
            ONAPP_FIELD_TYPE          => 'string',
            ONAPP_FIELD_REQUIRED      => true,
            ONAPP_FIELD_READ_ONLY     => true,
            ONAPP_FIELD_DEFAULT_VALUE => 'EdgeGroup'
        );

        $this->fields[ 'in_bucket_zone' ] = array(
            ONAPP_FIELD_MAP           => '_in_bucket_zone',
            ONAPP_FIELD_TYPE          => 'string',
            ONAPP_FIELD_REQUIRED      => false,
            ONAPP_FIELD_READ_ONLY     => false,
            ONAPP_FIELD_DEFAULT_VALUE => '1'
        );

        $this->fields[ 'id' ][ ONAPP_FIELD_REQUIRED ] = false;

        foreach( array( 'unit', 'limit', 'limit_type', 'limit_free', 'price_on', 'price_off' ) as $field ) {
            unset( $this->fields[ $field ] );
        }

        return $this->fields;
    }
}
