<?php
/**
 * API Wrapper for OnApp
 *
 * This API provides an interface to onapp.net allowing common virtual machine
 * and account management tasks
 *
 * @category    API wrapper
 * @package     OnApp
 * @author      Andrew Yatskovets
 * @author      Yakubskiy Yuriy
 * @author      Lev Bartashevsky
 * @copyright   (c) 2011-2012 OnApp
 * @link        http://www.onapp.com/
 */

/**
 * Current OnApp PHP API wrapper version
 */
define( 'ONAPP_VERSION', '3.0.dev' );

/**
 * The OnApp class uses this variable to define the Proxy server used by cURL
 */
define( 'ONAPP_OPTION_CURL_PROXY', 'proxy' );

/**
 * The OnApp class uses this variable to define the URL to the API used by cURL
 */
define( 'ONAPP_OPTION_CURL_URL', 'url' );

/**
 * The OnApp class uses this variable to define the data type which would help transfer data between the client and the API server
 *
 * Possible values:
 *   - xml  (default)
 *   - json (will be available after the parcer is created)
 */
define( 'ONAPP_OPTION_API_TYPE', 'data_type' );

/**
 * The OnApp class uses this variable to define the charsets used to transfer data between the client and the API server
 *
 * Possible values:
 *   - charset=utf-8 (default)
 */
define( 'ONAPP_OPTION_API_CHARSET', 'charset' );

/**
 * The OnApp class uses this value to define the content type used to transfer data between the client and the API server
 *
 * Possible values:
 *   - application/xml (default)
 *   - application/json (will be available after the Json parcer is created)
 */
define( 'ONAPP_OPTION_API_CONTENT', 'content' );

/**
 * The OnApp class uses this field name to map this field in the API response and variable in the class
 * The field name is used to unserialize the API server response to the necessary class.
 */
define( 'ONAPP_FIELD_MAP', 'map' );

/**
 * The field name that stands for the mapped field type in the API response
 *
 * The field is used to unserialize the object into API request.
 * Possible values:
 *   - integer
 *   - ...
 */
define( 'ONAPP_FIELD_TYPE', 'type' );

/**
 * The field name that stands for the field access in the API response
 *
 * Used to unserialize the object into API request.
 * Possible values:
 *   - true
 *   - false
 */
define( 'ONAPP_FIELD_READ_ONLY', 'read_only' );

/**
 * The flag to exclude this field from sending request
 *
 * Possible values:
 *   - true
 *   - false
 */
define( 'ONAPP_FIELD_SKIP_FROM_REQUEST', 'skip' );

/**
 * The field name that specifies if it is necessary to be used in the API request when new objects are created or existing edited
 *
 * Possible values:
 *   - true
 *   - false
 */
define( 'ONAPP_FIELD_REQUIRED', 'required' );

/**
 * The field name that stands for the default field value
 *
 * The field name is used to unserialize if the field was changed or not loaded.
 */
define( 'ONAPP_FIELD_DEFAULT_VALUE', 'default' );

/**
 * Specify field type to serialize and unserialize obgect using their name
 */
define( 'ONAPP_FIELD_CLASS', 'class' );

define( 'ONAPP_GETRESOURCE_DEFAULT', 'default' );

define( 'ONAPP_GETRESOURCE_LOAD', 'load' );

define( 'ONAPP_GETRESOURCE_LIST', 'list' );

define( 'ONAPP_GETRESOURCE_ADD', 'add' );

define( 'ONAPP_GETRESOURCE_EDIT', 'edit' );

define( 'ONAPP_GETRESOURCE_DELETE', 'delete' );

define( 'ONAPP_GETRESOURCE_VERSION', 'version' );

define( 'ONAPP_ACTIVATE_GETLIST', 'getList' );

define( 'ONAPP_ACTIVATE_LOAD', 'load' );

define( 'ONAPP_ACTIVATE_SAVE', 'save' );

define( 'ONAPP_ACTIVATE_DELETE', 'delete' );

/**
 * Specify the GET request
 *
 */
define( 'ONAPP_REQUEST_METHOD_GET', 'GET' );

/**
 * Specify the POST request
 *
 */
define( 'ONAPP_REQUEST_METHOD_POST', 'POST' );

/**
 * Specify the PUT request
 *
 */
define( 'ONAPP_REQUEST_METHOD_PUT', 'PUT' );

/**
 * Specify the DELETE request
 *
 */
define( 'ONAPP_REQUEST_METHOD_DELETE', 'DELETE' );

/**
 * API Wrapper for OnApp
 *
 * @package OnApp
 *
 * The wrapper is used to describe the following basic methods: {@link load},
 * {@link save}, {@link delete} and {@link getList}.
 *
 * To create a new class inheriting this one, re-define the
 * following variables:
 * <code>
 *
 *    // root tag used in the API request
 *    protected $rootElement  = '<root>';
 *
 *    // alias processing the object data
 *    protected $URLPath = '<alias>';
 *
 *    // the fields array used in the response and request to the API server
 *    var $fields   = array(
 *     ...
 *    )
 * </code>
 *
 * To create a read-only class, close the save and delete methods.
 * To re-define the traditional API aliases to the non-traditional,
 * re-define the  {@link getURL},  {@link getURLADD}, {@link getURLEDIT},
 * {@link getURLLOAD},  {@link getURLDELETE} and  {@link getURLLIST}
 * methods in the class that will be inheriting the OnApp class.
 *
 *
 * This API provides an interface to onapp.net allowing common virtual machine
 * and account management tasks
 *
 * <b> Usage OnApp_VirtualMachine class example ( Could be applied almost to any of the Wrapper classes ): </b> <br /><br />
 * <b> Important ( OnApp CP Permissions Set Up): </b>
 * <code>
 *     Go to OnApp CP.
 *     Users and Groups -> Roles
 *     Push pencil edit icon to edit role of the user which you are going to use.
 *     Check checkbox { View OnApp version (settings.version) }
 *     Check other permissions in order to perform particular actions.
 *</code>
 *
 * <b>Code example:</b> <br />
 *
 * Require Wrapper AutoLoad Class:
 *
 * <code>
 *    require_once '{Path to the Wrapper}/OnAppInit.php';
 * </code>
 *
 *
 * Get OnApp Instance:
 *
 * <code>
 *     $onapp = new OnApp_Factory('{IP Address / Hostname}', '{Username}', '{Password}');
 * </code>
 *
 *
 * Get OnApp_VirtualMachine Instance:
 *
 * <code>
 *     $vm_obj = $onapp->factory('VirtualMachine', {debug mode boolean, not required} );
 * </code>
 *
 *
 * Get the list of VMs:
 *
 * <code>
 *     $vms    = $vm_obj->getList();
 * </code>
 *
 *
 * Get particular VM:
 *
 * <code>
 *     $vm     = $vm_obj->load({VM ID});
 * </code>
 *
 *
 * Create a VM:
 *
 * <code>
 *     $vm_obj->_label               = '{VM Label}';
 *     $vm_obj->_memory              = {VM RAM };
 *     $vm_obj->_cpu_shares          = {VM CPU priority};
 *     $vm_obj->_hostname            = '{Hostname}';
 *     $vm_obj->_cpus                = {number of VM CPUs};
 *     $vm_obj->_primary_disk_size   = {VM Disk Space};
 *     $vm_obj->_swap_disk_size      = {VM Swap Size};
 *     $vm_obj->_template_id         = {VM Template ID};
 *     $vm_obj->_allowed_hot_migrate = {VM Hot Migrate Boolean Value};
 *
 *     $vm_obj->save();
 * </code>
 *
 *
 * Edit VM:
 *
 * <code>
 *     $vm_obj->_id = {VM ID};
 *     $vm_obj->_{Field You Want To Edit} = {New Value};
 *
 *     $vm_obj->save();
 * </code>
 *
 *
 * Getting debug log ( depends on debug mode ):
 *
 * <code>
 *     print_r( $vm_obj );
 * </code>
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */
abstract class OnApp {
	/**
	 * Object cURL
	 *
	 * @var OnApp_Helper_Handler_CURL
	 */
	protected static $ch;

	/**
	 * @var string current class' name
	 */
	protected $className;

	/**
	 * Default options used in the class to create API requests and receive responses,
	 * as well as serialize and unserialize objects.
	 *
	 * @var array
	 */
	private $defaultOptions = array(
		// cURL proxy
		ONAPP_OPTION_CURL_PROXY  => '',
		// cURL url
		ONAPP_OPTION_CURL_URL    => '',
		// API request and response charset
		ONAPP_OPTION_API_CHARSET => 'charset=utf-8',
		// API request and response type
		ONAPP_OPTION_API_TYPE    => 'json',
		// API request and response content
		ONAPP_OPTION_API_CONTENT => 'application/json',
	);

	/**
	 * Holder for storing properties that were setted via magic setter
	 *
	 * @var array
	 */
	protected $dynamicFields = array();

	/**
	 * Variable for error handling
	 *
	 * @var    string
	 */
	protected $errors;

	/**
	 * Variable storing the data loaded by the API request. The data is static and cannot be changed by the class setters
	 *
	 * @var object
	 */
	public $inheritedObject;

	/**
	 * @var boolean
	 */
	protected $isAuthenticated = false;

	/**
	 * @var boolean
	 */
	protected $isChanged = false;

	/**
	 * @var boolean
	 */
	protected $isDeleted = false;

	/**
	 * The list of all available options used in the class to create API requests and receive responses,
	 * as well as to serialize and unserialize.
	 *
	 * @var array
	 */
	private $knownOptions = array(
		ONAPP_OPTION_CURL_PROXY,
		ONAPP_OPTION_CURL_URL,
		ONAPP_OPTION_API_TYPE,
		ONAPP_OPTION_API_CHARSET,
		ONAPP_OPTION_API_CONTENT,
	);

	/**
	 * The Object Logger used to log the processes in the basic and inherited classes
	 * It is possible to use the debug add error log methods
	 *
	 * @var OnApp_Helper_Handler_Log
	 */
	public $logger;

	/**
	 * The array of the options used to create API requests and receive responses,
	 * as well as serialize and unserialize objects in the class
	 *
	 * By default equals to $_defaultOptions
	 *
	 * <code>
	 *    var $options = array(
	 *
	 *        // cURL proxy
	 *        ONAPP_OPTION_CURL_PROXY     => '',
	 *
	 *        // cURL url
	 *        ONAPP_OPTION_CURL_URL       => '',
	 *
	 *        // API request and response type
	 *        ONAPP_OPTION_API_TYPE       => 'xml',
	 *
	 *        // API request and response charset
	 *        ONAPP_OPTION_API_CHARSET   => 'charset=utf-8',
	 *
	 *        // API request and response content
	 *        ONAPP_OPTION_API_CONTENT   => 'application/xml',
	 *    );
	 * </code>
	 *
	 * @var array
	 */
	public $options = array();

	/**
	 * @var string
	 */
	protected $rootElement;

	/**
	 * @var array fields which should be excluded from API request
	 */
	protected $skipFromRequest = array();

	/**
	 * @var integer
	 */
	protected $URLID;

	/**
	 * cURL Object alias used as the basic alias to the load, save, delete and getList methods
	 *
	 * @var string
	 */
	protected $URLPath;

	/**
	 * @var integer|float OnApp version
	 */
	protected $version;

	public function getOnAppVersion() {
		if( is_null( $this->version ) ) {
			$this->setAPIResource( ONAPP_GETRESOURCE_VERSION );
			$this->sendRequest( ONAPP_REQUEST_METHOD_GET );
			if( self::$ch->getResponseStatusCode() == 200 ) {
				$this->setOnAppVersion( self::$ch->getResponseBody() );
			}
		}
		return $this->version;
	}

	/**
	 * Resets all options to default options
	 *
	 * @return void
	 */
	public function resetOptions() {
		$this->options = $this->defaultOptions;
	}

	/**
	 * Sets an option
	 *
	 * Use this method if you do not want
	 * to set all options in the constructor
	 *
	 * @param string $name  option name
	 * @param mixed  $value option value
	 *
	 * @return void
	 */
	public function setOption( $name, $value ) {
		$this->logger->logDebug( 'setOption: Set option ' . $name . ' => ' . $value );
		$this->options[ $name ] = $value;
	}

	/**
	 * Sets several options at once
	 *
	 * Use this method if you do not want
	 * to set all options in the constructor
	 *
	 * @param array $options options array
	 *
	 * @return void
	 */
	public function setOptions( array $options ) {
		$this->options = array_merge( $this->options, $options );
	}

	/**
	 * Returns the URL Alias of the API Class that inherits the OnApp class
	 *
	 * Can be redefined if the API does not use the default alias (the alias
	 * consisting of few fields).
	 * The following example illustrates:
	 *
	 * <code>
	 *    function getURL() {
	 *        return "alias/" . $this->_field_name . "/" . $this->URLPath;
	 *    }
	 * </code>
	 *
	 * @param string $action
	 *
	 * @return string API resource
	 */
	protected function getURL( $action = ONAPP_GETRESOURCE_DEFAULT ) {
		switch( $action ) {
			case ONAPP_GETRESOURCE_LOAD:
			case ONAPP_GETRESOURCE_EDIT:
			case ONAPP_GETRESOURCE_DELETE:
				$URL = $this->getURL() . '/' . $this->id;
				break;

			case ONAPP_GETRESOURCE_LIST:
			case ONAPP_GETRESOURCE_ADD:
				$URL = $this->getURL();
				break;

			case ONAPP_GETRESOURCE_DEFAULT:
			default:
				$URL = $this->URLPath;
		}
		$this->logger->logDebug( 'getURL( ' . $action . ' ): return ' . $URL );

		return $URL;
	}

	/**
	 * Returns true if the API instance has authentication information set and authentication was succesful
	 *
	 * @return boolean true if authenticated
	 */
	public function isAuthenticated() {
		return $this->isAuthenticated;
	}

	/**
	 * Returns true if the Object was changed and API response was successful
	 *
	 * @return boolean true if the Object was changed
	 */
	public function isChanged() {
		return $this->isChanged;
	}

	/**
	 * Returns true if the Object was deleted in the API instance
	 * and API response was successful
	 *
	 * @return boolean true if the Object was deleted
	 */
	public function isDeleted() {
		return $this->isDeleted;
	}

	/**
	 * Returns Text written to the full class logs
	 *
	 * When the log level is set to debug, the debug messages will be also
	 * included
	 *
	 * @return string All formatted logs
	 */
	public function getLog() {
		if( isset( $this->logger ) ) {
			return $this->logger->getLog();
		}
	}

	/**
	 * Authorizes users in the system by the specified URL by means of cURL
	 *
	 * To authorize, set the user name and password. Specify the Proxy, if
	 * needed. When authorized, {@link load}, {@link save}, {@link delete} and
	 * {@link getList} methods can be used.
	 *
	 * @param string $url   API URL
	 * @param string $user  user name
	 * @param string $pass  password
	 * @param string $proxy (optional) proxy server
	 *
	 * @return void
	 */
	public function auth( $url, $user, $pass, $proxy = '' ) {
		$this->logger->setTimezone();

		$this->logger->logDebug( 'auth: Authorization( url => ' . $url . ', user => ' . $user . ', pass => ******** ).' );

		$this->setOption( ONAPP_OPTION_CURL_URL, $url );
		$this->setOption( ONAPP_OPTION_CURL_PROXY, $proxy );

		$this->initCURL( $user, $pass );
	}

	protected function setOnAppVersion( $data ) {
		preg_match( '#(\d\.\d.\d)#', $data, $m );
		if( isset( $m[ 1 ] ) ) {
			$this->version = (float)$m[ 1 ];
		}
		else {
			$msg = 'Can not get version from \'' . $data . '\'';
			throw new Exception( $msg );
		}
	}

	protected function initCURL( $user, $pass, $cookiesFile = null ) {
		$this->logger->logDebug( __METHOD__ . ': Init Curl ( cookies file => "' . $cookiesFile . '" ).' );

		self::$ch = new OnApp_Helper_Handler_CURL( $this );

		if( ! empty( $this->options[ ONAPP_OPTION_CURL_PROXY ] ) ) {
			self::$ch->setOption( CURLOPT_PROXY, $this->options[ ONAPP_OPTION_CURL_PROXY ] );
		}

		if( ! is_null( $cookiesFile ) ) {
			self::$ch->useCookies();
		}

		self::$ch->setOption( CURLOPT_USERPWD, $user . ':' . $pass );
		self::$ch->setOption( CURLOPT_HEADER, true );
	}

	/**
	 * Sets full API path to the variable cURL
	 *
	 * @param string  $resource    API alias
	 * @param boolean $append_api_version
	 * @param string  $queryString API request
	 *
	 * @return void
	 */
	protected function setAPIResource( $resource, $queryString = '' ) {
		if( ! empty( $queryString ) ) {
			$queryString = '?' . $queryString;
		}
		$url = sprintf(
			'%1$s/%2$s.%3$s%4$s', $this->options[ ONAPP_OPTION_CURL_URL ], $resource, $this->options[ ONAPP_OPTION_API_TYPE ], $queryString );

		self::$ch->setOption( CURLOPT_URL, $url );
		$this->logger->logMessage(
			'setAPIResource: Set an option for a cURL transfer (' .
				' url => "' . $url . '", ' .
				' resource => "' . $resource . '", ' .
				' data_type => "' . $this->options[ ONAPP_OPTION_API_TYPE ] . '"' .
				' queryString => "' . $queryString . '" ).'
		);
	}

	/**
	 * Sends API request to the API server and gets response from it
	 *
	 * @param string     $method
	 * @param array|null $data
	 *
	 * @return array|bool cURL response
	 */
	protected function sendRequest( $method, $data = null ) {
		$alowed_methods = array(
			ONAPP_REQUEST_METHOD_GET,
			ONAPP_REQUEST_METHOD_POST,
			ONAPP_REQUEST_METHOD_PUT,
			ONAPP_REQUEST_METHOD_DELETE,
		);
		if( ! in_array( $method, $alowed_methods ) ) {
			$this->logger->logError( 'Wrong request method: ' . $method );
		}

		$debug_msg = 'Send ' . $method . ' request.';
		if( $data ) {
			$debug_msg .= ' Request:' . PHP_EOL . print_r( $data, true );
		}
		$this->logger->logDebug( $debug_msg );

		self::$ch->setHeader( 'Content-Length', strlen( $data ) );
		self::$ch->setHeader( 'Accept', $this->options[ ONAPP_OPTION_API_CONTENT ] );
		self::$ch->setHeader( 'Content-Type', $this->options[ ONAPP_OPTION_API_CONTENT ] );

		if( ! is_null( $data ) ) {
			self::$ch->setOption( CURLOPT_POSTFIELDS, $data );
		}

		$method = strtolower( $method );
		$body   = self::$ch->$method()->getResponseBody();
		if( self::$ch->getRequestError() ) {
			$this->logger->logError( 'Error during sending request' );
		}
		elseif( empty( $body ) && ( self::$ch->getResponseStatusCode() != 204 ) ) {
			$this->logger->logError( 'Response body couldn\'t be empty for status code: ' . self::$ch->getResponseStatusCode() );
		}

		$this->logger->logDebug( 'Receive Response ' . print_r( self::$ch->getResponseBody(), true ) );

		if( self::$ch->getRequestInfo( 'content_type' ) == $this->options[ ONAPP_OPTION_API_CONTENT ] . "; " . $this->options[ ONAPP_OPTION_API_CHARSET ] ) {
			switch( self::$ch->getResponseStatusCode() ) {
				case 200:
				case 201:
				case 204:
				case 422:
				case 404:
					$this->isAuthenticated = true;
					break;

				case 401:
					$this->isAuthenticated = false;
					break;
			}
		}

		$this->logger->logMessage( __METHOD__ . ': get response (code => ' . self::$ch->getResponseStatusCode() . ', body:' . PHP_EOL . "\t" . self::$ch->getResponseBody() );

		return $this->castResponseToClass();
	}

	/**
	 * Casts an API response to the Array of Objects or an Object
	 *
	 * @return mixed (Array of Object or Object)
	 */
	protected function castResponseToClass() {
		if( self::$ch->getRequestError() ) {
			$this->logger->logError(
				'castResponseToClass: Can\'t parse ' . self::$ch->getResponseBody(),
				__FILE__,
				__LINE__
			);
		}
		else {
			$this->logger->logMessage( __METHOD__ );
			switch( self::$ch->getResponseStatusCode() ) {
				case 200:
				case 201:
				case 404:
				case 422:
				case 401:
					return $this->doCastResponseToClass();
					break;

				case 204:
					break;

				case 500:
					$this->isAuthenticated = false;
					$this->setErrors( 'We\'re sorry, but something went wrong.' );
					return $this;

				default:
					$this->setErrors( 'Bad response ( code => ' . self::$ch->getResponseStatusCode() . ', response => ' . self::$ch->getResponseBody() . ' )' );
			}
		}
	}

	/**
	 * Casts string (API response body content) to the Object
	 *
	 * @return array|object
	 * @throws Exception
	 */
	protected function doCastResponseToClass() {
		$className = $this->getClassName();
		$this->logger->logMessage( __METHOD__ . ': cast data into the ' . $className . ' object.' );
		switch( $this->options[ ONAPP_OPTION_API_TYPE ] ) {
			case 'xml':
			case 'json':
				$root = $this->rootElement;
				$data = self::$ch->getResponseBody();

				$objCast = new OnApp_Helper_Caster( $this );

				if( self::$ch->getResponseStatusCode() > 201 ) {
					$root   = 'errors';
					$errors = $objCast->unserialize( $className, $data, $root );
					$this->setErrors( $errors );

					return $this;
				}
				else {
					return $objCast->unserialize( $className, $data, $root );
				}

			default:
				$msg = 'Caster for "' . $this->options[ ONAPP_OPTION_API_TYPE ] . '" is not defined';
				throw new Exception( $msg );
		}
	}

	/**
	 * Activates action performed with object
	 *
	 * @param string $action_name the name of action
	 */
	public function activate( $action_name ) {
	}

	/**
	 * Sends an API request to get the Objects. After requesting,
	 * unserializes the received response into the array of Objects
	 *
	 * @param mixed $params
	 * @param mixed $url_args
	 *
	 * @return array|bool|null
	 */
	public function getList( $params = null, $url_args = null ) {
		$this->activate( ONAPP_ACTIVATE_GETLIST );

		$this->logger->logMessage( 'Run ' . __METHOD__ );

		$result = $this->sendGet( ONAPP_GETRESOURCE_LIST, $params, $url_args );

		if( ! is_null( $this->getErrorsAsArray() ) ) {
			return false;
		}
		else {
			if( ! is_array( $result ) && ! is_null( $result ) ) {
				$result = array( $result );
			}
			return $result;
		}
	}

	/**
	 * Sends an API request to get the Object after sending,
	 * unserializes the response into an object
	 *
	 * The key field Parameter ID is used to load the Object. You can re-set
	 * this parameter in the class inheriting OnApp class.
	 *
	 * @param integer $id Object id
	 *
	 * @return mixed serialized Object instance from API
	 */
	public function load( $id = null ) {
		$this->activate( ONAPP_ACTIVATE_LOAD );

		if( is_null( $id ) && ! is_null( $this->_id ) ) {
			$id = $this->_id;
		}

		if( is_null( $id ) &&
			isset( $this->inheritedObject ) &&
			! is_null( $this->inheritedObject->_id )
		) {
			$id = $this->inheritedObject->_id;
		}

		if( is_null( $id ) ) {
			$this->logger->logError( 'load: Can\'t load ID = ' . $id, __FILE__, __LINE__ );
		}

		$this->logger->logMessage( 'load: Load class ( id => ' . $id . ' ).' );

		if( strlen( $id ) > 0 ) {
			$this->id = $id;

			$this->setAPIResource( $this->getURL( ONAPP_GETRESOURCE_LOAD ) );

			$this->inheritedObject = $this->sendRequest( ONAPP_REQUEST_METHOD_GET );
			$this->id              = $this->inheritedObject->id;
		}
		else {
			$this->logger->logError( 'load: property id not set.', __FILE__, __LINE__ );
		}
	}

	/**
	 * The method saves an Object to your account
	 *
	 * After sending an API request to create an object or change the data in
	 * the existing object, the method checks the response and loads the
	 * exisitng object with the new data.
	 *
	 * This method can be closed for read only objects of the inherited class
	 * <code>
	 *    function save() {
	 *        $this->logger->error(
	 *            "Call to undefined method ".__CLASS__."::save()",
	 *            __FILE__,
	 *            __LINE__
	 *        );
	 *    }
	 * </code>
	 *
	 * @return void
	 */
	public function save() {
		$this->activate( ONAPP_ACTIVATE_SAVE );

		if( is_null( $this->id ) ) {
			$obj = $this->createObject();
		}
		else {
			$obj = $this->editObject();
		}

		if( isset( $obj ) && ! isset( $obj->errors ) ) {
			$this->load();
		}
	}

	/**
	 * The method creates a new Object
	 *
	 * @return mixed object Serialized API Response
	 * @throws Exception
	 */
	protected function createObject() {
		$this->logger->logMessage( 'Create new Object.' );

		switch( $this->options[ ONAPP_OPTION_API_TYPE ] ) {
			case 'xml':
			case 'json':
				$objCast = new OnApp_Helper_Caster( $this );
				$data    = $objCast->serialize( $this->rootElement, $this->getFieldsToSend() );
				$this->logger->logDebug( 'serialize: serialized data:' . PHP_EOL . $data );
				$this->setAPIResource( $this->getURL( ONAPP_GETRESOURCE_ADD ) );
				$response = $this->sendRequest( ONAPP_REQUEST_METHOD_POST, $data );

				$result                = $this->castResponseToClass( $response );
				$this->inheritedObject = $result;
				break;

			default:
				$msg = 'Caster for "' . $this->options[ ONAPP_OPTION_API_TYPE ] . '" is not defined';
				throw new Exception( $msg );
		}
		return $result;
	}

	/**
	 * The method edits an existing Object
	 *
	 * @return object Serialized API Response
	 * @throws Exception
	 */
	protected function editObject() {
		switch( $this->options[ ONAPP_OPTION_API_TYPE ] ) {
			case 'xml':
			case 'json':
				$objCast = new OnApp_Helper_Caster( $this );
				$data    = $objCast->serialize( $this->rootElement, $this->getFieldsToSend() );
				$this->logger->logDebug( 'serialize: serialized data:' . PHP_EOL . $data );
				$this->setAPIResource( $this->getURL( ONAPP_GETRESOURCE_EDIT ) );
				$this->sendRequest( ONAPP_REQUEST_METHOD_PUT, $data );
				break;

			default:
				$msg = 'Caster for "' . $this->options[ ONAPP_OPTION_API_TYPE ] . '" is not defined';
				throw new Exception( $msg );
		}
	}

	/**
	 * Creates data fro API response to save or change the object data
	 *
	 * Returns the Hash of Object fields with values
	 *
	 * @return hash of string
	 */
	protected function getFieldsToSend() {
		$this->logger->logDebug( 'getFieldsToSend: Prepare data array:' );
		if( empty( $this->inheritedObject->dynamicFields ) ) {
			$result = $this->dynamicFields;
		}
		else {
			$result = array_merge( $this->inheritedObject->dynamicFields, $this->dynamicFields );
		}

		if( ! empty( $this->skipFromRequest ) ) {
			for( $i = 0, $size = count( $this->skipFromRequest ); $i < $size; ++$i ) {
				$this->skipFromRequest[ $this->skipFromRequest[ $i ] ] = '';
				unset( $this->skipFromRequest[ $i ] );
			}
			$result = array_diff_key( $result, $this->skipFromRequest );
		}

		return $result;
	}

	/**
	 * Sends an API request to delete an Object from your account
	 *
	 * This method can be closed for read only objects of the inherited class
	 * <code>
	 *    function delete() {
	 *        $this->logger->error(
	 *            "Call to undefined method ".__CLASS__."::delete()",
	 *            __FILE__,
	 *            __LINE__
	 *        );
	 *    }
	 * </code>
	 *
	 * @return boolean the Object deleted
	 */
	public function delete() {
		$this->activate( ONAPP_ACTIVATE_DELETE );

		$this->logger->logMessage( 'Delete existing Object ( id => ' . $this->_id . ' ).' );

		$this->sendDelete( ONAPP_GETRESOURCE_DELETE );

		if( is_null( $this->errors ) ) {
			$this->isDeleted = true;
		}
	}

	protected function sendPost( $resource, $data = null ) {
		return $this->sendAPIRequest( ONAPP_REQUEST_METHOD_POST, $resource, $data );
	}

	protected function sendGet( $resource, $data = null, $url_args = null ) {
		return $this->sendAPIRequest( ONAPP_REQUEST_METHOD_GET, $resource, $data, $url_args );
	}

	protected function sendPut( $resource, $data = null ) {
		return $this->sendAPIRequest( ONAPP_REQUEST_METHOD_PUT, $resource, $data );
	}

	protected function sendDelete( $resource, $data = null ) {
		return $this->sendAPIRequest( ONAPP_REQUEST_METHOD_DELETE, $resource, $data );
	}

	/**
	 * Sends API Requests to realize not base actions
	 *
	 * @param string      $method
	 * @param string      $resource
	 * @param null|string $data
	 * @param null|string $url_args
	 *
	 * @return mixed
	 */
	protected function sendAPIRequest( $method, $resource, $data = null, $url_args = null ) {
		switch( $this->options[ ONAPP_OPTION_API_TYPE ] ) {
			case 'xml':
			case 'json':
				if( ! is_null( $data ) ) {
					$objCast = new OnApp_Helper_Caster( $this );
					$data    = $objCast->serialize( $data[ 'root' ], $data[ 'data' ] );
					$this->logger->logDebug( 'Additional parameters: ' . $data );
				}

				$url_args = ( $url_args ) ? preg_replace( '/%5B(0-9){1,4}%5D/', '%5B%5D', http_build_query( $url_args ) ) : '';

				$this->setAPIResource( $this->getURL( $resource ), $url_args );
				$result = $this->sendRequest( $method, $data );

				if( self::$ch->getResponseStatusCode() > 400 ) {
					if( is_null( $result ) ) {
						$this->inheritedObject = clone $this;
					}
					else {
						$this->inheritedObject->errors = $result->getErrorsAsArray();
					}
					return false;
				}
				else {
					$this->inheritedObject = $result;
				}
				break;

			default:
				$this->logger->logError( __METHOD__ . ': Can\'t find serialize and unserialize functions for type.', __FILE__, __LINE__ );
		}

		return $result;
	}

	public function getClassName() {
		return $this->className;
	}

	/**
	 * Store errors
	 *
	 * @param mixed $errors
	 *
	 * @return void
	 */
	public function setErrors( $errors = null ) {
		if( is_null( $errors ) ) {
			$this->errors = null;
		}
		else {
			$this->errors = (array)$errors;
		}
	}

	/**
	 * Return errors as string
	 *
	 * @param string $glue
	 *
	 * @return string
	 */
	public function getErrorsAsString( $glue = PHP_EOL ) {
		if( is_null( $this->getErrorsAsArray() ) ) {
			return '';
		}

		$errors = '';
		foreach( $this->getErrorsAsArray() as $Key => $Value ) {
			if( is_array( $Value ) ) {
				foreach( $Value as $key => $value ) {
					if( ! is_array( $value ) ) {
						$value = (array)$value;
					}
					$errors .= $glue . $Key . ': ' . implode( $glue . $Key . ': ', $value );
				}
			}
			else {
				$errors .= $Value . $glue;
			}
		}

		if( strpos( $errors, $glue ) == 0 ) {
			$errors = substr( $errors, strlen( $glue ) );
		}

		return $errors;
	}

	/**
	 * Return errors as array
	 *
	 * @return array
	 */
	public function getErrorsAsArray() {
		return $this->errors;
	}

	// getters, setters & other magic stuff //
	public function __construct() {
		$this->className = get_class( $this );
		$this->options   = $this->defaultOptions;
		$this->logger    = OnApp_Helper_Handler_Log::init();
	}

	/**
	 * Standard method to handle getting non-existent class' property
	 *
	 * @param string $name property name
	 *
	 * @return mixed
	 */
	public function __get( $name ) {
		// legacy getting errors
		// remove after rewriting the code to use getErrors() method
		// instead of direct access
		switch( $name ) {
			case 'error':
				return $this->getErrorsAsArray();

			case '_obj':
				return $this->inheritedObject;
		}

		if( ! isset( $this->dynamicFields[ $name ] ) ) {
			if( strpos( $name, '_' ) === 0 ) {
				$name = substr( $name, 1 );
				if( ! isset( $this->dynamicFields[ $name ] ) ) {
					return null;
				}
			}
			else {
				return null;
			}
		}

		if( is_object( $this->dynamicFields[ $name ] ) ) {
			if( $this->dynamicFields[ $name ] instanceof OnAppNestedDataHolder ) {
				$caster = new OnApp_Helper_Caster( $this );
				$this->dynamicFields[ $name ] = $caster->unserializeNested( $this->dynamicFields[ $name ] );
			}
		}
		return $this->dynamicFields[ $name ];
	}

	/**
	 * Standard method to handle writing into non-existent class' property
	 *
	 * @param string $name  property name
	 * @param string $value property value
	 *
	 * @return void
	 */
	public function __set( $name, $value ) {
		if( strpos( $name, '_' ) === 0 ) {
			$name = substr( $name, 1 );
		}

		$this->dynamicFields[ $name ] = $value;
	}

	/**
	 * Standard method to check if property was set via setter
	 *
	 * @param string $name  property name
	 *
	 * @return bool         result of checking property
	 */
	public function __isset( $name ) {
		// legacy getting errors
		// remove after rewriting the code to use getErrors() method
		// instead of direct access
		switch( $name ) {
			case 'error':
				return isset( $this->errors );
				break;

			case '_version':
				return isset( $this->version );
				break;
		}

		return isset( $this->dynamicFields[ $name ] );
	}

	/**
	 * Standard method to unset property which was set via setter
	 *
	 * @param string $name property name
	 *
	 * @return void
	 */
	public function __unset( $name ) {
		if( ! isset( $this->dynamicFields[ $name ] ) ) {
			if( strpos( $name, '_' ) === 0 ) {
				$name = substr( $name, 1 );
				if( ! isset( $this->dynamicFields[ $name ] ) ) {
					return null;
				}
			}
			else {
				return null;
			}
		}

		unset( $this->dynamicFields[ $name ] );
	}

	/**
	 * @return \OnApp_Helper_Handler_CURL
	 */
	public function getCURLHandler() {
		return self::$ch;
	}
}