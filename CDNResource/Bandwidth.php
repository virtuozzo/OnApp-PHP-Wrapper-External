<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * CDN Resource Bandwidth Statistics
 *
 * @category    API wrapper
 * @package     OnApp
 * @subpackage  CDNResource
 * @author      Yakubskiy Yuriy
 * @copyright   © 2012 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */

/**
 * CDN Resource Bandwidth Statistics
 *
 * The OnApp_CDNResource_Bandwidth uses the following basic methods:
 * {@link getList}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */
class OnApp_CDNResource_Bandwidth extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'stat';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'cdn_resources/bandwidth';

    /**
     * API Fields description
     *
     * @param string|float $version   OnApp API version
     * @param string       $className current class' name
     *
     * @return array
     */
    public function initFields( $version = null, $className = '' ) {
        switch( $version ) {
            case '2.0':
            case '2.1':
            case '2.2':
                break;
            case '2.3':
                $this->fields = array(
                    'non_cached' => array(
                        ONAPP_FIELD_MAP       => '_non_cached',
                        ONAPP_FIELD_TYPE      => 'string',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'date'       => array(
                        ONAPP_FIELD_MAP       => '_date',
                        ONAPP_FIELD_TYPE      => 'string',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'cached'     => array(
                        ONAPP_FIELD_MAP       => '_cached',
                        ONAPP_FIELD_TYPE      => 'string',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                );
                $this->fields = $this->initFields( 2.1 );
                break;

            case 3.0:
            case 3.1:
            case 3.2:
            case 3.3:
                $this->fields = $this->initFields( 2.3 );
                break;
        }

        parent::initFields( $version, __CLASS__ );

        return $this->fields;
    }

    /**
     * Sends an API request to get the Objects. After requesting,
     * unserializes the received response into the array of Objects
     *
     * @param array $url_args [start, end, type, resource_type, resources[] ]
     *
     * @return mixed an array of Object instances on success. Otherwise false
     * @access public
     */
    public function getList( $url_args = null ) {
        return parent::getList( null, $url_args );
    }

    /**
     * Activates action performed with object
     *
     * @param string $action_name the name of action
     *
     * @access public
     */
    function activate( $action_name ) {
        switch( $action_name ) {
            case ONAPP_ACTIVATE_LOAD:
            case ONAPP_ACTIVATE_SAVE:
            case ONAPP_ACTIVATE_DELETE:
                exit( 'Call to undefined method ' . __CLASS__ . '::' . $action_name . '()' );
                break;
        }
    }
}