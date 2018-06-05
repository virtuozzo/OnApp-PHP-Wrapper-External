<?php

/**
 * User_YubiKey
 *
 * @category    API wrapper
 * @package     OnApp
 * @subpackage  User
 * @author      Ivan Gavryliuk
 * @copyright   © 2016 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */

/**
 * User Yubi Key
 *
 * The OnApp_User_YubiKey class supports the following basic methods
 *
 * The OnApp_User_YubiKey class uses the following basic methods:
 * {@link getList}.
 *
 */
class OnApp_User_YubiKey extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'yubi_key';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'yubi_keys';

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
            case 5.2:
                $this->fields = array(
                    'id'         => array(
                        ONAPP_FIELD_MAP  => '_id',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'created_at' => array(
                        ONAPP_FIELD_MAP  => '_created_at',
                        ONAPP_FIELD_TYPE => 'datetime',
                    ),
                    'updated_at' => array(
                        ONAPP_FIELD_MAP  => '_updated_at',
                        ONAPP_FIELD_TYPE => 'datetime',
                    ),
                    'user_id'    => array(
                        ONAPP_FIELD_MAP  => '_user_id',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'label'      => array(
                        ONAPP_FIELD_MAP  => '_label',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'last_used'  => array(
                        ONAPP_FIELD_MAP  => '_last_used',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'otp'        => array(
                        ONAPP_FIELD_MAP  => '_otp',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                );
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
            case ONAPP_GETRESOURCE_DEFAULT:

                if ( is_null( $this->_user_id ) && is_null( $this->_obj->_user_id ) ) {
                    $this->logger->error(
                        'getResource( ' . $action . ' ): argument _user_id not set.',
                        __FILE__,
                        __LINE__
                    );
                } else {
                    if ( is_null( $this->_user_id ) ) {
                        $this->_user_id = $this->_obj->_user_id;
                    }
                }

                $resource = 'users/' . $this->_user_id . '/' . $this->_resource;
                break;
            default:
                $resource = parent::getResource( $action );
                break;
        }

        return $resource;
    }

}
