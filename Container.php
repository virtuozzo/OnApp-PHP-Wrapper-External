<?php
/**
 * Managing Containers
 *
 *
 * @category    API wrapper
 * @package     OnApp
 * @author
 * @copyright   © 2017 OnApp
 * @link        http://www.onapp.com/
 * @docs        https://docs.onapp.com/display/42API/Backup+Servers
 * @see         OnApp
 */

define( 'ONAPP_GETRESOURCE_CONTAINERS_CLOUD_CONFIG', 'cloudConfig' );

/**
 * Managing Containers
 *
 *
 * The OnApp_Container class uses the following basic methods:
 * {@link load}, {@link save}, {@link delete}, and {@link getList}.
 *
 * For full fields reference and curl request details visit: ( https://docs.onapp.com/display/42API/Backup+Servers )
 */
//class OnApp_Container extends OnApp {
class OnApp_Container extends OnApp_VirtualMachine {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'container_server';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'container_servers';

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
            case 5.0:
            case 5.1:
            case 5.2:
            case 5.3:
                $this->fields['cloud_config'] = array(
                    ONAPP_FIELD_MAP  => '_cloud_config',
                    ONAPP_FIELD_TYPE => 'string',
                );
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

        return $this->fields;
    }

    function getResource( $action = ONAPP_GETRESOURCE_DEFAULT ) {
        switch ( $action ) {
            case ONAPP_GETRESOURCE_CONTAINERS_CLOUD_CONFIG:
                $resource = $this->getResource( ONAPP_GETRESOURCE_LOAD ) . '/cloud_config';
                break;
            default:
                $resource = parent::getResource( $action );
        }

        return $resource;
    }

    function getCloudConfig() {
        if ( is_null( $this->_id ) ) {
            $this->logger->error(
                'cloudConfig: argument _id not set.',
                __FILE__,
                __LINE__
            );
        }
        $res = $this->sendGet( ONAPP_GETRESOURCE_CONTAINERS_CLOUD_CONFIG );

        return $res;
    }

    function addCloudConfig($cloudConfig) {
        if ( is_null( $this->_id ) ) {
            $this->logger->error(
                'cloudConfig: argument _id not set.',
                __FILE__,
                __LINE__
            );
        }

        $data = array(
            'root' => $this->_tagRoot,
            'data' => array(
                'cloud_config' => $cloudConfig
            ),
        );

        $res = $this->sendPatch( ONAPP_GETRESOURCE_CONTAINERS_CLOUD_CONFIG, $data);

        return $res;
    }

    function editCloudConfig($cloudConfig) {
        if ( is_null( $this->_id ) ) {
            $this->logger->error(
                'cloudConfig: argument _id not set.',
                __FILE__,
                __LINE__
            );
        }

        $data = array(
            'root' => $this->_tagRoot,
            'data' => array(
                'cloud_config' => $cloudConfig
            ),
        );

        $res = $this->sendPut( ONAPP_GETRESOURCE_CONTAINERS_CLOUD_CONFIG, $data);

        return $res;
    }

}