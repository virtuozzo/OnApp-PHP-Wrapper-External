<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Managing Edge Gateways
 *
 *
 * @category    API wrapper
 * @package     OnApp
 * @author
 * @copyright   © 2011 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */


/**
 * Edge Gateways
 *
 */
class OnApp_VDCS_EdgeGateway extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'edge_gateway';

    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'edge_gateways';

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
            case '4.0':
                $this->fields = array(
                    'id'                          => array(
                        ONAPP_FIELD_MAP       => '_id',
                        ONAPP_FIELD_TYPE      => 'integer',
                        ONAPP_FIELD_READ_ONLY => true
                    ),
                    'created_at'                  => array(
                        ONAPP_FIELD_MAP       => '_created_at',
                        ONAPP_FIELD_TYPE      => 'datetime',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'description'                       => array(
                        ONAPP_FIELD_MAP      => '_description',
                        ONAPP_FIELD_REQUIRED => true,
                    ),
                    'identifier'                  => array(
                        ONAPP_FIELD_MAP       => '_identifier',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'label'                       => array(
                        ONAPP_FIELD_MAP      => '_label',
                        ONAPP_FIELD_REQUIRED => true,
                    ),
                    'updated_at'                  => array(
                        ONAPP_FIELD_MAP       => '_updated_at',
                        ONAPP_FIELD_TYPE      => 'datetime',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'vdc_id'                          => array(
                        ONAPP_FIELD_MAP       => '_vdc_id',
                        ONAPP_FIELD_TYPE      => 'integer',
                        ONAPP_FIELD_READ_ONLY => true
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
                 * @name vdcs_edge_gateways
                 * @method GET
                 * @alias    /vdcs/:vdc_id/edge_gateways(.:format)
                 * @format    {:controller=>"edge_gateways", :action=>"index"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name vdcs_edge_gateway
                 * @method GET
                 * @alias    /vdcs/:vdc_id/edge_gateways/:edge_gateways_id(.:format)
                 * @format    {:controller=>"edge_gateways", :action=>"show"}
                 */
                if( is_null( $this->_vdcs_id ) && is_null( $this->_obj->_vdcs_id ) ) {
                    $this->logger->error(
                        'getResource( ' . $action . ' ): argument _vdcs_id not set.',
                        __FILE__,
                        __LINE__
                    );
                }
                else {
                    if( is_null( $this->_vdcs_id ) ) {
                        $this->_vdcs_id = $this->_obj->_vdcs_id;
                    }
                }

                $resource = 'vdcs/' . $this->_vdcs_id . '/' . $this->_resource;
                break;
          default:
              $resource = parent::getResource( $action );
              break;
        }

        return $resource;
    }

}