<?php
/**
 * User Additional Field
 *
 * @todo        Add description
 *
 * @category    API wrapper
 * @package     OnApp
 * @author      Yuriy Yakubskiy
 * @copyright   © 2012 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */

/**
 *
 * Managing User Additional Fields
 *
 * The OnApp_UserAdditionalField class uses the following basic methods:
 * {@link load}, {@link save}, {@link delete}, and {@link getList}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */
class OnApp_UserAdditionalField extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'user_additional_field';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'user_additional_fields';

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
            case '2.3':
                $this->fields = array(
                    'id'            => array(
                        ONAPP_FIELD_MAP       => '_id',
                        ONAPP_FIELD_TYPE      => 'integer',
                        ONAPP_FIELD_READ_ONLY => true
                    ),
                    'name'          => array(
                        ONAPP_FIELD_MAP       => '_name',
                        ONAPP_FIELD_TYPE      => 'string',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'default_value' => array(
                        ONAPP_FIELD_MAP       => '_default_value',
                        ONAPP_FIELD_TYPE      => 'integer',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'data_type'     => array(
                        ONAPP_FIELD_MAP       => '_data_type',
                        ONAPP_FIELD_TYPE      => 'string',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                );
                break;

            case 3.0:
            case 3.1:
            case 3.2:
            case 3.3:
                $this->fields = $this->initFields( 2.3 );
                break;

            default:
                $this->logger->error(
                    'supported only from 2.3 version',
                    __FILE__,
                    __LINE__
                );
                break;
        }

        parent::initFields( $version, __CLASS__ );

        return $this->fields;
    }
}