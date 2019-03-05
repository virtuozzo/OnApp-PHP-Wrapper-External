<?php
/**
 * Managing User Groups
 *
 * User Groups are created to set custom layout to selected users.
 *
 * @category    API wrapper
 * @package     OnApp
 * @author      Lev Bartashevsky
 * @copyright   © 2011 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */

/**
 *
 * Managing User Groups
 *
 * The OnApp_UserAdditionalField class uses the following basic methods:
 * {@link load}, {@link save}, {@link delete}, and {@link getList}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */
class OnApp_UserGroup extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'user_group';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'user_groups';

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
            case '2.0':
            case '2.1':
            case 2.2:
            case 2.3:
                $this->fields = array(
                    'label'      => array(
                        ONAPP_FIELD_MAP           => '_label',
                        ONAPP_FIELD_REQUIRED      => true,
                        ONAPP_FIELD_DEFAULT_VALUE => ''
                    ),
                    'created_at' => array(
                        ONAPP_FIELD_MAP       => '_created_at',
                        ONAPP_FIELD_TYPE      => 'datetime',
                        ONAPP_FIELD_READ_ONLY => true
                    ),
                    'updated_at' => array(
                        ONAPP_FIELD_MAP       => '_updated_at',
                        ONAPP_FIELD_TYPE      => 'datetime',
                        ONAPP_FIELD_READ_ONLY => true
                    ),
                    'id'         => array(
                        ONAPP_FIELD_MAP       => '_id',
                        ONAPP_FIELD_TYPE      => 'integer',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                );
                break;

            case 3.0:
            case 3.1:
            case 3.2:
            case 3.3:
            case 3.4:
            case 3.5:
            case 4.0:
            case 4.1:
                $this->fields = $this->initFields( 2.3 );

                $this->fields['roles']              = array(
                    ONAPP_FIELD_MAP   => '_roles',
                    ONAPP_FIELD_TYPE  => 'array',
                    ONAPP_FIELD_CLASS => 'Role',
                );
                $this->fields['billing_plans']      = array(
                    ONAPP_FIELD_MAP   => '_billing_plans',
                    ONAPP_FIELD_TYPE  => 'array',
                    ONAPP_FIELD_CLASS => 'BillingPlan',
                );
                $this->fields['identifier']         = array(
                    ONAPP_FIELD_MAP  => '_identifier',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['closed']             = array(
                    ONAPP_FIELD_MAP  => '_closed',
                    ONAPP_FIELD_TYPE => 'boolean',
                );
                $this->fields['traded']             = array(
                    ONAPP_FIELD_MAP  => '_traded',
                    ONAPP_FIELD_TYPE => 'boolean',
                );
                $this->fields['federation_enabled'] = array(
                    ONAPP_FIELD_MAP  => '_federation_enabled',
                    ONAPP_FIELD_TYPE => 'boolean',
                );
                $this->fields['federation_id']      = array(
                    ONAPP_FIELD_MAP  => '_federation_id',
                    ONAPP_FIELD_TYPE => 'integer',
                );
                $this->fields['billing_plan_ids']   = array(
                    ONAPP_FIELD_MAP => 'billing_plan_ids',
                );
                break;
            case 4.2:
                $this->fields                            = $this->initFields( 4.1 );
                $this->fields['company_billing_plan_id'] = array(
                    ONAPP_FIELD_MAP  => '_company_billing_plan_id',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['draas_id']                = array(
                    ONAPP_FIELD_MAP  => '_draas_id',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['hypervisor_id']           = array(
                    ONAPP_FIELD_MAP  => '_hypervisor_id',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['preconfigured_only']      = array(
                    ONAPP_FIELD_MAP  => '_preconfigured_only',
                    ONAPP_FIELD_TYPE => 'boolean',
                );
                break;
            case 4.3:
                $this->fields                    = $this->initFields( 4.2 );
                $this->fields['provider_vdc_id'] = array(
                    ONAPP_FIELD_MAP  => '_provider_vdc_id',
                    ONAPP_FIELD_TYPE => 'string',
                );
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
                $this->fields                      = $this->initFields( 5.4 );
                $this->fields['additional_fields'] = array(
                    ONAPP_FIELD_MAP  => '_additional_fields',
                    ONAPP_FIELD_TYPE => 'boolean',
                );
                break;
            case 6.0:
                $this->fields = $this->initFields( 5.5 );
                $fields       = array(
                    'assign_to_vcloud',
                    'role_id',
                    'billing_plan_id',
                );
                $this->unsetFields( $fields );
                $this->fields['role_ids']         = array(
                    ONAPP_FIELD_MAP   => '_role_ids',
                    ONAPP_FIELD_TYPE  => 'array',
                );
                $this->fields['billing_plan_ids'] = array(
                    ONAPP_FIELD_MAP   => '_billing_plan_ids',
                    ONAPP_FIELD_TYPE  => 'array',
                );
                $this->fields['bucket_id']       = array(
                    ONAPP_FIELD_MAP   => '_bucket_id',
                    ONAPP_FIELD_TYPE  => 'integer',
                );
                $this->fields['user_buckets']       = array(
                    ONAPP_FIELD_MAP   => '_user_buckets',
                    ONAPP_FIELD_TYPE  => 'array',
                );
                $this->fields['assign_vcloud_roles']       = array(
                    ONAPP_FIELD_MAP   => '_assign_vcloud_roles',
                    ONAPP_FIELD_TYPE  => 'boolean',
                );
                break;
        }

        parent::initFields( $version, __CLASS__ );

        return $this->fields;
    }
}