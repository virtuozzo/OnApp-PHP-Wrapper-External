<?php

/**
 * Restrictions
 *
 * @category    API wrapper
 * @package     OnApp
 * @author      Ivan Gavryliuk
 * @copyright   © 2016 OnApp
 * @link        https://docs.onapp.com/display/42API/Restrictions+Sets
 * @see         OnApp
 */

/**
 * See all restrictions resources
 */
define( 'ONAPP_GET_ALL_RESTRICTIONS_RESOURCES', 'all_restrictions_resources' );

/**
 * Managing Restriction
 *
 * The OnApp_Restriction class uses the following basic methods:
 * {@link load}, {@link save}, {@link delete}, {@link getList}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */
class OnApp_Restriction extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'restrictions_set';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'restrictions/sets';

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
                    'created_at'             => array(
                        ONAPP_FIELD_MAP  => '_created_at',
                        ONAPP_FIELD_TYPE => 'datetime',
                    ),
                    'id'                     => array(
                        ONAPP_FIELD_MAP  => '_id',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'identifier'             => array(
                        ONAPP_FIELD_MAP  => '_identifier',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'label'                  => array(
                        ONAPP_FIELD_MAP  => '_label',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'updated_at'             => array(
                        ONAPP_FIELD_MAP  => '_updated_at',
                        ONAPP_FIELD_TYPE => 'datetime',
                    ),
                    'roles'                  => array(
                        ONAPP_FIELD_MAP  => '_roles',
                        ONAPP_FIELD_TYPE => 'array',
                    ),
                    'restrictions_resources' => array(
                        ONAPP_FIELD_MAP  => '_restrictions_resources',
                        ONAPP_FIELD_TYPE => 'array',
                    ),
                    //field for Restrictions Resources
                    'restriction_type'       => array(
                        ONAPP_FIELD_MAP  => '_restriction_type',
                        ONAPP_FIELD_TYPE => 'string',
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
            case ONAPP_GET_ALL_RESTRICTIONS_RESOURCES:
                /**
                 * ROUTE :
                 *
                 * @name restrictions
                 * @method GET
                 * @alias  restrictions/sets(.:format)
                 * @format {:controller=>"resources", :action=>"index"}
                 */

                $resource = $this->_resource . '/resources';
                break;
            default:
                /**
                 * ROUTE :
                 *
                 * @name restrictions
                 * @method GET
                 * @alias    restrictions/sets(.:format)
                 * @format    {:controller=>"restrictions", :action=>"index"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name restrictions
                 * @method GET
                 * @alias     restrictions/sets/:id(.:format)
                 * @format    {:controller=>"restrictions", :action=>"show"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name   restrictions
                 * @method POST
                 * @alias  restrictions/sets(.:format)
                 * @format {:controller=>"restrictions", :action=>"create"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name
                 * @method PUT
                 * @alias  restrictions/sets/:id(.:format)
                 * @format {:controller=>"restrictions", :action=>"update"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name  restrictions
                 * @method DELETE
                 * @alias  restrictions/sets/:id(.:format)
                 * @format {:controller=>"restrictions", :action=>"destroy"}
                 */
                $resource = parent::getResource( $action );
                break;
        }

        return $resource;
    }

    public function restrictionResource() {
        $oldTagRoot     = $this->_tagRoot;
        $this->_tagRoot = 'restrictions_resource';
        $result         = $this->sendGet( ONAPP_GET_ALL_RESTRICTIONS_RESOURCES );
        $this->_tagRoot = $oldTagRoot;

        return $result;
    }
}
