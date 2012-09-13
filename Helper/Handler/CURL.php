<?php

class OnApp_Helper_Handler_CURL {
	private $ch;
	private $super;
	private $infoStorage;
	private $requestError = false;
	private $customOptions = array();
	private $customHeaders = array();

	private $defaultOptions = array(
		CURLOPT_SSL_VERIFYPEER => false,
		CURLOPT_SSL_VERIFYHOST => false,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_USERAGENT      => 'OnApp_CURL',
		CURLOPT_HEADER         => false,
		CURLOPT_NOBODY         => false,
	);

	public function __construct( $super ) {
		$this->super = $super;
		$this->ch = curl_init();
	}

	/**
	 * Set up cookies support
	 *
	 * @param null|string $cookiesFile file to store cookies
	 */
	public function useCookies( $cookiesFile = null ) {
		if( is_null( $cookiesFile ) ) {
			$cookiesFile = tempnam( '/tmp', 'OnApp_CURL_cookies' );
		}
		$this->defaultOptions[ CURLOPT_COOKIEFILE ] = $cookiesFile;
		$this->defaultOptions[ CURLOPT_COOKIEJAR ]  = $cookiesFile;
	}

	/**
	 * Set CURL options (CURLOPT_*)
	 *
	 * @param string $name  option name
	 * @param mixed  $value option value
	 */
	public function setOption( $name, $value ) {
		$this->customOptions[ $name ] = $value;
	}

	/**
	 * Set headers to be sent
	 *
	 * @param string     $name  header name
	 * @param int|string $value header value
	 */
	public function setHeader( $name, $value ) {
		$this->customHeaders[ ] = $name . ': ' . $value;
	}

	/**
	 * @deprecated use setOption instead.
	 */
	public function addOption( $name, $value ) {
		$this->setOption( $name, $value );
	}

	public function setLog() {
		$log = fopen( dirname( __FILE__ ) . '/CURL.log', 'a' );
		if( $log ) {
			fwrite( $log, str_repeat( '=', 80 ) . PHP_EOL );
			$this->setOption( CURLOPT_STDERR, $log );
			$this->setOption( CURLOPT_VERBOSE, true );
		}
	}

	public function delete( $url = null ) {
		return $this->send( 'DELETE', $url );
	}

	public function get( $url = null ) {
		return $this->send( 'GET', $url );
	}

	public function head( $url = null ) {
		return $this->send( 'HEAD', $url );
	}

	public function post( $url = null ) {
		return $this->send( 'POST', $url );
	}

	public function put( $url = null ) {
		return $this->send( 'PUT', $url );
	}

	/**
	 * Check if error occur during curl request
	 *
	 * @return bool
	 */
	public function getRequestError() {
		return $this->requestError;
	}

	public function getRequestHeaders() {
		return $this->infoStorage[ 'request_headers' ];
	}

	public function getRequestInfo( $param = false ) {
		if( $param ) {
			if( isset( $this->infoStorage[ 'request_info' ][ $param ] ) ) {
				return $this->infoStorage[ 'request_info' ][ $param ];
			}
			else {
				return null;
			}
		}
		return $this->infoStorage[ 'request_info' ];
	}

	public function getResponseBody() {
		return $this->infoStorage[ 'response_body' ];
	}

	public function getResponseHeader( $param ) {
		if( isset( $this->infoStorage[ 'response_headers_parsed' ][ $param ] ) ) {
			return $this->infoStorage[ 'response_headers_parsed' ][ $param ];
		}
		else {
			return null;
		}
	}

	public function getResponseHeaders() {
		return $this->infoStorage[ 'response_headers' ];
	}

	/**
	 * Return HTTP response code
	 *
	 * @return int HTTP response code
	 */
	public function getResponseStatusCode() {
		return $this->infoStorage[ 'request_info' ][ 'http_code' ];
	}

	private function send( $method, $url ) {
		if( $url === null ) {
			if( ! isset( $this->customOptions[ CURLOPT_URL ] ) || empty( $this->customOptions[ CURLOPT_URL ] ) ) {
				// add log
				exit( 'empty url' );
			}
		}
		else {
			$this->setOption( CURLOPT_URL, $url );
		}
		$this->setOption( CURLOPT_CUSTOMREQUEST, $method );
		return $this->exec();
	}

	private function combineOptions() {
		if( isset( $this->customOptions[ CURLOPT_HEADER ] ) && $this->customOptions[ CURLOPT_HEADER ] ) {
			$this->setOption( CURLINFO_HEADER_OUT, true );
		}

		if( ! is_null( $this->customHeaders ) ) {
			$this->setOption( CURLOPT_HTTPHEADER, $this->customHeaders );
		}

		$options = $this->customOptions + $this->defaultOptions;
		curl_setopt_array( $this->ch, $options );
	}

	private function flushHeaders() {
		$this->customHeaders = null;
	}

	private function exec() {
		$this->combineOptions();
		$response = curl_exec( $this->ch );
		$this->flushHeaders();
		$this->infoStorage[ 'request_info' ] = curl_getinfo( $this->ch );

		if( ( $errorCode = curl_errno( $this->ch ) ) > 0 ) {
			$this->processError( $errorCode );
		}

		$this->processResponse( $response );
		return $this;
	}

	/**
	 * Process response
	 *
	 * @param boolean|text $data CURL response
	 */
	private function processResponse( $data ) {
		if( $data === false ) {
			$this->requestError = true;
			$this->infoStorage[ 'response_body' ] = $data;
		}
		elseif( isset( $this->customOptions[ CURLOPT_HEADER ] ) && $this->customOptions[ CURLOPT_HEADER ] ) {
			$this->infoStorage[ 'request_headers' ] = trim( $this->infoStorage[ 'request_info' ][ 'request_header' ] );
			unset( $this->infoStorage[ 'request_info' ][ 'request_header' ] );

			$tmp                                     = explode( "\r\n\r\n", $data, 2 );
			$this->infoStorage[ 'response_body' ]    = $data = trim( $tmp[ 1 ] );
			$this->infoStorage[ 'response_headers' ] = $tmp[ 0 ];

			$tmp = explode( "\r\n", $this->infoStorage[ 'response_headers' ] );
			$this->infoStorage[ 'response_headers_parsed' ][ '' ] = $tmp[ 0 ];
			for( $i = 1, $size = count( $tmp ); $i < $size; ++$i ) {
				$string                                                         = explode( ': ', $tmp[ $i ], 2 );
				$this->infoStorage[ 'response_headers_parsed' ][ $string[ 0 ] ] = $string[ 1 ];
			}
		}
	}

	private function processError( $errorCode ) {
		switch( $errorCode ) {
			case ( $errorCode < 64 ):
				$msg = 'CURL ERROR CODE: ' . $this->getErrorDescription( $errorCode );
				$msg .= ', look http://curl.haxx.se/libcurl/c/libcurl-errors.html for description.';
				break;

			default:
				$msg = 'UNKNOWN_CURL_ERROR CODE: ' . $errorCode;
		}
		$this->super->logger->error( $msg . PHP_EOL, __FILE__, __LINE__ );
	}

	/**
	 * Get error description by code
	 *
	 * @param integer $errorCode error code
	 *
	 * @return string error description
	 */
	private function getErrorDescription( $errorCode ) {
		$errorCodes = array(
			1  => 'CURLE_UNSUPPORTED_PROTOCOL',
			2  => 'CURLE_FAILED_INIT',
			3  => 'CURLE_URL_MALFORMAT',
			4  => 'CURLE_URL_MALFORMAT_USER',
			5  => 'CURLE_COULDNT_RESOLVE_PROXY',
			6  => 'CURLE_COULDNT_RESOLVE_HOST',
			7  => 'CURLE_COULDNT_CONNECT',
			8  => 'CURLE_FTP_WEIRD_SERVER_REPLY',
			9  => 'CURLE_REMOTE_ACCESS_DENIED',
			11 => 'CURLE_FTP_WEIRD_PASS_REPLY',
			13 => 'CURLE_FTP_WEIRD_PASV_REPLY',
			14 => 'CURLE_FTP_WEIRD_227_FORMAT',
			15 => 'CURLE_FTP_CANT_GET_HOST',
			17 => 'CURLE_FTP_COULDNT_SET_TYPE',
			18 => 'CURLE_PARTIAL_FILE',
			19 => 'CURLE_FTP_COULDNT_RETR_FILE',
			21 => 'CURLE_QUOTE_ERROR',
			22 => 'CURLE_HTTP_RETURNED_ERROR',
			23 => 'CURLE_WRITE_ERROR',
			25 => 'CURLE_UPLOAD_FAILED',
			26 => 'CURLE_READ_ERROR',
			27 => 'CURLE_OUT_OF_MEMORY',
			28 => 'CURLE_OPERATION_TIMEDOUT',
			30 => 'CURLE_FTP_PORT_FAILED',
			31 => 'CURLE_FTP_COULDNT_USE_REST',
			33 => 'CURLE_RANGE_ERROR',
			34 => 'CURLE_HTTP_POST_ERROR',
			35 => 'CURLE_SSL_CONNECT_ERROR',
			36 => 'CURLE_BAD_DOWNLOAD_RESUME',
			37 => 'CURLE_FILE_COULDNT_READ_FILE',
			38 => 'CURLE_LDAP_CANNOT_BIND',
			39 => 'CURLE_LDAP_SEARCH_FAILED',
			41 => 'CURLE_FUNCTION_NOT_FOUND',
			42 => 'CURLE_ABORTED_BY_CALLBACK',
			43 => 'CURLE_BAD_FUNCTION_ARGUMENT',
			45 => 'CURLE_INTERFACE_FAILED',
			47 => 'CURLE_TOO_MANY_REDIRECTS',
			48 => 'CURLE_UNKNOWN_TELNET_OPTION',
			49 => 'CURLE_TELNET_OPTION_SYNTAX',
			51 => 'CURLE_PEER_FAILED_VERIFICATION',
			52 => 'CURLE_GOT_NOTHING',
			53 => 'CURLE_SSL_ENGINE_NOTFOUND',
			54 => 'CURLE_SSL_ENGINE_SETFAILED',
			55 => 'CURLE_SEND_ERROR',
			56 => 'CURLE_RECV_ERROR',
			58 => 'CURLE_SSL_CERTPROBLEM',
			59 => 'CURLE_SSL_CIPHER',
			60 => 'CURLE_SSL_CACERT',
			61 => 'CURLE_BAD_CONTENT_ENCODING',
			62 => 'CURLE_LDAP_INVALID_URL',
			63 => 'CURLE_FILESIZE_EXCEEDED',
			64 => 'CURLE_USE_SSL_FAILED',
			65 => 'CURLE_SEND_FAIL_REWIND',
			66 => 'CURLE_SSL_ENGINE_INITFAILED',
			67 => 'CURLE_LOGIN_DENIED',
			68 => 'CURLE_TFTP_NOTFOUND',
			69 => 'CURLE_TFTP_PERM',
			70 => 'CURLE_REMOTE_DISK_FULL',
			71 => 'CURLE_TFTP_ILLEGAL',
			72 => 'CURLE_TFTP_UNKNOWNID',
			73 => 'CURLE_REMOTE_FILE_EXISTS',
			74 => 'CURLE_TFTP_NOSUCHUSER',
			75 => 'CURLE_CONV_FAILED',
			76 => 'CURLE_CONV_REQD',
			77 => 'CURLE_SSL_CACERT_BADFILE',
			78 => 'CURLE_REMOTE_FILE_NOT_FOUND',
			79 => 'CURLE_SSH',
			80 => 'CURLE_SSL_SHUTDOWN_FAILED',
			81 => 'CURLE_AGAIN',
			82 => 'CURLE_SSL_CRL_BADFILE',
			83 => 'CURLE_SSL_ISSUER_ERROR',
			84 => 'CURLE_FTP_PRET_FAILED',
			84 => 'CURLE_FTP_PRET_FAILED',
			85 => 'CURLE_RTSP_CSEQ_ERROR',
			86 => 'CURLE_RTSP_SESSION_ERROR',
			87 => 'CURLE_FTP_BAD_FILE_LIST',
			88 => 'CURLE_CHUNK_FAILED'
		);
		return $errorCodes[ $errorCode ];
	}
}