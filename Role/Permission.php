<?php
/**
 * Managing Role Permissions
 *
 * @category    API wrapper
 * @package     OnApp
 * @subpackage  Role
 * @author      Lev Bartashevsky
 * @copyright   © 2011 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */

/**
 * Managing Role Permissions
 *
 * The OnApp_Role_Permission class represents the billing plans. The OnApp class is the parent of the OnApp class.
 *
 * The OnApp_BillingPlan class uses the following basic methods:
 * {@link load}, {@link save}, {@link delete}, and {@link getList}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */
class OnApp_Role_Permission extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'permission';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'permissions';

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
                    'id'         => array(
                        ONAPP_FIELD_MAP       => '_id',
                        ONAPP_FIELD_TYPE      => 'integer',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'label'      => array(
                        ONAPP_FIELD_MAP      => '_label',
                        ONAPP_FIELD_REQUIRED => true,
                    ),
                    'created_at' => array(
                        ONAPP_FIELD_MAP       => '_created_at',
                        ONAPP_FIELD_TYPE      => 'datetime',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'updated_at' => array(
                        ONAPP_FIELD_MAP       => '_updated_at',
                        ONAPP_FIELD_TYPE      => 'datetime',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'identifier' => array(
                        ONAPP_FIELD_MAP       => '_identifier',
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
}