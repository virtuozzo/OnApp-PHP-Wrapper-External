<?php
/**
 * Managing VDCS DataStore
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
 * VDCS DataStore
 *
 */
class OnApp_VDCS_DataStore extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'data_store';

    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'data_stores';

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
                $this->fields = array(
                    '_id' => array(
                        ONAPP_FIELD_MAP       => '_id',
                        ONAPP_FIELD_TYPE      => 'string',
                    ),
                    'vdcs_id' => array(
                        ONAPP_FIELD_MAP       => '_vdcs_id',
                        ONAPP_FIELD_TYPE      => 'string',
                    ),
                    'data_store_group_id'          => array(
                        ONAPP_FIELD_MAP       => '_data_store_group_id',
                        ONAPP_FIELD_TYPE      => 'string',
                    ),
                    'data_store_size'          => array(
                        ONAPP_FIELD_MAP       => '_data_store_size',
                        ONAPP_FIELD_TYPE      => 'string',
                    ),
                    'data_store_type'          => array(
                        ONAPP_FIELD_MAP       => '_data_store_type',
                        ONAPP_FIELD_TYPE      => 'string',
                    ),
                    'enabled'          => array(
                        ONAPP_FIELD_MAP       => '_enabled',
                        ONAPP_FIELD_TYPE      => 'boolean',
                    ),
                );
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
                $this->fields['default']    = array(
                    ONAPP_FIELD_MAP  => '_default',
                    ONAPP_FIELD_TYPE => 'string',
                );
                break;
        }

        parent::initFields( $version, __CLASS__ );

        return $this->fields;
    }

    function getResource( $action = ONAPP_GETRESOURCE_DEFAULT ) {
        switch ( $action ) {
            case ONAPP_GETRESOURCE_DEFAULT:
                if ( is_null( $this->_vdcs_id ) && is_null( $this->_obj->vdcs_id ) ) {
                    $this->logger->error(
                        "getResource($action): argument vdcs_id not set.",
                        __FILE__,
                        __LINE__
                    );
                } else {
                    if ( is_null( $this->vdcs_id ) ) {
                        $this->vdcs_id = $this->_obj->vdcs_id;
                    }
                }
                $resource = 'vdcs/' . $this->vdcs_id . '/' . $this->_resource;
                $this->logger->debug( 'getResource( ' . $action . ' ): return ' . $resource );
                break;
            default:
                $resource = parent::getResource( $action );
                break;
        }

        return $resource;
    }

    function activateCheck( $action_name ) {
        switch ( $action_name ) {
            case ONAPP_GETRESOURCE_LIST:
                exit( 'Call to undefined method ' . __CLASS__ . '::' . $action_name . '()' );
                break;
        }
    }

}