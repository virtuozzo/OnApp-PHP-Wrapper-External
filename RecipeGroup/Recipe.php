<?php
/**
 * Managing Recipe
 *
 * @category    API wrapper
 * @package     OnApp
 * @subpackage  Recipe Group
 * @author      Ivan Gavryliuk
 * @copyright   © 2016 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */

/**
 * Managing Recipes

 * The OnApp_RecipeGroup_Recipe class uses the following basic methods:
 * {@link load}, {@link save}, {@link delete}, and {@link getList}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */
class OnApp_RecipeGroup_Recipe extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'recipe';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'recipe_group_relations';

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
                    'compatible_with'         => array(
                        ONAPP_FIELD_MAP       => '_compatible_with',
                        ONAPP_FIELD_TYPE      => 'string',
                    ),
                    'created_at'         => array(
                        ONAPP_FIELD_MAP       => '_created_at',
                        ONAPP_FIELD_TYPE      => 'datetime',
                    ),
                    'description'         => array(
                        ONAPP_FIELD_MAP       => '_description',
                        ONAPP_FIELD_TYPE      => 'string',
                    ),
                    'id'         => array(
                        ONAPP_FIELD_MAP       => '_id',
                        ONAPP_FIELD_TYPE      => 'integer',
                    ),
                    'label'         => array(
                        ONAPP_FIELD_MAP       => '_label',
                        ONAPP_FIELD_TYPE      => 'string',
                    ),
                    'script_type'         => array(
                        ONAPP_FIELD_MAP       => '_script_type',
                        ONAPP_FIELD_TYPE      => 'string',
                    ),
                    'updated_at'         => array(
                        ONAPP_FIELD_MAP       => '_updated_at',
                        ONAPP_FIELD_TYPE      => 'datetime',
                    ),
                    'user_id'         => array(
                        ONAPP_FIELD_MAP       => '_user_id',
                        ONAPP_FIELD_TYPE      => 'integer',
                    ),
                    'recipe_steps'         => array(
                        ONAPP_FIELD_MAP       => '_recipe_steps',
                        ONAPP_FIELD_TYPE      => 'array',
                    ),
                    'recipe_group_relation_id'  => array(
                        ONAPP_FIELD_MAP       => '_recipe_group_relation_id',
                        ONAPP_FIELD_TYPE      => 'array',
                    ),
                );
                break;
        }

        parent::initFields( $version, __CLASS__ );

        return $this->fields;
    }
    function getResource( $action = ONAPP_GETRESOURCE_DEFAULT ) {
        switch( $action ) {
            case ONAPP_GETRESOURCE_DEFAULT:
                /**
                 * ROUTE :
                 *
                 * @name recipe_groups
                 * @method GET
                 * @alias   /recipe_groups/:id/recipe_group_relations(.:format)
                 * @format  {:controller=>"recipe_group_relations", :action=>"index"}
                 */
                if( is_null( $this->_id ) ) {
                    $this->logger->error(
                        'getResource( ' . $action . ' ): argument _id not set.',
                        __FILE__,
                        __LINE__
                    );
                }
                $resource = 'recipe_groups/' . $this->_id . '/' . $this->_resource;
                break;
            case ONAPP_ACTIVATE_SAVE:
                /**
                 * ROUTE :
                 *
                 * @name recipe_groups
                 * @method POST
                 * @alias   /recipe_groups/:id/recipe_group_relations(.:format)
                 * @format  {:controller=>"recipe_groups", :action=>"create"}
                 */
                if( is_null( $this->_id ) ) {
                    $this->logger->error(
                        'getResource( ' . $action . ' ): argument _id not set.',
                        __FILE__,
                        __LINE__
                    );
                }
                $resource = 'recipe_groups/' . $this->_id . '/' . $this->_resource;
                break;
            case ONAPP_ACTIVATE_DELETE:
                /**
                 * ROUTE :
                 *
                 * @name  recipe_groups
                 * @method DELETE
                 * @alias   /recipe_groups/:id/recipe_group_relations/recipe_group_relation_id(.:format)
                 * @format  {:controller=>"recipe_groups", :action=>"destroy"}
                 */
                if( is_null( $this->_id ) ) {
                    $this->logger->error(
                        'getResource( ' . $action . ' ): argument _id not set.',
                        __FILE__,
                        __LINE__
                    );
                }
                if( is_null( $this->_recipe_group_relation_id ) ) {
                    $this->logger->error(
                        'getResource( ' . $action . ' ): argument _recipe_group_relation_id not set.',
                        __FILE__,
                        __LINE__
                    );
                }
                $resource = 'recipe_groups/' . $this->_id . '/' . $this->_resource .'/'. $this->_recipe_group_relation_id;
                break;
            default:
                $resource = parent::getResource( $action );
                break;
        }
        return $resource;
    }

    public function save(){

        if($this->_recipe_id){
            $data['recipe_id'] = $this->_recipe_id;

            $data = array(
                'root' => 'recipe_group_relation',
                'data' => $data
            );
            return $this->sendPost(ONAPP_ACTIVATE_SAVE, $data);
        } else {
            $this->logger->error(
                'argument _recipe_id not set.',
                __FILE__,
                __LINE__
            );
        }
    }
}