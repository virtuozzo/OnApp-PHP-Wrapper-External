<?php
/**
 * Managing Currencies
 *
 *
 * @category    API wrapper
 * @package     OnApp
 * @author
 * @copyright   © 2016 OnApp
 * @link        http://www.onapp.com/
 * @docs        https://docs.onapp.com/display/42API/Currencies
 * @see         OnApp
 */

/**
 * Managing Currencies
 *
 *
 * The Availability class uses the following basic methods:
 * {@link load}, {@link save}, {@link delete}, and {@link getList}.
 *
 * For full fields reference and curl request details visit: ( https://docs.onapp.com/display/42API/Currencies )
 */
class OnApp_Currency extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'currency';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'settings/currencies';

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
                    'name' => array(
                        ONAPP_FIELD_MAP  => '_name',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'format' => array(
                        ONAPP_FIELD_MAP  => '_format',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'created_at' => array(
                        ONAPP_FIELD_MAP  => '_created_at',
                        ONAPP_FIELD_TYPE => 'datetime',
                    ),
                    'updated_at' => array(
                        ONAPP_FIELD_MAP  => '_updated_at',
                        ONAPP_FIELD_TYPE => 'datetime',
                    ),
                    'code'  => array(
                        ONAPP_FIELD_MAP  => '_code',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'id'  => array(
                        ONAPP_FIELD_MAP  => '_id',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'unit'  => array(
                        ONAPP_FIELD_MAP  => '_unit',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'separator'  => array(
                        ONAPP_FIELD_MAP  => '_separator',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'precision'  => array(
                        ONAPP_FIELD_MAP  => '_precision',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'precision_for_unit'  => array(
                        ONAPP_FIELD_MAP  => '_precision_for_unit',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'delimiter'  => array(
                        ONAPP_FIELD_MAP  => '_delimiter',
                        ONAPP_FIELD_TYPE => 'string',
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
                 * @alias  /settings/currencies/:id.json
                 */
                $resource = parent::getResource( $action );
        }

        return $resource;
    }

}