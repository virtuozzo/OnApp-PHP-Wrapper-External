<?php
/**
 * Managing CDN SSL
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
 * Managing CDN SSL
 *
 * The CDN SSL class represents the CDN SSL.
 * The OnApp_CDNSSL class is the parent of the OnApp class.
 *
 * The CDNSSL uses the following basic methods:
 * {@link load}, {@link save}, {@link delete}, and {@link getList}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/ )
 */
class OnApp_CDNSSL extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'cdn_ssl_certificate';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'cdn_ssl_certificates';

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
                    'id'                => array(
                        ONAPP_FIELD_MAP       => '_id',
                        ONAPP_FIELD_TYPE      => 'integer',
                        ONAPP_FIELD_READ_ONLY => true
                    ),
                    'name'              => array(
                        ONAPP_FIELD_MAP       => '_name',
                        ONAPP_FIELD_TYPE      => 'string',
                    ),
                    'user_id'           => array(
                        ONAPP_FIELD_MAP       => '_user_id',
                        ONAPP_FIELD_TYPE      => 'integer',
                    ),
                    'created_at'        => array(
                        ONAPP_FIELD_MAP       => '_created_at',
                        ONAPP_FIELD_TYPE      => 'datetime',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'updated_at'        => array(
                        ONAPP_FIELD_MAP       => '_updated_at',
                        ONAPP_FIELD_TYPE      => 'datetime',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'cdn_reference'     => array(
                        ONAPP_FIELD_MAP       => '_cdn_reference',
                        ONAPP_FIELD_TYPE      => 'integer',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                );
                break;
        }

        parent::initFields( $version, __CLASS__ );

        return $this->fields;
    }
    
    public function search( $question ) {
        
        return $this->sendGet( ONAPP_GETRESOURCE_DEFAULT, null, array( 'q' => $question ) );
    }
}
