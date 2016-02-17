<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Managing Application Servers
 *
 *
 * Application Server is a regular VS based on default CentOS template with pre-installed additional software.
 * This software allows you to install and have up & running various PHP/Perl/Python frameworks
 * (like Drupal, Joomla, Wordpress etc.) on a server using web interface.
 *
 * @category    API wrapper
 * @package     OnApp
 * @author      Andrew Yatskovets
 * @copyright   © 2016 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */

/**
 *
 *
 */
define( 'ONAPP_GETRESOURCE_REBOOT', 'reboot' );

/**
 *
 *
 */
define( 'ONAPP_GETRESOURCE_SHUTDOWN', 'shutdown' );

/**
 *
 *
 */
define( 'ONAPP_GETRESOURCE_STOP', 'stop' );

/**
 *
 *
 */
define( 'ONAPP_GETRESOURCE_CHANGE_OWNER', 'change_owner' );

/**
 *
 *
 */
define( 'ONAPP_GETRESOURCE_REBUILD_NETWORK', 'rebuild_network' );

/**
 *
 *
 */
define( 'ONAPP_GETRESOURCE_STARTUP', 'startup' );

/**
 *
 *
 */
define( 'ONAPP_GETRESOURCE_UNLOCK', 'unlock' );

/**
 *
 *
 */
define( 'ONAPP_GETRESOURCE_BUILD', 'build' );

/**
 *
 *
 */
define( 'ONAPP_GETRESOURCE_SUSPEND_VM', 'suspend' );

/**
 *
 *
 */
define( 'ONAPP_ACTIVATE_GETLIST_USER', 'getUserVMsList' );

/**
 *
 *
 */
define( 'ONAPP_RESET_ROOT_PASSWORD', 'resetRootPassword' );

/**
 *
 *
 */
define( 'ONAPP_GETRESOURCE_MIGRATE', 'migrate' );

/**
 *
 *
 */
define( 'ONAPP_GETRESOURCE_VIRTUALMACHINES_STATUSES', 'statusAll' );

/**
 *
 *
 */
define( 'ONAPP_GETRESOURCE_VIRTUALMACHINE_STATUS', 'status' );

/**
 * Enable Booting from CD for ISO Virtual Server
 */
define( 'ONAPP_ENABLE_BOOT_FROM_CD', 'cd_boot_enable' );

/**
 * Disable Booting from CD for ISO Virtual Server
 */
define( 'ONAPP_DISABLE_BOOT_FROM_CD', 'cd_boot_disable' );

/**
 * Search
 */
define( 'ONAPP_SEARCH', 'search' );

/**
 * Application Servers
 *
 * The Application Servers class represents the Application Servers of the OnAPP installation.
 *
 * The OnApp_ApplicationServer class uses the following basic methods:
 * {@link load}, {@link save}, {@link delete}, and {@link getList}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */
class OnApp_ApplicationServer extends OnApp_VirtualMachine {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'application_server';

    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'application_servers';


}