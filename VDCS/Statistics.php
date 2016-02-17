<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * User Statistics
 *
 * @todo        write description
 *
 * @category    API wrapper
 * @package     OnApp
 * @subpackage  User
 * @author      Yakubskiy Yuriy
 * @copyright   © 2011 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */

/**
 * User IP User Statistics
 *
 *  The OnApp_User_Statistics class uses the following basic methods:
 *  {@link getList}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */
class OnApp_VDCS_Statistics extends OnApp {
	/**
	 * root tag used in the API request
	 *
	 * @var string
	 */
	var $_tagRoot = 'vdc_stat';
	/**
	 * alias processing the object data
	 *
	 * @var string
	 */
	var $_resource = 'statistics';

	/**
	 * API Fields description
	 *
	 * @param string|float $version   OnApp API version
	 * @param string       $className current class' name
	 *
	 * @return array
	 */
	public function initFields( $version = null, $className = '' ) {
		switch( $version ) {
			case 4.1:
			case 4.2:
				$this->fields = [
					'id'             => [
						ONAPP_FIELD_MAP       => 'id',
						ONAPP_FIELD_READ_ONLY => true,
					],
					'company_id'     => [
						ONAPP_FIELD_MAP       => 'company_id',
						ONAPP_FIELD_READ_ONLY => true,
					],
					'vdc_id'         => [
						ONAPP_FIELD_MAP       => 'vdc_id',
						ONAPP_FIELD_READ_ONLY => true,
					],
					'cost'           => [
						ONAPP_FIELD_MAP       => 'cost',
						ONAPP_FIELD_READ_ONLY => true,
					],
					'currency_code'  => [
						ONAPP_FIELD_MAP       => 'currency_code',
						ONAPP_FIELD_READ_ONLY => true,
					],
					'stat_time'      => [
						ONAPP_FIELD_MAP       => 'stat_time',
						ONAPP_FIELD_READ_ONLY => true,
					],
					'created_at'     => [
						ONAPP_FIELD_MAP       => 'created_at',
						ONAPP_FIELD_READ_ONLY => true,
					],
					'updated_at'     => [
						ONAPP_FIELD_MAP       => 'updated_at',
						ONAPP_FIELD_READ_ONLY => true,
					],
					'vdc_model_type' => [
						ONAPP_FIELD_MAP       => 'vdc_model_type',
						ONAPP_FIELD_READ_ONLY => true,
					],
					'status'         => [
						ONAPP_FIELD_MAP       => 'status',
						ONAPP_FIELD_READ_ONLY => true,
					],
				];
				break;
		}

		parent::initFields( $version, __CLASS__ );

		return $this->fields;
	}

	/**
	 * Returns the URL Alias of the API Class that inherits the OnApp class
	 *
	 * @param string $action action name
	 *
	 * @return string API resource
	 * @access public
	 */
	function getResource( $action = ONAPP_GETRESOURCE_DEFAULT ) {
		switch( $action ) {
			case ONAPP_GETRESOURCE_DEFAULT:
				/**
				 * ROUTE :
				 *
				 * @name user_vm_stats
				 * @method GET
				 * @alias   /users/:user_id/vm_stats(.:format)
				 * @format  {:controller=>"vm_stats", :action=>"index"}
				 */
				if( is_null( $this->vdc_id ) && is_null( $this->_obj->vdc_id ) ) {
					$this->logger->error(
						"getResource($action): argument vdc_id not set.",
						__FILE__,
						__LINE__
					);
				}
				else {
					if( is_null( $this->vdc_id ) ) {
						$this->vdc_id = $this->_obj->vdc_id;
					}
				}
				$resource = 'vdcs/' . $this->vdc_id . '/' . $this->_resource;
				$this->logger->debug( 'getResource( ' . $action . ' ): return ' . $resource );
				break;

			default:
				$resource = parent::getResource( $action );
				break;
		}

		return $resource;
	}

	/**
	 * Sends an API request to get the Objects. After requesting,
	 * unserializes the received response into the array of Objects
	 *
	 * @param integer $vdc_id User ID
	 *
	 * @return mixed an array of Object instances on success. Otherwise false
	 * @access public
	 */
	function getList( $vdc_id = null, $url_args = [ ] ) {
		if( is_null( $vdc_id ) && ! is_null( $this->vdc_id ) ) {
			$vdc_id = $this->vdc_id;
		}

		if( ! is_null( $vdc_id ) ) {
			$this->vdc_id = $vdc_id;

			return parent::getList( null, $url_args );
		}
		else {
			$this->logger->error(
				'getList: argument vdc_id not set.',
				__FILE__,
				__LINE__
			);
		}
	}
}