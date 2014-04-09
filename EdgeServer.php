<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Managing Edge Servers
 *
 *
 * @category    API wrapper
 * @package     OnApp
 * @author      Yakubskiy Yuriy
 * @copyright   © 2011 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */

/**
 * Edge Server
 *
 * The Edge Server class represents the Edge Server of the OnAPP installation.
 *
 * The OnApp_EdgeServer class uses the following basic methods:
 * {@link getList} and {@link load} and .
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */
class OnApp_EdgeServer extends OnApp_VirtualMachine {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'edge_server';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'edge_servers';
}