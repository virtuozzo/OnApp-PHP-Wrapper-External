<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Billing Plan Base Resources
 *
 * @category    API wrapper
 * @package     OnApp
 * @subpackage  BillingUser
 * @author      Andrew Yatskovets
 * @copyright   © 2011 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */

/**
 * The OnApp_BillingUser_ResourceVmMonit class uses the following basic methods:
 * {@link load}, {@link save}, {@link delete}, and {@link getList}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */
class OnApp_BillingUser_ResourceVmMonit extends OnApp_BillingUser_BaseResource {
    /**
     * specified resource name for getList
     *
     * @var string
     */
    var $_specified_resource_name = 'vm_monit';

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
            ONAPP_FIELD_DEFAULT_VALUE => 'Resource::VmMonit'
        );

        $this->fields[ 'id' ][ ONAPP_FIELD_REQUIRED ] = false;

        foreach( array( 'unit', 'price_on', 'price_off' ) as $field ) {
            unset( $this->fields[ $field ] );
        }

        return $this->fields;
    }
}