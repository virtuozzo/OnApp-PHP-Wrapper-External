<?php
/**
 * Managing VirtualMachine FileEntriesFields
 * 
 * much they will be charged per unit.
 *
 * @category    API wrapper
 * @package     OnApp
 * @author      Mykola Vuy
 * @copyright   © 2018 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */

/**
 * Managing VirtualMachine FileEntriesFields
 *
 * The OnApp_VirtualMachine_FileEntriesFields class uses the following basic methods:
 * {@link load}, {@link add}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php )
 */

class OnApp_VirtualMachine_FileEntriesFields extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'file_entry';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = '';

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
                    'path'                  => array(
                        ONAPP_FIELD_MAP         => '_path',
                        ONAPP_FIELD_TYPE        => 'string',
                        ONAPP_FIELD_READ_ONLY   => true
                    ),
                    'file_name'             => array(
                        ONAPP_FIELD_MAP         => '_file_name',
                        ONAPP_FIELD_TYPE        => 'string',
                        ONAPP_FIELD_READ_ONLY   => true
                    ),
                    'dir'                   => array(
                        ONAPP_FIELD_MAP         => '_dir',
                        ONAPP_FIELD_TYPE        => 'boolean',
                    ),
                    'last_modified'             => array(
                        ONAPP_FIELD_MAP         => '_last_modified',
                        ONAPP_FIELD_TYPE        => 'datetime',
                    ),
                    'size'                  => array(
                        ONAPP_FIELD_MAP         => '_size',
                        ONAPP_FIELD_TYPE        => 'integer',
                    ),
                );
                break;
        }
        parent::initFields( $version, __CLASS__ );

        return $this->fields;
    }

}
