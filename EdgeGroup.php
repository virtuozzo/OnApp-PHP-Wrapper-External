<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Managing Edge Groups
 *
 * @category    API wrapper
 * @package     OnApp
 * @author      Yakubskiy Yuriy
 * @copyright   (c) 2011 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */

define( 'ONAPP_GETRESOURCE_EDGE_GROUP_ASSIGN_LOCATION', 'edge_group_assign_location' );

define( 'ONAPP_GETRESOURCE_EDGE_GROUP_UNASSIGN_LOCATION', 'edge_group_unassign_location' );

/**
 * Managing Edge Groups
 *
 * The Edge Group class represents the Edge groups.
 * The OnApp_EdgeGroup class is the parent of the OnApp class.
 *
 * The OnApp_EdgeGroup uses the following basic methods:
 * {@link load}, {@link save}, {@link delete}, and {@link getList}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */
/**
 * Magic properties used for autocomplete
 *
 * @property string   label
 * @property string   created_at
 * @property string   updated_at
 * @property integer  id
 */
class OnApp_EdgeGroup extends OnApp {
	public static $nestedData = array(
		'assigned_locations'  => 'EdgeGroup_AssignedLocation',
		'available_locations' => 'EdgeGroup_AvailableLocation',
	);

	/**
	 * root tag used in the API request
	 *
	 * @var string
	 */
	protected $rootElement = 'edge_group';

	/**
	 * alias processing the object data
	 *
	 * @var string
	 */
	protected $URLPath = 'edge_groups';

	public function __construct() {
		parent::__construct();
		$this->className = __CLASS__;
	}

	/**
	 * Returns the URL Alias of the API Class that inherits the OnApp class
	 *
	 * @param string $action action name
	 *
	 * @return string API resource
	 * @access public
	 */
	protected function getURL( $action = ONAPP_GETRESOURCE_DEFAULT ) {
		switch( $action ) {
			case ONAPP_GETRESOURCE_EDGE_GROUP_ASSIGN_LOCATION:
				/**
				 * TODO: ADD ROUTE
				 *
				 *
				 *
				 *
				 */
				$resource = $this->getURL() . '/' . $this->_id . '/assign';
				break;

			case ONAPP_GETRESOURCE_EDGE_GROUP_UNASSIGN_LOCATION:
				/**
				 * TODO: ADD ROUTE
				 *
				 *
				 *
				 *
				 */
				$resource = $this->getURL() . '/' . $this->_id . '/unassign';
				break;

			default:
				$resource = parent::getURL( $action );
		}

		$this->logger->debug( 'getURL( ' . $action . ' ): return ' . $resource );

		return $resource;
	}

	function assign_location( $edge_group_id, $location_id ) {
		if( $edge_group_id ) {
			$this->_id = $edge_group_id;
		}
		else {
			$this->logger->error(
				'assign: argument edge_group_id not set.',
				__FILE__,
				__LINE__
			);
		}

		if( ! $location_id ) {
			$this->logger->error(
				'assign: argument location_id not set.',
				__FILE__,
				__LINE__
			);
		}

		$data = array(
			'root' => 'tmp_holder',
			'data' => array(
				'location' => $location_id,
			),
		);

		$this->sendPost( ONAPP_GETRESOURCE_EDGE_GROUP_ASSIGN_LOCATION, $data );
	}

	/**
	 *
	 * @param <type> $edge_group_id
	 * @param <type> $location_id
	 */
	function unassign_location( $edge_group_id, $location_id ) {
		if( $edge_group_id ) {
			$this->_id = $edge_group_id;
		}
		else {
			$this->logger->error(
				'assign: argument edge_group_id not set.',
				__FILE__,
				__LINE__
			);
		}

		if( ! $location_id ) {
			$this->logger->error(
				'assign: argument location_id not set.',
				__FILE__,
				__LINE__
			);
		}

		$data = array(
			'root' => 'tmp_holder',
			'data' => array(
				'location' => $location_id,
			),
		);

		$this->sendPost( ONAPP_GETRESOURCE_EDGE_GROUP_UNASSIGN_LOCATION, $data );
	}
}