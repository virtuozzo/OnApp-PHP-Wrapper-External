<?php
/**
 * Software Licenses
 *
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
 * Managing Software Lincenses
 *
 * The ONAPP_SoftwareLincense class uses the following basic methods:
 * {@link load}, {@link save}, {@link delete}, and {@link getList}.
 *
 * The ONAPP_SoftwareLincense class represents Software Lincenses.
 * The ONAPP class is a parent of ONAPP_SoftwareLincense class.
 *
 * <b>Use the following XML API requests:</b>
 *
 * Get the list of software licenses
 *
 *	 - <i>GET onapp.com/software_licenses.xml</i>
 *
 * Get a particular software license details
 *
 *	 - <i>GET onapp.com/software_licenses/{ID}.xml</i>
 *
 * Add new software license
 *
 *	 - <i>POST onapp.com/software_licenses.xml</i>
 *
 * <software_licenses type="array">
 *
 * <code>
 * <?xml version="1.0" encoding="UTF-8"?>
 * <software_licenses type="array">
 *  <software_license>
 *	<license>{LICENSE}</license>
 *  </software_license>
 * </software_licenses>
 * </code>
 *
 * Edit existing group
 *
 *	 - <i>PUT onapp.com/software_licenses/{ID}.xml</i>
 *
 * <?xml version="1.0" encoding="UTF-8"?>
 * <software_licenses type="array">
 *  <software_license>
 *	<license>{LICENSE}</license>
 *  </software_license>
 * </software_licenses>
 * </code>
 *
 * Delete group
 *
 *	 - <i>DELETE onapp.com/software_licenses/{ID}.xml</i>
 *
 * <b>Use the following JSON API requests:</b>
 *
 * Get the list of groups
 *
 *	 - <i>GET onapp.com/software_licenses.json</i>
 *
 * Get a particular group details
 *
 *	 - <i>GET onapp.com/software_licenses/{ID}.json</i>
 *
 * Add new group
 *
 *	 - <i>POST onapp.com/software_licenses.json</i>
 *
 * <code>
 * {
 *	  software_license: {
 *		  license:'{LICENSE}',
 *	  }
 * }
 * </code>
 *
 * Edit existing group
 *
 *	 - <i>PUT onapp.com/software_licenses/{ID}.json</i>
 *
 * <code>
 * {
 *	  software_license: {
 *		  license:'{LICENSE}',
 *	  }
 * }
 * </code>
 *
 * Delete group
 *
 *	 - <i>DELETE onapp.com/software_licenses/{ID}.json</i>
 *
 *
 *
 */
class OnApp_SoftwareLincense extends OnApp {
	/**
	 * root tag used in the API request
	 *
	 * @var string
	 */
	var $_tagRoot = 'software_license';

	/**
	 * alias processing the object data
	 *
	 * @var string
	 */
	var $_resource = 'software_licenses';

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
			case '2.1':
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
					'arch' => array(
						ONAPP_FIELD_MAP => '_arch',
						ONAPP_FIELD_TYPE => 'string',
						ONAPP_FIELD_REQUIRED => true,
					),
					'total' => array(
						ONAPP_FIELD_MAP => '_total',
						ONAPP_FIELD_TYPE => 'integer',
						ONAPP_FIELD_REQUIRED => true,
					),
					'distro' => array(
						ONAPP_FIELD_MAP => '_distro',
						ONAPP_FIELD_TYPE => 'string',
						ONAPP_FIELD_REQUIRED => true,
					),
					'count' => array(
						ONAPP_FIELD_MAP => '_count',
						ONAPP_FIELD_TYPE => 'integer',
						ONAPP_FIELD_REQUIRED => true,
					),
					'tail' => array(
						ONAPP_FIELD_MAP => '_tail',
						ONAPP_FIELD_TYPE => 'string',
						ONAPP_FIELD_REQUIRED => true,
					),
					'edition' => array(
						ONAPP_FIELD_MAP => '_edition',
						ONAPP_FIELD_TYPE => 'string',
						ONAPP_FIELD_REQUIRED => true,
					),
					'license' => array(
						ONAPP_FIELD_MAP => '_license',
						ONAPP_FIELD_TYPE => 'string',
						ONAPP_FIELD_REQUIRED => true,
					),
				);
				break;

			case 2.2:
				$this->fields = $this->initFields( 2.1 );
				break;
		}

		parent::initFields( $version, __CLASS__ );
		return $this->fields;
	}
}