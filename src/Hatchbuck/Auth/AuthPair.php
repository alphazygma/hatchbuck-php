<?php /** @copyright Alejandro Salazar (c) 2017 */
namespace Hatchbuck\Auth;

/**
 * The <kbd>AuthPair</kbd>
 *
 * @author Alejandro Salazar (alphazygma@gmail.com)
 * @version 1.0
 * @package Hatchbuck.Auth
 * @subpackage Auth
 */
class AuthPair
{
    /** @var string */
    private $_filePath;
    /** @var string */
    private $_password;
    
    public function __construct($filePath, $password = null)
    {
        $this->_filePath = $filePath;
        $this->_password = $password;
    }

    /**
     * Returns the path to the file representing this Key or Certificate
     * @return string
     */
    public function getFilePath()
    {
        return $this->_filePath;
    }

    /**
     * Returns the optional decription password in case the FilePath is encrypted.
     * @return string|null The supplied password or <kbd>Null</kbd> if not password is required.
     * @see ::isRequiresPassword()
     */
    public function getPassword()
    {
        return $this->_password;
    }

    
    /**
     * Returns whether the supplied File Path requires a decription password.
     * @return boolean
     */
    public function isRequiresPassword()
    {
        return isset($this->_password);
    }
}
