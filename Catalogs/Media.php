<?php
/**
 * Media
 *
 *
 * @category    API wrapper
 * @package     OnApp
 * @author
 * @copyright   © 2017 OnApp
 * @link        http://www.onapp.com/
 * @docs        https://docs.onapp.com/display/42API/High+Availability+Control+Panel
 * @see         OnApp
 */

/**
 * Media
 *
 *
 * The Availability class uses the following basic methods:
 * {@link load}, {@link save}, {@link delete}, and {@link getList}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */
class OnApp_Catalogs_Media extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'vcloud_media';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'media';

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
            case 5.0:
            case 5.1:
            case 5.2:
            case 5.3:
                $this->fields = array(
                    'created_at' => array(
                        ONAPP_FIELD_MAP  => '_created_at',
                        ONAPP_FIELD_TYPE => 'datetime',
                    ),
                    'updated_at' => array(
                        ONAPP_FIELD_MAP       => '_updated_at',
                        ONAPP_FIELD_TYPE      => 'datetime',
                    ),
                    'label'  => array(
                        ONAPP_FIELD_MAP  => '_label',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'catalog_item_id'   => array(
                        ONAPP_FIELD_MAP  => '_catalog_item_id',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'identifier'      => array(
                        ONAPP_FIELD_MAP  => '_identifier',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'id' => array(
                        ONAPP_FIELD_MAP  => '_id',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'description'      => array(
                        ONAPP_FIELD_MAP  => '_description',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'status'      => array(
                        ONAPP_FIELD_MAP  => '_status',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'user_id'      => array(
                        ONAPP_FIELD_MAP  => '_user_id',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'data_store_id'      => array(
                        ONAPP_FIELD_MAP  => '_data_store_id',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'image_type'      => array(
                        ONAPP_FIELD_MAP  => '_image_type',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'vdc_id'      => array(
                        ONAPP_FIELD_MAP  => '_vdc_id',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'size'      => array(
                        ONAPP_FIELD_MAP  => '_size',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                );
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
            case ONAPP_GETRESOURCE_DEFAULT:
                if ( is_null( $this->_catalog_item_id ) ) {
                    $this->logger->error(
                        'getResource( ' . $action . ' ): argument _catalog_item_id not set.',
                        __FILE__,
                        __LINE__
                    );
                }
                $resource = 'catalogs/' . $this->_catalog_item_id . '/' . $this->_resource;
                break;

            default:
                $resource = parent::getResource( $action );

        }

        return $resource;
    }
}