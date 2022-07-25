<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Represents Edge Groups Assigned to the current logined user's Billling Plan
 *
 *
 * @category    API wrapper
 * @package     OnApp
 * @author      Yakubskiy Yuriy
 * @subpackage  CDNResource
 * @copyright   © 2011 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */

/**
 * Managing Edge Groups
 *
 * The Available Edge Group class represents the Edge groups.
 * The OnApp_CDNResource_AvailableEdgeGroup class is the parent of the OnApp class.
 *
 * The OnApp_CDNResource_AvailableEdgeGroup uses the following basic methods:
 * {@link getList}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */
class OnApp_CDNResource_AvailableEdgeGroup extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'edge_group';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'cdn_resources/available_edge_groups';

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
            case '2.3':
                $this->fields = array(
                    'label'                => array(
                        ONAPP_FIELD_MAP           => '_label',
                        ONAPP_FIELD_REQUIRED      => true,
                        ONAPP_FIELD_DEFAULT_VALUE => ''
                    ),
                    'created_at'           => array(
                        ONAPP_FIELD_MAP       => '_created_at',
                        ONAPP_FIELD_TYPE      => 'datetime',
                        ONAPP_FIELD_READ_ONLY => true
                    ),
                    'updated_at'           => array(
                        ONAPP_FIELD_MAP       => '_updated_at',
                        ONAPP_FIELD_TYPE      => 'datetime',
                        ONAPP_FIELD_READ_ONLY => true
                    ),
                    'id'                   => array(
                        ONAPP_FIELD_MAP       => '_id',
                        ONAPP_FIELD_TYPE      => 'integer',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'edge_group_locations' => array(
                        ONAPP_FIELD_MAP   => '_edge_group_locations',
                        ONAPP_FIELD_TYPE  => 'array',
                        ONAPP_FIELD_CLASS => 'CDNResource_AvailableEdgeGroup_Location'
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
            case 4.2:
                $this->fields = $this->initFields( 2.3 );
                break;
            case 4.3:
                $this->fields = $this->initFields( 4.2 );
                break;
            case 5.0:
                $this->fields = $this->initFields( 4.3 );
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

            case 6.1:
                $this->fields = $this->initFields( 6.0 );
                break;

            case 6.2:
                $this->fields = $this->initFields( 6.1 );
                $this->fields['cdn_reference'] = array(
                    ONAPP_FIELD_MAP  => '_cdn_reference',
                    ONAPP_FIELD_TYPE => 'integer',
                );
                break;

            case 6.3:
                $this->fields = $this->initFields( 6.2 );
                break;

            case 6.4:
                $this->fields = $this->initFields( 6.3 );
                break;

            case 6.5:
                $this->fields = $this->initFields( 6.4 );
                break;

            case 6.6:
                $this->fields = $this->initFields( 6.5 );
                break;

            case 6.7:
                $this->fields = $this->initFields( 6.6 );
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
    function activateCheck( $action_name ) {
        switch ( $action_name ) {
            case ONAPP_ACTIVATE_LOAD:
            case ONAPP_ACTIVATE_SAVE:
            case ONAPP_ACTIVATE_DELETE:
                exit( 'Call to undefined method ' . __CLASS__ . '::' . $action_name . '()' );
                break;
        }
    }
}