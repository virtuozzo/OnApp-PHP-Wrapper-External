<?php
/**
 * Template OVAs
 **
 * @category    API wrapper
 * @package     OnApp
 * @author      Ivan Gavryliuk
 * @copyright   © 2016 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */

/**
 * Template OVAs
 *
 * This class represents the Template OVAs of the OnApp installation that you can build VMs on.
 *
 * The OnApp_TemplateOVA class uses the following basic methods:
 * {@link load}, {@link delete}, and {@link getList}.
 *
 */

/*
 * To view the list of system OVAs
 * */
define( 'ONAPP_GETRESOURCE_SYSTEM', 'system' );

/*
 * To view the list of own OVAs
 * */
define( 'ONAPP_GETRESOURCE_OWN', 'own' );

/*
 * To view the list of user OVAs
 * */
define( 'ONAPP_GETRESOURCE_USER', 'user' );

/*
 * To make an OVA public
 * */
define( 'ONAPP_MAKE_PUBLIC', 'make_public' );

/*
 * To delete OVA files
 * */
define( 'ONAPP_DELETE_FILES', 'delete_files' );

/*
 * To unlock OVA files
 * */
define( 'ONAPP_UNLOCK_OVA', 'unlock_ova' );

/*
 * To convert the OVA template into a virtualization format
 * */
define('ONAPP_CONVERTING', 'converting');


class OnApp_TemplateOVA extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'image_template_ova';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'template_ovas';

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
            case 5.2:
                $this->fields                                 = array();
                $this->fields['allow_resize_without_reboot']  = array(
                    ONAPP_FIELD_MAP  => '_allow_resize_without_reboot',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['allowed_hot_migrate']          = array(
                    ONAPP_FIELD_MAP  => '_allowed_hot_migrate',
                    ONAPP_FIELD_TYPE => 'boolean',
                );
                $this->fields['allowed_swap']                 = array(
                    ONAPP_FIELD_MAP  => '_allowed_swap',
                    ONAPP_FIELD_TYPE => 'boolean',
                );
                $this->fields['application_server']           = array(
                    ONAPP_FIELD_MAP  => '_application_server',
                    ONAPP_FIELD_TYPE => 'boolean',
                );
                $this->fields['backup_server_id']             = array(
                    ONAPP_FIELD_MAP  => '_backup_server_id',
                    ONAPP_FIELD_TYPE => 'integer',
                );
                $this->fields['baremetal_server']             = array(
                    ONAPP_FIELD_MAP  => '_baremetal_server',
                    ONAPP_FIELD_TYPE => 'boolean',
                );
                $this->fields['cdn']                          = array(
                    ONAPP_FIELD_MAP  => '_cdn',
                    ONAPP_FIELD_TYPE => 'boolean',
                );
                $this->fields['checksum']                     = array(
                    ONAPP_FIELD_MAP  => '_checksum',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['created_at']                   = array(
                    ONAPP_FIELD_MAP  => '_created_at',
                    ONAPP_FIELD_TYPE => 'datetime',
                );
                $this->fields['disk_target_device']           = array(
                    ONAPP_FIELD_MAP  => '_disk_target_device',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['draas']                        = array(
                    ONAPP_FIELD_MAP  => '_draas',
                    ONAPP_FIELD_TYPE => 'boolean',
                );
                $this->fields['ext4']                         = array(
                    ONAPP_FIELD_MAP  => '_ext4',
                    ONAPP_FIELD_TYPE => 'boolean',
                );
                $this->fields['file_name']                    = array(
                    ONAPP_FIELD_MAP  => '_file_name',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['id']                           = array(
                    ONAPP_FIELD_MAP  => '_id',
                    ONAPP_FIELD_TYPE => 'integer',
                );
                $this->fields['initial_password']             = array(
                    ONAPP_FIELD_MAP  => '_initial_password',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['initial_username']             = array(
                    ONAPP_FIELD_MAP  => '_initial_username',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['label']                        = array(
                    ONAPP_FIELD_MAP  => '_label',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['manager_id']                   = array(
                    ONAPP_FIELD_MAP  => '_manager_id',
                    ONAPP_FIELD_TYPE => 'integer',
                );
                $this->fields['min_disk_size']                = array(
                    ONAPP_FIELD_MAP  => '_min_disk_size',
                    ONAPP_FIELD_TYPE => 'integer',
                );
                $this->fields['min_memory_size']              = array(
                    ONAPP_FIELD_MAP  => '_min_memory_size',
                    ONAPP_FIELD_TYPE => 'integer',
                );
                $this->fields['operating_system']             = array(
                    ONAPP_FIELD_MAP  => '_operating_system',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['operating_system_arch']        = array(
                    ONAPP_FIELD_MAP  => '_operating_system_arch',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['operating_system_distro']      = array(
                    ONAPP_FIELD_MAP  => '_operating_system_distro',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['operating_system_edition']     = array(
                    ONAPP_FIELD_MAP  => '_operating_system_edition',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['operating_system_tail']        = array(
                    ONAPP_FIELD_MAP  => '_operating_system_tail',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['parent_template_id']           = array(
                    ONAPP_FIELD_MAP  => '_parent_template_id',
                    ONAPP_FIELD_TYPE => 'integer',
                );
                $this->fields['properties']                   = array(
                    ONAPP_FIELD_MAP  => '_properties',
                    ONAPP_FIELD_TYPE => 'array',
                );
                $this->fields['remote_id']                    = array(
                    ONAPP_FIELD_MAP  => '_remote_id',
                    ONAPP_FIELD_TYPE => 'integer',
                );
                $this->fields['resize_without_reboot_policy'] = array(
                    ONAPP_FIELD_MAP  => '_resize_without_reboot_policy',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['smart_server']                 = array(
                    ONAPP_FIELD_MAP  => '_smart_server',
                    ONAPP_FIELD_TYPE => 'boolean',
                );
                $this->fields['state']                        = array(
                    ONAPP_FIELD_MAP  => '_state',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['template_size']                = array(
                    ONAPP_FIELD_MAP  => '_template_size',
                    ONAPP_FIELD_TYPE => 'integer',
                );
                $this->fields['updated_at']                   = array(
                    ONAPP_FIELD_MAP  => '_updated_at',
                    ONAPP_FIELD_TYPE => 'datetime',
                );
                $this->fields['user_id']                      = array(
                    ONAPP_FIELD_MAP  => '_user_id',
                    ONAPP_FIELD_TYPE => 'integer',
                );
                $this->fields['version']                      = array(
                    ONAPP_FIELD_MAP  => '_version',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['virtualization']               = array(
                    ONAPP_FIELD_MAP  => '_virtualization',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['type']                         = array(
                    ONAPP_FIELD_MAP  => '_type',
                    ONAPP_FIELD_TYPE => 'array',
                );
                $this->fields['file_url']                         = array(
                    ONAPP_FIELD_MAP  => '_file_url',
                    ONAPP_FIELD_TYPE => 'string',
                );
                break;
            case 5.3:
                $this->fields = $this->initFields( 5.2 );
                $this->fields['locked'] = array(
                    ONAPP_FIELD_MAP  => '_locked',
                    ONAPP_FIELD_TYPE => 'boolean',
                );
                break;
            case 5.4:
                $this->fields = $this->initFields( 5.3 );
                $this->fields['openstack_id'] = array(
                    ONAPP_FIELD_MAP  => '_openstack_id',
                    ONAPP_FIELD_TYPE => 'string',
                );
                break;
            case 5.5:
                $this->fields = $this->initFields( 5.4 );
                $fields       = array(
                    'min_disk_size',
                );
                $this->unsetFields( $fields );
                break;
            case 6.0:
                $this->fields = $this->initFields( 5.5 );
                $this->fields['make_public']                 = array(
                    ONAPP_FIELD_MAP  => '_make_public',
                    ONAPP_FIELD_TYPE => 'boolean',
                );
                break;
        }

        parent::initFields( $version, __CLASS__ );

        return $this->fields;
    }

    function getResource( $action = ONAPP_GETRESOURCE_DEFAULT ) {
        switch ( $action ) {
            case ONAPP_GETRESOURCE_SYSTEM:
                /**
                 * ROUTE :
                 *
                 * @name template_ovas
                 * @method GET
                 * @alias   /template_ovas/system(.:format)
                 * @format  {:controller=>"system", :action=>"index"}
                 */
                $resource = $this->_resource . '/system';
                break;
            case ONAPP_GETRESOURCE_OWN:
                /**
                 * ROUTE :
                 *
                 * @name template_ovas
                 * @method GET
                 * @alias   /template_ovas/own(.:format)
                 * @format  {:controller=>"own", :action=>"index"}
                 */
                $resource = $this->_resource . '/own';
                break;
            case ONAPP_GETRESOURCE_USER:
                /**
                 * ROUTE :
                 *
                 * @name template_ovas
                 * @method GET
                 * @alias   /template_ovas/user(.:format)
                 * @format  {:controller=>"user", :action=>"index"}
                 */
                $resource = $this->_resource . '/user';
                break;

            case ONAPP_MAKE_PUBLIC:
                /**
                 * ROUTE :
                 *
                 * @name template_ovas
                 * @method GET
                 * @alias   /template_ovas/:id/make_public(.:format)
                 * @format  {:controller=>"user", :action=>"index"}
                 */

                if ( is_null( $this->_id ) && is_null( $this->_obj->_id ) ) {
                    $this->logger->error(
                        'getResource( ' . $action . ' ): argument _id not set.',
                        __FILE__,
                        __LINE__
                    );
                } else {
                    if ( is_null( $this->_id ) ) {
                        $this->_id = $this->_obj->_id;
                    }
                }
                $resource = $this->_resource . '/' .$this->_id .'/make_public';
                break;

            case ONAPP_DELETE_FILES:
                /**
                 * ROUTE :
                 *
                 * @name template_ovas
                 * @method GET
                 * @alias   /template_ovas/:id/delete_files(.:format)
                 * @format  {:controller=>"user", :action=>"index"}
                 */

                if ( is_null( $this->_id ) && is_null( $this->_obj->_id ) ) {
                    $this->logger->error(
                        'getResource( ' . $action . ' ): argument _id not set.',
                        __FILE__,
                        __LINE__
                    );
                } else {
                    if ( is_null( $this->_id ) ) {
                        $this->_id = $this->_obj->_id;
                    }
                }
                $resource = $this->_resource . '/' .$this->_id .'/delete_files';
                break;

            case ONAPP_UNLOCK_OVA:
                /**
                 * ROUTE :
                 *
                 * @name template_ovas
                 * @method POST
                 * @alias   /template_ovas/:id/unlock.json(.:format)
                 * @format  {:controller=>"user", :action=>"index"}
                 */

                if ( is_null( $this->_id ) && is_null( $this->_obj->_id ) ) {
                    $this->logger->error(
                        'getResource( ' . $action . ' ): argument _id not set.',
                        __FILE__,
                        __LINE__
                    );
                } else {
                    if ( is_null( $this->_id ) ) {
                        $this->_id = $this->_obj->_id;
                    }
                }
                $resource = $this->_resource . '/' . $this->_id . '/unlock';
                break;
                
            case ONAPP_CONVERTING:
                /**
                 * ROUTE :
                 *
                 * @name template_ovas
                 * @method POST
                 * @alias   /template_ovas/:id/converting(.:format)
                 * @format  {:controller=>"template_ovas", :action=>"index"}
                 */

                if ( is_null( $this->_id ) && is_null( $this->_obj->_id ) ) {
                    $this->logger->error(
                        'getResource( ' . $action . ' ): argument _id not set.',
                        __FILE__,
                        __LINE__
                    );
                } else {
                    if ( is_null( $this->_id ) ) {
                        $this->_id = $this->_obj->_id;
                    }
                }
                $resource = $this->_resource . '/' . $this->_id . '/converting';
                break;
                
            default:
                /**
                 * ROUTE :
                 *
                 * @name template_ovas
                 * @method GET
                 * @alias   /template_ovas(.:format)
                 * @format  {:controller=>"template_ovas", :action=>"index"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name template_ovas
                 * @method GET
                 * @alias   /template_ovas/:id(.:format)
                 * @format  {:controller=>"template_ovas", :action=>"show"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name
                 * @method DELETE
                 * @alias    /template_ovas/:id(.:format)
                 * @format   {:controller=>"template_ovas", :action=>"destroy"}
                 */
                $resource = parent::getResource( $action );
        }

        return $resource;
    }

    public function system() {
       return $this->sendGet( ONAPP_GETRESOURCE_SYSTEM );
    }

    public function own() {
        return $this->sendGet( ONAPP_GETRESOURCE_OWN );
    }

    public function user() {
        return $this->sendGet( ONAPP_GETRESOURCE_USER );
    }

    public function search( $question ) {
        return $this->sendGet( ONAPP_SEARCH, null, array( 'q' => $question ) );
    }

    public function make_public() {
       return $this->sendPost( ONAPP_MAKE_PUBLIC );
    }

    public function delete_files() {
       return $this->sendPost( ONAPP_DELETE_FILES );
    }

    public function unlock() {
        return $this->sendPost( ONAPP_UNLOCK_OVA );
    }
    
    public function converting() {
        return $this->sendPost( ONAPP_CONVERTING );
    }
    
    public function save() {
        $fields = array(
                'operating_system',
                'operating_system_distro',
                'virtualization',
                'make_public',
            );
        if ( is_null( $this->_id ) ) {
            $fields[] = 'allowed_hot_migrate';
        } else {
            $fields[] = 'file_url';
        }
        $this->unsetFields( $fields );
        
        parent::save();
    }
}
