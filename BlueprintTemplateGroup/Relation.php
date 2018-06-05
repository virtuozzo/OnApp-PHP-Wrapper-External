<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Blueprint Template Group Relations
 *
 * @todo        write description
 *
 * @category    API wrapper
 * @package     OnApp
 * @subpackage  User
 * @author      Ivan Gavryliuk
 * @copyright   © 2016 OnApp
 * @link        https://docs.onapp.com/display/43API/Get+List+of+Blueprint+Templates+Attached+to+Blueprint+Template+Group
 * @see         OnApp
 */

/**
 * User White List
 *
 * The OnApp_BlueprintTemplateGroup_Relation class supports the following basic methods
 *
 * The OnApp_User_WhiteList class uses the following basic methods:
 * {@link load}, {@link save}, {@link delete}, and {@link getList}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */
class OnApp_BlueprintTemplateGroup_Relation extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'blueprint_template';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'blueprint_template_group_relations';

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
                $this->fields = array(
                    'id'                          => array(
                        ONAPP_FIELD_MAP  => '_id',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'label'                       => array(
                        ONAPP_FIELD_MAP  => '_label',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'user_id'                     => array(
                        ONAPP_FIELD_MAP  => '_user_id',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'vapp_name'                   => array(
                        ONAPP_FIELD_MAP  => '_vapp_name',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'hypervisor_id'               => array(
                        ONAPP_FIELD_MAP  => '_hypervisor_id',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'created_at'                  => array(
                        ONAPP_FIELD_MAP  => '_created_at',
                        ONAPP_FIELD_TYPE => 'datetime',
                    ),
                    'updated_at'                  => array(
                        ONAPP_FIELD_MAP  => '_updated_at',
                        ONAPP_FIELD_TYPE => 'datetime',
                    ),
                    'built'                       => array(
                        ONAPP_FIELD_MAP  => '_built',
                        ONAPP_FIELD_TYPE => 'boolean',
                    ),
                    'blueprint_template_group_id' => array(
                        ONAPP_FIELD_MAP  => '_blueprint_template_group_id',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'blueprint_template_id'       => array(
                        ONAPP_FIELD_MAP  => '_blueprint_template_id',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                );
                break;
            case 4.3:
                $this->fields = $this->initFields( 4.2 );
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
            case ONAPP_GETRESOURCE_DEFAULT:
                /**
                 * ROUTE :
                 *
                 * @name blueprint_template_groups
                 * @method GET
                 * @alias   /blueprint_template_groups/:blueprint_template_group_id/blueprint_template_group_relations(.:format)
                 * @format  {:controller=>"blueprint_template_group_relations", :action=>"index"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name blueprint_template_groups
                 * @method GET
                 * @alias  /blueprint_template_groups/:blueprint_template_group_id/blueprint_template_group_relations/:id(.:format)
                 * @format {:controller=>"blueprint_template_group_relations", :action=>"show"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name
                 * @method PUT
                 * @alias  /blueprint_template_groups/:blueprint_template_group_id/blueprint_template_group_relations/:id(.:format)
                 * @format {:controller=>"blueprint_template_group_relations", :action=>"update"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name
                 * @method POST
                 * @alias  /blueprint_template_groups/:blueprint_template_group_id/blueprint_template_group_relations(.:format)
                 * @format {:controller=>"blueprint_template_group_relations", :action=>"create"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name blueprint_template_groups
                 * @method DELETE
                 * @alias   /blueprint_template_groups/:blueprint_template_group_id/blueprint_template_group_relations/:id(.:format)
                 * @format  {:controller=>"blueprint_template_group_relations", :action=>"destroy"}
                 */
                if ( is_null( $this->_blueprint_template_group_id ) && is_null( $this->_obj->_blueprint_template_group_id ) ) {
                    $this->logger->error(
                        "getResource($action): argument _blueprint_template_group_id not set.",
                        __FILE__,
                        __LINE__
                    );
                } else {
                    if ( is_null( $this->_blueprint_template_group_id ) ) {
                        $this->_blueprint_template_group_id = $this->_obj->_blueprint_template_group_id;
                    }
                }
                $resource = 'blueprint_template_groups/' . $this->_blueprint_template_group_id . '/' . $this->_resource;
                $this->logger->debug( 'getResource( ' . $action . ' ): return ' . $resource );
                break;

            default:
                $resource = parent::getResource( $action );
                break;
        }

        return $resource;
    }


    function _create() {
        $this->logger->add( 'Create new Object.' );

        $data = array(
            'root' => 'blueprint_template_group_relation',
            'data' => [
                'blueprint_template_id' => $this->_blueprint_template_id,
            ]
        );

        return $this->sendPost( ONAPP_GETRESOURCE_ADD, $data );
    }
}
