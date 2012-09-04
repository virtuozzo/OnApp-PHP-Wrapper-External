<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Managing CDN Resources
 *
 *
 * @category    API wrapper
 * @package     OnApp
 * @author      Yakubskiy Yuriy
 * @copyright   (c) 2011 OnApp
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
	 * Magic properties
	 *
	 * @property string  created_at
	 * @property string  updated_at
	 * @property integer id
	 * @property integer user_id
	 * @property string  cdn_hostname
	 * @property integer aflexi_resource_id
	 * @property integer last_24h_cost
	 * @property string  hotlink_policy
	 * @property string  ip_access_policy
	 * @property string  ip_addresses
	 * @property integer resource_type
	 * @property string  country_access_policy
	 * @property string  origin
	 * @property boolean advanced_settings
	 * @property string  domains
	 * @property boolean url_signing_on
	 * @property string  url_signing_key
	 * @property integer cache_expiry
	 * @property boolean password_on
	 * @property string  password_unauthorized_html
	 * @property array   pass
	 * @property array   user
	 * @property array   form_pass
	 * @property string  status
	 * @property string  edge_group_ids
	 * @property array   secondary_hostnames
	 * @property string  ftp_password
	 * @property boolean mp4_pseudo_on
	 * @property boolean flv_pseudo_on
	 * @property boolean ignore_set_cookie_on
	 * @property string  publishing_point
	 * @property boolean anti_leech_on
	 * @property string  anti_leech_domains
	 * @property boolean secure_wowza_on
	 * @property string  secure_wowza_token
	 * @property integer internal_publishing_point
	 * @property integer failover_internal_publishing_point
	 * @property integer external_publishing_url
	 * @property integer failover_external_publishing_url
	 */

	public static $nestedData = array(
		'edge_groups' => 'EdgeGroup',
		'countries' => 'CDNResource_Advanced_Country',
		'origins' => 'CDNResource_Origin',
	);

	/**
	 * root tag used in the API request
	 *
	 * @var string
	 */
	protected $_tagRoot = 'cdn_resource';

	/**
	 * alias processing the object data
	 *
	 * @var string
	 */
	protected $_resource = 'cdn_resources';

	public function __construct() {
		parent::__construct();
		$this->className = __CLASS__;
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
}