<?php
/**
 * Catalogs
 **
 * @category    API wrapper
 * @package     OnApp
 * @author
 * @copyright   © 2017 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */

/**
 * Catalogs
 *
 * This class represents the media library.
 *
 * The OnApp_Catalogs class uses the following basic methods:
 * {@link load}, {@link delete}, and {@link getList}.
 *
 */
class OnApp_Catalogs extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'vcloud_catalog';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'catalogs';

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
                $this->fields                  = array();
                $this->fields['user_id']       = array(
                    ONAPP_FIELD_MAP  => '_user_id',
                    ONAPP_FIELD_TYPE => 'integer',
                );
                $this->fields['hypervisor_id'] = array(
                    ONAPP_FIELD_MAP  => '_hypervisor_id',
                    ONAPP_FIELD_TYPE => 'integer',
                );
                $this->fields['created_at']    = array(
                    ONAPP_FIELD_MAP  => '_created_at',
                    ONAPP_FIELD_TYPE => 'datetime',
                );
                $this->fields['updated_at']    = array(
                    ONAPP_FIELD_MAP  => '_updated_at',
                    ONAPP_FIELD_TYPE => 'datetime',
                );
                $this->fields['label']         = array(
                    ONAPP_FIELD_MAP  => '_label',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['published']     = array(
                    ONAPP_FIELD_MAP  => '_published',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['user_group_id'] = array(
                    ONAPP_FIELD_MAP  => '_user_group_id',
                    ONAPP_FIELD_TYPE => 'integer',
                );
                $this->fields['identifier']    = array(
                    ONAPP_FIELD_MAP  => '_identifier',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['id']            = array(
                    ONAPP_FIELD_MAP  => '_id',
                    ONAPP_FIELD_TYPE => 'integer',
                );
                $this->fields['data_store_id'] = array(
                    ONAPP_FIELD_MAP  => '_data_store_id',
                    ONAPP_FIELD_TYPE => 'integer',
                );
                $this->fields['vdc_id']        = array(
                    ONAPP_FIELD_MAP  => '_vdc_id',
                    ONAPP_FIELD_TYPE => 'integer',
                );
                break;
            case 5.4:
                $this->fields = $this->initFields( 5.3 );
                break;
            case 5.5:
                $this->fields = $this->initFields( 5.4 );
                $this->fields['description']    = array(
                    ONAPP_FIELD_MAP  => '_description',
                    ONAPP_FIELD_TYPE => 'string',
                );
                break;
            case 6.0:
                $this->fields = $this->initFields( 5.5 );
                $this->fields['organization_id']    = array(
                    ONAPP_FIELD_MAP  => '_organization_id',
                    ONAPP_FIELD_TYPE => 'integer',
                );
                break;
        }

        parent::initFields( $version, __CLASS__ );

        return $this->fields;
    }

    function getResource( $action = ONAPP_GETRESOURCE_DEFAULT ) {
        switch ( $action ) {
            default:
                $resource = parent::getResource( $action );
        }

        return $resource;
    }

}
