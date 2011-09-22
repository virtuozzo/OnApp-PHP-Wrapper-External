<?php
/**
 * Scheduleds
 *
 *
 * @category	API WRAPPER
 * @package		OnApp
 * @author		Yakubskiy Yuriy
 * @copyright	(c) 2011 OnApp
 * @link		http://www.onapp.com/
 * @see			OnApp
 */

/**
 *
 * Managing Disk Backups Schedules
 *
 * The ONAPP_Disk_Schedule class uses the following basic methods:
 * {@link load}, {@link save}, {@link delete}, and {@link getList}.
 *
 * The ONAPP_Disk_Schedule class represents Disk Backups Schedules.
 * The ONAPP class is a parent of ONAPP_Disk_Schedule class.
 *
 * <b>Use the following XML API requests:</b>
 *
 * Get the list of schedules
 *
 *	   - <i>GET onapp.com/schedules.xml</i>
 *
 * Get a particular schedule details
 *
 *	   - <i>GET onapp.com/schedules/{ID}.xml</i>
 *
 * Add new software license
 *
 *	   - <i>POST onapp.com/schedules.xml</i>
 *
 * <schedules type="array">
 *
 * <code>
 * <?xml version="1.0" encoding="UTF-8"?>
 * <schedules>
 *	<schedule>
 *			 <duration>{DURATION}</duration>
 *			 <created_at>{CREATED_AT}</created_at>
 *			 <target_id>{TARGET}</target_id>
 *			 <updated_at>{UPDATED_AT}</updated_at>
 *			 <period>{PERIOD}</period>
 *			 <action>{ACTION}</action>
 *			 <start_at>{START_AT}</start_at>
 *			 <id>{ID}</id>
 *			 <user_id>{USER_ID}</user_id>
 *			 <schedule_logs>
 *			 <schedule_log>
 *				   <created_at>{CREATED_AT}</created_at>
 *				   <updated_at>{UPDATED_AT}</updated_at>
 *				   <schedule_id>{SCHEDULE_ID}</schedule_id>
 *				   <id>{ID}</id>
 *				   <log_output></log_output>
 *				   <status>{STATUS}</status>
 *			  </schedule_log>
 *
 *		  </schedule_logs>
 *		  <params nil="true">{PARAMS}</params>
 *		  <failure_count>{FAILURE_COUNT}</failure_count>
 *		  <status>{STATUS}</status>
 *		  <target_type>{TARGET_TYPE}</target_type>
 *	  </schedule>
 *</schedules>
 * </code>
 *
 * Edit existing schedule
 *
 *	   - <i>PUT onapp.com/shedules/{ID}.xml</i>
 *
 * <code>
 * <?xml version="1.0" encoding="UTF-8"?>
 * <schedules>
 *	<schedule>
 *			 <duration>{DURATION}</duration>
 *			 <created_at>{CREATED_AT}</created_at>
 *			 <target_id>{TARGET}</target_id>
 *			 <updated_at>{UPDATED_AT}</updated_at>
 *			 <period>{PERIOD}</period>
 *			 <action>{ACTION}</action>
 *			 <start_at>{START_AT}</start_at>
 *			 <id>{ID}</id>
 *			 <user_id>{USER_ID}</user_id>
 *			 <schedule_logs>
 *			 <schedule_log>
 *				   <created_at>{CREATED_AT}</created_at>
 *				   <updated_at>{UPDATED_AT}</updated_at>
 *				   <schedule_id>{SCHEDULE_ID}</schedule_id>
 *				   <id>{ID}</id>
 *				   <log_output></log_output>
 *				   <status>{STATUS}</status>
 *			  </schedule_log>
 *
 *		  </schedule_logs>
 *		  <params nil="true">{PARAMS}</params>
 *		  <failure_count>{FAILURE_COUNT}</failure_count>
 *		  <status>{STATUS}</status>
 *		  <target_type>{TARGET_TYPE}</target_type>
 *	  </schedule>
 *</schedules>
 * </code>
 *
 * Delete schedule
 *
 *	   - <i>DELETE onapp.com/shedules/{ID}.xml</i>
 *
 * <b>Use the following JSON API requests:</b>
 *
 * Get the list of schedules
 *
 *	   - <i>GET onapp.com/schedules.json</i>
 *
 * Get a particular schedule
 *
 *	   - <i>GET onapp.com/schedules/{ID}.json</i>
 *
 * Add new schedule
 *
 *	   - <i>POST onapp.com/schedules.json</i>
 *
 * <code>
 * {
 *		schedules: {
 *			duration:'{DURATION}',
 *			target_id:{TARGET_ID},
 *			target_type:{TARGET_TYPE},
 *			period:{PERIOD},
 *			action:{ACTION},
 *			status:{STATUS}
 *		}
 * }
 * </code>
 *
 * Edit existing group
 *
 *	   - <i>PUT onapp.com/schedules/{ID}.json</i>
 *
 * <code>
 * {
 *		software_license: {
 *			duration:'{DURATION}',
 *			period:{PERIOD},
 *			status:{STATUS}
 *		}
 * }
 * </code>
 *
 * Delete group
 *
 *	   - <i>DELETE onapp.com/schedules/{ID}.json</i>
 *
 *
 *
 */
/**
 * Initialize the GET LIST BY DISK ID request
 *
 */
define( 'ONAPP_GETRESOURCE_LIST_BY_DISK_ID', 'get list by disk id' );

class OnApp_Disk_Schedule extends OnApp {
	/**
	 * root tag used in the API request
	 *
	 * @var string
	 */
	var $_tagRoot = 'schedule';

	/**
	 * alias processing the object data
	 *
	 * @var string
	 */
	var $_resource = 'schedules';

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
			case '2.1':
				$this->fields = array(
					'id' => array(
						ONAPP_FIELD_MAP => '_id',
						ONAPP_FIELD_TYPE => 'integer',
						ONAPP_FIELD_READ_ONLY => true
					),
					'duration' => array(
						ONAPP_FIELD_MAP => '_duration',
						ONAPP_FIELD_TYPE => 'integer',
						ONAPP_FIELD_REQUIRED => true,
					),
					'target_id' => array(
						ONAPP_FIELD_MAP => '_target_id',
						ONAPP_FIELD_TYPE => 'integer',
						ONAPP_FIELD_READ_ONLY => true,
					),
					'schedule_logs' => array(
						ONAPP_FIELD_MAP => '_schedule_logs',
						ONAPP_FIELD_TYPE => 'string',
						ONAPP_FIELD_READ_ONLY => true,
					),
					'period' => array(
						ONAPP_FIELD_MAP => '_period',
						ONAPP_FIELD_TYPE => 'string',
						ONAPP_FIELD_REQUIRED => true,
					),
					'updated_at' => array(
						ONAPP_FIELD_MAP => '_updated_at',
						ONAPP_FIELD_TYPE => 'string',
						ONAPP_FIELD_READ_ONLY => true,
					),
					'action' => array(
						ONAPP_FIELD_MAP => '_action',
						ONAPP_FIELD_TYPE => 'string',
						ONAPP_FIELD_READ_ONLY => true,
					),
					'start_at' => array(
						ONAPP_FIELD_MAP => '_start_at',
						ONAPP_FIELD_TYPE => 'string',
						ONAPP_FIELD_READ_ONLY => true,
					),
					'user_id' => array(
						ONAPP_FIELD_MAP => '_user_id',
						ONAPP_FIELD_TYPE => 'integer',
						ONAPP_FIELD_READ_ONLY => true,
					),
					'failure_count' => array(
						ONAPP_FIELD_MAP => '_failure_count',
						ONAPP_FIELD_TYPE => 'integer',
						ONAPP_FIELD_READ_ONLY => true,
					),
					'params' => array(
						ONAPP_FIELD_MAP => '_params',
						ONAPP_FIELD_TYPE => 'string',
						ONAPP_FIELD_READ_ONLY => true,
					),
					'status' => array(
						ONAPP_FIELD_MAP => '_status',
						ONAPP_FIELD_TYPE => 'string',
						ONAPP_FIELD_REQUIRED => true,
						ONAPP_FIELD_DEFAULT_VALUE => 'enabled',

					),
					'target_type' => array(
						ONAPP_FIELD_MAP => '_target_type',
						ONAPP_FIELD_TYPE => 'string',
						ONAPP_FIELD_READ_ONLY => true,
					),
					'created_at' => array(
						ONAPP_FIELD_MAP => '_created_at',
						ONAPP_FIELD_TYPE => 'string',
						ONAPP_FIELD_READ_ONLY => true,
					),
				);
				break;

			case 2.2:
			case 2.3:
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
		$show_log_msg = true;
		switch( $action ) {
			case ONAPP_GETRESOURCE_LIST_BY_DISK_ID:
				$resource = 'settings/disks/' . $this->_target_id . '/' . $this->_resource;
				break;
			default:
				$resource = parent::getResource( $action );
				$show_log_msg = false;
				break;
		}

		if( $show_log_msg ) {
			$this->logger->debug( 'getResource( ' . $action . ' ): return ' . $resource );
		}

		return $resource;
	}

	/**
	 * Sends an API request to get the Objects. After requesting,
	 * unserializes the received response into the array of Objects
	 *
	 * @param integer $disk_id Virtual Machine Disk id
	 *
	 * @return mixed an array of Object instances on success. Otherwise false
	 * @access public
	 */
	function getListByDiskId( $disk_id = null ) {
		if( $disk_id ) {
			$this->_target_id = $disk_id;
		}

		$this->activate( ONAPP_ACTIVATE_GETLIST );

		$this->logger->add( 'getList: Get Transaction list.' );

		$this->setAPIResource( $this->getResource( ONAPP_GETRESOURCE_LIST_BY_DISK_ID ) );
		$response = $this->sendRequest( ONAPP_REQUEST_METHOD_GET );

		$result = $this->castStringToClass( $response );

		if( !empty( $response[ 'errors' ] ) ) {
			return false;
		}

		return ( is_array( $result ) || ! $result ) ? $result : array($result);
	}

	function save() {
		if( $this->_target_id ) {
			$this->fields[ 'target_id' ][ ONAPP_FIELD_REQUIRED ] = true;
			$this->fields[ 'target_type' ][ ONAPP_FIELD_REQUIRED ] = true;
			$this->fields[ 'target_type' ][ ONAPP_FIELD_DEFAULT_VALUE ] = 'Disk';
			$this->fields[ 'action' ][ ONAPP_FIELD_REQUIRED ] = true;
			$this->fields[ 'action' ][ ONAPP_FIELD_DEFAULT_VALUE ] = 'autobackup';
		}

		return parent::save();
	}
}