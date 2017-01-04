<?php /** @copyright Alejandro Salazar (c) 2017 */
namespace Hatchbuck\Exception;

/**
 * The <kbd>ExceptionCode</kbd> class provides a central place to identify Errores by a given number.
 *
 * @author Alejandro Salazar (alphazygma@gmail.com)
 * @version 1.0
 * @package Hatchbuck.Exception
 * @subpackage Exception
 */
class ExceptionCode
{
    // Using a number grouping structutre, first 3 digits indicate a group, and last 3 digits the
    // specific error within the group
    
    // Search group 100xxx
    const SEARCH_INVALID = 100000;
}
