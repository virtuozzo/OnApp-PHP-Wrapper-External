<?php
/**
 * Managing OrchestrationModel Network
 *
 *
 * @category    API wrapper
 * @package     OnApp
 * @author
 * @copyright   © 2016 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */


/**
 * OrchestrationModel Network
 *
 */
class OnApp_OrchestrationModel_Network extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'networks_to_create';

    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'networks';

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
            case 4.2:
            case 4.3:
            case 5.0:
                $this->fields = array(
                    'name'                   => array(
                        ONAPP_FIELD_MAP  => '_name',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'type'                     => array(
                        ONAPP_FIELD_MAP  => '_type',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'network_address'                     => array(
                        ONAPP_FIELD_MAP  => '_network_address',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'dns'                 => array(
                        ONAPP_FIELD_MAP  => '_dns',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                );
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

}