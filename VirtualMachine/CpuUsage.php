<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 *
 * The CPU utilization for Virtual Machine
 *
 * @category    API wrapper
 * @package     OnApp
 * @subpackage  VirtualMachine
 * @author      Vitaliy Kondratyuk
 * @copyright   (c) 2012 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */

/**
 * The CPU utilization for Virtual Machine
 *
 * The OnApp_VirtualMachine_CpuUsage class uses the following basic methods:
 * {@link getList}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */
/**
 * Magic properties used for autocomplete
 *
 * @property integer  $id
 * @property string   $created_at
 * @property string   $updated_at
 * @property integer  $cpu_time
 * @property integer  $virtual_machine_id
 * @property string   $stat_time
 * @property integer  $user_id
 */
class OnApp_VirtualMachine_CpuUsage extends OnApp {
	/**
	 * root tag used in the API request
	 *
	 * @var string
	 */
	protected $rootElement = 'cpu_hourly_stat';

	/**
	 * alias processing the object data
	 *
	 * @var string
	 */
	protected $URLPath = 'cpu_usage';

	/**
	 * Returns the URL Alias of the API Class that inherits the OnApp class
	 *
	 * @param string $action action name
	 *
	 * @return string API resource
	 */
	protected function getURL( $action = ONAPP_GETRESOURCE_DEFAULT ) {
		switch( $action ) {
			case ONAPP_GETRESOURCE_LIST:
				/**
				 * ROUTE :
				 *
				 * @name cpu_usage_virtual_machine
				 * @method GET
				 * @alias   /virtual_machines/:id/cpu_usage(.:format)
				 * @format  {:controller=>"virtual_machines", :action=>"cpu_usage"}
				 */
				if( is_null( $this->virtual_machine_id ) && is_null( $this->loadedObject->virtual_machine_id ) ) {
					$this->logger->logError(
						'getURL( ' . $action . ' ): property virtual_machine_id not set.',
						__FILE__,
						__LINE__
					);
				}
				else {
					if( is_null( $this->virtual_machine_id ) ) {
						$this->virtual_machine_id = $this->loadedObject->virtual_machine_id;
					}
				}

				$resource = 'virtual_machines/' . $this->virtual_machine_id . '/' . $this->URLPath;
				$this->logger->logDebug( 'getURL( ' . $action . ' ): return ' . $resource );
				break;

			default:
				$resource = parent::getURL( $action );
		}

		return $resource;
	}

	/**
	 * Sends an API request to get the Objects. After requesting,
	 * unserializes the received response into the array of Objects
	 *
	 * @param integer $virtual_machine_id Virtual Machine id
	 * @param mixed   $url_args           additional parameters
	 *
	 * @return mixed an array of Object instances on success. Otherwise false
	 */
	public function getList( $virtual_machine_id = null, $url_args = null ) {
		if( is_null( $virtual_machine_id ) && ! is_null( $this->virtual_machine_id ) ) {
			$virtual_machine_id = $this->virtual_machine_id;
		}

		if( ! is_null( $virtual_machine_id ) ) {
			$this->virtual_machine_id = $virtual_machine_id;

			return parent::getList( $virtual_machine_id, $url_args );
		}
		else {
			$this->logger->logError(
				'getList: property virtual_machine_id not set.',
				__FILE__,
				__LINE__
			);
		}
	}

	/**
	 * Activates action performed with object
	 *
	 * @param string $action_name the name of action
	 */
	public function activate( $action_name ) {
		switch( $action_name ) {
			case ONAPP_ACTIVATE_LOAD:
			case ONAPP_ACTIVATE_SAVE:
			case ONAPP_ACTIVATE_DELETE:
				exit( 'Call to undefined method ' . __CLASS__ . '::' . $action_name . '()' );
		}
	}
}