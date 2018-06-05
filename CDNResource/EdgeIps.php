<?php
/**
 * Managing CDNResource EdgeIps
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
 * Managing CDNResource EdgeIps
 * 
 * {@link getList}
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php )
 */
class OnApp_CDNResource_EdgeIps extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'edge_ips';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'cdn_resources/edge_ips';

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
                    'edge_ip'  => array(
                        ONAPP_FIELD_MAP         => '_edge_ip',
                        ONAPP_FIELD_TYPE        => 'string',
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
                 * @name CDNResource EdgeIps
                 * @method GET
                 * @alias   /cdn_resources/edge_ips(.:format)
                 * @format  {:controller=>"CDNResource_EdgeIps", :action=>"index"}
                 */

                $resource = $this->_resource;
                $this->logger->debug( 'getResource( ' . $action . ' ): return ' . $resource );
                break;
            
            default:
                $resource = parent::getResource( $action );
                break;
        }

        return $resource;
    }
}
