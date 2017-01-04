<?php /** @copyright Alejandro Salazar (c) 2017 */
namespace Hatchbuck;

/**
 * The <kbd>Hatchbuck</kbd> class is the main API interface.
 *
 * @author Alejandro Salazar (alphazygma@gmail.com)
 * @version 1.0
 * @package Hatchbuck
 */
class Hatchbuck
{
    const VERSION = 'v1';
    
    /** @var string */
    private static $API_KEY = null;
    /** @var \Hatchbuck\Auth\Auth */
    private static $AUTH = null;
    
    public static function setApiKey($apiKey, \Hatchbuck\Auth\Auth $auth)
    {
        static::$API_KEY = $apiKey;
        static::$AUTH    = $auth;
    }
    
    /**
     * Get a list of Contacts for the supplied search input.
     * 
     * @param \Hatchbuck\SearchInput $searchInput
     * @return \Hatchbuck\Entity\Contact[]
     * @throws \Hatchbuck\Exception\InvalidSearchException
     */
    public function search(SearchInput $searchInput)
    {
        if (!$searchInput->isValidSearch()) {
            throw new \Hatchbuck\Exception\InvalidSearchException();
        }
        
        $api = 'contact/search';
        
        $searchArray = [];
        $this->_setArrayInput($searchArray, 'contactId', $searchInput->getContactId());
        $this->_setArrayInput($searchArray, 'firstName', $searchInput->getFirstName());
        $this->_setArrayInput($searchArray, 'lastName', $searchInput->getLastName());
        $this->_setArrayInput($searchArray, 'emails', $searchInput->getEmailList());
        
        $reqClient = $this->_getRequestClient();
        
        $responseList = $reqClient->post($api, $searchArray);
        
        // In-place replacement of the Array Map representation with the Contact Object representation.
        $contactList = \Hatchbuck\Entity\EntityParseHelper::parseMapList(
            $responseList, \Hatchbuck\Entity\Contact::class
        );
        
        return $contactList;
    }
    
    /**
     * Returns an Http Request client to perform calls to the Hatchbuck API.
     * @return \Hatchbuck\Http\Request
     */
    protected function _getRequestClient()
    {
        // Declaring this class variable locally as I am not looking forward for this variable to
        // be used directly without going through this method to avoid other calls forgetting to
        // initialize it or modifying the value accidentally.
        // This also allows for some sort of caching of the Request object as well as mocking for tests.
        if (!isset($this->_requestClient)) {
            $this->_requestClient = new \Hatchbuck\Http\Request(
                static::$API_KEY, static::$AUTH
            );
        }
        
        return $this->_requestClient;
    }
    
    /**
     * Helper method to set A value to the supplied array on the given key if value is not <kbd>null</kbd>.
     * @param array $array The Array by reference to update with the supplied key/value pair.
     * @param string $key  The key to use on the reference array.
     * @param mixed $value The value to use on the reference array if not <kbd>null</kbd>.
     * @param mixed $defaultValue (Optional)<br/>To be used in case <kbd>$value</kbd> is not set.
     */
    private function _setArrayInput(&$array, $key, $value, $defaultValue = null)
    {
        // If the value supplied is set, then set it in the supplied array by the given key
        if (isset($value)) {
            $array[$key] = $value;
            return;
        }
        
        // Otherwise, check if a default value was supplied to use instead.
        if (isset($defaultValue)) {
            $array[$key] = $defaultValue;
            return;
        }
    }
}
