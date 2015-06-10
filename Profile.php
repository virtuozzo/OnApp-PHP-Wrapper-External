<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Provisioning Profile
 *
 * @category    API wrapper
 * @package     OnApp
 * @author      Andrew Yatskovets
 * @copyright   © 2011 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */

/**
 * Manages User Profile
 *
 * The OnApp_Payment class uses the following basic methods:
 * {@link load}, {@link save}, {@link delete}, and {@link getList}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */
class OnApp_Profile extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'user';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'profile';

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
                    'created_at'                => array(
                        ONAPP_FIELD_MAP       => '_created_at',
                        ONAPP_FIELD_TYPE      => 'datetime',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'activated_at'              => array(
                        ONAPP_FIELD_MAP       => '_activated_at',
                        ONAPP_FIELD_TYPE      => 'datetime',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'memory_available'          => array(
                        ONAPP_FIELD_MAP       => '_memory_available',
                        ONAPP_FIELD_TYPE      => 'integer',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'used_memory'               => array(
                        ONAPP_FIELD_MAP       => '_used_memory',
                        ONAPP_FIELD_TYPE      => 'integer',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'outstanding_amount'        => array(
                        ONAPP_FIELD_MAP       => '_outstanding_amount',
                        ONAPP_FIELD_TYPE      => 'float',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'suspend_at'                => array(
                        ONAPP_FIELD_MAP       => '_suspend_at',
                        ONAPP_FIELD_TYPE      => 'datetime',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'remember_token_expires_at' => array(
                        ONAPP_FIELD_MAP       => '_remember_token_expires_at',
                        ONAPP_FIELD_TYPE      => 'datetime',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'roles'                     => array(
                        ONAPP_FIELD_MAP       => '_roles',
                        ONAPP_FIELD_TYPE      => 'array',
                        ONAPP_FIELD_CLASS     => 'Role',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'total_amount'              => array(
                        ONAPP_FIELD_MAP       => '_total_amount',
                        ONAPP_FIELD_TYPE      => 'float',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'updated_at'                => array(
                        ONAPP_FIELD_MAP       => '_updated_at',
                        ONAPP_FIELD_TYPE      => 'datetime',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'deleted_at'                => array(
                        ONAPP_FIELD_MAP       => '_deleted_at',
                        ONAPP_FIELD_TYPE      => 'datetime',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'used_ip_addresses'         => array(
                        ONAPP_FIELD_MAP       => '_used_ip_addresses',
                        ONAPP_FIELD_TYPE      => 'array',
                        ONAPP_FIELD_CLASS     => 'IpAddress',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'billing_plan_id'           => array(
                        ONAPP_FIELD_MAP       => '_billing_plan_id',
                        ONAPP_FIELD_TYPE      => 'integer',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'used_disk_size'            => array(
                        ONAPP_FIELD_MAP       => '_used_disk_size',
                        ONAPP_FIELD_TYPE      => 'integer',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'id'                        => array(
                        ONAPP_FIELD_MAP       => '_id',
                        ONAPP_FIELD_TYPE      => 'integer',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'group_id'                  => array(
                        ONAPP_FIELD_MAP       => '_group_id',
                        ONAPP_FIELD_TYPE      => 'integer',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'user_group_id'             => array(
                        ONAPP_FIELD_MAP       => '_user_group_id',
                        ONAPP_FIELD_TYPE      => 'integer',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'disk_space_available'      => array(
                        ONAPP_FIELD_MAP       => '_disk_space_available',
                        ONAPP_FIELD_TYPE      => 'integer',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'used_cpu_shares'           => array(
                        ONAPP_FIELD_MAP       => '_used_cpu_shares',
                        ONAPP_FIELD_TYPE      => 'integer',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'payment_amount'            => array(
                        ONAPP_FIELD_MAP       => '_payment_amount',
                        ONAPP_FIELD_TYPE      => 'decimal',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'remember_token'            => array(
                        ONAPP_FIELD_MAP       => '_remember_token',
                        ONAPP_FIELD_TYPE      => 'integer',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'last_name'                 => array(
                        ONAPP_FIELD_MAP       => '_last_name',
                        ONAPP_FIELD_TYPE      => 'string',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'time_zone'                 => array(
                        ONAPP_FIELD_MAP       => '_time_zone',
                        ONAPP_FIELD_TYPE      => 'string',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'locale'                    => array(
                        ONAPP_FIELD_MAP       => '_locale',
                        ONAPP_FIELD_TYPE      => 'string',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'image_template_group_id'   => array(
                        ONAPP_FIELD_MAP       => '_image_template_group_id',
                        ONAPP_FIELD_TYPE      => 'integer',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'used_cpus'                 => array(
                        ONAPP_FIELD_MAP       => '_used_cpus',
                        ONAPP_FIELD_TYPE      => 'integer',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'status'                    => array(
                        ONAPP_FIELD_MAP       => '_status',
                        ONAPP_FIELD_TYPE      => 'string',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'login'                     => array(
                        ONAPP_FIELD_MAP       => '_login',
                        ONAPP_FIELD_TYPE      => 'string',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'first_name'                => array(
                        ONAPP_FIELD_MAP       => '_first_name',
                        ONAPP_FIELD_TYPE      => 'string',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'email'                     => array(
                        ONAPP_FIELD_MAP       => '_email',
                        ONAPP_FIELD_TYPE      => 'string',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'update_billing_stat'       => array(
                        ONAPP_FIELD_MAP       => '_update_billing_stat',
                        ONAPP_FIELD_TYPE      => 'bolean',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                );
                break;

            case 3.0:
            case 3.1:
            case 3.2:
            case 3.3:
            case 3.4:
            case 3.5:
            case 4.0:
            case 4.1:
                $this->fields = $this->initFields( 2.3 );
                break;
        }

        parent::initFields( $version, __CLASS__ );

        return $this->fields;
    }

    function activate( $action_name ) {
        switch( $action_name ) {
            case ONAPP_ACTIVATE_GETLIST:
            case ONAPP_ACTIVATE_DELETE:
                exit( 'Call to undefined method ' . __CLASS__ . '::' . $action_name . '()' );
                break;
        }
    }

    /**
     * Returns the URL Alias of the API Class that inherits the OnApp class
     *
     * @param string $action action name
     *
     * @return string API resource
     * @access public
     */
    function getResource( $action = ONAPP_GETRESOURCE_DEFAULT ) {
        /**
         * ROUTE :
         *
         * @name profile
         * @method GET
         * @alias    /profile(.:format)
         * @format   {:controller=>"users", :action=>"profile"}
         */
        $resource = $this->_resource;
        $this->logger->debug( 'getResource( ' . $action . ' ): return ' . $resource );

        return $resource;
    }

    /**
     * Sends an API request to get the Object after sending,
     * unserializes the response into an object
     *
     * The key field Parameter ID is used to load the Object. You can re-set
     * this parameter in the class inheriting OnApp class.
     *
     * @param integer $id Object id
     *
     * @return mixed serialized Object instance from API
     * @access public
     */
    function load( $id = null ) {
        $this->activate( ONAPP_ACTIVATE_LOAD );

        $this->logger->add( "load: Load class" );

        $this->setAPIResource( $this->getResource( ONAPP_GETRESOURCE_LOAD ) );

        $response = $this->sendRequest( ONAPP_REQUEST_METHOD_GET );

        $result = $this->_castResponseToClass( $response );

        $this->_obj = $result;

        return $result;
    }
}