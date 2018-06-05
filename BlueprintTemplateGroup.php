<?php

/**
 * Managing Blueprint Template Groups
 *
 * @category    API wrapper
 * @package     OnApp
 * @author      Ivan Gavryliuk
 * @copyright   © 2016 OnApp
 * @link        https://docs.onapp.com/display/43API/Blueprint+Template+Groups
 * @see         OnApp
 */

/**
 * SSH
 *
 * The OnApp_BlueprintTemplateGroup class uses the following basic methods:
 * {@link load}, {@link save}, {@link delete}, and {@link getList}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */
class OnApp_BlueprintTemplateGroup extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'blueprint_template_group';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'blueprint_template_groups';

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
                    'id'         => array(
                        ONAPP_FIELD_MAP  => '_id',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'label'      => array(
                        ONAPP_FIELD_MAP  => '_label',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'parent_id'  => array(
                        ONAPP_FIELD_MAP  => '_parent_id',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'lft'        => array(
                        ONAPP_FIELD_MAP  => '_lft',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'rgt'        => array(
                        ONAPP_FIELD_MAP  => '_rgt',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'depth'      => array(
                        ONAPP_FIELD_MAP  => '_depth',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'created_at' => array(
                        ONAPP_FIELD_MAP  => '_created_at',
                        ONAPP_FIELD_TYPE => 'datetime',
                    ),
                    'updated_at' => array(
                        ONAPP_FIELD_MAP  => '_updated_at',
                        ONAPP_FIELD_TYPE => 'datetime',
                    ),
                    'children'   => array(
                        ONAPP_FIELD_MAP  => '_children',
                        ONAPP_FIELD_TYPE => 'array',
                    ),
                    'relations'  => array(
                        ONAPP_FIELD_MAP  => '_relations',
                        ONAPP_FIELD_TYPE => 'array',
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
            default:
                /**
                 * ROUTE :
                 *
                 * @name blueprint_template_groups
                 * @method GET
                 * @alias   /blueprint_template_groups(.:format)
                 * @format  {:controller=>"blueprint_template_groups", :action=>"index"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name blueprint_template_groups
                 * @method GET
                 * @alias   /blueprint_template_groups/:id(.:format)
                 * @format  {:controller=>"blueprint_template_groups", :action=>"show"}
                 */

                /**
                 * ROUTE :
                 *
                 * @name
                 * @method PUT
                 * @alias  /blueprint_template_groups/:id(.:format)
                 * @format {:controller=>"blueprint_template_groups", :action=>"update"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name
                 * @method DELETE
                 * @alias  /blueprint_template_groups/:id(.:format)
                 * @format {:controller=>"blueprint_template_groups", :action=>"destroy"}
                 */
                $resource = parent::getResource( $action );
                break;

        }

        return $resource;
    }

}
