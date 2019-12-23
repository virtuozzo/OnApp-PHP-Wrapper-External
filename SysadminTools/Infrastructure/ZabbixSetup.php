<?php

/**
 * SysadminTools Infrastructure ZabbixSetup
 *
 * @category        API wrapper
 * @package         OnApp
 * @author          Mykola Vuy
 * @copyright       © 2019 OnApp
 */

/**
 * @var
 */
define('ONAPP_ZABBIX_SETUP_DEPLOY', 'deploy');

/**
 * @var
 */
define('ONAPP_ZABBIX_SETUP_CONFIGURE', 'configure');

/**
 * SysadminTools_Infrastructure_ZabbixSetup
 *
 * Use the following API calls to view, assign and delete virtual server recipes in your cloud.
 *
 * The OnApp_SysadminTools_Infrastructure_ZabbixSetup class uses the following methods:
 * {@link deploy} and {@link configure}
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */
class OnApp_SysadminTools_Infrastructure_ZabbixSetup extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'zabbix_setup';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'sysadmin_tools/infrastructure/zabbix_setup';
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
            case 6.2:
                $this->fields = array(
                    'ip_address'            => array(
                        ONAPP_FIELD_MAP  => '_ip_address',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'server_os'             => array(
                        ONAPP_FIELD_MAP  => '_server_os',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                );
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
        $show_log_msg = true;
        switch ( $action ) {
            case ONAPP_ZABBIX_SETUP_DEPLOY:
                /**
                 * ROUTE :
                 *
                 * @name ZabbixSetup Deploy
                 * @method POST
                 * @alias   /sysadmin_tools/infrastructure/zabbix_setup/deploy(.:format)
                 */

                $resource = $this->_resource . '/' . ONAPP_ZABBIX_SETUP_DEPLOY;
                $this->logger->debug( 'getResource( ' . $action . ' ): return ' . $resource );
                break;

            case ONAPP_ZABBIX_SETUP_CONFIGURE:
                /**
                 * ROUTE :
                 *
                 * @name ZabbixSetup Configure
                 * @method POST
                 * @alias   /sysadmin_tools/infrastructure/zabbix_setup/configure(.:format)
                 */

                $resource = $this->_resource . '/' . ONAPP_ZABBIX_SETUP_CONFIGURE;
                $this->logger->debug( 'getResource( ' . $action . ' ): return ' . $resource );
                break;

            default:
                $resource = parent::getResource( $action );
                break;
        }

        return $resource;
    }

    public function deploy() {
        if (!$this->_ip_address ) {
            $this->logger->error(
                'getResource(deploy): argument ip_address not set.',
                __FILE__,
                __LINE__
            );
        }

        if (!$this->_server_os ) {
            $this->logger->error(
                'getResource(deploy): argument server_os not set.',
                __FILE__,
                __LINE__
            );
        }

        $data = array(
            'root' => $this->_tagRoot,
            'data' => array(
                'ip_address' => $this->_ip_address,
                'server_os'  => $this->_server_os,
            ),
        );

        $this->sendPost( ONAPP_ZABBIX_SETUP_DEPLOY, $data );
    }

    public function configure() {
        $this->sendPost(ONAPP_ZABBIX_SETUP_CONFIGURE);
    }

    /**
     * Activates action performed with object
     *
     * @param string $action_name the name of action
     *
     * @access public
     */
    function activateCheck( $action_name ) {
        switch ( $action_name ) {
            case ONAPP_ACTIVATE_GETLIST:
            case ONAPP_ACTIVATE_LOAD:
            case ONAPP_ACTIVATE_SAVE:
            case ONAPP_ACTIVATE_DELETE:
                exit( 'Call to undefined method ' . __CLASS__ . '::' . $action_name . '()' );
                break;
        }
    }

}
