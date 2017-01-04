<?php /** @copyright Alejandro Salazar (c) 2017 */
namespace Hatchbuck;

/**
 * The <kbd>SearchInput</kbd> class provides the accepted input parameters to be sent to the search api.
 *
 * @author Alejandro Salazar (alphazygma@gmail.com)
 * @version 1.0
 * @package Hatchbuck
 */
class SearchInput
{
    /** @var string */
    private $_contactId;
    /** @var string */
    private $_firstName;
    /** @var string */
    private $_lastName;
    /** @var array List of Map entries (e.g. ['address' => 'email@hatchbuck.com']) */
    private $_emailList;
    
    /**
     * The contact ID to search for.
     * @return string
     */
    public function getContactId()
    {
        return $this->_contactId;
    }

    /**
     * The first name to search for.
     * @return string
     */
    public function getFirstName()
    {
        return $this->_firstName;
    }

    /**
     * The last name to search for.
     * @return string
     */
    public function getLastName()
    {
        return $this->_lastName;
    }

    /**
     * The list of emails to search for.
     * @return array List of Map entries (e.g. [['address' => 'email@hatchbuck.com'], ...])
     */
    public function getEmailList()
    {
        return $this->_emailList;
    }

    /**
     * Set the contact ID to search for.
     * @param string $contactId
     */
    public function setContactId($contactId)
    {
        $this->_contactId = $contactId;
    }

    /**
     * Set the first name to search for.
     * @param string $firstName
     */
    public function setFirstName($firstName)
    {
        $this->_firstName = $firstName;
    }

    /**
     * Set the last Name to search for.
     * @param string $lastName
     */
    public function setLastName($lastName)
    {
        $this->_lastName = $lastName;
    }

    /**
     * Add an email to the list to search for.
     * @param string $email
     */
    public function addEmail($email)
    {
        if (!isset($this->_emailList)) {
            $this->_emailList = [];
        }
        
        $this->_emailList[] = ['address' => $email];
    }

    /**
     * Return if this search object is valid for search with at least one field set.
     * <p>As per Hatchbuck API Documentation, <i>"It is mandatory to provide one field to search the
     * contact."</i></p>
     * @return boolean <kbd>True</kbd> if at least one parameter is set for search, <kbd>False</kbd>
     *      otherwise.
     */
    public function isValidSearch()
    {
        return isset($this->_contactId)
                || isset($this->_firstName)
                || isset($this->_lastName)
                || !empty($this->_emailList);
    }
}
