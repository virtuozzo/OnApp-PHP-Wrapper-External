<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Usage Statistics
 *
 * @category    API wrapper
 * @package     OnApp
 * @author      Vitaliy Kondratyuk
 * @copyright   (c) 2012 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */

/**
 * Usage Statistics
 *
 * The Usage Statistics class uses the following basic methods:
 * {@link getList}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */
/**
 * Magic properties used for autocomplete
 *
 * @property integer $user_id
 * @property integer $virtual_machine_id
 * @property string  $data_received
 * @property string  $data_sent
 * @property string  $data_read
 * @property string  $data_written
 * @property string  $writes_completed
 * @property string  $reads_completed
 * @property string  $cpu_usage
 */
class OnApp_UsageStatistic extends OnApp {
	/**
	 * root tag used in the API request
	 *
	 * @var string
	 */
	protected $rootElement = 'vm_stat';

	/**
	 * alias processing the object data
	 *
	 * @var string
	 */
	protected $URLPath = 'usage_statistics';

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

	protected function getURL( $action = ONAPP_GETRESOURCE_DEFAULT ) {
		return parent::getURL( $action );
		/**
		 * ROUTE :
		 *
		 * @name usage_statistics
		 * @method GET
		 * @alias   /usage_statistics(.:format)
		 * @format  {:controller=>"usage_statistics", :action=>"index"}
		 */
	}
}