<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Logger for OnApp Wrapper
 *
 * Log management (LM) comprises an approach to dealing with large volumes of
 * computer-generated log messages (also known as audit records, audit trails,
 * event-logs, etc). LM covers log collection, centralized aggregation,
 * long-term retention, log analysis (in real-time and in bulk after storage) as
 * well as log search and reporting.
 *
 * Log management is driven by reasons of security, system and network
 * operations (such as system or network administration) and regulatory
 * compliance.
 *
 * Effectively analyzing large volumes of diverse logs can pose many challenges
 * — such as huge log-volumes (reaching hundreds of gigabytes of data per day
 * for a large organization), log-format diversity, undocumented proprietary
 * log-formats (that resist analysis) as well as the presence of false log
 * records in some types of logs (such as intrusion-detection logs)[examples
 * needed].
 *
 * Users and potential users of LM can build their own log management and
 * intelligence tools, assemble the functionality from various open-source
 * components, or acquire (sub-)systems from commercial vendors. Log management
 * is a complicated process and organizations often make mistakes while
 * approaching it.
 *
 * @category    LOGGER
 * @package     OnApp
 * @subpackage  Helper
 * @author      Andrew Yatskovets
 * @copyright   © 2011 OnApp
 * @link        http://www.onapp.com/
 */

/**
 * The constant that stands for the loglevel
 * When it is set, the error is added to the logs, the system stops working and outputs this error.
 */
define( 'ONAPP_LOGGER_VALUE_ERROR', 'error' );

/**
 * The constant that stands for the loglevel
 * When it is set, the error is added to the logs.
 */
define( 'ONAPP_LOGGER_VALUE_WARNING', 'warning' );

/**
 * The constant that stands for the loglevel
 * When it is set, the information needed for the system development or processed information tracing is added
 * to the logs
 */
define( 'ONAPP_LOGGER_VALUE_DEBUG', 'debug' );

/**
 * The constant that identifies the standard message flow into the buffer log
 */
define( 'ONAPP_LOGGER_VALUE_MESSAGE', 'message' );

/**
 * The Logger class provides a simple but sophisticated logging utility
 * Each message has a level, and the Logger itself has a level, which acts as
 * a filter, so you can control the amount of information emitted from the
 * logger without having to remove actual messages. For instance, in a
 * production system, you may have your logger(s) set to message (as well as warning, or
 * error if you do not want the log files growing large with repetitive
 * information). When you are developing it, though, you probably want to know
 * about the program's internal state, and would set them to debug.
 */
class OnApp_Helper_Logger {
    /**
     * Shows a region on Earth, more or less bounded by lines of
     * longitude, that has a uniform, legally mandated standard time, usually
     * referred to as the local time.
     *
     * @access private
     * @var    string
     */
    var $_timezone = 'America/Los_Angeles';
    /**
     * Outputs the date format inside of Logger
     *
     * @access private
     * @var    string
     */
    var $_date_format = 'Y-m-d H:i:s';
    /**
     * Stands for the adding of the information needed to adjust
     * the system.
     *
     * @access private
     * @var    boolean
     */
    var $_debug = false;
    /**
     * Buffer containing all the information on the messages used in the class
     *
     * @access private
     * @var    array
     */
    var $_log = array();

    /**
     * Sets debug status
     *
     * @param boolean $debug set new debug status
     *
     * @return void
     * @access public
     */
    function setDebug( $debug ) {
        if( ! is_null( $debug ) ) {
            $this->_debug = $debug;
        }
    }

    /**
     * Adds the log message to the logger buffer
     *
     * @param string $msg log message
     *
     * @return void
     * @access public
     */
    function add( $msg ) {
        $this->_log( $msg, ONAPP_LOGGER_VALUE_MESSAGE );
    }

    /**
     * Adds the error message to the logger buffer and stops
     * executing
     *
     * @param string  $msg  log message
     * @param string  $file file which initialized error
     * @param integer $line string in which was initialized error
     *
     * @return void
     * @access public
     */
    function error( $msg, $file = '', $line = null ) {
        $this->_log( $msg, ONAPP_LOGGER_VALUE_ERROR );
        echo $this->logs();
        trigger_error( "FILE => '$file', LINE => '$line'\n$msg", E_USER_ERROR );
    }

    /**
     * Adds a warning message to the logger buffer
     *
     * @param string $msg log message
     *
     * @return void
     * @access public
     */
    function warning( $msg ) {
        $this->_log( $msg, ONAPP_LOGGER_VALUE_WARNING );
    }

    /**
     * Adds debug message to the logger buffer
     *
     * @param string $msg log message
     *
     * @return void
     * @access public
     */
    function debug( $msg ) {
        if( $this->_debug ) {
            $this->_log( $msg, ONAPP_LOGGER_VALUE_DEBUG );
        }
    }

    /**
     * Adds the message and additional data to the buffer depending
     * on the message type
     *
     * @param string $msg  log message
     * @param string $type log type
     *
     * @return boolean
     * @access private
     */
    function _log( $msg, $type = ONAPP_LOGGER_VALUE_MESSAGE ) {
        $log = '';

        $date_format = $this->_date_format;

        if( strlen( $msg ) > 0 ) {
            switch( $type ) {
                case ONAPP_LOGGER_VALUE_ERROR:
                    $log = "[ERROR] $msg";
                    break;
                case ONAPP_LOGGER_VALUE_WARNING:
                    $log = "[WARN]  $msg";
                    break;
                case ONAPP_LOGGER_VALUE_DEBUG:
                    $log = "[DEBUG] $msg";
                    break;
                default:
                    $log = "[MSG]   $msg";
                    break;
            }

            $time = microtime( true );
            $micro = sprintf( "%06d", ( $time - floor( $time ) ) * 1000000 );
            $date = date( "$date_format $micro", $time );

            $this->_log[ $date ] = array(
                'log' => $log
            );
        }

        return true;
    }

    /**
     * Shows Logger buffer messages (error, log, and debug)
     *
     * @param void
     *
     * @return string full Logger buffer
     * @access public
     */
    function logs() {
        $output = "";
        foreach( $this->_log as $key => $value ) {
            $output .= "[$key] " . $value[ 'log' ] . "\n";
        }

        return $output;
    }

    /**
     * Sets script timezone
     *
     * @param string $timezone new Timezone for data function
     *
     * @return void
     * @access public
     */
    function setTimezone( $timezone = '' ) {
        if( strlen( $timezone ) == 0 ) {
            $timezone = $this->_timezone;
        }

        if( ! function_exists( 'date_default_timezone_set' ) ) {
            $this->warning( "This PHP version not suport functions date_default_timezone_set or date_default_timezone_get." );
        }
        else {
            if( strlen( ini_get( 'date.timezone' ) ) == 0 ) {
                //                               date_default_timezone_set( $timezone );
                $this->add( "setTimezone: Change default date.timezone." );
            }
            else {
                $this->add( "setTimezone: Do not need to change default date.timezone." );
            }

            $script_tz = date_default_timezone_get();

            if( strcmp( $script_tz, ini_get( 'date.timezone' ) ) ) {
                $this->warning( "setTimezone: Script timezone differs from ini-set timezone." );
            }
        }
    }
}