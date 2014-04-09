<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * User Statistics
 *
 * @todo        write description
 *
 * @category    API wrapper
 * @package     OnApp
 * @subpackage  User_Statistics
 * @author      Yakubskiy Yuriy
 * @copyright   © 2011 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */

/**
 * User User Statistics VmStat
 *
 *  The OnApp_User_UserStatistics_VmStats class uses NO basic methods:
 *
 *
 */
class OnApp_User_Statistics_VmStat extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'vm_stats';
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
            case '2.0':
            case '2.1':
            case 2.2:
            case 2.3:
                $this->fields = array(
                    'usage_cost'         => array(
                        ONAPP_FIELD_MAP       => '_usage_cost',
                        ONAPP_FIELD_TYPE      => 'float',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'vm_resources_cost'  => array(
                        ONAPP_FIELD_MAP       => '_vm_resources_cost',
                        ONAPP_FIELD_TYPE      => 'float',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'virtual_machine_id' => array(
                        ONAPP_FIELD_MAP       => '_virtual_machine_id',
                        ONAPP_FIELD_TYPE      => 'float',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'total_cost'         => array(
                        ONAPP_FIELD_MAP       => '_total_cost',
                        ONAPP_FIELD_TYPE      => 'string',
                        ONAPP_FIELD_READ_ONLY => true,
                    )
                );
                break;

            case 3.0:
            case 3.1:
            case 3.2:
            case 3.3:
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
            case ONAPP_ACTIVATE_LOAD:
            case ONAPP_ACTIVATE_SAVE:
            case ONAPP_ACTIVATE_GETLIST:
            case ONAPP_ACTIVATE_DELETE:
                exit( 'Call to undefined method ' . __CLASS__ . '::' . $action_name . '()' );
                break;
        }
    }
}