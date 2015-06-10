<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Managing CDN Resources
 *
 *
 * @category    API wrapper
 * @package     OnApp
 * @author      Yakubskiy Yuriy
 * @copyright   © 2011 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */

/**
 *
 *
 */
define( 'ONAPP_GETRESOURCE_ENABLE_CDN', 'enable_cdn' );

/**
 *
 *
 */
define( 'ONAPP_GETRESOURCE_CDN_PREFETCH', 'cdn_prefetch' );

/**
 *
 *
 */
define( 'ONAPP_GETRESOURCE_CDN_PURGE', 'cdn_purge' );

/**
 *
 *
 */
define( 'ONAPP_POSTRESOURCE_PURGE_ALL', 'purge_all' );

/**
 * Managing CDN Resource
 *
 * The CDN Resource class represents the CDN Resources.
 * The OnApp_CDNResource class is the parent of the OnApp class.
 *
 * The CDNResource uses the following basic methods:
 * {@link load}, {@link save}, {@link delete}, and {@link getList}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */
class OnApp_CDNResource extends OnApp {
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
    var $_resource = 'cdn_resources';

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
            case '2.3':
                $this->fields = array(
                    'created_at'                 => array(
                        ONAPP_FIELD_MAP       => '_created_at',
                        ONAPP_FIELD_TYPE      => 'string',
                        ONAPP_FIELD_READ_ONLY => true
                    ),
                    'updated_at'                 => array(
                        ONAPP_FIELD_MAP       => '_updated_at',
                        ONAPP_FIELD_TYPE      => 'string',
                        ONAPP_FIELD_READ_ONLY => true
                    ),
                    'id'                         => array(
                        ONAPP_FIELD_MAP       => '_id',
                        ONAPP_FIELD_TYPE      => 'integer',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'user_id'                    => array(
                        ONAPP_FIELD_MAP  => '_user_id',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'cdn_hostname'               => array(
                        ONAPP_FIELD_MAP  => '_cdn_hostname',
                        ONAPP_FIELD_TYPE => 'string',
                        //ONAPP_FIELD_REQUIRED => true,
                    ),
                    'aflexi_resource_id'         => array(
                        ONAPP_FIELD_MAP  => '_aflexi_resource_id',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'origins_for_api'            => array(
                        ONAPP_FIELD_MAP       => '_origins_for_api',
                        ONAPP_FIELD_TYPE      => 'array',
                        ONAPP_FIELD_READ_ONLY => true,
                        ONAPP_FIELD_CLASS     => 'CDNResource_Origin',
                    ),
                    'last_24h_cost'              => array(
                        ONAPP_FIELD_MAP  => '_last_24h_cost',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),

                    // fields to create CDN Resource
                    'hotlink_policy'             => array(
                        ONAPP_FIELD_MAP  => '_hotlink_policy',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'ip_access_policy'           => array(
                        ONAPP_FIELD_MAP  => '_ip_access_policy',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'ip_addresses'               => array(
                        ONAPP_FIELD_MAP  => '_ip_addresses',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'edge_groups'                => array(
                        ONAPP_FIELD_MAP   => '_edge_groups',
                        ONAPP_FIELD_TYPE  => 'array',
                        ONAPP_FIELD_CLASS => 'EdgeGroup',
                    ),
                    'resource_type'              => array(
                        ONAPP_FIELD_MAP           => '_resource_type',
                        ONAPP_FIELD_TYPE          => 'integer',
                        //ONAPP_FIELD_REQUIRED => true,
                        ONAPP_FIELD_DEFAULT_VALUE => 'HTTP_PULL'
                    ),
                    'country_access_policy'      => array(
                        ONAPP_FIELD_MAP  => '_country_access_policy',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'origin'                     => array(
                        ONAPP_FIELD_MAP  => '_origin',
                        ONAPP_FIELD_TYPE => 'string',
                        //ONAPP_FIELD_REQUIRED => true,
                    ),
                    'advanced_settings'          => array(
                        ONAPP_FIELD_MAP  => '_advanced_settings',
                        ONAPP_FIELD_TYPE => 'boolean',
                    ),
                    'hotlink_policy'             => array(
                        ONAPP_FIELD_MAP  => '_hotlink_policy',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'domains'                    => array(
                        ONAPP_FIELD_MAP  => '_domains',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'url_signing_on'             => array(
                        ONAPP_FIELD_MAP  => '_url_signing_on',
                        ONAPP_FIELD_TYPE => 'boolean',
                    ),
                    'url_signing_key'            => array(
                        ONAPP_FIELD_MAP  => '_url_signing_key',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'cache_expiry'               => array(
                        ONAPP_FIELD_MAP  => '_cache_expiry',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'password_on'                => array(
                        ONAPP_FIELD_MAP  => '_password_on',
                        ONAPP_FIELD_TYPE => 'boolean',
                    ),
                    'password_unauthorized_html' => array(
                        ONAPP_FIELD_MAP  => '_password_unauthorized_html',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'pass'                       => array(
                        ONAPP_FIELD_MAP  => '_pass',
                        ONAPP_FIELD_TYPE => 'array',
                    ),
                    'user'                       => array(
                        ONAPP_FIELD_MAP  => '_user',
                        ONAPP_FIELD_TYPE => 'array',
                    ),
                    'form_pass'                  => array(
                        ONAPP_FIELD_MAP  => '_form_pass',
                        ONAPP_FIELD_TYPE => 'array',
                    ),
                    'countries'                  => array(
                        ONAPP_FIELD_MAP   => '_countries',
                        ONAPP_FIELD_TYPE  => 'array',
                        ONAPP_FIELD_CLASS => 'CDNResource_Advanced_Country',
                    ),
                    'status'                     => array(
                        ONAPP_FIELD_MAP  => '_status',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'edge_group_ids'             => array(
                        ONAPP_FIELD_MAP  => '_edge_group_ids',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                );
                break;

            case 3.0:
                $this->fields = $this->initFields( 2.3 );
                $fields       = array(
                    'origins_for_api',
                );
                $this->unsetFields( $fields );

                $this->fields[ 'origins' ]                               = array(
                    ONAPP_FIELD_MAP   => '_origins',
                    ONAPP_FIELD_TYPE  => 'array',
                    ONAPP_FIELD_CLASS => 'CDNResource_Origin',
                );
                $this->fields[ 'secondary_hostnames' ]                   = array(
                    ONAPP_FIELD_MAP  => '_secondary_hostnames',
                    ONAPP_FIELD_TYPE => '_array',
                );
                $this->fields[ 'ftp_password' ]                          = array(
                    ONAPP_FIELD_MAP  => '_ftp_password',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields[ 'mp4_pseudo_on' ]                         = array(
                    ONAPP_FIELD_MAP  => '_mp4_pseudo_on',
                    ONAPP_FIELD_TYPE => 'boolean',
                );
                $this->fields[ 'flv_pseudo_on' ]                         = array(
                    ONAPP_FIELD_MAP  => '_flv_pseudo_on',
                    ONAPP_FIELD_TYPE => 'boolean',
                );
                $this->fields[ 'ignore_set_cookie_on' ]                  = array(
                    ONAPP_FIELD_MAP  => '_ignore_set_cookie_on',
                    ONAPP_FIELD_TYPE => 'boolean',
                );
                $this->fields[ 'publishing_point' ]                      = array(
                    ONAPP_FIELD_MAP  => '_publishing_point',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields[ 'anti_leech_on' ]                         = array(
                    ONAPP_FIELD_MAP  => '_anti_leech_on',
                    ONAPP_FIELD_TYPE => 'boolean',
                );
                $this->fields[ 'anti_leech_domains' ]                    = array(
                    ONAPP_FIELD_MAP  => '_anti_leech_domains',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields[ 'secure_wowza_on' ]                       = array(
                    ONAPP_FIELD_MAP  => '_secure_wowza_on',
                    ONAPP_FIELD_TYPE => 'boolean',
                );
                $this->fields[ 'secure_wowza_token' ]                    = array(
                    ONAPP_FIELD_MAP  => '_secure_wowza_token',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields[ 'internal_publishing_point' ]             = array(
                    ONAPP_FIELD_MAP  => '_internal_publishing_point',
                    ONAPP_FIELD_TYPE => 'integer',
                );
                $this->fields[ 'failover_internal_publishing_point' ]    = array(
                    ONAPP_FIELD_MAP  => '_failover_internal_publishing_point',
                    ONAPP_FIELD_TYPE => 'integer',
                );
                $this->fields[ 'external_publishing_location' ]          = array(
                    ONAPP_FIELD_MAP  => '_external_publishing_location',
                    ONAPP_FIELD_TYPE => 'integer',
                );
                $this->fields[ 'failover_external_publishing_location' ] = array(
                    ONAPP_FIELD_MAP  => '_failover_external_publishing_location',
                    ONAPP_FIELD_TYPE => 'integer',
                );
                $this->fields[ 'origin_sites' ]                          = array(
                    ONAPP_FIELD_MAP  => 'origin_sites',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields[ 'cname' ]                                 = array(
                    ONAPP_FIELD_MAP  => 'cname',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields[ 'push_origin_hostname' ]                  = array(
                    ONAPP_FIELD_MAP  => 'push_origin_hostname',
                    ONAPP_FIELD_TYPE => 'string',
                );
                break;

            case 3.1:
            case 3.2:
            case 3.3:
            case 3.4:
            case 3.5:
            case 4.0:
            case 4.1:
                $this->fields                           = $this->initFields( 3.0 );
                $this->fields[ 'cname' ]                = array(
                    ONAPP_FIELD_MAP  => 'cname',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields[ 'push_origin_hostname' ] = array(
                    ONAPP_FIELD_MAP  => 'push_origin_hostname',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields[ 'origins' ]              = array(
                    ONAPP_FIELD_MAP  => '_origins',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields[ 'cdn_reference' ]        = array(
                    ONAPP_FIELD_MAP  => 'cdn_reference',
                    ONAPP_FIELD_TYPE => 'integer',
                );
                break;
        }

        parent::initFields( $version, __CLASS__ );

        return $this->fields;
    }

    function getResource( $action = ONAPP_GETRESOURCE_DEFAULT ) {
        switch( $action ) {
            case ONAPP_GETRESOURCE_ENABLE_CDN:
                /**
                 * ROUTE :
                 *
                 * @name
                 * @method POST
                 * @alias  /cdn_resources/enable(.:format)
                 * @format {:controller=>"cdn_resources", :action=>"enable"}
                 */
                $resource = $this->_resource . '/enable';
                break;

            case ONAPP_GETRESOURCE_CDN_PREFETCH:
                /**
                 * ROUTE :
                 *
                 * @name
                 * @method POST
                 * @alias  /cdn_resources/:id/prefetch(.:format)
                 * @format {:controller=>"cdn_resources", :action=>"prefetch"}
                 */
                $resource = $this->_resource . '/' . $this->_id . '/prefetch';
                break;

            case ONAPP_GETRESOURCE_CDN_PURGE:
                /**
                 * ROUTE :
                 *
                 * @name
                 * @method POST
                 * @alias  /cdn_resources/:id/purge(.:format)
                 * @format {:controller=>"cdn_resources", :action=>"purge"}
                 */
                $resource = $this->_resource . '/' . $this->_id . '/purge';
                break;

            case ONAPP_POSTRESOURCE_PURGE_ALL:
                /**
                 * ROUTE :
                 *
                 * @name
                 * @method POST
                 * @alias  /cdn_resources/:id/purge_all(.:format)
                 * @format {:controller=>"cdn_resources", :action=>"purge_all"}
                 */
                $resource = $this->_resource . '/' . $this->_id . '/purge_all';
                break;

            default:
                $resource = parent::getResource( $action );
                break;
        }

        $this->logger->debug( 'getResource( ' . $action . ' ): return ' . $resource );

        return $resource;
    }

    /**
     * This tool allows HTTP Pull content to be pre-populated to the CDN.
     * Recommended only if files especially large.
     *
     * @param integer $cdn_resource_id CDN resource id
     * @param string  $prefetch_paths  Paths to prefetch
     */
    public function prefetch( $cdn_resource_id, $prefetch_paths ) {
        if( $cdn_resource_id ) {
            $this->_id = $cdn_resource_id;
        }
        else {
            $this->logger->error(
                'prefetch: argument $cdn_resource_id not set.',
                __FILE__,
                __LINE__
            );
        }

        $data = array(
            'root' => 'tmp_holder',
            'data' => array(
                'prefetch_paths' => $prefetch_paths
            )
        );

        $this->sendPost( ONAPP_GETRESOURCE_CDN_PREFETCH, $data );
    }

    /**
     * This tool allows instant removal of HTTP Pull cache content in the CDN
     *
     * @param integer $cdn_resource_id CDN resource id
     * @param string  $purge_paths     Paths to prefetch
     */
    public function purge( $cdn_resource_id, $purge_paths ) {
        if( $cdn_resource_id ) {
            $this->_id = $cdn_resource_id;
        }
        else {
            $this->logger->error(
                'prefetch: argument $cdn_resource_id not set.',
                __FILE__,
                __LINE__
            );
        }

        $data = array(
            'root' => 'tmp_holder',
            'data' => array(
                'purge_paths' => $purge_paths
            )
        );

        $this->sendPost( ONAPP_GETRESOURCE_CDN_PURGE, $data );
    }

    /**
     * Enables cdn
     *
     */
    public function enable() {
        $this->sendPost( ONAPP_GETRESOURCE_ENABLE_CDN );
    }

    /**
     * This function allows to purge all content
     *
     * @param integer $cdn_resource_id CDN resource id
     */
    function purge_all( $cdn_resource_id ) {
        if( $cdn_resource_id ) {
            $this->_id = $cdn_resource_id;
        }
        else {
            $this->logger->error(
                'prefetch: argument $cdn_resource_id not set.',
                __FILE__,
                __LINE__
            );
        }

        $this->sendPost( ONAPP_POSTRESOURCE_PURGE_ALL );
    }

    public function save() {
        if( count( $this->_countries ) == 0 ) {
            unset( $this->fields[ 'countries' ] );
        }

        return parent::save();
    }
}
