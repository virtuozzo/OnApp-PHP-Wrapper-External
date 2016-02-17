<?php
/**
 * Managing VDCS
 *
 *
 * @category    API wrapper
 * @package     OnApp
 * @author
 * @copyright   © 2011 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */

/**
 * Edge Gateways
 *
 */
class OnApp_VDCS extends OnApp {
	/**
	 * root tag used in the API request
	 *
	 * @var string
	 */
	var $_tagRoot = 'vdc';
	/**
	 * alias processing the object data
	 *
	 * @var string
	 */
	var $_resource = 'vdcs';

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
			case 4.0:
			case 4.1:
				$this->fields = [
					'id'               => [
						ONAPP_FIELD_MAP       => '_id',
						ONAPP_FIELD_TYPE      => 'integer',
						ONAPP_FIELD_READ_ONLY => true,
					],
					'allocation_model' => [
						ONAPP_FIELD_MAP       => '_allocation_model',
						ONAPP_FIELD_READ_ONLY => true,
					],
					'cpu_allocated'    => [
						ONAPP_FIELD_MAP       => '_cpu_allocated',
						ONAPP_FIELD_READ_ONLY => true,
					],
					'cpu_limit'        => [
						ONAPP_FIELD_MAP       => '_cpu_limit',
						ONAPP_FIELD_READ_ONLY => true,
					],
					'label'            => [
						ONAPP_FIELD_MAP       => '_label',
						ONAPP_FIELD_READ_ONLY => true,
					],
				];
				break;
			case 4.2:
				$this->fields = $this->initFields( 4.1 ) + [
						'cpu_reserved'      => [
							ONAPP_FIELD_MAP       => 'cpu_reserved',
							ONAPP_FIELD_READ_ONLY => true,
						],
						'cpu_used'          => [
							ONAPP_FIELD_MAP       => 'cpu_used',
							ONAPP_FIELD_READ_ONLY => true,
						],
						'created_at'        => [
							ONAPP_FIELD_MAP       => 'created_at',
							ONAPP_FIELD_READ_ONLY => true,
						],
						'enabled'           => [
							ONAPP_FIELD_MAP       => 'enabled',
							ONAPP_FIELD_READ_ONLY => true,
						],
						'fast_provisioning' => [
							ONAPP_FIELD_MAP       => 'fast_provisioning',
							ONAPP_FIELD_READ_ONLY => true,
						],
						'guaranteed_cpu'    => [
							ONAPP_FIELD_MAP       => 'guaranteed_cpu',
							ONAPP_FIELD_READ_ONLY => true,
						],
						'guaranteed_memory' => [
							ONAPP_FIELD_MAP       => 'guaranteed_memory',
							ONAPP_FIELD_READ_ONLY => true,
						],
						'identifier'        => [
							ONAPP_FIELD_MAP       => 'identifier',
							ONAPP_FIELD_READ_ONLY => true,
						],
						'memory_allocated'  => [
							ONAPP_FIELD_MAP       => 'memory_allocated',
							ONAPP_FIELD_READ_ONLY => true,
						],
						'memory_limit'      => [
							ONAPP_FIELD_MAP       => 'memory_limit',
							ONAPP_FIELD_READ_ONLY => true,
						],
						'memory_reserved'   => [
							ONAPP_FIELD_MAP       => 'memory_reserved',
							ONAPP_FIELD_READ_ONLY => true,
						],
						'memory_used'       => [
							ONAPP_FIELD_MAP       => 'memory_used',
							ONAPP_FIELD_READ_ONLY => true,
						],
						'network_quota'     => [
							ONAPP_FIELD_MAP       => 'network_quota',
							ONAPP_FIELD_READ_ONLY => true,
						],
						'thin_provisioning' => [
							ONAPP_FIELD_MAP       => 'thin_provisioning',
							ONAPP_FIELD_READ_ONLY => true,
						],
						'updated_at'        => [
							ONAPP_FIELD_MAP       => 'updated_at',
							ONAPP_FIELD_READ_ONLY => true,
						],
						'user_group_id'     => [
							ONAPP_FIELD_MAP       => 'user_group_id',
							ONAPP_FIELD_READ_ONLY => true,
						],
						'vcpu_speed'        => [
							ONAPP_FIELD_MAP       => 'vcpu_speed',
							ONAPP_FIELD_READ_ONLY => true,
						],
						'vm_quota'          => [
							ONAPP_FIELD_MAP       => 'vm_quota',
							ONAPP_FIELD_READ_ONLY => true,
						],
					];
				break;
		}

		parent::initFields( $version, __CLASS__ );

		return $this->fields;
	}

	function getResource( $action = ONAPP_GETRESOURCE_DEFAULT ) {
		switch( $action ) {
			default:
				$resource = parent::getResource( $action );
				break;
		}

		return $resource;
	}
}