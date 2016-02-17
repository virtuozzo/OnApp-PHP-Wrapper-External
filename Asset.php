<?php
/**
 * Managing Asset
 *
 *
 * @category    API wrapper
 * @package     OnApp
 * @author
 * @copyright   © 2016 OnApp
 * @link        http://www.onapp.com/
 * @docs        https://docs.onapp.com/display/42API/Assets
 * @see         OnApp
 */

/**
 *
 */
define( 'ONAPP_GETRESOURCE_ASSETS_GET_UNASSIGNED', 'assets_get_unassigned' );

/**
 * Managing Asset
 *
 *
 * The Availability class uses the following basic methods:
 * {@link load}, {@link save}, {@link delete}, and {@link getList}.
 *
 * For full fields reference and curl request details visit: ( https://docs.onapp.com/display/42API/Assets )
 */
class OnApp_Asset extends OnApp_Hypervisor {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'asset';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'settings/assets';

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
                $this->fields['ip']    = array(
                    ONAPP_FIELD_MAP  => '_ip',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['disks'] = array(
                    ONAPP_FIELD_MAP  => '_disks',
                    ONAPP_FIELD_TYPE => 'array',
                );
                $this->fields['nics']  = array(
                    ONAPP_FIELD_MAP  => '_nics',
                    ONAPP_FIELD_TYPE => 'array',
                );
                $this->fields['pcis']  = array(
                    ONAPP_FIELD_MAP  => '_pcis',
                    ONAPP_FIELD_TYPE => 'array',
                );
                break;
        }


        return $this->fields;
    }

    function getResource( $action = ONAPP_GETRESOURCE_DEFAULT ) {
        switch ( $action ) {
            case ONAPP_GETRESOURCE_ASSETS_GET_UNASSIGNED:
                /**
                 * @alias   hypervisors/not_grouped.json
                 */
                $resource = 'hypervisors/not_grouped';
                break;

            default:
                /**
                 * @alias   /settings/assets/:asset_mac_address.json
                 */
                $resource = parent::getResource( $action );
                break;
        }

        return $resource;

    }

    function getListUnassigned() {

        $tagRootOld = $this->_tagRoot;
        $this->_tagRoot = 'hypervisor';
        $result = $this->sendGet( ONAPP_GETRESOURCE_ASSETS_GET_UNASSIGNED );
        $this->_tagRoot = $tagRootOld;

        if ( ! is_null( $this->getErrorsAsArray() ) ) {
            return false;
        } else {
            if ( ! is_array( $result ) && ! is_null( $result ) ) {
                $result = array( $result );
            }

            return $result;
        }
    }


}