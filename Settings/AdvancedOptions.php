<?php
/**
 * Managing Settings AdvancedOptions
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

class OnApp_Settings_AdvancedOptions extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'advanced_options';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'advanced_options';

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
                    'vsphere_template_job_name'     => array(
                        ONAPP_FIELD_MAP       => '_vsphere_template_job_name',
                        ONAPP_FIELD_TYPE      => 'string',
                    ),
                    'backup_repository_name'        => array(
                        ONAPP_FIELD_MAP       => '_backup_repository_name',
                        ONAPP_FIELD_TYPE      => 'string',
                    ),
                    'power_on_after_restore'        => array(
                        ONAPP_FIELD_MAP       => '_power_on_after_restore',
                        ONAPP_FIELD_TYPE      => 'boolean',
                    ),
                    'quick_rollback'                => array(
                        ONAPP_FIELD_MAP       => '_quick_rollback',
                        ONAPP_FIELD_TYPE      => 'boolean',
                    ),
                );

                break;
        }

        parent::initFields( $version, __CLASS__ );

        return $this->fields;
    }

}
