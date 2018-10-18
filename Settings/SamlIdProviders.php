<?php
/**
 * Managing SamlIdProviders
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
 * Managing SamlIdProviders
 *
 * The OnApp_SamlIdProviders class uses the following basic methods:
 * {@link load} and {@link getList}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php )
 */

class OnApp_Settings_SamlIdProviders extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'saml_id_provider';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'settings/authentication/saml_id_providers';

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
                    'id'                                => array(
                        ONAPP_FIELD_MAP         => '_id',
                        ONAPP_FIELD_TYPE        => 'integer',
                        ONAPP_FIELD_READ_ONLY   => true,
                    ),
                    'name'                              => array(
                        ONAPP_FIELD_MAP         => '_name',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'issuer'                            => array(
                        ONAPP_FIELD_MAP         => '_issuer',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'icon'                              => array(
                        ONAPP_FIELD_MAP         => '_icon',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'idp_sso_target_url'                => array(
                        ONAPP_FIELD_MAP         => '_idp_sso_target_url',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'idp_cert'                          => array(
                        ONAPP_FIELD_MAP         => '_idp_cert',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'enabled'                           => array(
                        ONAPP_FIELD_MAP         => '_enabled',
                        ONAPP_FIELD_TYPE        => 'boolean',
                    ),
                    'assertion_consumer_service_url'    => array(
                        ONAPP_FIELD_MAP         => '_assertion_consumer_service_url',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    
                    'onapp_key'                         => array(
                        ONAPP_FIELD_MAP         => '_onapp_key',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'user_name_key'                     => array(
                        ONAPP_FIELD_MAP         => '_user_name_key',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'roles_key'                         => array(
                        ONAPP_FIELD_MAP         => '_roles_key',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'user_group_key'                    => array(
                        ONAPP_FIELD_MAP         => '_user_group_key',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'time_zone_key'                     => array(
                        ONAPP_FIELD_MAP         => '_time_zone_key',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'created_at'                        => array(
                        ONAPP_FIELD_MAP         => '_created_at',
                        ONAPP_FIELD_TYPE        => 'datetime',
                        ONAPP_FIELD_READ_ONLY   => true
                    ),
                    'updated_at'                        => array(
                        ONAPP_FIELD_MAP         => '_updated_at',
                        ONAPP_FIELD_TYPE        => 'datetime',
                        ONAPP_FIELD_READ_ONLY   => true
                    ),
                    'nameid_format'                     => array(
                        ONAPP_FIELD_MAP         => '_nameid_format',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'user_email_key'                    => array(
                        ONAPP_FIELD_MAP         => '_user_email_key',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'encrypted_assertion'               => array(
                        ONAPP_FIELD_MAP         => '_encrypted_assertion',
                        ONAPP_FIELD_TYPE        => 'boolean',
                    ),
                    'private_key'                       => array(
                        ONAPP_FIELD_MAP         => '_private_key',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'user_billing_plan_key'             => array(
                        ONAPP_FIELD_MAP         => '_user_billing_plan_key',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'first_name_key'                    => array(
                        ONAPP_FIELD_MAP         => '_first_name_key',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'last_name_key'                     => array(
                        ONAPP_FIELD_MAP         => '_last_name_key',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'locale_key'                        => array(
                        ONAPP_FIELD_MAP         => '_locale_key',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'system_theme_key'                  => array(
                        ONAPP_FIELD_MAP         => '_system_theme_key',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'display_infoboxes_key'             => array(
                        ONAPP_FIELD_MAP         => '_display_infoboxes_key',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'disable_auto_suspend_key'          => array(
                        ONAPP_FIELD_MAP         => '_disable_auto_suspend_key',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'suspend_after_key'                 => array(
                        ONAPP_FIELD_MAP         => '_suspend_after_key',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'suspend_at_key'                    => array(
                        ONAPP_FIELD_MAP         => '_suspend_at_key',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'idp_slo_target_url'                => array(
                        ONAPP_FIELD_MAP         => '_idp_slo_target_url',
                        ONAPP_FIELD_TYPE        => 'string',
                    ), 
                );
                break;
        }
        parent::initFields( $version, __CLASS__ );

        return $this->fields;
    }
    
}
