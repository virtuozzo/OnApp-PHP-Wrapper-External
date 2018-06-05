<?php
/**
 * VM Custom Variables Attribute
 *
 * @category    API wrapper
 * @package     OnApp
 * @subpackage  VirtualMachine
 * @author
 * @copyright   © 2017 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */

/**
 * VM Custom Variables Attribute
 *
 * The OnApp_VirtualMachine_CustomVariablesAttribute class doesn't support any basic method.
 *
 */
class OnApp_VirtualMachine_CustomVariablesAttribute extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    //var $_tagRoot = '';
    /**
     * alias processing the object data
     *
     * @var string
     */
    //var $_resource = '';

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
            case '2.0':
            case '2.1':
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
            case 4.3:
            case 5.0:
            case 5.1:
            case 5.2:
            case 5.3:
                $this->fields = array(
                    'id'      => array(
                        ONAPP_FIELD_MAP  => '_id',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'enabled' => array(
                        ONAPP_FIELD_MAP  => '_enabled',
                        ONAPP_FIELD_TYPE => 'boolean',
                    ),
                    'name'    => array(
                        ONAPP_FIELD_MAP  => '_name',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'value'   => array(
                        ONAPP_FIELD_MAP  => '_value',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
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

        parent::initFields( $version, __CLASS__ );

        return $this->fields;
    }

    /**
     * Returns the URL Alias of the API Class that inherits the OnApp class
     *
     * @param string $action action name
     *
     * @return string API resource
     * @access public
     */
    function getResource( $action = ONAPP_GETRESOURCE_DEFAULT ) {
        switch ( $action ) {
            default:
                $resource = parent::getResource( $action );
                break;
        }

        return $resource;
    }

}
