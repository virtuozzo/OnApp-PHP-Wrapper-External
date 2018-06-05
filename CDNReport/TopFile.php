<?php

/**
 * Managing CDN Top File
 *
 *
 * @category    API wrapper
 * @package     OnApp
 * @author      Ivan Gavryliuk
 * @copyright   © 2017 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */

/**
 * Managing CDN Top File
 *
 * The CDN Top File class represents the CDN Top File.
 * The OnApp_CDNReport_TopFile class is the parent of the OnApp class.
 *
 * The OnApp_CDNReport_TopFile uses the following basic methods:
 * {@link load}, {@link getList}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */

/**
 * Purge top files
 */
define( 'ONAPP_TOP_FILES_PURGE', 'purge' );


class OnApp_CDNReport_TopFile extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'top_files';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'cdn/reports/top_files';

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
                    'top_fifty_files_table' => array(
                        ONAPP_FIELD_MAP   => '_top_fifty_files_table',
                        ONAPP_FIELD_TYPE  => 'array',
                        ONAPP_FIELD_CLASS => 'CDNReport_TopFifty_FilesTable'
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
            case ONAPP_TOP_FILES_PURGE:
                if ( is_null( $this->_remote_id ) ) {
                    $this->logger->error(
                        'getResource( ' . $action . ' ): argument _remote_id not set.',
                        __FILE__,
                        __LINE__
                    );
                }
                if ( is_null( $this->_url) ) {
                    $this->logger->error(
                        'getResource( ' . $action . ' ): argument _url not set.',
                        __FILE__,
                        __LINE__
                    );
                }

                $resource = $this->getResource( ONAPP_GETRESOURCE_LOAD ) . 'purge';
                break;

            default:
                $resource = parent::getResource( $action );
                break;
        }

        return $resource;
    }


    /**
     * Sends an API request to get the Objects. After requesting,
     * unserializes the received response into the array of Objects
     *
     * @param array $url_args [start, end, type, resource_type, resources[] ]
     *
     * @return mixed an array of Object instances on success. Otherwise false
     * @access public
     */
    public function getList( $url_args = null, $params = null ) {
        return parent::getList( null, $url_args );
    }

    public function purge() {
        $data = array();

        if ( !is_null($this->_remote_id) ) {
            $data['remote_id'] = $this->_remote_id;
        } else {
            $this->logger->error(
                'prefetch: argument _remote_id not set.',
                __FILE__,
                __LINE__
            );
        }

        if ( !is_null($this->_url) ) {
            $data['url'] = $this->_url;
        } else {
            $this->logger->error(
                'prefetch: argument _url not set.',
                __FILE__,
                __LINE__
            );
        }


        $data = array(
            'root' => 'tmp_holder',
            'data' => $data
        );

        $this->sendPost( ONAPP_TOP_FILES_PURGE, $data );
    }

    /**
     * Activates action performed with object
     *
     * @param string $action_name the name of action
     *
     * @access public
     */
    function activateCheck( $action_name ) {
        switch ( $action_name ) {
            case ONAPP_ACTIVATE_LOAD:
            case ONAPP_ACTIVATE_SAVE:
            case ONAPP_ACTIVATE_DELETE:
                exit( 'Call to undefined method ' . __CLASS__ . '::' . $action_name . '()' );
                break;
        }
    }


}
