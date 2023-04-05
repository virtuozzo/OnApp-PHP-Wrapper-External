<?php
/**
 * Managing Backup Servers
 *
 *
 * @category    API wrapper
 * @package     OnApp
 * @author
 * @copyright   © 2016 OnApp
 * @link        http://www.onapp.com/
 * @docs        https://docs.onapp.com/display/42API/Backup+Servers
 * @see         OnApp
 */

/**
 * Managing Backup Servers
 *
 *
 * The Availability class uses the following basic methods:
 * {@link load}, {@link save}, {@link delete}, and {@link getList}.
 *
 * For full fields reference and curl request details visit: ( https://docs.onapp.com/display/42API/Backup+Servers )
 */
class OnApp_BackupServer extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'backup_server';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'settings/backup_servers';

    /**
     * API Fields description
     *
     * @param string|float $version OnApp API version
     * @param string $className current class' name
     *
     * @return array
     */
    public function initFields( $version = null, $className = '' ) {
        switch ( $version ) {
            case 2.0:
            case 2.1:
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
                $this->fields = array(
                    'created_at'             => array(
                        ONAPP_FIELD_MAP  => '_created_at',
                        ONAPP_FIELD_TYPE => 'datetime',
                    ),
                    'updated_at'             => array(
                        ONAPP_FIELD_MAP  => '_updated_at',
                        ONAPP_FIELD_TYPE => 'datetime',
                    ),
                    'backup_ip_address'      => array(
                        ONAPP_FIELD_MAP  => '_backup_ip_address',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'ip_address'             => array(
                        ONAPP_FIELD_MAP  => '_ip_address',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'label'                  => array(
                        ONAPP_FIELD_MAP  => '_label',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'cpu_idle'               => array(
                        ONAPP_FIELD_MAP  => '_cpu_idle',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'distro'                 => array(
                        ONAPP_FIELD_MAP  => '_distro',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'backup_server_group_id' => array(
                        ONAPP_FIELD_MAP  => '_backup_server_group_id',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'capacity'               => array(
                        ONAPP_FIELD_MAP  => '_capacity',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'id'                     => array(
                        ONAPP_FIELD_MAP  => '_id',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'enabled'                => array(
                        ONAPP_FIELD_MAP  => '_enabled',
                        ONAPP_FIELD_TYPE => 'boolean',
                    ),
                );
                break;

            case 4.3:
            case 5.0:
                $this->fields = $this->initFields( 4.2 );
                break;
            case 5.1:
                $this->fields = $this->initFields( 5.0 );
                break;
            case 5.2:
                $this->fields = $this->initFields( 5.1 );
                $this->fields['os_version'] = array(
                    ONAPP_FIELD_MAP  => '_os_version',
                    ONAPP_FIELD_TYPE => 'string',
                );
                break;
            case 5.3:
                $this->fields = $this->initFields( 5.2 );
                break;
            case 5.4:
                $this->fields = $this->initFields( 5.3 );
                $this->fields['os_version_minor'] = array(
                    ONAPP_FIELD_MAP  => '_os_version_minor',
                    ONAPP_FIELD_TYPE => 'string',
                );
                break;
            case 5.5:
                $this->fields = $this->initFields( 5.4 );
                break;
            case 6.0:
                $this->fields = $this->initFields( 5.5 );
                $this->fields['cpu_mhz']    = array(
                    ONAPP_FIELD_MAP  => '_os_cpu_mhz',
                    ONAPP_FIELD_TYPE => 'integer',
                );
                $this->fields['os_cpus']       = array(
                    ONAPP_FIELD_MAP  => '_os_cpus',
                    ONAPP_FIELD_TYPE => 'integer',
                );
                $this->fields['total_mem']  = array(
                    ONAPP_FIELD_MAP  => '_total_mem',
                    ONAPP_FIELD_TYPE => 'integer',
                );
                $this->fields['uptime']     = array(
                    ONAPP_FIELD_MAP  => '_uptime',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['release']    = array(
                    ONAPP_FIELD_MAP  => '_release',
                    ONAPP_FIELD_TYPE => 'integer',
                );
                break;

            case 6.1:
                $this->fields = $this->initFields( 6.0 );
                $this->fields['cpus']               = array(
                    ONAPP_FIELD_MAP  => '_cpus',
                    ONAPP_FIELD_TYPE => 'integer',
                );
                $this->fields['integrated_storage'] = array(
                    ONAPP_FIELD_MAP  => '_integrated_storage',
                    ONAPP_FIELD_TYPE => 'boolean',
                );
                break;

            case 6.2:
                $this->fields = $this->initFields( 6.1 );
                break;

            case 6.3:
                $this->fields = $this->initFields( 6.2 );
                break;

            case 6.4:
                $this->fields = $this->initFields( 6.3 );
                break;

            case 6.5:
                $this->fields = $this->initFields( 6.4 );
                break;

            case 6.6:
                $this->fields = $this->initFields( 6.5 );
                break;

            case 6.7:
                $this->fields = $this->initFields( 6.6 );
                break;

            default:
                $this->fields = $this->initFields( 6.7 );
                break;
        }

        parent::initFields( $version, __CLASS__ );

        return $this->fields;
    }

    function getResource( $action = ONAPP_GETRESOURCE_DEFAULT ) {
        switch ( $action ) {
            default:
                /**
                 * @alias  /settings/backup_servers/:id.json
                 */
                $resource = parent::getResource( $action );
        }

        return $resource;
    }

}