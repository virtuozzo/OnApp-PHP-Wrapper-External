<?php

/**
 * Manages ServiceAddonGroup Icon
 *
 * @category    API wrapper
 * @package     OnApp
 * @subpackage  ServiceAddonGroup
 * @author
 * @copyright   © 2017 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */
class OnApp_ServiceAddonGroup_Icon extends OnApp {
    var $_tagRoot = 'icon';

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
            case 5.4:
                $this->fields = array();

                $this->fields['url'] = array(
                    ONAPP_FIELD_MAP  => '_url',
                    ONAPP_FIELD_TYPE => 'string',
                );
                break;
        }

        parent::initFields( $version, __CLASS__ );

        return $this->fields;
    }
}