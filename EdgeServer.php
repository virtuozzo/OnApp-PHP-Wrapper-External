<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Managing Edge Servers
 *
 *
 * @category	API WRAPPER
 * @package		OnApp
 * @subpackage	Edge Server
 * @author		Yakubskiy Yuriy
 * @copyright	(c) 2011 OnApp
 * @link		http://www.onapp.com/
 * @see			OnApp
 */

/**
 * Edge Server
 *
 * The Edge Server class represents the Edge Server of the OnAPP installation.
 *
 * The ONAPP_EdgeServer class uses the following basic methods:
 * {@link getList} and {@link load} and .
 *
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

    public function __construct() {
        parent::__construct();
        $this->className = __CLASS__;
    }
    
}