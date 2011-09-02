<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Data Store Join
 *
 * @category	API WRAPPER
 * @package		OnApp
 * @author		Yakubskiy Yuriy
 * @copyright	(c) 2011 OnApp
 * @link		http://www.onapp.com/
 * @see			OnApp
 */

/**
 * ONAPP_Hypervisor_DataStoreJoin
 *
 * This class reprsents the Data Store Joins for Hypervisor Zones.
 *
 * The ONAPP_Hypervisor_DataStoreJoin class uses the following basic methods:
 * {@link getList}.
 *
 * <b>Use the following XML API requests:</b>
 *
 * Get the list of Data Store Joins
 *
 *	 - <i>GET onapp.com/settings/hypervisor_zones/{HYPERVISOR_ZONE_ID}/data_store_joins.xml</i>
 *
 */
class OnApp_HypervisorZone_DataStoreJoin extends OnApp {
	/**
	 * root tag used in the API request
	 *
	 * @var string
	 */
	var $_tagRoot = 'data_store_join';

	/**
	 * alias processing the object data
	 *
	 * @var string
	 */
	var $_resource = 'data_store_joins';

	public function __construct() {
		parent::__construct();
		$this->className = __CLASS__;
	}

	/**
	 * API Fields description
	 *
	 * @param string|float $version OnApp API version
	 * @param string $className current class' name
	 * @return array
	 */
	public function initFields( $version = null, $className = '' ) {
		switch( $version ) {
			case '2.0':
				$this->fields = array(
					'id' => array(
						ONAPP_FIELD_MAP => '_id',
						ONAPP_FIELD_TYPE => 'integer',
						ONAPP_FIELD_READ_ONLY => true
					),
					'created_at' => array(
						ONAPP_FIELD_MAP => '_created_at',
						ONAPP_FIELD_TYPE => 'datetime',
						ONAPP_FIELD_READ_ONLY => true,
					),
					'updated_at' => array(
						ONAPP_FIELD_MAP => '_updated_at',
						ONAPP_FIELD_TYPE => 'datetime',
						ONAPP_FIELD_READ_ONLY => true,
					),
					'data_store_id' => array(
						ONAPP_FIELD_MAP => '_data_store_id',
						ONAPP_FIELD_TYPE => 'integer',
						ONAPP_FIELD_REQUIRED => true,
					),
				);
				break;

			case '2.1':
				$this->fields = $this->initFields( '2.0' );
				$this->fields[ 'target_join_id' ] = array(
					ONAPP_FIELD_MAP => '_target_join_id',
					ONAPP_FIELD_TYPE => 'integer',
					ONAPP_FIELD_REQUIRED => true
				);
				$this->fields[ 'target_join_type' ] = array(
					ONAPP_FIELD_MAP => '_target_join_type',
					ONAPP_FIELD_TYPE => 'string',
					ONAPP_FIELD_REQUIRED => true
				);
				break;

			case 2.2:
				$this->fields = $this->initFields( 2.1 );
				break;
		}

		parent::initFields( $version, __CLASS__ );
		return $this->fields;
	}

	/**
	 * Returns the URL Alias of the API Class that inherits the Class ONAPP
	 *
	 * @param string $action action name
	 *
	 * @return string API resource
	 * @access public
	 */
	function getResource( $action = ONAPP_GETRESOURCE_DEFAULT ) {
		switch( $action ) {
			case ONAPP_GETRESOURCE_DEFAULT:
				/**
				 * ROUTE :
				 * @name hypervisor_data_store_joins
				 * @method GET
				 * @alias  /settings/hyrvisor_zones/:hypervisor_id/data_store_joins(.:format)
				 * @format  {:controller=>"data_store_joins", :action=>"index"}
				 */
				$resource = 'settings/hypervisor_zones/' . $this->_target_join_id . '/' . $this->_resource;
				$this->logger->debug( 'getResource( ' . $action . ' ): return ' . $resource );
				break;

			default:
				$resource = parent::getResource( $action );
				break;
		}

		return $resource;
	}

	/**
	 * Gets list of datastore joins to particular hypervisor zone
	 *
	 * @param integet $target_join_id hypervisor zone id
	 * @return array of datastore join objects
	 */
	function getList( $target_join_id = null ) {
		if( is_null( $target_join_id ) && !is_null( $this->_target_join_id ) ) {
			$target_join_id = $this->_target_join_id;
		}

		if( !is_null( $target_join_id ) ) {
			$this->_target_join_id = $target_join_id;
			return parent::getList();
		}
		else {
			$this->logger->error(
				'getList: argument _target_join_id not set.',
				__FILE__,
				__LINE__
			);
		}
	}

	/**
	 * Activates action performed with object
	 *
	 * @param string $action_name the name of action
	 *
	 * @access public
	 */
	function activate( $action_name ) {
		switch( $action_name ) {
			case ONAPP_ACTIVATE_LOAD:
			case ONAPP_ACTIVATE_SAVE:
			case ONAPP_ACTIVATE_DELETE:
				exit( 'Call to undefined method ' . __CLASS__ . '::' . $action_name . '()' );
				break;
		}
	}
}