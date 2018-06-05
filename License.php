<?php

/**
 * License
 *
 * @category    API wrapper
 * @package     OnApp
 * @author      Ivan Gavryliuk
 * @copyright   © 2016 OnApp
 * @link        https://docs.onapp.com/display/42API/License
 * @see         OnApp
 */

/**
 * License
 *
 * The OnApp_License class uses the following basic methods:
 * {@link load}, {@link save}, {@link delete}, and {@link getList}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */
class OnApp_License extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'license';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'settings/license';

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
                    'core_limit'       => array(
                        ONAPP_FIELD_MAP  => '_core_limit',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'key'              => array(
                        ONAPP_FIELD_MAP  => '_key',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'status'           => array(
                        ONAPP_FIELD_MAP  => '_status',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'supplier_allowed' => array(
                        ONAPP_FIELD_MAP  => '_supplier_allowed',
                        ONAPP_FIELD_TYPE => 'boolean',
                    ),
                    'supplier_status'  => array(
                        ONAPP_FIELD_MAP  => '_supplier_status',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'trader_allowed'   => array(
                        ONAPP_FIELD_MAP  => '_trader_allowed',
                        ONAPP_FIELD_TYPE => 'boolean',
                    ),
                    'trader_status'    => array(
                        ONAPP_FIELD_MAP  => '_trader_status',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'type'             => array(
                        ONAPP_FIELD_MAP  => '_type',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'valid'            => array(
                        ONAPP_FIELD_MAP  => '_valid',
                        ONAPP_FIELD_TYPE => 'boolean',
                    ),
                );
                break;
            case 4.3:
            case 5.0:
                $this->fields = $this->initFields( 4.2 );
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
                $this->fields['kvm_xen_hv_limit'] = array(
                    ONAPP_FIELD_MAP   => '_kvm_xen_hv_limit',
                    ONAPP_FIELD_TYPE  => 'string',
                );
                $this->fields['kvm_xen_vm_limit']         = array(
                    ONAPP_FIELD_MAP   => '_kvm_xen_vm_limit',
                    ONAPP_FIELD_TYPE  => 'string',
                );
                $this->fields['vcenter_vm_limit']         = array(
                    ONAPP_FIELD_MAP   => '_vcenter_vm_limit',
                    ONAPP_FIELD_TYPE  => 'string',
                );
                $this->fields['kvm_xen_core_limit']       = array(
                    ONAPP_FIELD_MAP   => '_kvm_xen_core_limit',
                    ONAPP_FIELD_TYPE  => 'string',
                );
                $this->fields['vcenter_core_limit']       = array(
                    ONAPP_FIELD_MAP   => '_vcenter_core_limit',
                    ONAPP_FIELD_TYPE  => 'string',
                );
                $this->fields['integrated_storage_limit'] = array(
                    ONAPP_FIELD_MAP   => '_integrated_storage_limit',
                    ONAPP_FIELD_TYPE  => 'string',
                );
                break;
        }

        parent::initFields( $version, __CLASS__ );

        return $this->fields;
    }

    function getResource( $action = ONAPP_GETRESOURCE_DEFAULT ) {
        switch ( $action ) {
            case ONAPP_GETRESOURCE_EDIT :
                /**
                 * ROUTE :
                 *
                 * @name template_isos
                 * @method PUT
                 * @alias  /settings(.:format)
                 * @format {:action=>"index", :controller=>"system"}
                 */
                $resource = '/settings';
                break;
            default:
                $resource = parent::getResource( $action );
                break;
        }

        return $resource;
    }

    public function save() {
        $this->activateCheck( ONAPP_ACTIVATE_SAVE );

        $obj = $this->_edit();

        //todo handle errors
        if ( isset( $obj ) && ! isset( $obj->errors ) ) {
            $this->load();
        }
    }

    function activateCheck( $action_name ) {
        switch ( $action_name ) {
            case ONAPP_ACTIVATE_DELETE:
                exit( 'Call to undefined method ' . __CLASS__ . '::' . $action_name . '()' );
                break;
        }
    }
}
