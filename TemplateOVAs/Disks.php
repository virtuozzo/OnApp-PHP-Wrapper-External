<?php
/**
 * Managing TemplateOVAs Disks
 *
 * much they will be charged per unit.
 *
 * @category    API wrapper
 * @package     OnApp
 * @author      Mykola Vuy
 * @copyright   © 2019 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */

/**
 * Managing TemplateOVAs Disks
 *
 * The OnApp_TemplateOVAs_Disks class uses the following basic methods:
 * {@link getList}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php )
 */
class OnApp_TemplateOVAs_Disks extends OnApp
{
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'image_template_disk';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'disks';

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
            case 6.1:
                $this->fields = array(
                    'id'                        => array(
                        ONAPP_FIELD_MAP           => '_id',
                        ONAPP_FIELD_TYPE          => 'integer',
                        ONAPP_FIELD_READ_ONLY     => true,
                    ),
                    'identifier'                => array(
                        ONAPP_FIELD_MAP           => '_identifier',
                        ONAPP_FIELD_TYPE          => 'string',
                    ),
                    'template_id'               => array(
                        ONAPP_FIELD_MAP           => '_template_id',
                        ONAPP_FIELD_TYPE          => 'integer',
                        ONAPP_FIELD_READ_ONLY     => true,
                    ),
                    'disk_size'                 => array(
                        ONAPP_FIELD_MAP           => '_disk_size',
                        ONAPP_FIELD_TYPE          => 'integer',
                    ),
                    'disk_type'                 => array(
                        ONAPP_FIELD_MAP           => '_disk_type',
                        ONAPP_FIELD_TYPE          => 'integer',
                    ),
                    'mount_point'               => array(
                        ONAPP_FIELD_MAP           => '_mount_point',
                        ONAPP_FIELD_TYPE          => 'string',
                    ),
                    'label'                     => array(
                        ONAPP_FIELD_MAP           => '_label',
                        ONAPP_FIELD_TYPE          => 'string',
                    ),
                    'file_system'               => array(
                        ONAPP_FIELD_MAP           => '_file_system',
                        ONAPP_FIELD_TYPE          => 'string',
                    ),
                    'mounted'                   => array(
                        ONAPP_FIELD_MAP           => '_mounted',
                        ONAPP_FIELD_TYPE          => 'boolean',
                    ),
                    'created_at'      => array(
                        ONAPP_FIELD_MAP       => '_created_at',
                        ONAPP_FIELD_TYPE      => 'datetime',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'updated_at'      => array(
                        ONAPP_FIELD_MAP       => '_updated_at',
                        ONAPP_FIELD_TYPE      => 'datetime',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                );
                break;

            case 6.2:
                $this->fields = $this->initFields( 6.1 );
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
        $show_log_msg = true;
        switch ( $action ) {
            case ONAPP_GETRESOURCE_DEFAULT:
                /**
                 * ROUTE :
                 *
                 * @name TemplateOVAs_Disks
                 * @method GET
                 * @alias   /template_ovas/:template_id/disks(.:format)
                 * @format  {:controller=>"base_resources", :action=>"index"}
                 */
                if ( is_null( $this->_template_id ) && is_null( $this->_obj->_template_id ) ) {
                    $this->logger->error(
                        'getResource( ' . $action . ' ): argument _id not set.',
                        __FILE__,
                        __LINE__
                    );
                } else {
                    if ( is_null( $this->_template_id ) ) {
                        $this->_template_id = $this->_obj->_template_id;
                    }
                }
                $resource = 'template_ovas/' . $this->_template_id . '/' . $this->_resource;
                break;

            default:
                $resource     = parent::getResource( $action );
                $show_log_msg = false;
                break;
        }

        if ( $show_log_msg ) {
            $this->logger->debug( 'getResource( ' . $action . ' ): return ' . $resource );
        }

        return $resource;
    }

    /**
     * Activates action performed with object
     *
     * @param string $action_name the name of action
     *
     * @access public
     */
    public function activateCheck( $action_name ) {
        switch ( $action_name ) {
            case ONAPP_ACTIVATE_LOAD:
            case ONAPP_ACTIVATE_SAVE:
            case ONAPP_ACTIVATE_DELETE:
                exit( 'Call to undefined method ' . __CLASS__ . '::' . $action_name . '()' );
                break;
        }
    }
}