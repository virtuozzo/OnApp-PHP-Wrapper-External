<?php
/**
 * Managing High Availability Host
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
 * Managing High Availability Host
 *
 *
 * The Availability class uses the following basic methods:
 * {@link load}, {@link save}, {@link delete}, and {@link getList}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */
class OnApp_Availability_Host extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'availability_host';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'settings/availability/hosts';

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
                    'host_id'    => array(
                        ONAPP_FIELD_MAP  => '_host_id',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'id'         => array(
                        ONAPP_FIELD_MAP  => '_id',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'interface'  => array(
                        ONAPP_FIELD_MAP  => '_interface',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'ip_address' => array(
                        ONAPP_FIELD_MAP  => '_ip_address',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'priority'   => array(
                        ONAPP_FIELD_MAP  => '_priority',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'state'      => array(
                        ONAPP_FIELD_MAP  => '_state',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'updated_at' => array(
                        ONAPP_FIELD_MAP       => '_updated_at',
                        ONAPP_FIELD_TYPE      => 'datetime',
                        ONAPP_FIELD_READ_ONLY => true
                    ),
                    'hostname'   => array(
                        ONAPP_FIELD_MAP  => '_hostname',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'cluster_id' => array(
                        ONAPP_FIELD_MAP  => '_cluster_id',
                        ONAPP_FIELD_TYPE => 'integer',
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
                 * @alias  /settings/availability/hosts/:id.json
                 */
                $resource = parent::getResource( $action );
        }

        return $resource;
    }

    public function getNodeList($id = null) {
        if( !is_null( $id ) ) {
            $this->_id = $id;
        }

        $oldTagRoot = $this->_tagRoot;
        $this->_tagRoot = 'availability_node';
        $result = $this->sendGet( ONAPP_GETRESOURCE_LOAD );
        $this->_tagRoot = $oldTagRoot;

        if( ! is_null( $this->getErrorsAsArray() ) ) {
            return false;
        }
        else {
            if( ! is_array( $result ) && ! is_null( $result ) ) {
                $result = array( $result );
            }

            return $result;
        }
    }

}