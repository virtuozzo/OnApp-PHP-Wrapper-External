<?php
/**
 *
 * @category    API wrapper
 * @package     OnApp
 * @author      Ivan Gavryliuk
 * @copyright   © 2017 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */

/**
 * Managing CDN Report Visitor Country Table
 *
 * The OnApp_CDNReport_Location_VisitorCountryTable class uses the following basic methods:
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */
class OnApp_CDNReport_Location_VisitorCountryTable extends OnApp {
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
            case 5.4:
                $this->fields = array(
                    'country' => array(
                        ONAPP_FIELD_MAP  => '_country',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'avgLatency'    => array(
                        ONAPP_FIELD_MAP  => '_avgLatency',
                        ONAPP_FIELD_TYPE => 'float',
                    ),
                    'avgTransferRate'    => array(
                        ONAPP_FIELD_MAP  => '_avgTransferRate',
                        ONAPP_FIELD_TYPE => 'float',
                    ),
                    'request'  => array(
                        ONAPP_FIELD_MAP  => '_request',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'bandwidth'  => array(
                        ONAPP_FIELD_MAP  => '_bandwidth',
                        ONAPP_FIELD_TYPE => 'string',
                    )
                );
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
}