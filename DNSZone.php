<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Managing DNS Zones
 *
 * @category    API wrapper
 * @package     OnApp
 * @author      Andrew Yatskovets
 * @copyright   © 2013 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */

/**
 * DNS Zone
 *
 * The DNS Zone class represents the DNS Zone of the OnAPP installation.
 *
 * The OnApp_DNS_Zone class uses the following basic methods:
 * {@link load}, {@link save}, {@link delete}, and {@link getList}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */
class OnApp_DNSZone extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'dns_zone';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'dns_zones';
    /**
     * API Fields description
     *
     * @param string|float $version   OnApp API version
     * @param string       $className current class' name
     *
     * @return array
     */

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
            case 3.0:
            case 3.1:
            case 3.2:
            case 3.3:
            case 3.4:
            case 3.5:
            case 4.0:
            case 4.1:
                $this->fields = array(
                    'id'            => array(
                        ONAPP_FIELD_MAP       => '_id',
                        ONAPP_FIELD_TYPE      => 'integer',
                        ONAPP_FIELD_READ_ONLY => true
                    ),
                    'name'          => array(
                        ONAPP_FIELD_MAP           => '_name',
                        ONAPP_FIELD_REQUIRED      => true,
                        ONAPP_FIELD_TYPE          => 'string',
                        ONAPP_FIELD_DEFAULT_VALUE => ''
                    ),
                    'created_at'    => array(
                        ONAPP_FIELD_MAP       => '_created_at',
                        ONAPP_FIELD_TYPE      => 'datetime',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'updated_at'    => array(
                        ONAPP_FIELD_MAP       => '_updated_at',
                        ONAPP_FIELD_TYPE      => 'datetime',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'user_id'       => array(
                        ONAPP_FIELD_MAP       => '_user_id',
                        ONAPP_FIELD_TYPE      => 'integer',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'auto_populate' => array(
                        ONAPP_FIELD_MAP           => '_auto_populate',
                        ONAPP_FIELD_TYPE          => 'integer',
                        ONAPP_FIELD_REQUIRED      => true,
                        ONAPP_FIELD_DEFAULT_VALUE => 0
                    )
                );
                break;

            default:
                $this->fields = $this->initFields( '3.0' );
                break;
        }
    }
}
