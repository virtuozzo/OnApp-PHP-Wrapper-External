<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Usage Statistics
 *
 * @category    API wrapper
 * @package     OnApp
 * @author      Vitaliy Kondratyuk
 * @copyright   © 2011 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */

/**
 * Usage Statistics
 *
 * The Usage Statistics class uses the following basic methods:
 * {@link getList}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */
class OnApp_UsageStatistic extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'vm_stat';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'usage_statistics';

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
                $this->fields = array(
                    'id'                 => array(
                        ONAPP_FIELD_MAP       => '_id',
                        ONAPP_FIELD_TYPE      => 'integer',
                        ONAPP_FIELD_READ_ONLY => true
                    ),
                    'created_at'         => array(
                        ONAPP_FIELD_MAP       => '_created_at',
                        ONAPP_FIELD_TYPE      => 'datetime',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'updated_at'         => array(
                        ONAPP_FIELD_MAP       => '_updated_at',
                        ONAPP_FIELD_TYPE      => 'datetime',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'cpu_used'           => array(
                        ONAPP_FIELD_MAP       => '_cpu_used',
                        ONAPP_FIELD_TYPE      => 'integer',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'cpu_shares'         => array(
                        ONAPP_FIELD_MAP       => '_cpu_shares',
                        ONAPP_FIELD_TYPE      => 'integer',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'disk_size'          => array(
                        ONAPP_FIELD_MAP       => '_disk_size',
                        ONAPP_FIELD_TYPE      => 'integer',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'amount'             => array(
                        ONAPP_FIELD_MAP       => '_amount',
                        ONAPP_FIELD_TYPE      => 'decimal',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'cpu_count'          => array(
                        ONAPP_FIELD_MAP       => '_cpu_count',
                        ONAPP_FIELD_TYPE      => 'integer',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'bandwidth_used'     => array(
                        ONAPP_FIELD_MAP       => '_bandwidth_used',
                        ONAPP_FIELD_TYPE      => 'integer',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'user_id'            => array(
                        ONAPP_FIELD_MAP       => '_user_id',
                        ONAPP_FIELD_TYPE      => 'integer',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'number_of_hours'    => array(
                        ONAPP_FIELD_MAP       => '_number_of_hours',
                        ONAPP_FIELD_TYPE      => 'integer',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'booted'             => array(
                        ONAPP_FIELD_MAP       => '_booted',
                        ONAPP_FIELD_TYPE      => 'boolean',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'ram'                => array(
                        ONAPP_FIELD_MAP       => '_ram',
                        ONAPP_FIELD_TYPE      => 'integer',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'virtual_machine_id' => array(
                        ONAPP_FIELD_MAP       => '_virtual_machine_id',
                        ONAPP_FIELD_TYPE      => 'integer',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'ip_addresses_count' => array(
                        ONAPP_FIELD_MAP       => '_ip_addresses_count',
                        ONAPP_FIELD_TYPE      => 'integer',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                );
                break;

            case '2.1':
                $this->fields = $this->initFields( '2.0' );
                $fields = array(
                    'amount',
                    'bandwidth_used',
                    'booted',
                    'cpu_count',
                    'cpu_shares',
                    'cpu_used',
                    'disk_size',
                    'ip_addresses_count',
                    'number_of_hours',
                    'ram',
                );
                $this->unsetFields( $fields );
                $this->fields[ 'cost' ] = array(
                    ONAPP_FIELD_MAP       => '_cost',
                    ONAPP_FIELD_TYPE      => 'string',
                    ONAPP_FIELD_READ_ONLY => true,
                );
                $this->fields[ 'stat_time' ] = array(
                    ONAPP_FIELD_MAP       => '_stat_time',
                    ONAPP_FIELD_TYPE      => 'string',
                    ONAPP_FIELD_READ_ONLY => true,
                );
                $this->fields[ 'vm_billing_stat_id' ] = array(
                    ONAPP_FIELD_MAP       => '_vm_billing_stat_id',
                    ONAPP_FIELD_TYPE      => 'integer',
                    ONAPP_FIELD_READ_ONLY => true,
                );
                break;

            case 2.2:
            case 2.3:
                $this->fields = $this->initFields( '2.1' );
                $fields = array(
                    'id',
                    'cost',
                    'stat_time',
                    'created_at',
                    'updated_at',
                    'vm_billing_stat_id',
                );
                $this->unsetFields( $fields );
                $this->fields[ 'data_received' ] = array(
                    ONAPP_FIELD_MAP       => '_data_received',
                    ONAPP_FIELD_TYPE      => 'string',
                    ONAPP_FIELD_READ_ONLY => true,
                );
                $this->fields[ 'data_sent' ] = array(
                    ONAPP_FIELD_MAP       => '_data_sent',
                    ONAPP_FIELD_TYPE      => 'string',
                    ONAPP_FIELD_READ_ONLY => true,
                );
                $this->fields[ 'data_read' ] = array(
                    ONAPP_FIELD_MAP       => '_data_read',
                    ONAPP_FIELD_TYPE      => 'string',
                    ONAPP_FIELD_READ_ONLY => true,
                );
                $this->fields[ 'data_written' ] = array(
                    ONAPP_FIELD_MAP       => '_data_written',
                    ONAPP_FIELD_TYPE      => 'string',
                    ONAPP_FIELD_READ_ONLY => true,
                );
                $this->fields[ 'writes_completed' ] = array(
                    ONAPP_FIELD_MAP       => '_writes_completed',
                    ONAPP_FIELD_TYPE      => 'string',
                    ONAPP_FIELD_READ_ONLY => true,
                );
                $this->fields[ 'reads_completed' ] = array(
                    ONAPP_FIELD_MAP       => '_reads_completed',
                    ONAPP_FIELD_TYPE      => 'string',
                    ONAPP_FIELD_READ_ONLY => true,
                );
                $this->fields[ 'cpu_usage' ] = array(
                    ONAPP_FIELD_MAP       => '_cpu_usage',
                    ONAPP_FIELD_TYPE      => 'string',
                    ONAPP_FIELD_READ_ONLY => true,
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
            case ONAPP_ACTIVATE_DELETE:
                exit( 'Call to undefined method ' . __CLASS__ . '::' . $action_name . '()' );
                break;
        }
    }

    function getResource( $action = ONAPP_GETRESOURCE_DEFAULT ) {
        return parent::getResource( $action );
        /**
         * ROUTE :
         *
         * @name usage_statistics
         * @method GET
         * @alias   /usage_statistics(.:format)
         * @format  {:controller=>"usage_statistics", :action=>"index"}
         */
    }
}