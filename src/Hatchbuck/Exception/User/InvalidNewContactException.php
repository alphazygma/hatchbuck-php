<?php /** @copyright Alejandro Salazar (c) 2017 */
namespace Hatchbuck\Exception\User;

/**
 * The <kbd>InvalidNewContactException</kbd> class represents the exception thrown when attempting to
 * add an invalid new Contact.
 *
 * @author Alejandro Salazar (alphazygma@gmail.com)
 * @version 1.0
 * @package Hatchbuck.Exception.User
 * @subpackage Exception
 */
class InvalidNewContactException extends \Exception
{
    public function __construct($previous = null)
    {
        $message = 'Invalid new contact, it misses either email address or status.';
        parent::__construct($message, \Hatchbuck\Exception\ExceptionCode::CONTACT_INVALID_NEW, $previous);
    }
}
