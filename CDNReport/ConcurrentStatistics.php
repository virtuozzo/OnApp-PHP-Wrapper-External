<?php

/**
 * Managing CDN Concurrent Statistics
 *
 *
 * @category    API wrapper
 * @package     OnApp
 * @author      Mykola Vuy
 * @copyright   © 2018 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */

/**
 * Managing CDN Concurrent Statistics
 *
 * The CDN Overview Report class represents the CDN Concurrent Statistics.
 * The OnApp_CDNReport_ConcurrentStatistics class is the parent of the OnApp class.
 *
 * The OnApp_CDNReport_ConcurrentStatistics uses the following basic methods:
 * {@link getList}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php )
 */
class OnApp_CDNReport_ConcurrentStatistics extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'concurrent_statistics';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'cdn/reports/concurrent_statistics';

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
            case 6.0:
                $this->fields = array(
                    'stream_concurrent_line_chart' => array(
                        ONAPP_FIELD_MAP  => '_stream_concurrent_line_chart',
                        ONAPP_FIELD_TYPE => '_array',
                    ),
                );
                break;
        }

        parent::initFields( $version, __CLASS__ );

        return $this->fields;
    }

    /**
     * Sends an API request to get the Objects. After requesting,
     * unserializes the received response into the array of Objects
     *
     * @param array $params [start, end, resources[], locations[],]
     *
     * @return mixed an array of Object instances on success. Otherwise false
     * @access public
     */
    public function getList( $params = null, $url_args = null ) {
        $data = null;
        if (is_countable($params) && count($params)) {
            $data = array(
                'root' => $this->_tagRoot,
                'data' => array(),
            );
            if (isset($params['start']) && !is_null($params['start'])) {
                $data['data']['start'] = $params['start'];
            }
            if (isset($params['end']) && !is_null($params['end'])) {
                $data['data']['end'] = $params['end'];
            }
            if (isset($params['resources']) && is_countable($params['resources']) && count($params['resources'])) {
                $data['data']['resources'] = $params['resources'];
            }
            if (isset($params['locations']) && is_countable($params['locations']) && count($params['locations'])) {
                $data['data']['locations'] = $params['locations'];
            }
        }

        return parent::getList( $data, null );
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
