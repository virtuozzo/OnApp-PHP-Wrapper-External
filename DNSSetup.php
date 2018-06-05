<?php

/**
 * DNS Setup
 *
 * @category    API wrapper
 * @package     OnApp
 * @author
 * @copyright   © 2013 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */

/**
 *
 */
define( 'ONAPP_GETRESOURCE_GET_GLUE_RECORDS', 'get_glue_records' );

/**
 * DNS Setup
 *
 * The OnApp_DNSSetup class uses the following basic methods:
 * {@link load}, {@link save}, {@link delete}, and {@link getList}.
 *
 * For full fields reference and curl request details visit: ( https://docs.onapp.com/display/42API/DNS+Setup )
 */
class OnApp_DNSSetup extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'dns_setup';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'settings/dns_setup';
    /**
     * API Fields description
     *
     * @param string|float $version OnApp API version
     * @param string $className current class' name
     *
     * @return array
     */

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
                    'domain' => array(
                        ONAPP_FIELD_MAP       => '_domain',
                        ONAPP_FIELD_TYPE      => 'string',
                        ONAPP_FIELD_READ_ONLY => true
                    ),
                    'ns1'    => array(
                        ONAPP_FIELD_MAP       => '_ns1',
                        ONAPP_FIELD_TYPE      => 'string',
                        ONAPP_FIELD_READ_ONLY => true
                    ),
                    'ns2'    => array(
                        ONAPP_FIELD_MAP       => '_ns2',
                        ONAPP_FIELD_TYPE      => 'string',
                        ONAPP_FIELD_READ_ONLY => true
                    ),
                    'ns3'    => array(
                        ONAPP_FIELD_MAP       => '_ns3',
                        ONAPP_FIELD_TYPE      => 'string',
                        ONAPP_FIELD_READ_ONLY => true
                    ),
                    'ns4'    => array(
                        ONAPP_FIELD_MAP       => '_ns4',
                        ONAPP_FIELD_TYPE      => 'string',
                        ONAPP_FIELD_READ_ONLY => true
                    ),
                );
                break;

            case 4.3:
            case 5.0:
                $this->fields = $this->initFields( 4.2 );
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
    }

    function getResource( $action = ONAPP_GETRESOURCE_DEFAULT ) {
        switch ( $action ) {
            case ONAPP_GETRESOURCE_GET_GLUE_RECORDS:
                /**
                 * @alias   /settings/dns_setup/glue_records.json
                 */
                $resource = $this->getResource( ONAPP_GETRESOURCE_DEFAULT ) . '/glue_records';
                break;
            default:
                /**
                 * @alias   /settings/dns_setup.json
                 */
                $resource = parent::getResource( $action );
                break;
        }

        return $resource;
    }

    public function setUpDNSDomain( $domain ) {
        $data = array(
            'root' => $this->_tagRoot,
            'data' => array(
                'domain' => $domain,
            ),
        );
        $this->sendPost( ONAPP_GETRESOURCE_DEFAULT, $data );
    }

    public function editDNSDomain( $domain ) {
        $data = array(
            'root' => $this->_tagRoot,
            'data' => array(
                'domain' => $domain,
            ),
        );
        $this->sendPut( ONAPP_GETRESOURCE_DEFAULT, $data );
    }

    function getGlueRecords() {

        $result = $this->sendGet( ONAPP_GETRESOURCE_GET_GLUE_RECORDS );

        if ( ! is_null( $this->getErrorsAsArray() ) ) {
            return false;
        } else {
            if ( ! is_array( $result ) && ! is_null( $result ) ) {
                $result = array( $result );
            }

            return $result;
        }
    }

}
