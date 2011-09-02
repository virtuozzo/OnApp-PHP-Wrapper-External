<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Managing Groups
 *
 * Groups are created to set prices for the resources so that users know how
 * much they will be charged per unit. The prices can be set for the memory,
 * CPU, CPU Share, and Disk size. Each user is assigned a billing group during
 * the creation process.
 *
 * @category	API WRAPPER
 * @package		OnApp
 * @author		Andrew Yatskovets
 * @copyright	(c) 2011 OnApp
 * @link		http://www.onapp.com/
 * @see			OnApp
 */

/**
 * Managing Groups
 *
 * The Group class represents the billing groups.
 * The ONAPP class is the parent of the Group class.
 *
 * The ONAPP_Group uses the following basic methods:
 * {@link load}, {@link save}, {@link delete}, and {@link getList}.
 *
 * <b>Use the following XML API requests:</b>
 *
 * Get the list of groups
 *
 *	 - <i>GET onapp.com/settings/groups.xml</i>
 *
 * Get a particular group details
 *
 *	 - <i>GET onapp.com/settings/groups/{ID}.xml</i>
 *
 * Add new group
 *
 *	 - <i>POST onapp.com/settings/groups.xml</i>
 *
 * <code>
 * <?xml version="1.0" encoding="UTF-8"?>
 * <group>
 *	<label>{LABEL}</label>
 *	<price_cpu>{PRICE}</price_cpu>
 *	<price_cpu_share>{PRICE}</price_cpu_share>
 *	<price_disk_size>{PRICE}</price_disk_size>
 *	<price_memory>{PRICE}</price_memory>
 *	<price_ip_address>{PRICE}</price_ip_address>
 *	<price_cpu_power_off>{PRICE}</price_cpu_power_off>
 *	<price_cpu_share_power_off>{PRICE}</price_cpu_share_power_off>
 *	<price_disk_size>_power_off{PRICE}</price_disk_size_power_off>
 *	<price_memory_power_off>{PRICE}</price_memory_power_off>
 *	<price_ip_address_power_off>{PRICE}</price_ip_address_power_off>
 *	<price_storage_disk_size>{PRICE}</price_storage_disk_size>
 * </group>
 * </code>
 *
 * Edit existing group
 *
 *	 - <i>PUT onapp.com/settings/groups/{ID}.xml</i>
 *
 * <code>
 * <?xml version="1.0" encoding="UTF-8"?>
 * <group>
 *	<label>{LABEL}</label>
 *	<price_cpu>{PRICE}</price_cpu>
 *	<price_cpu_share>{PRICE}</price_cpu_share>
 *	<price_disk_size>{PRICE}</price_disk_size>
 *	<price_memory>{PRICE}</price_memory>
 *	<price_ip_address>{PRICE}</price_ip_address>
 *	<price_cpu_power_off>{PRICE}</price_cpu_power_off>
 *	<price_cpu_share_power_off>{PRICE}</price_cpu_share_power_off>
 *	<price_disk_size>_power_off{PRICE}</price_disk_size_power_off>
 *	<price_memory_power_off>{PRICE}</price_memory_power_off>
 *	<price_ip_address_power_off>{PRICE}</price_ip_address_power_off>
 *	<price_storage_disk_size>{PRICE}</price_storage_disk_size>
 * </group>
 * </code>
 *
 * Delete group
 *
 *	 - <i>DELETE onapp.com/settings/groups/{ID}.xml</i>
 *
 * <b>Use the following JSON API requests:</b>
 *
 * Get the list of groups
 *
 *	 - <i>GET onapp.com/settings/groups.json</i>
 *
 * Get a particular group details
 *
 *	 - <i>GET onapp.com/settings/groups/{ID}.json</i>
 *
 * Add new group
 *
 *	 - <i>POST onapp.com/settings/groups.json</i>
 *
 * <code>
 * {
 *	  group: {
 *		  label:'{LABEL}',
 *		  price_cpu:{PRICE},
 *		  price_cpu_share:{PRICE},
 *		  price_disk_size:{PRICE},
 *		  price_memory:{PRICE},
 *		  price_ip_address:{PRICE},
 *		  price_cpu_power_off:{PRICE},
 *		  price_cpu_share_power_off:{PRICE},
 *		  price_disk_size_power_off:{PRICE},
 *		  price_memory_power_off:{PRICE},
 *		  price_ip_address_power_off:{PRICE},
 *		  price_storage_disk_size:{PRICE}
 *	  }
 * }
 * </code>
 *
 * Edit existing group
 *
 *	 - <i>PUT onapp.com/settings/groups/{ID}.json</i>
 *
 * <code>
 * {
 *	  group: {
 *		  label:'{LABEL}',
 *		  price_cpu:{PRICE},
 *		  price_cpu_share:{PRICE},
 *		  price_disk_size:{PRICE},
 *		  price_memory:{PRICE},
 *		  price_ip_address:{PRICE},
 *		  price_cpu_power_off:{PRICE},
 *		  price_cpu_share_power_off:{PRICE},
 *		  price_disk_size_power_off:{PRICE},
 *		  price_memory_power_off:{PRICE},
 *		  price_ip_address_power_off:{PRICE},
 *		  price_storage_disk_size:{PRICE}
 *	  }
 * }
 * </code>
 *
 * Delete group
 *
 *	 - <i>DELETE onapp.com/settings/groups/{ID}.json</i>
 */
class OnApp_Group extends OnApp {
	/**
	 * root tag used in the API request
	 *
	 * @var string
	 */
	var $_tagRoot = 'group';

	/**
	 * alias processing the object data
	 *
	 * @var string
	 */
	var $_resource = 'groups';

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
						ONAPP_FIELD_READ_ONLY => true,
					),
					'created_at' => array(
						ONAPP_FIELD_MAP => '_created_at',
						ONAPP_FIELD_TYPE => 'datetime',
						ONAPP_FIELD_READ_ONLY => true
					),
					'identifier' => array(
						ONAPP_FIELD_MAP => '_identifier',
						ONAPP_FIELD_TYPE => 'integer',
						ONAPP_FIELD_READ_ONLY => true,
					),
					'label' => array(
						ONAPP_FIELD_MAP => '_label',
						ONAPP_FIELD_REQUIRED => true,
						ONAPP_FIELD_DEFAULT_VALUE => ''
					),
					'price_cpu' => array(
						ONAPP_FIELD_MAP => '_price_cpu',
						ONAPP_FIELD_TYPE => 'decimal',
						ONAPP_FIELD_REQUIRED => true,
						ONAPP_FIELD_DEFAULT_VALUE => '0.0',
					),
					'price_cpu_share' => array(
						ONAPP_FIELD_MAP => '_price_cpu_share',
						ONAPP_FIELD_TYPE => 'decimal',
						ONAPP_FIELD_REQUIRED => true,
						ONAPP_FIELD_DEFAULT_VALUE => '0.0',
					),
					'price_disk_size' => array(
						ONAPP_FIELD_MAP => '_price_disk_size',
						ONAPP_FIELD_TYPE => 'decimal',
						ONAPP_FIELD_REQUIRED => true,
						ONAPP_FIELD_DEFAULT_VALUE => '0.0',
					),
					'price_memory' => array(
						ONAPP_FIELD_MAP => '_price_memory',
						ONAPP_FIELD_TYPE => 'decimal',
						ONAPP_FIELD_REQUIRED => 'true',
						ONAPP_FIELD_DEFAULT_VALUE => '0.0',
					),
					'updated_at' => array(
						ONAPP_FIELD_MAP => '_updated_at',
						ONAPP_FIELD_TYPE => 'datetime',
						ONAPP_FIELD_READ_ONLY => true
					),
					'price_ip_address' => array(
						ONAPP_FIELD_MAP => '_price_ip_address',
						ONAPP_FIELD_REQUIRED => 'true',
					),
					'price_storage_disk_size' => array(
						ONAPP_FIELD_MAP => '_price_storage_disk_size',
						ONAPP_FIELD_TYPE => 'decimal',
						ONAPP_FIELD_REQUIRED => 'true',
						ONAPP_FIELD_DEFAULT_VALUE => '0.0',
					),
					'price_cpu_power_off' => array(
						ONAPP_FIELD_MAP => '_price_cpu_power_off',
						ONAPP_FIELD_TYPE => 'decimal',
						ONAPP_FIELD_REQUIRED => 'true',
						ONAPP_FIELD_DEFAULT_VALUE => '0.0',
					),
					'price_memory_power_off' => array(
						ONAPP_FIELD_MAP => '_price_memory_power_off',
						ONAPP_FIELD_TYPE => 'decimal',
						ONAPP_FIELD_REQUIRED => 'true',
						ONAPP_FIELD_DEFAULT_VALUE => '0.0',
					),
					'price_disk_size_power_off' => array(
						ONAPP_FIELD_MAP => '_price_disk_size_power_off',
						ONAPP_FIELD_TYPE => 'decimal',
						ONAPP_FIELD_REQUIRED => 'true',
						ONAPP_FIELD_DEFAULT_VALUE => '0.0',
					),
					'price_cpu_share_power_off' => array(
						ONAPP_FIELD_MAP => '_price_cpu_share_power_off',
						ONAPP_FIELD_TYPE => 'decimal',
						ONAPP_FIELD_REQUIRED => 'true',
						ONAPP_FIELD_DEFAULT_VALUE => '0.0',
					),
					'price_ip_address_power_off' => array(
						ONAPP_FIELD_MAP => '_price_ip_address_power_off',
						ONAPP_FIELD_TYPE => 'decimal',
						ONAPP_FIELD_REQUIRED => 'true',
						ONAPP_FIELD_DEFAULT_VALUE => '0.0',
					),
				);
				break;

			case '2.1':
				$this->fields = array();
				break;

			case 2.2:
				$this->fields = $this->initFields( 2.1 );
				break;
		}

		parent::initFields( $version, __CLASS__ );
		return $this->fields;
	}
}