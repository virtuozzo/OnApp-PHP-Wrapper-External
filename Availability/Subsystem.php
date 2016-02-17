<?php
/**
 * Managing High Availability Subsystems
 *
 *
 * @category    API wrapper
 * @package     OnApp
 * @author
 * @copyright   © 2016 OnApp
 * @link        http://www.onapp.com/
 * @docs        https://docs.onapp.com/display/42API/High+Availability+Control+Panel
 * @see         OnApp
 */

/**
 * Managing High Availability Subsystems
 *
 *
 * The Availability class uses the following basic methods:
 * {@link load}, {@link save}, {@link delete}, and {@link getList}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */
class OnApp_Availability_Subsystem extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'object';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'sysadmin_tools/infrastructure/services';

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
                    'node_name' => array(
                        ONAPP_FIELD_MAP  => '_node_name',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'services'          => array(
                        ONAPP_FIELD_MAP       => '_services',
                        ONAPP_FIELD_TYPE      => 'array',
                        ONAPP_FIELD_CLASS     => 'OnApp_Availability_Subsystem_Service',
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
                 * @alias  /sysadmin_tools/infrastructure/services.json
                 */
                $resource = parent::getResource( $action );
        }

        return $resource;
    }

}