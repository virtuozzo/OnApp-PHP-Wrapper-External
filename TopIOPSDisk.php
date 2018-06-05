<?php
/**
 * Managing Top IOPS Disks
 *
 *
 * @category    API wrapper
 * @package     OnApp
 * @author      Ivan Gavryliuk
 * @copyright   © 2016 OnApp
 * @docs        https://docs.onapp.com/display/43API/Get+TOP+IOPS+Disks
 * @see         OnApp
 */

/**
 * Managing Top IOPS Disks
 *
 *
 * The OnApp_TopIOPSDisk class use methods {@link getList}
 *
 * For full fields reference and curl request details visit: ( https://docs.onapp.com/display/43API/Get+TOP+IOPS+Disks )
 */
class OnApp_TopIOPSDisk extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'table';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'top_iops_statistics';

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
                    'disk_id' => array(
                        ONAPP_FIELD_MAP  => '_disk_id',
                        ONAPP_FIELD_TYPE => 'integer'
                    ),
                    'reads_completed' => array(
                        ONAPP_FIELD_MAP  => '_reads_completed',
                        ONAPP_FIELD_TYPE => 'integer'
                    ),
                    'writes_completed' => array(
                        ONAPP_FIELD_MAP  => '_writes_completed',
                        ONAPP_FIELD_TYPE => 'integer'
                    ),
                    'total_iops' => array(
                        ONAPP_FIELD_MAP  => '_total_iops',
                        ONAPP_FIELD_TYPE => 'integer'
                    ),
                    'disk' => array(
                        ONAPP_FIELD_MAP  => '_disk',
                        ONAPP_FIELD_TYPE => 'array'
                    ),
                );
                break;
            case 4.3:
            case 5.0:
                $this->fields = $this->initFields( 4.2 );
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


        return $this->fields;
    }

    function getResource( $action = ONAPP_GETRESOURCE_DEFAULT ) {
        return parent::getResource( $action );
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
            case ONAPP_ACTIVATE_SAVE:
            case ONAPP_ACTIVATE_DELETE:
                exit( 'Call to undefined method ' . __CLASS__ . '::' . $action_name . '()' );
                break;
        }
    }
}