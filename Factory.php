<?php

/**
 * API Factory Wrapper for OnApp
 *
 * This API provides an interface to onapp.com allowing common virtual machine
 * and account management tasks
 *
 * @category    Factory
 * @package     OnApp
 * @author      Andrew Yatskovets
 * @copyright   © 2011 OnApp
 * @link        http://www.onapp.com/
 */
class OnApp_Factory extends OnApp {
    /**
     * Object constructor
     *
     * @param string      $hostname
     * @param string      $username
     * @param string      $password
     * @param string|null $proxy
     */
    public function __construct( $hostname, $username, $password, $proxy = null ) {
        parent::__construct();
        $this->auth( $hostname, $username, $password );
        //todo ??? constructor should return instance instead of boolean value
        //return $this->_is_auth;
    }

    /**
     * Craft new object
     *
     * @param string $name  class name
     * @param bool   $debug flag for debug mode
     *
     * @return object instance of class
     */
    public function factory( $name, $debug = false ) {
        $class_name = 'OnApp_' . $name;

        $result = new $class_name();
        $result->logger->setDebug( $debug );

        $result->setOption( ONAPP_OPTION_DEBUG_MODE, $debug );
        $result->logger->setTimezone();
        $result->version = $this->getAPIVersion();
        $result->options = $this->options;
        $result->_ch = $this->_ch;
        $result->initFields( $this->getAPIVersion() );

        return $result;
    }
}