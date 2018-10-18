<?php
/**
 * Managing CDNResource WAF
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
 * Managing CDNResource WAF
 * 
 * {@link save}, {@link delete}, and {@link getList}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php )
 */
class OnApp_CDNResource_WAF extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'cdn_resource';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'waf';

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
            case 6.0:
                $this->fields = array(
                    'id'    => array(
                        ONAPP_FIELD_MAP         => '_id',
                        ONAPP_FIELD_TYPE        => 'integer',
                        ONAPP_FIELD_READ_ONLY   => true,
                    ),
                    'waf_on'    => array(
                        ONAPP_FIELD_MAP         => '_waf_on',
                        ONAPP_FIELD_TYPE        => 'boolean',
                    ),
                    'waf_ruleset_blacklists'    => array(
                        ONAPP_FIELD_MAP         => '_waf_ruleset_blacklists',
                        ONAPP_FIELD_CLASS       => 'OnApp_CDNResource_WAF_RulesetBlacklists',
                    ),
                    'waf_ruleset'               => array(
                        ONAPP_FIELD_MAP         => '_waf_ruleset',
                        ONAPP_FIELD_TYPE        => 'string',
                        ONAPP_FIELD_READ_ONLY   => true,
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
    public function getResource( $action = ONAPP_GETRESOURCE_DEFAULT ) {
        switch ( $action ) {
            case ONAPP_GETRESOURCE_DEFAULT:
                /**
                 * ROUTE :
                 *
                 * @name waf
                 * @method GET
                 * @alias   /cdn_resources/:id/waf(.:format)
                 * @format  {:controller=>"CDNResource_WAF", :action=>"index"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name waf
                 * @method POST
                 * @alias   /cdn_resources/:id/waf(.:format)
                 * @format {:controller=>"CDNResource_WAF", :action=>"create"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name waf
                 * @method PUT
                 * @alias  /cdn_resources/:id/waf(.:format)
                 * @format {:controller=>"CDNResource_WAF", :action=>"update"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name waf
                 * @method DELETE
                 * @alias   /cdn_resources/:id/waf(.:format)
                 * @format {:controller=>"CDNResource_WAF", :action=>"destroy"}
                 */
                if ( is_null( $this->_id ) && is_null( $this->_obj->_id ) ) {
                    $this->logger->error(
                        "getResource($action): argument _id not set.",
                        __FILE__,
                        __LINE__
                    );
                } else {
                    if ( is_null( $this->_id ) ) {
                        $this->_id = $this->_obj->_id;
                    }
                }
                $resource = 'cdn_resources/' . $this->_id . '/' . $this->_resource;
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

        if ( ! is_null( $this->_id ) ) {
            
            $this->setAPIResource( $this->getResource() );
            
            $response = $this->sendRequest( ONAPP_REQUEST_METHOD_GET );
            
            if ( isset( $response['response_body'] ) && !is_null( $response['response_body'] ) ) {
                $response_body = $response['response_body'];
                $data = json_decode( $response_body );
                
                if ( isset( $data->cdn_resource ) ) {
                    $response_body = json_encode(array($data));
                    $response['response_body'] = $response_body;
                }
            }
            
            $result = $this->_castResponseToClass( $response );
            
            $this->_obj = $result;
            
            return $result;
            
        } else {
            $this->logger->error(
                'getList: argument $_id not set.',
                __FILE__,
                __LINE__
            );
        }  
    }
    
    /**
     * The method saves an Object
     *
     * @param  bollean: true - edit | false - create
     * @return void
     */
    public function save() {
        
        if ( !isset( $this->_waf_on ) && empty( $this->_waf_on ) ) {
            $this->logger->error(
                "save(): argument _waf_on not set.",
                __FILE__,
                __LINE__
            );
        }
        
        $data = array(
            'root'        => $this->_tagRoot,
            'data'        => array(
                'waf_on'                    => $this->_waf_on,
                'waf_ruleset_blacklists'    => $this->_waf_ruleset_blacklists,
            ),
        );
        
        if ( $this->_waf_on && is_countable($this->_waf_ruleset_blacklists) && count( $this->_waf_ruleset_blacklists ) ) {
            $data['data']['waf_ruleset_blacklists'] = $this->_waf_ruleset_blacklists;
        }
        
        $this->sendPut( ONAPP_GETRESOURCE_DEFAULT, $data );
            
    }
   
}
