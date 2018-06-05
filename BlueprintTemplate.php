<?php

/**
 * Managing Blueprint Templates
 *
 * @category    API wrapper
 * @package     OnApp
 * @author      Ivan Gavryliuk
 * @copyright   © 2016 OnApp
 * @link        https://docs.onapp.com/display/42API/Blueprint+Templates
 * @see         OnApp
 */

/**
 * SSH
 *
 * The OnApp_BlueprintTemplate class uses the following basic methods:
 * {@link load}, {@link save}, {@link delete}, and {@link getList}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */
class OnApp_BlueprintTemplate extends OnApp {
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
    var $_resource = 'blueprint_templates';

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
                    'id'            => array(
                        ONAPP_FIELD_MAP  => '_id',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'label'         => array(
                        ONAPP_FIELD_MAP  => '_label',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'user_id'       => array(
                        ONAPP_FIELD_MAP  => '_user_id',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'vapp_name'     => array(
                        ONAPP_FIELD_MAP  => '_vapp_name',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'hypervisor_id' => array(
                        ONAPP_FIELD_MAP  => '_hypervisor_id',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'created_at'    => array(
                        ONAPP_FIELD_MAP  => '_created_at',
                        ONAPP_FIELD_TYPE => 'datetime',
                    ),
                    'updated_at'    => array(
                        ONAPP_FIELD_MAP  => '_updated_at',
                        ONAPP_FIELD_TYPE => 'datetime',
                    ),
                    'built'         => array(
                        ONAPP_FIELD_MAP  => '_built',
                        ONAPP_FIELD_TYPE => 'boolean',
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
            /**
             * ROUTE :
             *
             * @name
             * @method POST
             * @alias   /blueprint_templates(.:format)
             * @format  {:controller=>"blueprint_templates", :action=>"create"}
             */
            case ONAPP_GETRESOURCE_ADD:
                $resource = $this->getResource() . '/import';
                break;
            default:
                /**
                 * ROUTE :
                 *
                 * @name blueprint_template
                 * @method GET
                 * @alias   /blueprint_templates(.:format)
                 * @format  {:controller=>"blueprint_templates", :action=>"index"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name blueprint_template
                 * @method GET
                 * @alias   /blueprint_templates/:id(.:format)
                 * @format  {:controller=>"blueprint_templates", :action=>"show"}
                 */

                /**
                 * ROUTE :
                 *
                 * @name
                 * @method PUT
                 * @alias  /blueprint_templates/:id(.:format)
                 * @format {:controller=>"blueprint_templates", :action=>"update"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name
                 * @method DELETE
                 * @alias  /blueprint_templates/:id(.:format)
                 * @format {:controller=>"blueprint_templates", :action=>"destroy"}
                 */
                $resource = parent::getResource( $action );
                break;

        }

        return $resource;
    }

}
