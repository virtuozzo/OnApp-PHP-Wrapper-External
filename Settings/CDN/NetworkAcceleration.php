<?php
/**
 * Managing Settings CDN Network Acceleration
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
 * Managing Settings CDN NetworkAcceleration
 *
 * The OnApp_Settings_CDN_NetworkAcceleration class uses the following basic methods:
 * {@link index}, {@link add}, {@link delete}
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php )
 */

class OnApp_Settings_CDN_NetworkAcceleration extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'network';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'settings/cdn_network_accelerations';

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
                    'id'                        => array(
                        ONAPP_FIELD_MAP         => '_id',
                        ONAPP_FIELD_TYPE        => 'integer',
                        ONAPP_FIELD_READ_ONLY   => true,
                    ),
                    'network_id'                => array(
                        ONAPP_FIELD_MAP         => '_network_id',
                        ONAPP_FIELD_TYPE        => 'integer',
                    ),
                    'label'                     => array(
                        ONAPP_FIELD_MAP         => '_label',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'network_acceleration_id'   => array(
                        ONAPP_FIELD_MAP         => '_network_acceleration_id',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'accelerator_id'            => array(
                        ONAPP_FIELD_MAP         => '_accelerator_id',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                );
                break;
        }
        parent::initFields( $version, __CLASS__ );

        return $this->fields;
    }

    public function save()
    {
        if ( is_null( $this->_network_id ) ) {
            $this->logger->error(
                'save(): argument _network_id not set.',
                __FILE__,
                __LINE__
            );
        }

        $data = array(
            'network_id' => $this->_network_id,
        );

        $data = json_encode($data);

        $this->setAPIResource($this->getResource());

        $response = $this->sendRequest( ONAPP_REQUEST_METHOD_POST, $data );

        $result     = $this->_castResponseToClass( $response );
        $this->_obj = $result;
    }

    /**
     * Activates action performed with object
     *
     * @param string $action_name the name of action
     *
     * @access public
     */
    function activateCheck( $action_name ) {
        switch ( $action_name ) {
            case ONAPP_ACTIVATE_LOAD:
                exit( 'Call to undefined method ' . __CLASS__ . '::' . $action_name . '()' );
                break;
        }
    }

}
