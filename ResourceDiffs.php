<?php
/**
 * Managing ResourceDiffs
 * 
 * much they will be charged per unit.
 *
 * @category    API wrapper
 * @package     OnApp
 * @author      Mykola Vuy
 * @copyright   © 2019 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */
/**
 * Managing ResourceDiffs
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php )
 */

class OnApp_ResourceDiffs extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'resource_diff';

    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'resource_diffs';

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
            case 6.1:
                $this->fields = array(
                    'id'                    => array(
                        ONAPP_FIELD_MAP       => '_id',
                        ONAPP_FIELD_TYPE      => 'integer',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'transaction_id'         => array(
                        ONAPP_FIELD_MAP       => '_transaction_id',
                        ONAPP_FIELD_TYPE      => 'integer',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'diff'  => array(
                        ONAPP_FIELD_MAP         => '_diff',
                        ONAPP_FIELD_TYPE        => '_array',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'created_at' => array(
                        ONAPP_FIELD_MAP       => '_created_at',
                        ONAPP_FIELD_TYPE      => 'datetime',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'updated_at' => array(
                        ONAPP_FIELD_MAP       => '_updated_at',
                        ONAPP_FIELD_TYPE      => 'datetime',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                );

                break;

            case 6.2:
                $this->fields = $this->initFields( 6.1 );
                break;

            case 6.3:
                $this->fields = $this->initFields( 6.2 );
                break;

            case 6.4:
                $this->fields = $this->initFields( 6.3 );
                break;

            case 6.5:
                $this->fields = $this->initFields( 6.4 );
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
                 * @name ResourceDiffs
                 *
                 * @method GET
                 * @alias   /resource_diffs(.:format)
                 * @format  {:controller=>"vapp_template_groups", :action=>"index"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name ResourceDiffs
                 * @method GET
                 * @alias    /resource_diffs/:resource_diff_id(.:format)
                 * @format   {:controller=>"vapp_template_groups", :action=>"show"}
                 */
                $resource = parent::getResource( $action );
                break;
        }

        return $resource;
    }
}