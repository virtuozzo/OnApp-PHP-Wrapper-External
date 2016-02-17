<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Managing VappTemplateGroup
 *
 *
 * @category    API wrapper
 * @package     OnApp
 * @author
 * @copyright   © 2011 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */


/**
 * Vapp Template Group
 *
 */
class OnApp_VappTemplateGroup extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'vapp_template_group';

    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'vapp_template_groups';

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
            case 4.0:
            case 4.1:
                $this->fields = array(
                    'id'                          => array(
                        ONAPP_FIELD_MAP       => '_id',
                        ONAPP_FIELD_TYPE      => 'integer',
                        ONAPP_FIELD_READ_ONLY => true
                    ),
                    'created_at'                  => array(
                        ONAPP_FIELD_MAP       => '_created_at',
                        ONAPP_FIELD_TYPE      => 'datetime',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'identifier'                  => array(
                        ONAPP_FIELD_MAP       => '_identifier',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'label'                       => array(
                        ONAPP_FIELD_MAP      => '_label',
                        ONAPP_FIELD_REQUIRED => true,
                    ),
                    'updated_at'                  => array(
                        ONAPP_FIELD_MAP       => '_updated_at',
                        ONAPP_FIELD_TYPE      => 'datetime',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'user_group_id'                          => array(
                        ONAPP_FIELD_MAP       => '_user_group_id',
                        ONAPP_FIELD_TYPE      => 'integer',
                        ONAPP_FIELD_READ_ONLY => true
                    ),

                );

                break;
            case 4.2:
                $this->fields = $this->initFields( 4.1 );
                break;
        }

        parent::initFields( $version, __CLASS__ );

        return $this->fields;
    }

    function getResource( $action = ONAPP_GETRESOURCE_DEFAULT ) {
        switch( $action ) {
            default:
                /**
                 * ROUTE :
                 *
                 * @name vapp_template_groups
                 * @method GET
                 * @alias   /vapp_template_groups(.:format)
                 * @format  {:controller=>"vapp_template_groups", :action=>"index"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name vapp_template_group
                 * @method GET
                 * @alias    /vapp_template_groups/:id(.:format)
                 * @format   {:controller=>"vapp_template_groups", :action=>"show"}
                 */
                $resource = parent::getResource( $action );
                break;
        }

        return $resource;
    }

}