<?php

/**
 * Settings HypervisorsAutoImportRules
 *
 * @category        API wrapper
 * @package         OnApp
 * @subpackage      Settings
 * @author          Mykola Vuy
 * @copyright       © 2019 OnApp
 *
 */

/**
 * @var
 */
define('ONAPP_RUN_RULES', 'run');

/**
 * Settings HypervisorsAutoImportRules
 *
 * Use the following API calls to view, assign and delete virtual server recipes in your cloud.
 *
 * The OnApp_Settings_HypervisorsAutoImportRules class uses the
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */
class OnApp_Settings_HypervisorsAutoImportRules extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'auto_import_rule';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'auto_import_rules';
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
            case 6.1:
                $this->fields = array(
                    '_id'                   => array(
                        ONAPP_FIELD_MAP  => '_id',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'hypervisor_id'         => array(
                        ONAPP_FIELD_MAP  => '_hypervisor_id',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'event_type'            => array(
                        ONAPP_FIELD_MAP  => '_event_type',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'label'                 => array(
                        ONAPP_FIELD_MAP  => '_label',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'source_type'           => array(
                        ONAPP_FIELD_MAP  => '_source_type',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'source_id'             => array(
                        ONAPP_FIELD_MAP  => '_source_id',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'target_type'           => array(
                        ONAPP_FIELD_MAP  => '_target_type',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'target_id'             => array(
                        ONAPP_FIELD_MAP  => '_target_id',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                );
                break;
        }

        parent::initFields( $version, __CLASS__ );

        return $this->fields;
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
        $show_log_msg = true;
        switch ( $action ) {
            case ONAPP_GETRESOURCE_DEFAULT:
                /**
                 * ROUTE :
                 *
                 * @name Get List of Auto Import Rules
                 * @method GET
                 * @alias   /settings/hypervisors/:hypervisor_id/auto_import_rules(.:format)
                 */
                /**
                 * ROUTE :
                 *
                 * @name Add Auto Import Rule
                 * @method POST
                 * @alias   /settings/hypervisors/:hypervisor_id/auto_import_rules(.:format)
                 */
                /**
                 * ROUTE :
                 *
                 * @name Edit Auto Import Rule
                 * @method PUT
                 * @alias   /settings/hypervisors/:hypervisor_id/auto_import_rules/:rule_id(.:format)
                 */
                /**
                 * ROUTE :
                 *
                 * @name Delete Auto Import Rule
                 * @method DELETE
                 * @alias   /settings/hypervisors/:hypervisor_id/auto_import_rules/:rule_id(.:format)
                 */
                if ( is_null( $this->_hypervisor_id ) ) {
                    $this->logger->error(
                        'getResource( ' . $action . ' ): argument _hypervisor_id not set.',
                        __FILE__,
                        __LINE__
                    );
                }

                $resource = 'settings/hypervisors/' . $this->_hypervisor_id . '/' . $this->_resource;
                break;

            case ONAPP_RUN_RULES:
                /**
                 * ROUTE :
                 *
                 * @name Add Auto Import Rule
                 * @method POST
                 * @alias   /settings/hypervisors/:hypervisor_id/auto_import_rules/:rule_id/run.json
                (.:format)
                 */
                if ( is_null( $this->_id ) ) {
                    $this->logger->error(
                        'getResource( ' . $action . ' ): argument _id not set.',
                        __FILE__,
                        __LINE__
                    );
                }
                if ( is_null( $this->_hypervisor_id ) ) {
                    $this->logger->error(
                        'getResource( ' . $action . ' ): argument _hypervisor_id not set.',
                        __FILE__,
                        __LINE__
                    );
                }
                $resource = 'settings/hypervisors/' . $this->_hypervisor_id . '/' . $this->_resource . '/' . $this->_id . '/' . ONAPP_RUN_RULES;
                break;

            default:
                $resource = parent::getResource( $action );
                break;
        }

        return $resource;
    }

    public function runRules(){
        return $this->sendPost(ONAPP_RUN_RULES);
    }

    /**
     * Activates action performed with object
     *
     * @param string $action_name the name of action
     *
     * @access public
     */
    function activateCheck( $action_name ) {
        switch ( $action_name ) {
            case ONAPP_ACTIVATE_LOAD:
                exit( 'Call to undefined method ' . __CLASS__ . '::' . $action_name . '()' );
                break;
        }
    }

}
