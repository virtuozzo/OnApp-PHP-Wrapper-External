<?php
/**
 * Storage
 *
 * @todo        Add description
 *
 * @category    API wrapper
 * @package     OnApp
 * @subpackage  Hypervisor
 * @author
 * @copyright   © 2011 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */

/**
 * ONAPP_Hypervisor_Storage
 *
 * This class reprsents the Storage for Hypervisor.
 *
 * The OnApp_Hypervisor_Storage class uses the following basic methods:
 * {@link load}, {@link save}, {@link delete}, and {@link getList}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */
class OnApp_Hypervisor_Storage extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'storage';
    /**
     * alias processing the object data
     *
     * @var string
     */
    //var $_resource = 'network_joins';

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
            case '2.0':
            case '2.1':
            case 2.2:
            case 2.3:
            case 3.0:
            case 3.1:
            case 3.2:
            case 3.3:
            case 3.4:
            case 3.5:
            case 4.0:
            case 4.1:
            case 4.2:
                $this->fields = array(
                    'api_url'                         => array(
                        ONAPP_FIELD_MAP  => '_api_url',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'login'                           => array(
                        ONAPP_FIELD_MAP  => '_login',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'password'                        => array(
                        ONAPP_FIELD_MAP  => '_password',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'cluster_name'                    => array(
                        ONAPP_FIELD_MAP  => '_cluster_name',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'distributed_virtual_switch_name' => array(
                        ONAPP_FIELD_MAP  => '_distributed_virtual_switch_name',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'organization'                    => array(
                        ONAPP_FIELD_MAP  => '_organization',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'password_encryption_key'         => array(
                        ONAPP_FIELD_MAP  => '_password_encryption_key',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                );
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
        }

        parent::initFields( $version, __CLASS__ );

        return $this->fields;
    }

}
