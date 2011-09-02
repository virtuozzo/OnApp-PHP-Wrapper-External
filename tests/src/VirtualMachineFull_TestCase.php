<?php
/**
 * Unit Tests for serializing
 *
 * @package	ONAPP
 * @subpackage tests
 * @author	 Andrew Yatskovets <ayatsk@onapp.com>
 */

define( 'ONAPP_TEST_VM_DEFAULT_OS', 'linux' );

/**
 * Unit Tests for serializing arrays
 *
 * @package	ONAPP
 * @subpackage tests
 * @author	 Andrew Yatskovets <ayatsk@onapp.com>
 */
class VirtualMachineFull_TestCase extends OnApp_TestCase {
	private $_onapp_config = array();
	private $_template_ids = array();
	private $_hypervisor_ids = array();
	private $_data_store_ids = array();
	private $_network_ids = array();
	private $_free_network_ids = array();

	public static function main() {
		$suite = new PHPUnit_Framework_TestSuite( 'VirtualMachineFull_TestCase' );
		$result = PHPUnit_TextUI_TestRunner::run( $suite );
	}

	protected function setUp() {
		parent::setUp();
		$this->_onapp_config = $this->getConfig();
		$this->getTempateIds();
		$this->getHypervisorIds();
		$this->getDataStores();
		$this->getNetworks();
	}

	private function getTempateIds() {
		$template = $this->createObj( 'OnApp_Template' );
		$template_list = $template->getList();
		$os = $this->_onapp_config[ 'vm_operating_system' ] ?
				$this->_onapp_config[ 'vm_operating_system' ] :
				ONAPP_TEST_VM_DEFAULT_OS;

		$os_distro = '';
		if( $os == ONAPP_TEST_VM_DEFAULT_OS &&
			$this->_onapp_config[ 'vm_operating_system_distro' ]
		) {
			$os_distro = $this->_onapp_config[ 'vm_operating_system_distro' ];
		}

		foreach( $template_list as $item ) {
			if( $os_distro ) {
				if( $item->_operating_system_distro == $os_distro ) {
					$this->_template_ids[ ] = $item->_id;
				}
			}
			else {
				if( $item->_operating_system == $os ) {
					$this->_template_ids[ ] = $item->_id;
				}
			}
		}
	}

	private function getHypervisorIds() {
		$hypervisor = $this->createObj( 'OnApp_Hypervisor' );
		$hypervisor_list = $hypervisor->getList();
		foreach( $hypervisor_list as $item ) {
			$this->_hypervisor_ids[ ] = $item->_id;
		}
	}

	private function getDataStores() {
		$data_store = $this->createObj( 'OnApp_DataStore' );
		$data_store_list = $data_store->getList();
		foreach( $data_store_list as $item ) {
			$this->_data_store_ids[ ] = $item->_id;
		}
	}

	private function getNetworks() {
		$network = $this->createObj( 'OnApp_Network' );
		$network_list = $network->getList();
		foreach( $network_list as $item ) {
			$this->_network_ids[ ] = $item->_id;
			$free_ips = $this->getFreeIPs( $item->_id );
			if( count( $free_ips ) ) {
				$this->_free_network_ids[ ] = $item->_id;
			}
		}
	}

	private function getFreeIPs( $network_id ) {
		$ip = $this->createObj( 'OnApp_IpAddress' );
		$ip->logger->setDebug(true);
		$ip_list = $ip->getList( $network_id );
		$free_ip_ids = array();

		if( !is_null( $ip_list ) ) {
			foreach( $ip_list as $item ) {
				if( $item->_free == 'true' ) {
					$free_ip_ids[ ] = $item->_id;
				}
			}
		}

		return $free_ip_ids;
	}

	protected function tearDown() {
	}

	public function testCheckCreate() {
		$vm = new OnApp_VirtualMachine();

		$vm->_label = 'testvm' . time();
		$vm->_hostname = $this->_onapp_config[ 'vm_hostname' ];
		$vm->_primary_network_id = ( !empty( $this->_free_network_ids ) ) ?
				$this->_free_network_ids[ 0 ] :
				$this->_network_ids[ 0 ];
		$vm->_required_ip_address_assignment = $this->_onapp_config[ 'vm_required_ip_address_assignment' ];
		$vm->_memory = $this->_onapp_config[ 'vm_memory' ];
		$vm->_cpus = $this->_onapp_config[ 'vm_cpus' ];
		$vm->_cpu_shares = 1;
		$vm->_swap_disk_size = 1;
		$vm->_required_virtual_machine_build = false;
		$vm->_allowed_hot_migrate = true;
		$vm->_required_automatic_backup = false;
		$vm->_template_id = $this->_template_ids[ 0 ];
		$vm->_initial_root_password = $this->_onapp_config[ 'vm_initial_root_password' ];
		$vm->_primary_disk_size = $this->_onapp_config[ 'vm_primary_disk_size' ];
		$vm->_hypervisor_id = $this->_hypervisor_ids[ 0 ];

		$result = $this->CheckSave( $vm );

		$repeat_times = round( $this->_onapp_config[ 'vm_create_time' ] / $this->_onapp_config[ 'vm_create_delay' ] );
		for( $i = 0; ( $vm->_obj->_locked == 'true' && $i < $repeat_times ); $i++ ) {
			sleep( $this->_onapp_config[ 'vm_create_delay' ] );
			$vm->load();
		}

		return $result;
	}

	/**
	 * @depends testCheckCreate
	 */
	public function testCheckLoad( $vm ) {
		$result = $this->CheckLoad( $vm );

		return $result;
	}

	/**
	 * @dataProvider editDataProvider
	 * @depends testCheckLoad
	 */
	public function testCheckEdit( $attr, $value, $vm ) {
		$result = $this->CheckEdit( $attr, $value, $vm );

		return $result;
	}

	/**
	 * @depends testCheckCreate
	 */
	public function testAddNetworkInterface( $vm ) {
		$this->markTestIncomplete( 'This test has not been implemented yet.' );
		$network_interface = new OnApp_VirtualMachine_NetworkInterface();

		$network_join = $this->createObj( 'OnApp_Hypervisor_NetworkJoin' );

		$network_join_list = $network_join->getList( $vm->_obj->_hypervisor_id );
		if( empty( $network_join_list ) ) {
			$this->fail( 'There are no networks assigned to this Hypervisor ( id = ' . $vm->_hypervisor_id . ' )' );
		}

		$network_interface->_virtual_machine_id = $vm->_obj->_id;
		$network_interface->_label = 'test' . time();
		$network_interface->_network_join_id = $network_join_list[ 0 ]->_id;

		$result = $this->CheckSave( $network_interface );

		return $result;
	}

	/**
	 * @depends testAddNetworkInterface
	 */
	public function testLoadNetworkInterface( $network_interface ) {
		$this->markTestIncomplete( 'This test has not been implemented yet.' );
		$result = $this->CheckLoad( $network_interface );

		return $result;
	}

	/**
	 * @depends testAddNetworkInterface
	 */
	public function testEditNetworkInterface( $network_interface ) {
		$this->markTestIncomplete( 'This test has not been implemented yet.' );
	}

	/**
	 * @depends testAddNetworkInterface
	 */
	public function testDeleteNetworkInterface( $network_interface ) {
		$this->markTestIncomplete( 'This test has not been implemented yet.' );
	}

	/**
	 * @depends testCheckCreate
	 */
	public function testAddIP( $vm ) {
		$ip = new OnApp_VirtualMachine_IpAddressJoin();

		$network_interface = $this->createObj( 'OnApp_VirtualMachine_NetworkInterface' );
		$network_join = $this->createObj( 'OnApp_Hypervisor_NetworkJoin' );

		$network_join_list = $network_join->getList( $vm->_obj->_hypervisor_id );
		if( empty( $network_join_list ) ) {
			$this->fail( 'There are no networks assigned to this Hypervisor ( id = ' . $vm->_hypervisor_id . ' )' );
		}

		$network_interface_list = $network_interface->getList( $vm->_obj->_id );
		if( empty( $network_interface_list ) ) {
			$this->fail( 'VM has no Network Interfaces' );
		}

		$free_ip_id = 0;
		$free_ips = array();
		$network_interface_id = 0;
		foreach( $network_interface_list as $network_interface_item ) {
			foreach( $network_join_list as $network_join_item ) {
				if( $network_interface_item->_network_join_id == $network_join_item->_id ) {
					$free_ips = $this->getFreeIPs( $network_join_item->_network_id );
					if( !empty( $free_ips ) ) {
						$free_ip_id = $free_ips[ 0 ];
						$network_interface_id = $network_interface_item->_id;
						break;
					}
				}
			}
		}

		if( !$free_ip_id ) {
			$this->fail( 'There are no free IPs' );
		}

		$ip->_virtual_machine_id = $vm->_id;
		$ip->_network_interface_id = $network_interface_id;
		$ip->_ip_address_id = $free_ip_id;
		$result = $this->CheckSave( $ip );

		return $result;
	}

	/**
	 * @depends testAddIP
	 */
	public function testLoadIP( $ip ) {
		$result = $this->CheckLoad( $ip );

		return $result;
	}

	/**
	 * @depends testAddIP
	 */
	public function testDeleteIP( $ip ) {
		$this->CheckDelete( $ip );
	}

	/**
	 * @depends testCheckCreate
	 */
	public function testAddDisk( $obj ) {
		$disk = $this->createObj( 'OnApp_Disk' );
		$disk->logger->setDebug( 1 );

		$disk->_virtual_machine_id = $obj->_obj->_id;
		$disk->_data_store_id = $this->_data_store_ids[ 0 ];
		$disk->_disk_size = $this->_onapp_config[ 'disk_disk_size' ];
		$disk->_mount_point = '';
		$disk->_require_format_disk = false;

		$result = $this->CheckSave( $disk );

		$repeat_times = round( $this->_onapp_config[ 'disk_create_time' ] / $this->_onapp_config[ 'disk_create_delay' ] );
		for( $i = 0; ( $disk->_obj->_locked == 'true' && $i < $repeat_times ); $i++ ) {
			sleep( $this->_onapp_config[ 'disk_create_delay' ] );
			$disk->load();
		}
		return $result;
	}

	/**
	 * @depends testAddDisk
	 */
	public function testLoadDisk( $disk ) {
		$result = $this->CheckLoad( $disk );

		return $result;
	}

	/**
	 * @depends testLoadDisk
	 */
	public function testEditDisk( $disk ) {
		$value = $disk->_disk_size++;
		$disk->save();
		$this->assertEquals( $disk->_obj->_disk_size, $value );

		return $disk;
	}

	/**
	 * @depends testCheckCreate
	 */
	public function testBuildVM( $obj ) {
		$obj->build();
		$msg = '';
		if( !empty( $obj->_obj->errors ) ) {
			$msg = implode( PHP_EOL, $obj->_obj->errors );
		}
		else {
			$i = 1;
			while( ( $obj->_obj->_built != true ) || ( $i > 30 ) ) {
				sleep( $this->_onapp_config[ 'vm_build_delay' ] );
				$obj->load();
				++$i;
			}
		}

		$this->assertTrue( $obj->_obj->_built == 'true', $msg );

		return $obj;
	}

	/**
	 * @depends testAddDisk
	 * @depends testBuildVM
	 */
	public function testCreateBackup( $disk, $vm ) {
		$backup = new OnApp_VirtualMachine_Backup();
		$backup->_disk_id = $disk->_obj->_id;
		$backup->_virtual_machine_id = $vm->_id;
		$backup->logger->setDebug(1);

		$result = $this->CheckSave( $backup );

		$repeat_times = round( $this->_onapp_config[ 'backup_create_time' ] / $this->_onapp_config[ 'backup_create_delay' ] );
		for( $i = 0; ( $backup->_obj->_locked == 'true' && $i < $repeat_times ); $i++ ) {
			sleep( $this->_onapp_config[ 'backup_create_delay' ] );
			$backup->load();
		}

		return $result;
	}

	/**
	 * @depends testCreateBackup
	 */
	public function testLoadBackup( $backup ) {
		$result = $this->CheckLoad( $backup );
		return $result;
	}

	/**
	 * @depends testCreateBackup
	 */
	public function testConvertBackup( $backup ) {
		$convert_label = 'test_tmpl' . time();
		$backup->convert( $convert_label );

		$tmpl = $this->createObj( 'OnApp_Template' );
		$converted = 'false';
		$repeat_times = round( $this->_onapp_config[ 'backup_convert_time' ] / $this->_onapp_config[ 'backup_convert_delay' ] );
		$i = 0;
		while( !$converted || ($i < $repeat_times) ) {
			$tmpl_list = $tmpl->getUserTemplates();
			foreach( $tmpl_list as $item ) {
				if( $item->_label == $convert_label ) {
					$converted = true;
					$tmpl->_id = $item->_id;
					$tmpl->delete();

					break 2;
				}
			}
			++$i;
			sleep( $this->_onapp_config[ 'backup_convert_delay' ] );
		}

		$this->assertTrue( $converted );
	}

	/**
	 * @depends testCreateBackup
	 */
	public function testRestoreBackup( $backup ) {
		$this->markTestIncomplete( 'This test has not been implemented yet.' );
		$backup_id = $backup->_obj->_id;
		$backup->restore();

		$this->assertTrue( $backup_id == $backup->_obj->_id );
	}

	/**
	 * @depends testLoadDisk
	 */
	public function testDeleteDisk( $disk ) {
		$this->CheckDelete( $disk );
	}

	/**
	 * @depends testCheckCreate
	 */
	public function testCheckDelete( $obj ) {
		$this->CheckDelete( $obj );
	}

	public function editDataProvider() {
		return array(
			array( '_label', 'testvmedited' . time() ),
		);
	}
}

/**
 * PHPUnit main() hack
 * "Call class::main() if this source file is executed directly."
 */
if( PHPUnit_MAIN_METHOD == 'VirtualMachineFull_TestCase::main' ) {
	VirtualMachineFull_TestCase::main();
}