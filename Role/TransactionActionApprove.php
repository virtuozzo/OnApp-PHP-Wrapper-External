<?php
/**
 * Managing Role Transaction Action Approve
 *
 * @category    API wrapper
 * @package     OnApp
 * @subpackage  Role
 * @author      Ivan Gavryliuk
 * @copyright   © 2017 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */

/**
 * Managing Role Transaction Action Approve
 *
 * The OnApp_Role_TransactionActionApprove class uses the following basic methods:
 * {@link getList}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */
class OnApp_Role_TransactionActionApprove extends OnApp {
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
     * @param string|float $version OnApp API version
     * @param string $className current class' name
     *
     * @return array
     */
    public function initFields( $version = null, $className = '' ) {
        switch ( $version ) {
            case 5.5:
                $this->fields = array(
                    'id'      => array(
                        ONAPP_FIELD_MAP  => '_id',
                        ONAPP_FIELD_TYPE => 'integer'
                    ),
                    'action'  => array(
                        ONAPP_FIELD_MAP  => '_action',
                        ONAPP_FIELD_TYPE => 'string'
                    ),
                    'enabled' => array(
                        ONAPP_FIELD_MAP  => '_enabled',
                        ONAPP_FIELD_TYPE => 'boolean'
                    ),
                );
                break;
            case 6.0:
                $this->fields = $this->initFields( 5.5 );
                break;

            case 6.1:
                $this->fields = $this->initFields( 6.0 );
                break;

            case 6.2:
                $this->fields = $this->initFields( 6.1 );
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
}