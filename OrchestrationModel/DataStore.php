<?php
/**
 * Managing OrchestrationModel DataStore
 *
 *
 * @category    API wrapper
 * @package     OnApp
 * @author
 * @copyright   © 2016 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */


/**
 * OrchestrationModel DataStore
 *
 */
class OnApp_OrchestrationModel_DataStore extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'data_stores_to_create';

    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'data_stores';

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
            case 4.2:
            case 4.3:
            case 5.0:
                $this->fields = array(
                    'id'                      => array(
                        ONAPP_FIELD_MAP  => '_id',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'label'                   => array(
                        ONAPP_FIELD_MAP  => '_label',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'min'                     => array(
                        ONAPP_FIELD_MAP  => '_min',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'max'                     => array(
                        ONAPP_FIELD_MAP  => '_max',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'default'                 => array(
                        ONAPP_FIELD_MAP  => '_default',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'data_store_customizable' => array(
                        ONAPP_FIELD_MAP  => '_data_store_customizable',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'data_store_visible'      => array(
                        ONAPP_FIELD_MAP  => '_data_store_visible',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'use_it'                  => array(
                        ONAPP_FIELD_MAP  => '_use_it',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                );
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