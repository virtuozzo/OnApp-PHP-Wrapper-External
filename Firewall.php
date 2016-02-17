<?php
/**
 * Managing Firewalls
 *
 *
 * @category    API wrapper
 * @package     OnApp
 * @author
 * @copyright   © 2016 OnApp
 * @link        http://www.onapp.com/
 * @docs        https://docs.onapp.com/display/42API/Firewalls
 * @see         OnApp
 */

/**
 * Managing Firewalls
 *
 *
 * The Availability class uses the following basic methods:
 * {@link load}, {@link save}, {@link delete}, and {@link getList}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */
class OnApp_Firewall extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'firewall';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'settings/firewalls';

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
            case 2.0:
            case 2.1:
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
                $this->fields = array(
                    'created_at' => array(
                        ONAPP_FIELD_MAP  => '_created_at',
                        ONAPP_FIELD_TYPE => 'datetime',
                    ),
                    'updated_at' => array(
                        ONAPP_FIELD_MAP  => '_updated_at',
                        ONAPP_FIELD_TYPE => 'datetime',
                    ),
                    'firewall_cluster_id'  => array(
                        ONAPP_FIELD_MAP  => '_firewall_cluster_id',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'id'  => array(
                        ONAPP_FIELD_MAP  => '_id',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'inside_cidr'  => array(
                        ONAPP_FIELD_MAP  => '_inside_cidr',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'inside_interface'  => array(
                        ONAPP_FIELD_MAP  => '_inside_interface',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'inside_ip_address'  => array(
                        ONAPP_FIELD_MAP  => '_inside_ip_address',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'name_of_default_rule'  => array(
                        ONAPP_FIELD_MAP  => '_name_of_default_rule',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'outside_cidr_type'  => array(
                        ONAPP_FIELD_MAP  => '_outside_cidr_type',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'outside_gateway_address'  => array(
                        ONAPP_FIELD_MAP  => '_outside_gateway_address',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'outside_interface'  => array(
                        ONAPP_FIELD_MAP  => '_outside_interface',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'outside_ip_address'  => array(
                        ONAPP_FIELD_MAP  => '_outside_ip_address',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'preshared_cluster_secret'  => array(
                        ONAPP_FIELD_MAP  => '_preshared_cluster_secret',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'password'  => array(
                        ONAPP_FIELD_MAP  => '_password',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'username'  => array(
                        ONAPP_FIELD_MAP  => '_username',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'outside_cidr'  => array(
                        ONAPP_FIELD_MAP  => '_outside_cidr',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                );
                break;
        }

        parent::initFields( $version, __CLASS__ );

        return $this->fields;
    }

    function getResource( $action = ONAPP_GETRESOURCE_DEFAULT ) {
        switch ( $action ) {
            default:
                /**
                 * @alias  /settings/firewalls/:id.json
                 */
                $resource = parent::getResource( $action );
        }

        return $resource;
    }

}