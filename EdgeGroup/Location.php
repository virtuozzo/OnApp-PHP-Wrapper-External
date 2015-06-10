<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Manages Edge Group Location
 *
 * @todo        Add description
 *
 * @category    API wrapper
 * @package     OnApp
 * @subpackage  EdgeGroup
 * @author      Yakubskiy Yuriy
 * @copyright   © 2011 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */

/**
 * OnApp_EdgeGroup_Location
 *
 * Edge Group nested class
 *
 */
class OnApp_EdgeGroup_Location extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = '';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = '';

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
                    'city'        => array(
                        ONAPP_FIELD_MAP  => '_city',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'region'      => array(
                        ONAPP_FIELD_MAP  => '_region',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'price'       => array(
                        ONAPP_FIELD_MAP  => '_price',
                        ONAPP_FIELD_TYPE => 'float',
                    ),
                    'latitude'    => array(
                        ONAPP_FIELD_MAP  => '_latitude',
                        ONAPP_FIELD_TYPE => 'float',
                    ),
                    'country'     => array(
                        ONAPP_FIELD_MAP  => '_country',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'deleted'     => array(
                        ONAPP_FIELD_MAP  => '_deleted',
                        ONAPP_FIELD_TYPE => 'boolean',
                    ),
                    'id'          => array(
                        ONAPP_FIELD_MAP       => '_id',
                        ONAPP_FIELD_TYPE      => 'integer',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'geoblocking' => array(
                        ONAPP_FIELD_MAP  => '_geoblocking',
                        ONAPP_FIELD_TYPE => 'boolean',
                    ),
                    'createdAt'   => array(
                        ONAPP_FIELD_MAP  => '_createdAt',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'updatedAt'   => array(
                        ONAPP_FIELD_MAP  => '_updatedAt',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'description' => array(
                        ONAPP_FIELD_MAP  => '_description',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'longitude'   => array(
                        ONAPP_FIELD_MAP  => '_longitude',
                        ONAPP_FIELD_TYPE => 'float',
                    ),
                    'status'      => array(
                        ONAPP_FIELD_MAP  => '_status',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'operator'    => array(
                        ONAPP_FIELD_MAP   => '_operator',
                        ONAPP_FIELD_TYPE  => 'array',
                        ONAPP_FIELD_CLASS => 'EdgeGroup_Location_Operator',

                    ),

                );
                break;

            case 3.0:
                $this->fields = $this->initFields( 2.3 );
                break;

            case 3.1:
            case 3.2:
            case 3.3:
            case 3.4:
            case 3.5:
            case 4.0:
            case 4.1:
                $this->fields                            = $this->initFields( 3.0 );
                $this->fields[ 'geoBlocking' ]           = array(
                    ONAPP_FIELD_MAP  => 'geoBlocking',
                    ONAPP_FIELD_TYPE => 'boolean',
                );
                $this->fields[ 'onSaleStreamSupported' ] = array(
                    ONAPP_FIELD_MAP  => 'onSaleStreamSupported',
                    ONAPP_FIELD_TYPE => 'boolean',
                );
                $this->fields[ 'onSaleHttpSupported' ]   = array(
                    ONAPP_FIELD_MAP  => 'onSaleHttpSupported',
                    ONAPP_FIELD_TYPE => 'boolean',
                );
                $this->fields[ 'streamSupported' ]       = array(
                    ONAPP_FIELD_MAP  => 'streamSupported',
                    ONAPP_FIELD_TYPE => 'boolean',
                );
                $this->fields[ 'httpSupported' ]         = array(
                    ONAPP_FIELD_MAP  => 'httpSupported',
                    ONAPP_FIELD_TYPE => 'boolean',
                );
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
    function activate( $action_name ) {
        switch( $action_name ) {
            case ONAPP_ACTIVATE_GETLIST:
            case ONAPP_ACTIVATE_SAVE:
            case ONAPP_ACTIVATE_DELETE:
                exit( 'Call to undefined method ' . __CLASS__ . '::' . $action_name . '()' );
                break;
        }
    }
}