<?php

/**
 * Recipe Groups
 *
 * @category    API wrapper
 * @package     OnApp
 * @author      Ivan Gavryliuk
 * @copyright   © 2016 OnApp
 * @link        https://docs.onapp.com/display/42API/Recipe+Groups
 * @see         OnApp
 */


/**
 * Recipe Groups
 *
 * The OnApp_RecipeGroup class uses the following basic methods:
 * {@link load}, {@link save}, {@link delete}, and {@link getList}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */
class OnApp_RecipeGroup extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'recipe_group';

    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'recipe_groups';

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
                    'id' => array(
                        ONAPP_FIELD_MAP => '_id',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'label' => array(
                        ONAPP_FIELD_MAP => '_label',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'parent_id' => array(
                        ONAPP_FIELD_MAP => '_parent_id',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'lft' => array(
                        ONAPP_FIELD_MAP => '_lft',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'rgt' => array(
                        ONAPP_FIELD_MAP => '_rgt',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'depth' => array(
                        ONAPP_FIELD_MAP => '_depth',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'created_at' => array(
                        ONAPP_FIELD_MAP => '_created_at',
                        ONAPP_FIELD_TYPE => 'datetime',
                    ),
                    'updated_at' => array(
                        ONAPP_FIELD_MAP => '_updated_at',
                        ONAPP_FIELD_TYPE => 'datetime',
                    ),
                    'children' => array(
                        ONAPP_FIELD_MAP => '_children',
                        ONAPP_FIELD_TYPE => 'array',
                    ),
                    'relations' => array(
                        ONAPP_FIELD_MAP => '_relations',
                        ONAPP_FIELD_TYPE => 'array',
                    ),
                );
                break;
        }

        parent::initFields($version, __CLASS__);
        return $this->fields;
    }
}
