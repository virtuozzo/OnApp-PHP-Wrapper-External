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
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 ) 
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
			case 2.3:
				$this->fields = $this->initFields( 2.1 );
				break;
		}

		parent::initFields( $version, __CLASS__ );
		return $this->fields;
	}
}