<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Managing Vapps
 *
 *
 * @category    API wrapper
 * @package     OnApp
 * @author
 * @copyright   © 2011 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */

/**
 *
 *
 */
define( 'ONAPP_GETRESOURCE_VAPPS_RECOMPOSING', 'recomposing' );

/**
 *
 *
 */
define( 'ONAPP_GETRESOURCE_VAPPS_EDITNAME', 'editname' );

/**
 *
 *
 */
define( 'ONAPP_GETRESOURCE_VAPPS_START', 'start' );

/**
 *
 *
 */
define( 'ONAPP_GETRESOURCE_VAPPS_STOP', 'stop' );

/**
 * Vapps
 *
 */
class OnApp_Vapp extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'vapp';

    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'vapps';

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
            case '4.0':
            case '4.1':
                $this->fields = array(
                    'id'                          => array(
                        ONAPP_FIELD_MAP       => '_id',
                        ONAPP_FIELD_TYPE      => 'integer',
                        ONAPP_FIELD_READ_ONLY => true
                    ),
                    'created_at'                  => array(
                        ONAPP_FIELD_MAP       => '_created_at',
                        ONAPP_FIELD_TYPE      => 'datetime',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'identifier'                  => array(
                        ONAPP_FIELD_MAP       => '_identifier',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'name'                       => array(
                        ONAPP_FIELD_MAP      => '_name',
                        ONAPP_FIELD_REQUIRED => true,
                    ),
                    'status'                       => array(
                        ONAPP_FIELD_MAP      => '_status',
                        ONAPP_FIELD_REQUIRED => true,
                    ),
                    'updated_at'                  => array(
                        ONAPP_FIELD_MAP       => '_updated_at',
                        ONAPP_FIELD_TYPE      => 'datetime',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'user_id'                          => array(
                        ONAPP_FIELD_MAP       => '_user_id',
                        ONAPP_FIELD_TYPE      => 'integer',
                        ONAPP_FIELD_READ_ONLY => true
                    ),
                    //todo check value type of vapp_template_id
                    'vapp_template_id'                          => array(
                        ONAPP_FIELD_MAP       => '_vapp_template_id',
                        ONAPP_FIELD_TYPE      => 'integer',
                        ONAPP_FIELD_READ_ONLY => true
                    ),
                    'vdc_id'                          => array(
                        ONAPP_FIELD_MAP       => '_vdc_id',
                        ONAPP_FIELD_TYPE      => 'integer',
                        ONAPP_FIELD_READ_ONLY => true
                    ),
                    'virtual_machine_params'                => array(
                        ONAPP_FIELD_MAP       => '_virtual_machine_params',
                        ONAPP_FIELD_TYPE      => 'array',
                        ONAPP_FIELD_READ_ONLY => true,
                        ONAPP_FIELD_CLASS     => 'Vapp_VirtualMachineParams',
                    ),


                );
                break;
        }

        parent::initFields( $version, __CLASS__ );

        return $this->fields;
    }

    function getResource( $action = ONAPP_GETRESOURCE_DEFAULT ) {
        switch( $action ) {
            case ONAPP_GETRESOURCE_VAPPS_RECOMPOSING:
                /**
                 * ROUTE :
                 *
                 * @name recompose_vapp
                 * @method PUT
                 * @alias    /vapps/:id/reboot(.:format)
                 * @format   {:controller=>"vapps", :action=>"recompose"}
                 */
                $resource = $this->getResource( ONAPP_GETRESOURCE_LOAD ) . '/recompose';
                break;
            case ONAPP_GETRESOURCE_VAPPS_EDITNAME:
                /**
                 * ROUTE :
                 *
                 * @name editname_vapp
                 * @method PUT
                 * @alias    /vapps/:id/edit(.:format)
                 * @format   {:controller=>"vapps", :action=>"editname"}
                 */
                $resource = $this->getResource( ONAPP_GETRESOURCE_LOAD ) . '/edit';
                break;
            case ONAPP_GETRESOURCE_VAPPS_START:
                /**
                 * ROUTE :
                 *
                 * @name start_vapp
                 * @method POST
                 * @alias    /vapps/:id/start(.:format)
                 * @format   {:controller=>"vapps", :action=>"start"}
                 */
                $resource = $this->getResource( ONAPP_GETRESOURCE_LOAD ) . '/start';
                break;
            case ONAPP_GETRESOURCE_VAPPS_STOP:
                /**
                 * ROUTE :
                 *
                 * @name stop_vapp
                 * @method POST
                 * @alias    /vapps/:id/stop(.:format)
                 * @format   {:controller=>"vapps", :action=>"stop"}
                 */
                $resource = $this->getResource( ONAPP_GETRESOURCE_LOAD ) . '/stop';
                break;

            default:
                /**
                 * ROUTE :
                 *
                 * @name vapps
                 * @method GET
                 * @alias   /vapps(.:format)
                 * @format  {:controller=>"vapps", :action=>"index"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name vapp
                 * @method GET
                 * @alias    /vapps/:id(.:format)
                 * @format   {:controller=>"vapps", :action=>"show"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name delete_vapp
                 * @method DELETE
                 * @alias    /vapps/:id(.:format)
                 * @format   {:controller=>"vapps", :action=>"destroy"}
                 */
                $resource = parent::getResource( $action );
                break;
        }

        return $resource;
    }

    /**
     * recompose vApp
     *
     * @param $name
     *
     * @access    public
     */
    function recomposing( $name ) {
        $data = array(
            'root' => 'tmp_holder',
            'data' => array(
                'vapp' => array(
                    'name' => $name
                )
            )
        );
        $this->sendPut( ONAPP_GETRESOURCE_VAPPS_RECOMPOSING, $data );
    }

    /**
     * recompose vApp
     *
     * @param $name
     *
     * @access    public
     */
    function editName( $name ) {
        $data = array(
            'root' => 'tmp_holder',
            'data' => array(
                'vapp' => array(
                    'name' => $name
                )
            )
        );
        $this->sendPut( ONAPP_GETRESOURCE_VAPPS_EDITNAME, $data );
    }

    /**
     * start vApp
     *
     * @access    public
     */
    function start( ) {
        $this->sendPost( ONAPP_GETRESOURCE_VAPPS_START);
    }

    /**
     * stop vApp
     *
     * @access    public
     */
    function stop( ) {
        $this->sendPost( ONAPP_GETRESOURCE_VAPPS_STOP);
    }



}