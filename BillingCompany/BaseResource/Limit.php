<?php

/**
 * Manages Company Billing Plan Base Resource Limits
 *
 * @category    API wrapper
 * @package     OnApp
 * @subpackage  BillingCompany_BaseResource_Limit
 * @author      Ivan Gavryliuk
 * @copyright   © 2016 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */
class OnApp_BillingCompany_BaseResource_Limit extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'resource';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'resources';

    /**
     * API Fields description
     *
     * @param string|float $version   OnApp API version
     * @param string       $className current class' name
     *
     * @return array
     */
    public function initFields( $version = null, $className = '' ) {
        switch( $version ) {
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
                $this->fields = array();
                break;
        }

        parent::initFields( $version, __CLASS__ );

        return $this->fields;
    }

}