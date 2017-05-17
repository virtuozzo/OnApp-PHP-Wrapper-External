<?php
/**
 * Managing Smart Servers
 *
 */

/**
 * Smart Servers
 *
 * The Smart Servers class represents the Smart Servers of the OnAPP installation.
 *
 * The OnApp_SmartServer class uses the following basic methods:
 * {@link load}, {@link save}, {@link delete}, and {@link getList}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */
class OnApp_SmartServer extends OnApp_VirtualMachine {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'smart_server';

    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'smart_servers';


}