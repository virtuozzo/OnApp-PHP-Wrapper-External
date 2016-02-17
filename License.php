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
 * To view the list of public ISOs
 */
define('ONAPP_GET_LIST_PUBLIC_ISO', 'public');

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
    public function initFields($version = null, $className = '') {

        switch ($version) {
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
                    'core_limit' => array(
                        ONAPP_FIELD_MAP => '_core_limit',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'key' => array(
                        ONAPP_FIELD_MAP => '_key',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'status' => array(
                        ONAPP_FIELD_MAP => '_status',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'supplier_allowed' => array(
                        ONAPP_FIELD_MAP => '_supplier_allowed',
                        ONAPP_FIELD_TYPE => 'boolean',
                    ),
                    'supplier_status' => array(
                        ONAPP_FIELD_MAP => '_supplier_status',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'trader_allowed' => array(
                        ONAPP_FIELD_MAP => '_trader_allowed',
                        ONAPP_FIELD_TYPE => 'boolean',
                    ),
                    'trader_status' => array(
                        ONAPP_FIELD_MAP => '_trader_status',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'type' => array(
                        ONAPP_FIELD_MAP => '_type',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'valid' => array(
                        ONAPP_FIELD_MAP => '_valid',
                        ONAPP_FIELD_TYPE => 'boolean',
                    ),
                );
                break;
        }

        parent::initFields($version, __CLASS__);
        return $this->fields;
    }

    function getResource($action = ONAPP_GETRESOURCE_DEFAULT)  {
        switch ($action) {
            case ONAPP_GET_LIST_PUBLIC_ISO :
                /**
                 * ROUTE :
                 *
                 * @name template_isos
                 * @method PUT
                 * @alias  /settings(.:format)
                 * @format {:action=>"index", :controller=>"system"}
                 */
                $resource = $this->_resource . '/system';
                break;
            default:
                $resource = parent::getResource($action);
                break;
        }

        return $resource;
    }

    public function makeISOPublic() {
        return $this->sendPost(ONAPP__MAKE_ISO_PUBLIC);
    }
}
