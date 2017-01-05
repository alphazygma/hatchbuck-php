<?php /** @copyright Alejandro Salazar (c) 2017 */
namespace Hatchbuck\Exception;


/**
 * The <kbd>ImmutableAttributeException</kbd> class represents the exception thrown when trying to
 * modify an attribute that cannot be updated once set (like an ID).
 *
 * @author Alejandro Salazar (alphazygma@gmail.com)
 * @version 1.0
 * @package Hatchbuck.Exception.User
 * @subpackage Exception
 */
class ImmutableAttributeException
{
    public function __construct($attributeName, $previous = null)
    {
        $message = "Attribute `{$attributeName}` cannot be modified.";
        parent::__construct($message, ExceptionCode::IMMUTABLE_ATTRIBUTE, $previous);
    }
}
