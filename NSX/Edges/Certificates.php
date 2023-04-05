<?php

/**
 * NSX Edges Certificates
 *
 * @category        API wrapper
 * @package         OnApp
 * @author          Mykola Vuy
 * @copyright       © 2019 OnApp
 */

/**
 * NSX_Edges_Certificates
 *
 * Use the following API calls to view, assign and delete virtual server recipes in your cloud.
 *
 * The OnApp_NSX_Edges_Certificates class uses the following basic method:
 * {@link getList}
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */
class OnApp_NSX_Edges_Certificates extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'nsx_certificate';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'certificates';
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
            case 6.2:
                $this->fields = array(
                    'id'                    => array(
                        ONAPP_FIELD_MAP         => '_id',
                        ONAPP_FIELD_TYPE        => 'integer',
                        ONAPP_FIELD_READ_ONLY   => true,
                    ),
                    'identifier'            => array(
                        ONAPP_FIELD_MAP         => '_identifier',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'label'                 => array(
                        ONAPP_FIELD_MAP         => '_label',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'common_name'           => array(
                        ONAPP_FIELD_MAP         => '_common_name',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'issuer_common_name'    => array(
                        ONAPP_FIELD_MAP         => '_issuer_common_name',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'certificate_type'      => array(
                        ONAPP_FIELD_MAP         => '_certificate_type',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'edge_id'               => array(
                        ONAPP_FIELD_MAP         => '_edge_id',
                        ONAPP_FIELD_TYPE        => 'integer',
                        ONAPP_FIELD_READ_ONLY   => true,
                    ),
                    'valid_from'            => array(
                        ONAPP_FIELD_MAP         => '_valid_from',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'not_after'             => array(
                        ONAPP_FIELD_MAP         => '_not_after',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'created_at'            => array(
                        ONAPP_FIELD_MAP         => '_created_at',
                        ONAPP_FIELD_TYPE        => 'datetime',
                        ONAPP_FIELD_READ_ONLY   => true,
                    ),
                    'updated_at'            => array(
                        ONAPP_FIELD_MAP         => '_updated_at',
                        ONAPP_FIELD_TYPE        => 'datetime',
                        ONAPP_FIELD_READ_ONLY   => true,
                    ),
                    'signature_algorithm'   => array(
                        ONAPP_FIELD_MAP         => '_signature_algorithm',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'public_key_algorithm'  => array(
                        ONAPP_FIELD_MAP         => '_public_key_algorithm',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'public_key_length'     => array(
                        ONAPP_FIELD_MAP         => '_public_key_length',
                        ONAPP_FIELD_TYPE        => 'integer',
                    ),
                );
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

            case 6.6:
                $this->fields = $this->initFields( 6.5 );
                break;

            case 6.7:
                $this->fields = $this->initFields( 6.6 );
                break;

            default:
                $this->fields = $this->initFields( 6.7 );
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
            case ONAPP_GETRESOURCE_DEFAULT:
                /**
                 * ROUTE :
                 *
                 * @name Get List of NSX Certificates
                 * @method GET
                 * @alias  /nsx/edges/:edge_id/certificates(.:format)
                 * @format {:controller=>"NSX_Edges_Certificates", :action=>"index"}
                 */
                if ( is_null( $this->_edge_id ) && is_null( $this->_obj->_edge_id ) ) {
                    $this->logger->error(
                        "getResource($action): argument _edge_id not set.",
                        __FILE__,
                        __LINE__
                    );
                } else {
                    if ( is_null( $this->_edge_id ) ) {
                        $this->_edge_id = $this->_obj->_edge_id;
                    }
                }

                $resource = 'nsx/edges/' . $this->_edge_id . '/' . $this->_resource;
                $this->logger->debug( 'getResource( ' . $action . ' ): return ' . $resource );
                break;

            default:
                $resource = parent::getResource( $action );
                break;
        }

        return $resource;
    }

    /**
     * Activates action performed with object
     *
     * @param string $action_name the name of action
     *
     * @access public
     */
    function activateCheck( $action_name ) {
        switch ( $action_name ) {
            case ONAPP_ACTIVATE_LOAD:
            case ONAPP_ACTIVATE_SAVE:
            case ONAPP_ACTIVATE_DELETE:
                exit( 'Call to undefined method ' . __CLASS__ . '::' . $action_name . '()' );
                break;
        }
    }

}
