<?php

/**
 * Managing SSH
 *
 * @category    API wrapper
 * @package     OnApp
 * @author      Ivan Gavryliuk
 * @copyright   © 2016 OnApp
 * @link        https://docs.onapp.com/display/42API/SSH+keys
 * @see         OnApp
 */

/**
 * SSH
 *
 * The OnApp_SSH class uses the following basic methods:
 * {@link load}, {@link save}, {@link delete}, and {@link getList}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */
class OnApp_SSH extends OnApp
{
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'ssh_key';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = '/settings/ssh_keys';

    /**
     * API Fields description
     *
     * @param string|float $version OnApp API version
     * @param string $className current class' name
     *
     * @return array
     */
    public function initFields($version = null, $className = '') {

        switch ($version) {
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
                    'id'            => array(
                        ONAPP_FIELD_MAP  => '_id',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'user_id'            => array(
                        ONAPP_FIELD_MAP  => '_user_id',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'key'            => array(
                        ONAPP_FIELD_MAP  => '_key',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'created_at'            => array(
                        ONAPP_FIELD_MAP  => '_created_at',
                        ONAPP_FIELD_TYPE => 'datetime',
                    ),
                    'updated_at'            => array(
                        ONAPP_FIELD_MAP  => '_updated_at',
                        ONAPP_FIELD_TYPE => 'datetime',
                    ),
                );
                break;
        }

        parent::initFields($version, __CLASS__);

        return $this->fields;
    }

    function getResource($action = ONAPP_GETRESOURCE_DEFAULT) {
        switch ($action) {
            case ONAPP_GETRESOURCE_ADD :
                /**
                 * ROUTE :
                 *
                 * @name ssh
                 * @method POST
                 * @alias  /users/:user_id/ssh_keys(.:format)
                 * @format {:action=>"index", :controller=>"ssh_keys"}
                 */
                if (is_null($this->_user_id)) {
                    $this->logger->error(
                        'getResource( ' . $action . ' ): argument _user_id not set.',
                        __FILE__,
                        __LINE__
                    );
                }
                $resource = 'users/' . $this->_user_id . '/ssh_keys';
                break;
            default:
                $resource = parent::getResource($action);
                break;
        }
        return $resource;
    }
}
