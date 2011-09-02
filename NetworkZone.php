<?php
/**
 * Network Zone
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
 * The ONAPP_NetworkZone class uses the following basic methods:
 * {@link load}, {@link save}, {@link delete}, and {@link getList}.
 *
 * The ONAPP_NetworkZone class represents virtual machine network groups.  The ONAPP class is a parent of ONAPP_NetworkZone class.
 *
 * <b>Use the following XML API requests:</b>
 *
 * Get the list of groups
 *
 *	 - <i>GET onapp.com/network_zones.xml</i>
 *
 * Get a particular group details
 *
 *	 - <i>GET onapp.com/network_zones/{ID}.xml</i>
 *
 * Add new group
 *
 *	 - <i>POST onapp.com/network_zones.xml</i>
 *
 * <network_groups type="array">
 *
 * <code>
 * <?xml version="1.0" encoding="UTF-8"?>
 * <network_groups type="array">
 *  <network_group>
 *	<label>{LABEL}</label>
 *  </network_group>
 * </network_groups>
 * </code>
 *
 * Edit existing group
 *
 *	 - <i>PUT onapp.com/network_zones/{ID}.xml</i>
 *
 * <?xml version="1.0" encoding="UTF-8"?>
 * <network_groups type="array">
 *  <network_group>
 *	<label>{LABEL}</label>
 *  </network_group>
 * </network_groups>
 * </code>
 *
 * Delete group
 *
 *	 - <i>DELETE onapp.com/network_zones/{ID}.xml</i>
 *
 * <b>Use the following JSON API requests:</b>
 *
 * Get the list of groups
 *
 *	 - <i>GET onapp.com/network_zones.json</i>
 *
 * Get a particular group details
 *
 *	 - <i>GET onapp.com/network_zones/{ID}.json</i>
 *
 * Add new group
 *
 *	 - <i>POST onapp.com/network_zones.json</i>
 *
 * <code>
 * {
 *	  network_group: {
 *		  label:'{LABEL}',
 *	  }
 * }
 * </code>
 *
 * Edit existing group
 *
 *	 - <i>PUT onapp.com/network_zones/{ID}.json</i>
 *
 * <code>
 * {
 *	  network_group: {
 *		  label:'{LABEL}',
 *	  }
 * }
 * </code>
 *
 * Delete group
 *
 *	 - <i>DELETE onapp.com/network_zones/{ID}.json</i>
 *
 *
 *
 */
class OnApp_NetworkZone extends OnApp {
	/**
	 * root tag used in the API request
	 *
	 * @var string
	 */
	var $_tagRoot = 'network_group';

	/**
	 * alias processing the object data
	 *
	 * @var string
	 */
	var $_resource = 'network_zones';

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
				$this->fields = $this->initFields( 2.1 );
				break;
		}

		parent::initFields( $version, __CLASS__ );
		return $this->fields;
	}
}