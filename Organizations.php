<?php
/**
 * Managing Organizations
 * 
 * much they will be charged per unit.
 *
 * @category    API wrapper
 * @package     OnApp
 * @author      Mykola Vuy
 * @copyright   © 2018 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */

/**
 * Managing Organizations
 *
 * The OnApp_Organizations class uses the following basic methods:
 * {@link load}, {@link save}, {@link delete}, and {@link getList}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php )
 */

class OnApp_Organizations extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'vcloud_organization';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'organizations';

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
            case 6.0:
                $this->fields = array(
                    'id'                        => array(
                        ONAPP_FIELD_MAP           => '_id',
                        ONAPP_FIELD_TYPE          => 'integer',
                        ONAPP_FIELD_READ_ONLY     => true,
                    ),
                    'user_group_id'             => array(
                        ONAPP_FIELD_MAP           => '_user_group_id',
                        ONAPP_FIELD_TYPE          => 'integer',
                    ),
                    'hypervisor_id'             => array(
                        ONAPP_FIELD_MAP           => '_hypervisor_id',
                        ONAPP_FIELD_TYPE          => 'integer',
                    ),
                    'label'                     => array(
                        ONAPP_FIELD_MAP           => '_label',
                        ONAPP_FIELD_TYPE          => 'string',
                        ONAPP_FIELD_REQUIRED      => true,
                        ONAPP_FIELD_DEFAULT_VALUE => ''
                    ),
                    'identifier'                => array(
                        ONAPP_FIELD_MAP           => '_identifier',
                        ONAPP_FIELD_TYPE          => 'string',
                    ),
                    'created_at'                => array(
                        ONAPP_FIELD_MAP           => '_created_at',
                        ONAPP_FIELD_TYPE          => 'datetime',
                        ONAPP_FIELD_READ_ONLY     => true
                    ),
                    'updated_at'                => array(
                        ONAPP_FIELD_MAP           => '_updated_at',
                        ONAPP_FIELD_TYPE          => 'datetime',
                        ONAPP_FIELD_READ_ONLY     => true
                    ),
                    'create_user_group'         => array(
                        ONAPP_FIELD_MAP           => '_create_user_group',
                        ONAPP_FIELD_TYPE          => 'boolean',
                    ),
                    'company_billing_plan_id'   => array(
                        ONAPP_FIELD_MAP           => '_company_billing_plan_id',
                        ONAPP_FIELD_TYPE          => 'integer',
                    ),
                );
                break;
        }
        parent::initFields( $version, __CLASS__ );

        return $this->fields;
    }
}
