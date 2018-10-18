<?php
/**
 * OnApp API wrapper Helpers
 *
 * @category    API wrapper
 * @package     OnApp
 * @author      Mykola Vuy
 * @copyright   © 2018 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */

if (!function_exists('is_countable')) {
     function is_countable($var) {
         return (is_array($var) || $var instanceof Countable);
     }
 }
