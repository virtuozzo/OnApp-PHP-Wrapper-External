<?php

/**
 * Recipe
 *
 * Recipes are the plugin mechanism used for adding new functionalities to the OnApp cloud.
 * Each recipe is a set of instructions that triggers events at certain stages during the deployment of certain services.
 *
 * @category    API wrapper
 * @package     OnApp
 * @author      Ivan Gavryliuk
 * @copyright   © 2016 OnApp
 * @link        https://docs.onapp.com/display/42API/Recipes
 * @see         OnApp
 */

/**
 * To view the list of public ISOs
 */
define('ONAPP_GET_LIST_OF_SERVER_RECIPES', 'server_list_of_recipes');

/**
 * Recipe
 *
 * The OnApp_Recipe class uses the following basic methods:
 * {@link load}, {@link save}, {@link delete}, and {@link getList}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */
class OnApp_Recipe extends OnApp {
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
    var $_resource = 'recipes';

    /**
     * API Fields description
     *
     * @param string|float $version OnApp API version
     * @param string $className current class' name
     *
     * @return array
     */
    public function initFields($version = null, $className = '') {

        switch ($version) {
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
                    'compatible_with'	 => array(
                        ONAPP_FIELD_MAP => '_compatible_with',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'created_at'	 => array(
                        ONAPP_FIELD_MAP => '_created_at',
                        ONAPP_FIELD_TYPE => 'datetime',
                    ),
                    'description'	 => array(
                        ONAPP_FIELD_MAP => '_description',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'id'	 => array(
                        ONAPP_FIELD_MAP => '_id',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'label'	 => array(
                        ONAPP_FIELD_MAP => '_label',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'script_type'	 => array(
                        ONAPP_FIELD_MAP => '_script_type',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'updated_at'	 => array(
                        ONAPP_FIELD_MAP => '_updated_at',
                        ONAPP_FIELD_TYPE => 'datetime',
                    ),
                    'user_id'	 => array(
                        ONAPP_FIELD_MAP => '_user_id',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'recipe_steps'	 => array(
                        ONAPP_FIELD_MAP => '_recipe_steps',
                        ONAPP_FIELD_TYPE => 'array',
                    ),
                );
                break;
        }

        parent::initFields($version, __CLASS__);
        return $this->fields;
    }

    function getResource($action = ONAPP_GETRESOURCE_DEFAULT)  {
        switch ($action) {
            case ONAPP_GET_LIST_OF_SERVER_RECIPES :
                /**
                 * ROUTE :
                 *
                 * @name recipes
                 * @method GET
                 * @alias  /recipes/:recipe_id/applied_to_vs(.:format)
                 * @format {:action=>"index", :controller=>"applied_to_vs"}
                 */

                if( is_null( $this->_id ) ) {
                    $this->logger->error(
                        'getResource( ' . $action . ' ): argument _id not set.',
                        __FILE__,
                        __LINE__
                    );
                }

                $resource = $this->_resource .'/'. $this->_id .'/applied_to_vs';
                break;
            default:
                $resource = parent::getResource($action);
                break;
        }

        return $resource;
    }

    public function getListOfServerUsingRecipe(){
        return $this->sendGet(ONAPP_GET_LIST_OF_SERVER_RECIPES);
    }
}
