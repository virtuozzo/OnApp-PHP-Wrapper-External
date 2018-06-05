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
 * Vapps
 *
 */
class OnApp_Vapp_VirtualMachineParam extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = ''; //todo: identifier?

    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = '';

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
            case 4.0:
            case 4.1:
                $this->fields = array(
                    'identifier'      => array(
                        ONAPP_FIELD_MAP       => '_identifier',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'name'            => array(
                        ONAPP_FIELD_MAP       => '_name',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'vcpu_per_vm'     => array(
                        ONAPP_FIELD_MAP       => '_vcpu_per_vm',
                        ONAPP_FIELD_TYPE      => 'integer',
                        ONAPP_FIELD_READ_ONLY => true
                    ),
                    'core_per_socket' => array(
                        ONAPP_FIELD_MAP       => '_core_per_socket',
                        ONAPP_FIELD_TYPE      => 'integer',
                        ONAPP_FIELD_READ_ONLY => true
                    ),
                    'memory'          => array(
                        ONAPP_FIELD_MAP       => '_memory',
                        ONAPP_FIELD_TYPE      => 'integer',
                        ONAPP_FIELD_READ_ONLY => true
                    ),

                );
                break;
            case 4.2:
            case 4.3:
            case 5.0:
                $this->fields = $this->initFields( 4.1 );
                break;
            case 5.1:
                $this->fields = $this->initFields( 5.0 );
                break;
            case 5.2:
                $this->fields = $this->initFields( 5.1 );
                break;
            case 5.3:
                $this->fields = $this->initFields( 5.2 );
                break;
            case 5.4:
                $this->fields = $this->initFields( 5.3 );
                break;
            case 5.5:
                $this->fields = $this->initFields( 5.4 );
                break;
            case 6.0:
                $this->fields = $this->initFields( 5.5 );
                break;
        }

        parent::initFields( $version, __CLASS__ );

        return $this->fields;
    }

    function getResource( $action = ONAPP_GETRESOURCE_DEFAULT ) {
        switch ( $action ) {
            case ONAPP_GETRESOURCE_VAPPS_RECOMPOSE:
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
        $this->sendPut( ONAPP_GETRESOURCE_VAPPS_RECOMPOSE, $data );
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
    function start() {
        $this->sendPost( ONAPP_GETRESOURCE_VAPPS_START );
    }

    /**
     * stop vApp
     *
     * @access    public
     */
    function stop() {
        $this->sendPost( ONAPP_GETRESOURCE_VAPPS_STOP );
    }


}