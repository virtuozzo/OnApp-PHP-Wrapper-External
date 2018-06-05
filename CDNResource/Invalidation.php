<?php
/**
 * Managing CDNResource Invalidations
 *
 * much they will be charged per unit.
 *
 * @category    API wrapper
 * @package     OnApp
 * @author      Mykola Vuy
 * @copyright   © 2018 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */

/**
 * Managing CDNResource Invalidations
 * 
 * {@link save}, {@link delete}, and {@link getList}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php )
 */
class OnApp_CDNResource_Invalidation extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'invalidations';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'invalidations';

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
            case '6.0':
                $this->fields = array(
                    'cdn_resource_id'               => array(
                        ONAPP_FIELD_MAP         => '_cdn_resource_id',
                        ONAPP_FIELD_TYPE        => 'integer',
                        ONAPP_FIELD_READ_ONLY   => true,
                    ),
                    'id'                            => array(
                        ONAPP_FIELD_MAP         => '_id',
                        ONAPP_FIELD_TYPE        => 'integer',
                        ONAPP_FIELD_READ_ONLY   => true,
                    ),
                    'rule'                          => array(
                        ONAPP_FIELD_MAP         => '_rule',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'invalidated_at'                => array(
                        ONAPP_FIELD_MAP         => '_invalidated_at',
                        ONAPP_FIELD_TYPE        => 'datetime',
                    ),
                    'wildcard_invalidation_rule'   => array(
                        ONAPP_FIELD_MAP         => '_wildcard_invalidation_rule',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'wildcard_invalidation_rule_id' => array(
                        ONAPP_FIELD_MAP         => '_wildcard_invalidation_rule_id',
                        ONAPP_FIELD_TYPE        => 'integer',
                    ),
                );
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
                 * @name invalidation
                 * @method GET
                 * @alias   /cdn_resources/:id/invalidations(.:format)
                 * @format  {:controller=>"CDNResource_Invalidation", :action=>"index"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name invalidation
                 * @method POST
                 * @alias   /cdn_resources/:id/invalidations(.:format)
                 * @format {:controller=>"CDNResource_Invalidation", :action=>"create"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name invalidation
                 * @method PUT
                 * @alias  /cdn_resources/:id/invalidations(.:format)
                 * @format {:controller=>"CDNResource_Invalidation", :action=>"update"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name invalidation
                 * @method DELETE
                 * @alias   /cdn_resources/:id/invalidations(.:format)
                 * @format {:controller=>"CDNResource_Invalidation", :action=>"destroy"}
                 */
                
                $resource = 'cdn_resources/' . $this->_cdn_resource_id . '/' . $this->_resource;
                $this->logger->debug( 'getResource( ' . $action . ' ): return ' . $resource );
                break;
            default:
                $resource = parent::getResource( $action );
                break;
        }

        return $resource;
    }
    
    /**
     * Sends an API request to get the Objects. After requesting,
     * unserializes the received response into the array of Objects
     *
     * @param integer $cdn_resource_id CDN Resource id
     *
     * @return mixed an array of Object instances on success. Otherwise false
     * @access public
     */
    public function getList($params = null, $url_args = null) {

        if ( ! is_null( $this->_cdn_resource_id ) ) {
            
            $this->_tagRoot = 'invalidation';
            
            $this->setAPIResource( $this->getResource() );
            
            $response = $this->sendRequest( ONAPP_REQUEST_METHOD_GET );
            
            if ( isset( $response['response_body'] ) && !is_null( $response['response_body'] ) ) {
                $response_body = $response['response_body'];
                $data = json_decode( $response_body );
                if ( isset( $data->invalidations ) ) {
                    $response_body = json_encode($data->invalidations);
                    $response['response_body'] = $response_body;
                }
            }

            $result = $this->_castResponseToClass( $response );
            
            $this->_obj = $result;
            
            return $result;
            
        } else {
            $this->logger->error(
                'getList: argument $cdn_resource_id not set.',
                __FILE__,
                __LINE__
            );
        }  
    }
    
    public function save() {
        
        if ( is_null( $this->_id ) && !is_null( $this->wildcard_invalidation_rule_id ) ) {
            $this->_id = $this->wildcard_invalidation_rule_id;
        }
        
        parent::save();
    }
    
}
