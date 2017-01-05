<?php /** @copyright Alejandro Salazar (c) 2017 */
namespace Hatchbuck\Exception;

/**
 * The <kbd>MissingIdException</kbd> class represents the exception thrown when attempting to
 * use an Entity that requires its ID to be set but its missing.
 *
 * @author Alejandro Salazar (alphazygma@gmail.com)
 * @version 1.0
 * @package Hatchbuck.Exception
 * @subpackage Exception
 */
class MissingIdException extends \Exception
{
    public function __construct($previous = null)
    {
        $message = 'Invalid new contact, it misses either email address or status.';
        parent::__construct($message, \Hatchbuck\Exception\ExceptionCode::MISSING_ID, $previous);
    }
}
