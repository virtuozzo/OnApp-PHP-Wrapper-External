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