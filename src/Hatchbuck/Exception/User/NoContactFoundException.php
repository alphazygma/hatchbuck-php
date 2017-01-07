<?php /** @copyright Alejandro Salazar (c) 2017 */
namespace Hatchbuck\Exception\User;

/**
 * The <kbd>NoContactFoundException</kbd> class represents the exception thrown when attempting to
 * search for a user but none is found.
 *
 * @author Alejandro Salazar (alphazygma@gmail.com)
 * @version 1.0
 * @package Hatchbuck.Exception.User
 * @subpackage Exception
 */
class NoContactFoundException extends \RuntimeException
{
    public function __construct($previous = null)
    {
        $message = 'No contact found for given search criteria.';
        
        parent::__construct($message, \Hatchbuck\Exception\ExceptionCode::CONTACT_NOT_FOUND, $previous);
    }
}
