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
     * @return \Hatchbuck\Entity\Contact[]|null Return <kbd>NULL</kbd> if no Contact was found.
     * @throws \Hatchbuck\Exception\InvalidSearchException
     */
    public function search(SearchInput $searchInput)
    {
        if (!$searchInput->isValidSearch()) {
            throw new \Hatchbuck\Exception\InvalidSearchException();
        }
        
        $api = 'contact/search';
        
        $searchArray = [];
        hb_array_set($searchArray, 'contactId', $searchInput->getContactId());
        hb_array_set($searchArray, 'firstName', $searchInput->getFirstName());
        hb_array_set($searchArray, 'lastName', $searchInput->getLastName());
        hb_array_set($searchArray, 'emails', $searchInput->getEmailList());
        
        $reqClient    = $this->_getRequestClient();
        $responseList = [];
        try {
            $responseList = $reqClient->post($api, $searchArray);
        } catch (\Hatchbuck\Exception\User\NoContactFoundException $e) {
            return null;
        }

        // In-place replacement of the Array Map representation with the Contact Object representation.
        $contactList = hb_to_entity_list($responseList, \Hatchbuck\Entity\Contact::class);
        
        return $contactList;
    }
    
    /**
     * Adds a new contact into the system and returns a new parsed version of the contact with all
     * the respective IDs generated by the CRM.
     * @param \Hatchbuck\Entity\Contact $contact
     * @return \Hatchbuck\Entity\Contact The inserted contact with respective IDs
     * @throws \Hatchbuck\Exception\User\ExistingContactException
     * @throws \Hatchbuck\Exception\User\InvalidNewContactException
     */
    public function addContact(\Hatchbuck\Entity\Contact $contact)
    {
        if ($contact->getContactId() != null) {
            throw new \Hatchbuck\Exception\User\ExistingContactException($contact);
        }
        
        if (empty($contact->getEmailList()) || empty($contact->getStatus())) {
            throw new Exception\User\InvalidNewContactException();
        }
        
        $responseContact = $this->_contactRequest(\Hatchbuck\Http\Request::METHOD_POST, $contact);
        
        return $responseContact;
    }
    
    /**
     * Updates an existing contact and returns a new parsed version of the contact with all
     * the respective IDs generated by the CRM.
     * @param \Hatchbuck\Entity\Contact $contact
     * @return \Hatchbuck\Entity\Contact The inserted contact with respective IDs
     * @throws \Hatchbuck\Exception\User\ExistingContactException
     * @throws \Hatchbuck\Exception\User\InvalidNewContactException
     */
    public function updateContact(\Hatchbuck\Entity\Contact $contact)
    {
        if (empty($contact->getContactId())) {
            throw new Exception\MissingIdException();
        }
        
        $responseContact = $this->_contactRequest(\Hatchbuck\Http\Request::METHOD_PUT, $contact);
        
        return $responseContact;
    }
    
    /**
     * Gets a list of tag for the supplied contact.
     * <p><b>Note:</b> Unless you can create the <kbd>Contact</kbd> from data you have stored, this
     * call would redudant if the <kbd>$contact</kbd> object was retrieved through search as it would
     * already contain the tags under the <kbd>$contact->getTagList()</kbd> method.</p>
     * 
     * @param \Hatchbuck\Entity\Contact $contact
     * @throws \Hatchbuck\Exception\MissingIdException If the Contact does not have an ID.
     */
    public function getTagList(\Hatchbuck\Entity\Contact $contact)
    {
        $response = $this->_tagRequest(\Hatchbuck\Http\Request::METHOD_GET, $contact);
        
        $tagList = hb_to_entity_list($response, \Hatchbuck\Entity\Tag::class);
        
        return $tagList;
    }
    
    /**
     * Adds a tag(s) to the supplied contact.
     * @param \Hatchbuck\Entity\Contact                     $contact
     * @param \Hatchbuck\Entity\Tag|\Hatchbuck\Entity\Tag[] $tag
     * @throws \Hatchbuck\Exception\MissingIdException If the Contact does not have an ID.
     */
    public function addTag(\Hatchbuck\Entity\Contact $contact, $tag)
    {
        $this->_tagRequest(\Hatchbuck\Http\Request::METHOD_POST, $contact, $tag);
    }
    
    /**
     * Removes a tag(s) from the supplied contact.
     * @param \Hatchbuck\Entity\Contact                     $contact
     * @param \Hatchbuck\Entity\Tag|\Hatchbuck\Entity\Tag[] $tag
     * @throws \Hatchbuck\Exception\MissingIdException If the Contact does not have an ID.
     */
    public function removeTag(\Hatchbuck\Entity\Contact $contact, $tag)
    {
        $this->_tagRequest(\Hatchbuck\Http\Request::METHOD_DELETE, $contact, $tag);
    }
    
    /**
     * Adds or Updates the supplied contact.
     * @param string                    $method
     * @param \Hatchbuck\Entity\Contact $contact
     * @return \Hatchbuck\Entity\Contact
     * @throws \InvalidArgumentException If an usupported request method is supplied.
     */
    protected function _contactRequest($method, \Hatchbuck\Entity\Contact $contact)
    {
        $api = 'contact';
        
        $dataArray = $contact->toArray();
        $reqClient = $this->_getRequestClient();
        
        $response = null;
        
        switch ($method) {
            case \Hatchbuck\Http\Request::METHOD_POST:
                $response = $reqClient->post($api, $dataArray);
                break;
            case \Hatchbuck\Http\Request::METHOD_PUT:
                $response = $reqClient->put($api, $dataArray);
                break;
            default:
                throw new \InvalidArgumentException("Method {$method} not supported");
        }
        
        $responseContact = hb_to_entity($response, \Hatchbuck\Entity\Contact::class);
        
        return $responseContact;
    }
    
    /**
     * Retrieves, Adds or Removes tag(s) on the supplied contact.
     * @param string                                        $method
     * @param \Hatchbuck\Entity\Contact                     $contact
     * @param \Hatchbuck\Entity\Tag|\Hatchbuck\Entity\Tag[] $tag
     * @throws \Hatchbuck\Exception\MissingIdException If the Contact does not have an ID.
     * @throws \InvalidArgumentException If an usupported request method is supplied.
     */
    protected function _tagRequest($method, \Hatchbuck\Entity\Contact $contact, $tag = null)
    {
        if (empty($contact->getContactId())) {
            throw new \Hatchbuck\Exception\MissingIdException();
        }
        
        $api       = 'contact/' . $contact->getContactId() . '/tags';
        $reqClient = $this->_getRequestClient();
        
        // The GET case does not require a body, so we don't need to execute the next section
        // which takes care of that.
        if ($method == \Hatchbuck\Http\Request::METHOD_GET) {
            return $reqClient->get($api);
        }
        
        $tagList = $tag;
        if (!is_array($tagList)) {
            $tagList = [$tag];
        }
        
        $dataListArray = [];
        foreach ($tagList as $tagObject) {
            $dataListArray[] = $tagObject->toArray();
        }

        switch ($method) {
            case \Hatchbuck\Http\Request::METHOD_POST:
                return $reqClient->post($api, $dataListArray);
            case \Hatchbuck\Http\Request::METHOD_DELETE:
                return $reqClient->delete($api, $dataListArray);
            default:
                throw new \InvalidArgumentException("Method {$method} not supported");
        }
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
}
