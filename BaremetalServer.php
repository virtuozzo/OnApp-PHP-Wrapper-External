<?php
/**
 * Managing Baremetal Servers
 *
 */

/**
 * Baremetal Servers
 *
 * The Baremetal Servers class represents the Baremetal Servers of the OnAPP installation.
 *
 * The OnApp_BaremetalServer class uses the following basic methods:
 * {@link load}, {@link save}, {@link delete}, and {@link getList}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */
class OnApp_BaremetalServer extends OnApp_VirtualMachine {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'baremetal_server';

    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'baremetal_servers';


}