<?php

/**
 * Get locale from OnApp CP
 *
 * @category    API wrapper
 * @package     OnApp
 * @author      Lev Bartashevsky
 * @copyright   © 2012 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */

define('ONAPP_VERSION_SIX', 6);

class OnApp_Locale extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'locale';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = '/settings/internationalization';

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
            case 2.3:
                $this->fields = array(
                    'code' => array(
                        ONAPP_FIELD_MAP  => 'code',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'name' => array(
                        ONAPP_FIELD_MAP  => 'name',
                        ONAPP_FIELD_TYPE => 'string',
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
            case 4.3:
            case 5.0:
                $this->fields = $this->initFields( 2.3 );
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
                $this->fields['id']                 = array(
                    ONAPP_FIELD_MAP             => '_id',
                    ONAPP_FIELD_TYPE            => 'integer',
                    ONAPP_FIELD_READ_ONLY       => true
                );
                $this->fields['created_at']         = array(
                        ONAPP_FIELD_MAP         => '_created_at',
                        ONAPP_FIELD_TYPE        => 'datetime',
                        ONAPP_FIELD_READ_ONLY   => true
                );
                $this->fields['updated_at']         = array(
                        ONAPP_FIELD_MAP         => '_updated_at',
                        ONAPP_FIELD_TYPE        => 'datetime',
                        ONAPP_FIELD_READ_ONLY   => true
                );
                break;
        }

        parent::initFields( $version, __CLASS__ );

        return $this->fields;
    }

    function getResource( $action = ONAPP_GETRESOURCE_DEFAULT ) {
        /**
         * ROUTE :
         *
         * @name roles
         * @method GET
         * @alias   /roles(.:format)
         * @format  {:controller=>"roles", :action=>"index"}
         */
        /**
         * ROUTE :
         *
         * @name role
         * @method GET
         * @alias   /roles/:id(.:format)
         * @format  {:controller=>"roles", :action=>"show"}
         */
        /**
         * ROUTE :
         *
         * @name
         * @method POST
         * @alias   /roles(.:format)
         * @format  {:controller=>"roles", :action=>"create"}
         */
        /**
         * ROUTE :
         *
         * @name
         * @method PUT
         * @alias  /roles/:id(.:format)
         * @format {:controller=>"roles", :action=>"update"}
         */
        /**
         * ROUTE :
         *
         * @name
         * @method DELETE
         * @alias  /roles/:id(.:format)
         * @format {:controller=>"roles", :action=>"destroy"}
         */
        
        if ( $this->getAPIVersion() >= ONAPP_VERSION_SIX ) {
            $this->_resource = 'settings/locales';
        }
        
        return parent::getResource( $action );
    }
    function activateCheck( $action_name ) {
        switch ( $action_name ) {
            case ONAPP_ACTIVATE_LOAD:
            case ONAPP_ACTIVATE_SAVE:
            case ONAPP_ACTIVATE_DELETE:
                $this->logger->error( 'Call to undefined method ' . __CLASS__ . '::' . $action_name . '()',
                    __FILE__,
                    __LINE__
                );
        }
    }
}