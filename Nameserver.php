<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Resolvers
 *
 * Resolvers in OnApp implement a name-service protocol. You can set the IP addresses corresponding to the hostnames added to the system.
 *
 * @category    API wrapper
 * @package     OnApp
 * @author      Andrew Yatskovets
 * @copyright   © 2011 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */

/**
 * Resolvers
 *
 * The Resolvers class represents the name-servers of the OnApp installation.
 *
 * The OnApp_Nameserver class uses the following basic methods:
 * {@link load}, {@link save}, {@link delete}, and {@link getList}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */
class OnApp_Nameserver extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'nameserver';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'settings/nameservers';

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
                        ONAPP_FIELD_MAP           => '_id',
                        ONAPP_FIELD_TYPE          => 'integer',
                        ONAPP_FIELD_READ_ONLY     => '',
                        ONAPP_FIELD_DEFAULT_VALUE => ''
                    ),
                    'address'    => array(
                        ONAPP_FIELD_MAP           => '_address',
                        ONAPP_FIELD_TYPE          => '',
                        ONAPP_FIELD_READ_ONLY     => '',
                        ONAPP_FIELD_REQUIRED      => '',
                        ONAPP_FIELD_DEFAULT_VALUE => ''
                    ),
                    'created_at' => array(
                        ONAPP_FIELD_MAP           => '_created_at',
                        ONAPP_FIELD_TYPE          => 'datetime',
                        ONAPP_FIELD_READ_ONLY     => '',
                        #ONAPP_FIELD_REQUIRED      =>'',
                        ONAPP_FIELD_DEFAULT_VALUE => ''
                    ),
                    'network_id' => array(
                        ONAPP_FIELD_MAP           => '_network_id',
                        ONAPP_FIELD_TYPE          => 'integer',
                        ONAPP_FIELD_READ_ONLY     => '',
                        #ONAPP_FIELD_REQUIRED      =>'',
                        ONAPP_FIELD_DEFAULT_VALUE => ''
                    ),
                    'updated_at' => array(
                        ONAPP_FIELD_MAP           => '_updated_at',
                        ONAPP_FIELD_TYPE          => 'datetime',
                        ONAPP_FIELD_READ_ONLY     => '',
                        #ONAPP_FIELD_REQUIRED      =>'',
                        ONAPP_FIELD_DEFAULT_VALUE => ''
                    ),
                );
                break;

            case 3.0:
            case 3.1:
            case 3.2:
            case 3.3:
            case 3.4:
            case 3.5:
                $this->fields = $this->initFields( 2.3 );
                break;
        }

        parent::initFields( $version, __CLASS__ );

        return $this->fields;
    }

    function getResource( $action = ONAPP_GETRESOURCE_DEFAULT ) {
        return parent::getResource( $action );
        /**
         * ROUTE :
         *
         * @name nameservers
         * @method GET
         * @alias   /settings/nameservers(.:format)
         * @format  {:controller=>"nameservers", :action=>"index"}
         */
        /**
         * ROUTE :
         *
         * @name nameserver
         * @method GET
         * @alias   /settings/nameservers/:id(.:format)
         * @format  {:controller=>"nameservers", :action=>"show"}
         */
        /**
         * ROUTE :
         *
         * @name
         * @method POST
         * @alias    /settings/nameservers(.:format)
         * @format   {:controller=>"nameservers", :action=>"create"}
         */
        /**
         * ROUTE :
         *
         * @name
         * @method PUT
         * @alias  /settings/nameservers/:id(.:format)
         * @format {:controller=>"nameservers", :action=>"update"}
         */
        /**
         * ROUTE :
         *
         * @name
         * @method DELETE
         * @alias    /settings/nameservers/:id(.:format)
         * @format   {:controller=>"nameservers", :action=>"destroy"}
         */
    }
}