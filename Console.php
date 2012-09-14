<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Managing Virtual Machine console
 *
 * Using this class You can get access to virtual machine console
 *
 * @category    API wrapper
 * @package     OnApp
 * @author      Andrew Yatskovets
 * @copyright   (c) 2011 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */

/**
 * Virtual Machine Console
 *
 * The OnApp_Console class uses the following basic methods:
 * {@link load}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */
/**
 * Magic properties used for autocomplete
 *
 * @property integer  $id
 * @property string   $called_in_at
 * @property string   $created_at
 * @property integer  $port
 * @property string   $updated_at
 * @property integer  $virtual_machine_id
 * @property string   $remote_key
 */
class OnApp_Console extends OnApp {
	/**
	 * root tag used in the API request
	 *
	 * @var string
	 */
	protected $rootElement = 'remote_access_session';

	/**
	 * alias processing the object data
	 *
	 * @var string
	 */
	protected $URLPath = 'console';

	/**
	 * Returns the URL Alias for Load of objects of the API Class that inherits the OnApp class
	 *
	 * Can be redefined if the API for load objects does not use the default
	 * alias (the alias consisting of few fields) the same way as {@link
	 * getURL}.
	 *
	 * @param string $action action name
	 *
	 * @return string API resource
	 * @access public
	 *
	 * @see    getURL
	 */
	protected function getURL( $action = ONAPP_GETRESOURCE_DEFAULT ) {
		switch( $action ) {
			case ONAPP_GETRESOURCE_LOAD:
				/**
				 * ROUTE :
				 *
				 * @name
				 * @method GET
				 * @alias  /console_remote/:remote_key(.:format)
				 * @format {:controller=>"virtual_machines", :action=>"console_remote"}
				 */
				$resource = 'virtual_machines/' . $this->_virtual_machine_id . '/' . $this->URLPath;
				$this->logger->logDebug( 'getURL( ' . $action . ' ): return ' . $resource );
				break;

			default:
				$resource = parent::getURL( $action );
		}

		return $resource;
	}

	/**
	 * Sends an API request to get the Object after sending,
	 * unserializes the response into an object
	 *
	 * The key field Parameter ID is used to load the Object. You can re-set
	 * this parameter in the class inheriting OnApp class.
	 *
	 * @param integer $virtual_machine_id Object id
	 *
	 * @return mixed serialized Object instance from API
	 * @access public
	 */
	function load( $virtual_machine_id = null ) {
		if( is_null( $virtual_machine_id ) && ! is_null( $this->_virtual_machine_id ) ) {
			$virtual_machine_id = $this->_virtual_machine_id;
		}

		if( is_null( $virtual_machine_id ) &&
			isset( $this->inheritedObject ) &&
			! is_null( $this->inheritedObject->_virtual_machine_id )
		) {
			$virtual_machine_id = $this->inheritedObject->_virtual_machine_id;
		}

		$this->logger->logMessage( 'load: Load class ( id => "' . $virtual_machine_id . '").' );

		if( ! is_null( $virtual_machine_id ) ) {
			$this->_virtual_machine_id = $virtual_machine_id;

			$this->setAPIResource( $this->getURL( ONAPP_GETRESOURCE_LOAD ) );

			$result                = $this->sendRequest( ONAPP_REQUEST_METHOD_GET );
			$this->inheritedObject = $result;

			return $result;
		}
		else {
			$this->logger->logError(
				'load: property virtual_machine_id not set.',
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
			case ONAPP_ACTIVATE_GETLIST:
			case ONAPP_ACTIVATE_SAVE:
			case ONAPP_ACTIVATE_DELETE:
				exit( 'Call to undefined method ' . __CLASS__ . '::' . $action_name . '()' );
		}
	}
}