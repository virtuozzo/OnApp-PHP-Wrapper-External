<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Manages Assigned Location
 *
 *
 * @category	API WRAPPER
 * @package		OnApp
 * @subpackage	EdgeGroup
 * @author		Yakubskiy Yuriy
 * @copyright	(c) 2011 OnApp
 * @link		http://www.onapp.com/
 * @see			OnApp
 */

/**
 * Edge Server
 *
 * The OnApp_EdgeGroup_AssignedLocation class represents the OnApp_EdgeGroup_AssignedLocation of the OnAPP installation.
 *
 * The OnApp_EdgeGroup_AssignedLocation class uses no basic methods and is nested of OnApp_EdgeGroup class
 * 
 *
 */
class OnApp_EdgeGroup_AssignedLocation extends OnApp {

    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = '';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = '';

    public function __construct() {
        parent::__construct();
        $this->className = __CLASS__;
    }

    /**
    * API Fields description
    *
    * @param string|float $version OnApp API version
    * @param string $className current class' name
    * @return array
    */
    public function initFields( $version = null, $className = '' ) {
        switch( $version ) {
            case '2.3':
                $this->fields = array(
                    'location' => array(
                        ONAPP_FIELD_MAP => '_location',
                        ONAPP_FIELD_TYPE => 'object',
                        ONAPP_FIELD_CLASS => 'EdgeGroup_Location',
                    )
                );
                break;
        }
        
        parent::initFields( $version, __CLASS__ );
        return $this->fields;
    }
}