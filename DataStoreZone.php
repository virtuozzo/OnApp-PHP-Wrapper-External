<?php
/**
 * Data Store Zone
 *
 * @todo Add description
 *
 * @category	API WRAPPER
 * @package		OnApp
 * @author		Andrew Yatskovets
 * @copyright	(c) 2011 OnApp
 * @link		http://www.onapp.com/
 * @see			OnApp
 */

/**
 *
 * Managing Network Zones
 *
 * The ONAPP_DataStoreZone class uses the following basic methods:
 * {@link load}, {@link save}, {@link delete}, and {@link getList}.
 *
 * The ONAPP_DataStoreZone class represents virtual machine data store groups.
 * The ONAPP class is a parent of ONAPP_DataStoreZone class.
 *
 * <b>Use the following XML API requests:</b>
 *
 * Get the list of groups
 *
 *	 - <i>GET onapp.com/data_store_zones.xml</i>
 *
 * Get a particular group details
 *
 *	 - <i>GET onapp.com/data_store_zones/{ID}.xml</i>
 *
 * Add new group
 *
 *	 - <i>POST onapp.com/data_store_zones.xml</i>
 *
 * <data_store_groups type="array">
 *
 * <code>
 * <?xml version="1.0" encoding="UTF-8"?>
 * <data_store_groups type="array">
 *  <data_store_group>
 *	<label>{LABEL}</label>
 *  </data_store_group>
 * </data_store_groups>
 * </code>
 *
 * Edit existing group
 *
 *	 - <i>PUT onapp.com/data_store_zones/{ID}.xml</i>
 *
 * <?xml version="1.0" encoding="UTF-8"?>
 * <data_store_groups type="array">
 *  <data_store_group>
 *	<label>{LABEL}</label>
 *  </data_store_group>
 * </data_store_groups>
 * </code>
 *
 * Delete group
 *
 *	 - <i>DELETE onapp.com/data_store_zones/{ID}.xml</i>
 *
 * <b>Use the following JSON API requests:</b>
 *
 * Get the list of groups
 *
 *	 - <i>GET onapp.com/data_store_zones.json</i>
 *
 * Get a particular group details
 *
 *	 - <i>GET onapp.com/data_store_zones/{ID}.json</i>
 *
 * Add new group
 *
 *	 - <i>POST onapp.com/data_store_zones.json</i>
 *
 * <code>
 * {
 *	  data_store_group: {
 *		  label:'{LABEL}',
 *	  }
 * }
 * </code>
 *
 * Edit existing group
 *
 *	 - <i>PUT onapp.com/data_store_zones/{ID}.json</i>
 *
 * <code>
 * {
 *	  data_store_group: {
 *		  label:'{LABEL}',
 *	  }
 * }
 * </code>
 *
 * Delete group
 *
 *	 - <i>DELETE onapp.com/data_store_zones/{ID}.json</i>
 *
 *
 *
 */
class OnApp_DataStoreZone extends OnApp {
	/**
	 * root tag used in the API request
	 *
	 * @var string
	 */
	var $_tagRoot = 'data_store_group';

	/**
	 * alias processing the object data
	 *
	 * @var string
	 */
	var $_resource = 'data_store_zones';

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
					'label' => array(
						ONAPP_FIELD_MAP => '_label',
						ONAPP_FIELD_TYPE => 'string',
						ONAPP_FIELD_READ_ONLY => true,
					),
				);
				break;

			case '2.1':
				$this->fields = $this->initFields( '2.0' );
				break;

			case 2.2:
			case 2.3:
				$this->fields = $this->initFields( 2.1 );
				break;
		}

		parent::initFields( $version, __CLASS__ );
		return $this->fields;
	}

	function getResource( $action = ONAPP_GETRESOURCE_DEFAULT ) {
		return parent::getResource( $action );
		/**
		 * ROUTE :
		 * @name user_data_store_groups
		 * @method GET
		 * @alias  /data_store_zones(.:format)
		 * @format {:controller=>"data_store_groups", :action=>"index"}
		 */
		/**
		 * ROUTE :
		 * @name user_data_store_group
		 * @method GET
		 * @alias  /data_store_zones/:id(.:format)
		 * @format  {:controller=>"data_store_groups", :action=>"show"}
		 */
		/**
		 * ROUTE :
		 * @name
		 * @method POST
		 * @alias  /data_store_zones(.:format)
		 * @format  {:controller=>"data_store_groups", :action=>"create"}
		 */
		/**
		 * ROUTE :
		 * @name
		 * @method PUT
		 * @alias  /data_store_zones/:id(.:format)
		 * @format {:controller=>"data_store_groups", :action=>"update"}
		 */
		/**
		 * ROUTE :
		 * @name
		 * @method DELETE
		 * @alias  /data_store_zones/:id(.:format)
		 * @format {:controller=>"data_store_groups", :action=>"destroy"}
		 */
	}
}