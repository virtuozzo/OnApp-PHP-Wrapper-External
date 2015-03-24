<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Edge Group Location
 *
 * @todo        Add description
 *
 * @category    API wrapper
 * @package     OnApp
 * @subpackage  EdgeGroup_Location
 * @author      Yakubskiy Yuriy
 * @copyright   © 2011 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */

/**
 * OnApp_EdgeGroup_Location
 *
 * Edge Group nested class and support no basic methods.
 *
 */
class OnApp_EdgeGroup_Location_Operator extends OnApp {
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
            case '2.3':
                $this->fields = array(
                    'name'               => array(
                        ONAPP_FIELD_MAP  => '_name',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'companyName'        => array(
                        ONAPP_FIELD_MAP  => '_companyName',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'companyDescription' => array(
                        ONAPP_FIELD_MAP  => '_companyDescription',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'statusReason'       => array(
                        ONAPP_FIELD_MAP  => '_statusReason',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'updatedAt'          => array(
                        ONAPP_FIELD_MAP  => '_updatedAt',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'username'           => array(
                        ONAPP_FIELD_MAP  => '_username',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'role'               => array(
                        ONAPP_FIELD_MAP  => '_role',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'id'                 => array(
                        ONAPP_FIELD_MAP  => '_id',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'companyPhone'       => array(
                        ONAPP_FIELD_MAP  => '_companyPhone',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'principal'          => array(
                        ONAPP_FIELD_MAP  => '_principal',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'createdAt'          => array(
                        ONAPP_FIELD_MAP  => '_createdAt',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'settings'           => array(
                        ONAPP_FIELD_MAP   => '_settings',
                        ONAPP_FIELD_TYPE  => 'array',
                        ONAPP_FIELD_CLASS => 'EdgeGroup_Location_Operator_Setting',
                    ),
                    'status'             => array(
                        ONAPP_FIELD_MAP  => '_status',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'email'              => array(
                        ONAPP_FIELD_MAP  => '_email',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                );
                break;

            case 3.0:
            case 3.1:
            case 3.2:
            case 3.3:
            case 3.4:
            case 3.5:
                $this->fields = $this->initFields( 2.3 );
                break;
        }

        parent::initFields( $version, __CLASS__ );

        return $this->fields;
    }

    /**
     * Activates action performed with object
     *
     * @param string $action_name the name of action
     *
     * @access public
     */
    function activate( $action_name ) {
        switch( $action_name ) {
            case ONAPP_ACTIVATE_GETLIST:
            case ONAPP_ACTIVATE_SAVE:
            case ONAPP_ACTIVATE_DELETE:
                exit( 'Call to undefined method ' . __CLASS__ . '::' . $action_name . '()' );
                break;
        }
    }
}