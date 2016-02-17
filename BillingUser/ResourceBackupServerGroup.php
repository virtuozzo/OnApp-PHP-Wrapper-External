<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Billing Plan Base Resources
 *
 * @category    API wrapper
 * @package     OnApp
 * @subpackage  BillingUser
 * @author      Andrew Yatskovets
 * @copyright   © 2014 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */

/**
 * The OnApp_BillingUser_ResourceBackupServerGroup class uses the following basic methods:
 * {@link load}, {@link save}, {@link delete}, and {@link getList}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */
class OnApp_BillingUser_ResourceBackupServerGroup extends OnApp_BillingUser_BaseResource {
    /**
     * alias processing the object data
     *
     * @var string
     */
//    var $_resource = 'resource_edge_groups';

    /**
     * specified resource name for getList
     *
     * @var string
     */
    var $_specified_resource_name = 'backup_server_group';

    /**
     * API Fields description
     *
     * @param string|float $version   OnApp API version
     * @param string       $className current class' name
     *
     * @return array
     */
    public function initFields( $version = null, $className = '' ) {
        parent::initFields( $version, __CLASS__ );

        switch( $version ) {
            case '2.0':
            case '2.1':
            case 2.2:
            case 2.3:
            case 3.0:
            case 3.1:
            case 3.2:
            case 3.3:
            case 3.4:
            case 3.5:
            case 4.0:
            case 4.1:
            case 4.2:
                $this->fields[ 'resource_class' ] = array(
                    ONAPP_FIELD_MAP           => '_resource_class',
                    ONAPP_FIELD_TYPE          => 'string',
                    ONAPP_FIELD_REQUIRED      => true,
                    ONAPP_FIELD_READ_ONLY     => true,
                    ONAPP_FIELD_DEFAULT_VALUE => 'Resource::BackupServerGroup',
                );

                $this->fields[ 'in_master_zone' ] = array(
                    ONAPP_FIELD_MAP           => '_in_master_zone',
                    ONAPP_FIELD_TYPE          => 'string',
                );

                $this->fields[ 'master' ] = array(
                    ONAPP_FIELD_MAP           => '_master',
                    ONAPP_FIELD_TYPE          => 'boolean',
                );

                $this->fields[ 'target_type' ] = array(
                    ONAPP_FIELD_MAP           => '_target_type',
                    ONAPP_FIELD_TYPE          => 'string',
                    ONAPP_FIELD_REQUIRED      => true,
                    ONAPP_FIELD_DEFAULT_VALUE => 'Pack',
                );

                $this->fields[ 'limit_backup' ] = array(
                    ONAPP_FIELD_MAP           => '_limit_backup',
                    ONAPP_FIELD_TYPE          => 'string',
                );
                $this->fields[ 'limit_backup_free' ] = array(
                    ONAPP_FIELD_MAP           => '_limit_backup_free',
                    ONAPP_FIELD_TYPE          => 'string',
                );
                $this->fields[ 'price_backup' ] = array(
                    ONAPP_FIELD_MAP           => '_price_backup',
                    ONAPP_FIELD_TYPE          => 'string',
                );
                $this->fields[ 'limit_backup_disk_size' ] = array(
                    ONAPP_FIELD_MAP           => '_limit_backup_disk_size',
                    ONAPP_FIELD_TYPE          => 'string',
                );
                $this->fields[ 'limit_backup_disk_size_free' ] = array(
                    ONAPP_FIELD_MAP           => '_limit_backup_disk_size_free',
                    ONAPP_FIELD_TYPE          => 'string',
                );
                $this->fields[ 'price_backup_disk_size' ] = array(
                    ONAPP_FIELD_MAP           => '_price_backup_disk_size',
                    ONAPP_FIELD_TYPE          => 'string',
                );
                $this->fields[ 'limit_template' ] = array(
                    ONAPP_FIELD_MAP           => '_limit_template',
                    ONAPP_FIELD_TYPE          => 'string',
                );
                $this->fields[ 'limit_template_free' ] = array(
                    ONAPP_FIELD_MAP           => '_limit_template_free',
                    ONAPP_FIELD_TYPE          => 'string',
                );
                $this->fields[ 'price_template' ] = array(
                    ONAPP_FIELD_MAP           => '_price_template',
                    ONAPP_FIELD_TYPE          => 'string',
                );
                $this->fields[ 'limit_template_disk_size' ] = array(
                    ONAPP_FIELD_MAP           => '_limit_template_disk_size',
                    ONAPP_FIELD_TYPE          => 'string',
                );
                $this->fields[ 'limit_template_disk_size_free' ] = array(
                    ONAPP_FIELD_MAP           => '_limit_template_disk_size_free',
                    ONAPP_FIELD_TYPE          => 'string',
                );
                $this->fields[ 'price_template_disk_size' ] = array(
                    ONAPP_FIELD_MAP           => '_price_template_disk_size',
                    ONAPP_FIELD_TYPE          => 'string',
                );

                break;
        }

        $this->fields[ 'id' ][ ONAPP_FIELD_REQUIRED ] = false;

        foreach( array( 'unit', 'limit', 'limit_free', 'price', 'price_on', 'price_off' ) as $field ) {
            unset( $this->fields[ $field ] );
        }

        return $this->fields;
    }

    public function editBackupsLimits($limit_backup = null, $limit_backup_free = null, $price_backup = null) {
        $dataArray = array();
        if($limit_backup != null){
            $dataArray['limit_backup'] = $limit_backup;
        }
        if($limit_backup_free != null){
            $dataArray['limit_backup_free'] = $limit_backup_free;
        }
        if($price_backup != null){
            $dataArray['price_backup'] = $price_backup;
        }

        if(count($dataArray) == 0){
            return false;
        }
        $data = array(
            'root' => 'resource',
            'data' => $dataArray,
        );
        $this->sendPut( ONAPP_GETRESOURCE_LOAD, $data );
    }

    public function editBackupDiskSizeLimits($limit_backup_disk_size = null, $limit_backup_disk_size_free = null, $price_backup_disk_size = null) {
        $dataArray = array();
        if($limit_backup_disk_size != null){
            $dataArray['limit_backup_disk_size'] = $limit_backup_disk_size;
        }
        if($limit_backup_disk_size_free != null){
            $dataArray['limit_backup_disk_size_free'] = $limit_backup_disk_size_free;
        }
        if($price_backup_disk_size != null){
            $dataArray['price_backup_disk_size'] = $price_backup_disk_size;
        }

        if(count($dataArray) == 0){
            return false;
        }
        $data = array(
            'root' => 'resource',
            'data' => $dataArray,
        );
        $this->sendPut( ONAPP_GETRESOURCE_LOAD, $data );
    }

    public function editTemplatesLimits($limit_template = null, $limit_template_free = null, $price_template = null) {
        $dataArray = array();
        if($limit_template != null){
            $dataArray['limit_template'] = $limit_template;
        }
        if($limit_template_free != null){
            $dataArray['limit_template_free'] = $limit_template_free;
        }
        if($price_template != null){
            $dataArray['price_template'] = $price_template;
        }

        if(count($dataArray) == 0){
            return false;
        }
        $data = array(
            'root' => 'resource',
            'data' => $dataArray,
        );
        $this->sendPut( ONAPP_GETRESOURCE_LOAD, $data );
    }

    public function editTemplatesDiskSizeLimits($limit_template_disk_size = null, $limit_template_disk_size_free = null, $price_template_disk_size = null) {
        $dataArray = array();
        if($limit_template_disk_size != null){
            $dataArray['limit_template_disk_size'] = $limit_template_disk_size;
        }
        if($limit_template_disk_size_free != null){
            $dataArray['limit_template_disk_size_free'] = $limit_template_disk_size_free;
        }
        if($price_template_disk_size != null){
            $dataArray['price_template_disk_size'] = $price_template_disk_size;
        }

        if(count($dataArray) == 0){
            return false;
        }
        $data = array(
            'root' => 'resource',
            'data' => $dataArray,
        );
        $this->sendPut( ONAPP_GETRESOURCE_LOAD, $data );
    }

}

