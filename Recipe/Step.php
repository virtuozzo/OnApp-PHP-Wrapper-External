<?php
/**
 * Managing Recipe Steps
 *
 * @category    API wrapper
 * @package     OnApp
 * @subpackage  Recipe
 * @author      Ivan Gavryliuk
 * @copyright   © 2016 OnApp
 * @link        https://docs.onapp.com/display/42API/Manage+Recipe+Steps
 * @see         OnApp
 */

/**
 * Swap Recipe Steps Locations
 */
define( 'ONAPP_SWAP_RECIPE_LOCATION', 'swap_recipe_location' );

/**
 * Managing Recipe Steps
 * The OnApp_Recipe_Step class uses the following basic methods:
 * {@link load}, {@link save}, {@link delete}, and {@link getList}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */
class OnApp_Recipe_Step extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'recipe_step';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'recipe_steps';

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
                    'created_at'         => array(
                        ONAPP_FIELD_MAP  => '_created_at',
                        ONAPP_FIELD_TYPE => 'datetime',
                    ),
                    'fail_anything_else' => array(
                        ONAPP_FIELD_MAP  => '_fail_anything_else',
                        ONAPP_FIELD_TYPE => 'boolean',
                    ),
                    'fail_values'        => array(
                        ONAPP_FIELD_MAP  => '_fail_values',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'failure_goto_step'  => array(
                        ONAPP_FIELD_MAP  => '_failure_goto_step',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'id'                 => array(
                        ONAPP_FIELD_MAP  => '_id',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'number'             => array(
                        ONAPP_FIELD_MAP  => '_number',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'on_failure'         => array(
                        ONAPP_FIELD_MAP  => '_on_failure',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'on_success'         => array(
                        ONAPP_FIELD_MAP  => '_on_success',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'pass_anything_else' => array(
                        ONAPP_FIELD_MAP  => '_pass_anything_else',
                        ONAPP_FIELD_TYPE => 'boolean',
                    ),
                    'pass_values'        => array(
                        ONAPP_FIELD_MAP  => '_pass_values',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'recipe_id'          => array(
                        ONAPP_FIELD_MAP  => '_recipe_id',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'result_source'      => array(
                        ONAPP_FIELD_MAP  => '_result_source',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'script'             => array(
                        ONAPP_FIELD_MAP  => '_script',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'success_goto_step'  => array(
                        ONAPP_FIELD_MAP  => '_success_goto_step',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'updated_at'         => array(
                        ONAPP_FIELD_MAP  => '_updated_at',
                        ONAPP_FIELD_TYPE => 'datetime',
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

        parent::initFields( $version, __CLASS__ );

        return $this->fields;
    }

    function getResource( $action = ONAPP_GETRESOURCE_DEFAULT ) {
        switch ( $action ) {
            case ONAPP_SWAP_RECIPE_LOCATION:
                /**
                 * ROUTE :
                 *
                 * @name recipes
                 * @method put
                 * @alias   /recipes/:recipe_id/recipe_steps/:recipe_step_id/move_to/:recipe_step_number(.:format)
                 * @format  {:controller=>"recipe_steps", :action=>"index"}
                 */
                if ( is_null( $this->_recipe_id ) ) {
                    $this->logger->error(
                        'getResource( ' . $action . ' ): argument _recipe_id not set.',
                        __FILE__,
                        __LINE__
                    );
                }
                if ( is_null( $this->_id ) ) {
                    $this->logger->error(
                        'getResource( ' . $action . ' ): argument _id not set.',
                        __FILE__,
                        __LINE__
                    );
                }
                if ( is_null( $this->_number ) ) {
                    $this->logger->error(
                        'getResource( ' . $action . ' ): argument _number not set.',
                        __FILE__,
                        __LINE__
                    );
                }
                $resource = 'recipes/' . $this->_recipe_id . '/' . $this->_resource . '/' . $this->_id . '/move_to/' . $this->_number;
                break;

            case ONAPP_GETRESOURCE_DEFAULT:
                /**
                 * ROUTE :
                 *
                 * @name recipe_steps
                 * @method GET
                 * @alias   /recipes/:recipe_id/recipe_steps(.:format)
                 * @format  {:controller=>"recipe_steps", :action=>"index"}
                 */
                if ( is_null( $this->_recipe_id ) ) {
                    $this->logger->error(
                        'getResource( ' . $action . ' ): argument _recipe_id not set.',
                        __FILE__,
                        __LINE__
                    );
                }
                $resource = 'recipes/' . $this->_recipe_id . '/' . $this->_resource;
                break;
            default:
                $resource = parent::getResource( $action );
                break;
        }

        return $resource;
    }

    public function swap() {
        $this->sendPut( ONAPP_SWAP_RECIPE_LOCATION );
    }
}