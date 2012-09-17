<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Managing Groups
 *
 * Groups are created to set prices for the resources so that users know how
 * much they will be charged per unit. The prices can be set for the memory,
 * CPU, CPU Share, and Disk size. Each user is assigned a billing group during
 * the creation process.
 *
 * @category    API wrapper
 * @package     OnApp
 * @author      Andrew Yatskovets
 * @copyright   (c) 2012 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */

/**
 * Managing Groups
 *
 * The Group class represents the billing groups.
 * The OnApp class is the parent of the Group class.
 *
 * The OnApp_Group uses the following basic methods:
 * {@link load}, {@link save}, {@link delete}, and {@link getList}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */
class OnApp_Group extends OnApp {
	/**
	 * root tag used in the API request
	 *
	 * @var string
	 */
	protected $rootElement = 'group';

	/**
	 * alias processing the object data
	 *
	 * @var string
	 */
	protected $URLPath = 'groups';
}