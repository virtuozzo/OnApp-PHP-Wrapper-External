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
 * Managing LineChart
 *
 * The OnApp_CDNReport_CacheStatistic_LineChart class uses the following basic methods:
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */
class OnApp_CDNReport_CacheStatistic_LineChart extends OnApp {
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
            case 5.3:
                $this->fields = array(
                    'time'     => array(
                        ONAPP_FIELD_MAP  => '_time',
                        ONAPP_FIELD_TYPE => 'datetime',
                    ),
                    'cached'   => array(
                        ONAPP_FIELD_MAP  => '_cached',
                        ONAPP_FIELD_TYPE => 'float',
                    ),
                    'uncached' => array(
                        ONAPP_FIELD_MAP  => '_uncached',
                        ONAPP_FIELD_TYPE => 'float',
                    ),
                    'hit'      => array(
                        ONAPP_FIELD_MAP  => '_hit',
                        ONAPP_FIELD_TYPE => 'float',
                    ),
                    'miss'     => array(
                        ONAPP_FIELD_MAP  => '_miss',
                        ONAPP_FIELD_TYPE => 'float',
                    ),
                    'gb'       => array(
                        ONAPP_FIELD_MAP  => '_gb',
                        ONAPP_FIELD_TYPE => 'float',
                    ),
                );
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

            case 6.1:
                $this->fields = $this->initFields( 6.0 );
                break;

            case 6.2:
                $this->fields = $this->initFields( 6.1 );
                break;

            case 6.3:
                $this->fields = $this->initFields( 6.2 );
                break;

            case 6.4:
                $this->fields = $this->initFields( 6.3 );
                break;

            case 6.5:
                $this->fields = $this->initFields( 6.4 );
                break;

            case 6.6:
                $this->fields = $this->initFields( 6.5 );
                break;

            case 6.7:
                $this->fields = $this->initFields( 6.6 );
                break;

            default:
                $this->fields = $this->initFields( 6.7 );
                break;
        }
        parent::initFields( $version, __CLASS__ );

        return $this->fields;
    }
}