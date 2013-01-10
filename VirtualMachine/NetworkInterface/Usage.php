<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * VM Backups
 *
 * @category    API wrapper
 * @package     OnApp
 * @subpackage  VirtualMachine_NetworkInterface
 * @author      Yuriy Yakubskiy
 * @copyright   (c) 2012 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */

/**
 * VM Network Interface Usage
 *
 * This class represents the VM Network Interface Usage.
 *
 * The OnApp_VirtualMachine_NetworkInterface_Usage class uses the following basic methods:
 * {@link load}, {@link getList}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */
/**
 * Magic properties used for autocomplete
 *
 * @property integer  $id
 * @property string   $created_at
 * @property string   $updated_at
 * @property integer  $data_received
 * @property integer  $data_sent
 * @property integer  $user_id
 * @property integer  $network_interface_id
 * @property integer  $virtual_machine_id
 */
class OnApp_VirtualMachine_NetworkInterface_Usage extends OnApp {
	/**
	 * root tag used in the API request
	 *
	 * @var string
	 */
	protected $rootElement = 'net_hourly_stat';

	/**
	 * alias processing the object data
	 *
	 * @var string
	 */
	protected $URLPath = 'usage';

	/**
	 * Returns the URL Alias of the API Class that inherits the OnApp class
	 *
	 * @param string $action action name
	 *
	 * @return string API resource
	 */
	protected function getURL( $action = ONAPP_GETRESOURCE_DEFAULT ) {
		$show_log_msg = true;
		switch( $action ) {
			case ONAPP_GETRESOURCE_DEFAULT:
				/**
				 * ROUTE :
				 *
				 * @name virtual_machine_backups
				 * @method GET
				 * @alias   /virtual_machines/:virtual_machine_id/backups(.:format)
				 * @format  {:controller=>"backups", :action=>"index"}
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

				if( is_null( $this->network_interface_id ) && is_null( $this->loadedObject->network_interface_id ) ) {
					$this->logger->logError(
						'getURL( ' . $action . ' ): property network_interface_id not set.',
						__FILE__,
						__LINE__
					);
				}
				else {
					if( is_null( $this->network_interface_id ) ) {
						$this->network_interface_id = $this->loadedObject->network_interface_id;
					}
				}

				$resource = 'virtual_machines/' . $this->virtual_machine_id . '/network_interfaces/' . $this->network_interface_id . '/' . $this->URLPath;
				break;

			default:
				$resource = parent::getURL( $action );
		}

		if( $show_log_msg ) {
			$this->logger->logDebug( 'getURL( ' . $action . ' ): return ' . $resource );
		}

		return $resource;
	}

	/**
	 * Sends an API request to get the Objects. After requesting,
	 * unserializes the received response into the array of Objects
	 *
	 * @param integer $virtual_machine_id   Virtual Machine id
	 * @param integer $network_interface_id Network Interface id
	 * @param mixed   $url_args             additional parameters
	 *
	 * @return mixed an array of Object instances on success. Otherwise false
	 */
	function getList( $virtual_machine_id = null, $network_interface_id = null, $url_args = '' ) {
		if( is_null( $virtual_machine_id ) && ! is_null( $this->virtual_machine_id ) ) {
			$virtual_machine_id = $this->virtual_machine_id;
		}

		if( ! is_null( $virtual_machine_id ) ) {
			$this->virtual_machine_id = $virtual_machine_id;
		}
		else {
			$this->logger->logError(
				'getList: property virtual_machine_id not set.',
				__FILE__,
				__LINE__
			);
		}

		if( is_null( $network_interface_id ) && ! is_null( $this->network_interface_id ) ) {
			$network_interface_id = $this->network_interface_id;
		}

		if( ! is_null( $network_interface_id ) ) {
			$this->network_interface_id = $network_interface_id;
		}
		else {
			$this->logger->logError(
				'getList: property network_interface_id not set.',
				__FILE__,
				__LINE__
			);
		}

		return parent::getList( null, $url_args );
	}
}