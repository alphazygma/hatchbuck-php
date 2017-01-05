<?php /** @copyright Alejandro Salazar (c) 2017 */
namespace Hatchbuck\Exception;


/**
 * The <kbd>InvalidSearchException</kbd> class represents the exception thrown when attempting a
 * Search with invalid input.
 *
 * @author Alejandro Salazar (alphazygma@gmail.com)
 * @version 1.0
 * @package Hatchbuck.Exception
 * @subpackage Exception
 */
class InvalidSearchException extends \RuntimeException
{
    public function __construct($previous = null)
    {
        $message = 'Invalid input for search.';
        parent::__construct($message, ExceptionCode::SEARCH_INVALID, $previous);
    }
}
