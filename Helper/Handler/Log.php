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
 * @copyright   (c) 2011 OnApp
 * @link        http://www.onapp.com/
 */

/**
 * The constant that stands for the loglevel
 * When it is set, the error is added to the logs, the system stops working and outputs this error.
 */
define( 'ONAPP_LOGGER_VALUE_ERROR', 'ERROR' );

/**
 * The constant that stands for the loglevel
 * When it is set, the error is added to the logs.
 */
define( 'ONAPP_LOGGER_VALUE_WARNING', 'WARNING' );

/**
 * The constant that stands for the loglevel
 * When it is set, the information needed for the system development or processed information tracing is added
 * to the logs
 */
define( 'ONAPP_LOGGER_VALUE_DEBUG', 'DEBUG' );

/**
 * The constant that identifies the standard message flow into the buffer log
 */
define( 'ONAPP_LOGGER_VALUE_MESSAGE', 'MESSAGE' );

/**
 * The constant that stands for the loglevel
 * When it is set, the information needed for the system development or processed information tracing is added
 * to the logs
 */
define( 'ONAPP_LOGGER_VALUE_PHP_MESSAGE', 'PHP' );

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
class OnApp_Helper_Handler_Log {
	/**
	 * Shows a region on Earth, more or less bounded by lines of
	 * longitude, that has a uniform, legally mandated standard time, usually
	 * referred to as the local time.
	 *
	 * @var string $timeZone
	 */
	private $timeZone = 'Europe/London';

	/**
	 * Outputs the date format inside of Logger
	 *
	 * @var string $dateFormat
	 */
	private $dateFormat = 'Y-m-d H:i:s';

	/**
	 * Stands for the adding of the information needed to adjust
	 * the system.
	 *
	 * @var boolean $debugMode
	 */
	private $debugMode = false;

	/**
	 * Using color output in console
	 *
	 * @var bool $colorMode
	 */
	private $colorMode = false;

	/**
	 * Buffer containing all the information on the messages used in the class
	 *
	 * @access private
	 * @var    array $log
	 */
	private $log = array();

	public function __construct() {
		OnApp_Helper_Handler_Errors::setLog( $this );
	}

	/**
	 * Sets debug status
	 *
	 * @param boolean $debug set new debug status
	 *
	 * @return void
	 */
	public function setDebugMode( $debug = false ) {
		$this->debugMode = $debug;
	}

	/**
	 * Set color mode
	 *
	 * @param boolean $colorMode
	 */
	public function setColorMode( $colorMode = false ) {
		$this->colorMode = $colorMode;
	}

	/**
	 * Adds the log message to the logger buffer
	 *
	 * @param string $msg log message
	 *
	 * @return void
	 */
	public function logMessage( $msg ) {
		$this->addToLog( $msg, ONAPP_LOGGER_VALUE_MESSAGE );
	}

	/**
	 * Adds the log message to the logger buffer
	 *
	 * @param string $msg log message
	 *
	 * @return void
	 */
	public function logPHPMessage( $msg ) {
		$this->addToLog( $msg, ONAPP_LOGGER_VALUE_PHP_MESSAGE );
	}

	/**
	 * Adds the error message to the logger buffer and stops
	 * executing
	 *
	 * @param string $msg  log message
	 * @param string $file file which initialized error
	 * @param string $line string in which was initialized error
	 *
	 * @return void
	 */
	public function logErrorMessage( $msg, $file = '', $line = '' ) {
		$this->addToLog( $msg, ONAPP_LOGGER_VALUE_ERROR );
		echo $this->getLog();
		trigger_error( "FILE => '$file', LINE => '$line'\n$msg", E_USER_ERROR );
	}

	/**
	 * Adds a warning message to the logger buffer
	 *
	 * @param string $msg log message
	 *
	 * @return void
	 */
	public function logWarningMessage( $msg ) {
		$this->addToLog( $msg, ONAPP_LOGGER_VALUE_WARNING );
	}

	/**
	 * Adds debug message to the logger buffer
	 *
	 * @param string $msg log message
	 *
	 * @return void
	 * @access public
	 */
	public function logDebugMessage( $msg ) {
		if( $this->debugMode ) {
			$this->addToLog( $msg, ONAPP_LOGGER_VALUE_DEBUG );
		}
	}

	/**
	 * Sets script timezone
	 *
	 * @param string $timezone new Timezone for data function
	 *
	 * @return void
	 */
	public function setTimezone( $timezone = null ) {
		if( is_null( $timezone ) ) {
			$timezone = $this->timeZone;
		}

		if( ! date_default_timezone_set( $timezone ) ) {
			$this->logWarningMessage( 'setTimezone: can\'t set timezone ' . $timezone );
		}
		else {
			$this->logMessage( 'setTimezone: set timezone to ' . $timezone );
		}
	}

	/**
	 * Shows Logger buffer messages (error, log, and debug)
	 *
	 * @param void
	 *
	 * @return string full Logger buffer
	 * @access public
	 */
	public function getLog() {
		$output = '';
		if( IS_CLI && $this->colorMode ) {
			$colors = new CLI_Colors;

			foreach( $this->log as $value ) {
				$str = $value[ 'time' ] . ' [' . $value[ 'type' ] . "]\t" . $value[ 'log' ] . PHP_EOL;

				switch( $value[ 'type' ] ) {
					case ONAPP_LOGGER_VALUE_WARNING:
						$str = $colors->text( $str )->fc( 'magenta' )->get();
						break;

					case ONAPP_LOGGER_VALUE_DEBUG:
						$str = $colors->text( $str )->fc( 'blue' )->get();
						break;

					case ONAPP_LOGGER_VALUE_ERROR:
						$str = $colors->text( $str )->fc( 'red' )->bold()->get();
						break;

					case ONAPP_LOGGER_VALUE_PHP_MESSAGE:
						$str = $colors->text( $str )->fc( 'cyan' )->bold()->get();
						break;
				}

				$output .= $str;
			}
		}
		else {
			foreach( $this->log as $value ) {
				$output .= $value[ 'time' ] . ' [' . $value[ 'type' ] . "]\t" . $value[ 'log' ] . PHP_EOL;
			}
		}

		return $output;
	}

	/**
	 * Adds the message and additional data to the buffer depending
	 * on the message type
	 *
	 * @param string $msg  log message
	 * @param string $type log type
	 *
	 * @return void
	 */
	private function addToLog( $msg, $type = ONAPP_LOGGER_VALUE_MESSAGE ) {
		if( strlen( $msg ) > 0 ) {
			$time  = microtime( true );
			$micro = sprintf( '%06d', ( $time - floor( $time ) ) * 1000000 );
			$time  = date( $this->dateFormat . '.' . $micro, $time );

			$this->log[] = array(
				'log' => $msg,
				'time' => $time,
				'type' => $type,
			);
		}
	}

	/**
	 * @depricated use setDebugMode instead
	 */
	public function setDebug( $debug ) {
		$this->setDebugMode( $debug );
	}

	/**
	 * @depricated use logMessage instead
	 */
	public function add( $msg ) {
		$this->logMessage( $msg );
	}

	/**
	 * @depricated use logErrorMessage instead
	 */
	public function error( $msg, $file = '', $line = '' ) {
		$this->logErrorMessage( $msg, $file, $line );
	}

	/**
	 * @depricated use logWarningMessage instead
	 */
	public function warning( $msg ) {
		$this->logWarningMessage( $msg );
	}

	/**
	 * @depricated use logDebugMessage instead
	 */
	public function debug( $msg ) {
		$this->logDebugMessage( $msg );
	}

	/**
	 * @depricated use getLog instead
	 */
	public function logs() {
		$this->getLog();
	}
}

/**
 * Use ANSI colors in console output
 *
 * @author Lev Bartashevsky
 */
class CLI_Colors {
	private $foregroundColors = array();
	private $backgroundColors = array();
	private $foregroundColor;
	private $backgroundColor;
	private $bold = false;
	private $text;

	/**
	 *  Set up shell colors
	 */
	public function __construct() {
		$this->foregroundColors[ 'black' ]   = ';30';
		$this->foregroundColors[ 'red' ]     = ';31';
		$this->foregroundColors[ 'green' ]   = ';32';
		$this->foregroundColors[ 'yellow' ]  = ';33';
		$this->foregroundColors[ 'blue' ]    = ';34';
		$this->foregroundColors[ 'magenta' ] = ';35';
		$this->foregroundColors[ 'cyan' ]    = ';36';
		$this->foregroundColors[ 'white' ]   = ';37';

		$this->backgroundColors[ 'black' ]   = '40';
		$this->backgroundColors[ 'red' ]     = '41';
		$this->backgroundColors[ 'green' ]   = '42';
		$this->backgroundColors[ 'yellow' ]  = '43';
		$this->backgroundColors[ 'blue' ]    = '44';
		$this->backgroundColors[ 'magenta' ] = '45';
		$this->backgroundColors[ 'cyan' ]    = '46';
		$this->backgroundColors[ 'white' ]   = '47';
	}

	public function text( $txt ) {
		$this->text = $txt;
		return $this;
	}

	public function fc( $color ) {
		$this->foregroundColor = $color;
		return $this;
	}

	public function bc( $color ) {
		$this->backgroundColor = $color;
		return $this;
	}

	public function bold() {
		$this->bold = true;
		return $this;
	}

	public function get() {
		$coloredString = "";

		// Check if given foreground color found
		if( isset( $this->foregroundColors[ $this->foregroundColor ] ) ) {
			$fc = ( $this->bold ? 1 : 0 ) . $this->foregroundColors[ $this->foregroundColor ];
			$coloredString .= "\033[" . $fc . "m";
		}
		// Check if given background color found
		if( isset( $this->backgroundColors[ $this->backgroundColor ] ) ) {
			$coloredString .= "\033[" . $this->backgroundColors[ $this->backgroundColor ] . "m";
		}

		// Add string and end coloring
		$coloredString .= $this->text . "\033[0m";

		$this->backgroundColor = $this->foregroundColor = null;
		$this->bold            = false;

		return $coloredString;
	}

	public function test() {
		// Get Foreground Colors
		$fgs = $this->getForegroundColors();
		// Get Background Colors
		$bgs = $this->getBackgroundColors();

		// Loop through all foreground and background colors
		$count = count( $fgs );
		for( $i = 0; $i < $count; $i ++ ) {
			echo $this->text( "Test Foreground colors {$fgs[ $i ]}" )->fc( $fgs[ $i ] )->get() . "\t";
			echo $this->text( "Test Foreground colors {$fgs[ $i ]}" )->fc( $fgs[ $i ] )->bold()->get() . "\t";
			if( isset( $bgs[ $i ] ) ) {
				echo $this->text( " Test Background colors {$bgs[ $i ]} " )->bc( $bgs[ $i ] )->get();
			}
			echo PHP_EOL;
		}
		echo PHP_EOL;

		foreach( $fgs as $fg ) {
			foreach( $bgs as $bg ) {
				echo $this->text( " Test Colors " )->fc( $fg )->bc( $bg )->get() . "\t";
			}
			echo PHP_EOL;
			foreach( $bgs as $bg ) {
				echo $this->text( " Test Colors " )->fc( $fg )->bc( $bg )->bold()->get() . "\t";
			}
			echo PHP_EOL;
		}
	}

	/**
	 * @return array returns all foreground color names
	 */
	private function getForegroundColors() {
		return array_keys( $this->foregroundColors );
	}

	/**
	 * @return array returns all background color names
	 */
	private function getBackgroundColors() {
		return array_keys( $this->backgroundColors );
	}
}