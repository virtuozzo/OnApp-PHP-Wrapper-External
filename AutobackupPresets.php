<?php
/**
 * Managing Auto-backup Presets
 *
 *
 * @category    API wrapper
 * @package     OnApp
 * @author
 * @copyright   © 2016 OnApp
 * @link        http://www.onapp.com/
 * @docs        https://docs.onapp.com/display/42API/Auto-backup+Presets
 * @see         OnApp
 */

/**
 * Managing Auto-backup Presets
 *
 *
 * The Availability class uses the following basic methods:
 * {@link load}, {@link save}, {@link delete}, and {@link getList}.
 *
 * For full fields reference and curl request details visit: ( https://docs.onapp.com/display/42API/Auto-backup+Presets )
 */
class OnApp_AutobackupPresets extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'autobackup_template';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'settings/autobackup_presets';

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
                    'period' => array(
                        ONAPP_FIELD_MAP  => '_period',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'id'  => array(
                        ONAPP_FIELD_MAP  => '_id',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'duration'  => array(
                        ONAPP_FIELD_MAP  => '_duration',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'rotation_period'  => array(
                        ONAPP_FIELD_MAP  => '_rotation_period',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'enabled'  => array(
                        ONAPP_FIELD_MAP  => '_enabled',
                        ONAPP_FIELD_TYPE => 'boolean',
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
                 * @alias  /settings/autobackup_presets/:id.json
                 */
                $resource = parent::getResource( $action );
        }

        return $resource;
    }

}