<?php
/**
 * Managing High Availability Communication Interfaces
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
 * Managing High Availability Communication Interfaces
 *
 *
 * The Availability class uses the following basic methods:
 * {@link load}, {@link save}, {@link delete}, and {@link getList}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */
class OnApp_Availability_CommunicationInterface extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'communication_interface';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'settings/availability/communication_interfaces';

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
                    'bindnetaddr' => array(
                        ONAPP_FIELD_MAP  => '_bindnetaddr',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'id'          => array(
                        ONAPP_FIELD_MAP  => '_id',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'mcastaddr'   => array(
                        ONAPP_FIELD_MAP  => '_mcastaddr',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'mcastport'   => array(
                        ONAPP_FIELD_MAP  => '_mcastport',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'state'       => array(
                        ONAPP_FIELD_MAP  => '_state',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'ttl'         => array(
                        ONAPP_FIELD_MAP  => '_ttl',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                );
                break;
            case 4.3:
                $this->fields = $this->initFields( 4.2 );
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
                $this->fields = $this->initFields( 5.4 );
                break;
            case 6.0:
                $this->fields = $this->initFields( 5.5 );
                break;
        }

        parent::initFields( $version, __CLASS__ );

        return $this->fields;
    }

    function getResource( $action = ONAPP_GETRESOURCE_DEFAULT ) {
        switch ( $action ) {
            default:
                /**
                 * @alias  /settings/availability/communication_interfaces/:id.json
                 */
                $resource = parent::getResource( $action );
        }

        return $resource;
    }

}