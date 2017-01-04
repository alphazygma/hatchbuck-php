<?php /** @copyright Alejandro Salazar (c) 2017 */
namespace Hatchbuck\Auth;

/**
 * The <kbd>Auth</kbd> class provides the input required to authenticate Hatchbuck API calls through
 * SSL.
 *
 * @author Alejandro Salazar (alphazygma@gmail.com)
 * @version 1.0
 * @package Hatchbuck.Auth
 * @subpackage Auth
 */
class Auth
{
    /** @var \Hatchbuck\Auth\AuthPair */
    private $_cert;
    /** @var \Hatchbuck\Auth\AuthPair */
    private $_privateKey;
    
    public function __construct(\Hatchbuck\Auth\AuthPair $cert, \Hatchbuck\Auth\AuthPair $sslKey = null)
    {
        $this->_cert       = $cert;
        $this->_privateKey = $sslKey;
    }

    /**
     * Returns the Certificate data to Authenticate the request
     * @return \Hatchbuck\Auth\AuthPair
     */
    public function getCert()
    {
        return $this->_cert;
    }

    /**
     * Returns the Private Key data to Authenticate the request
     * @return \Hatchbuck\Auth\AuthPair
     */
    public function getKey()
    {
        return $this->_privateKey;
    }

}
