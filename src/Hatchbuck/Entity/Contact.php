<?php /** @copyright Alejandro Salazar (c) 2017 */
namespace Hatchbuck\Entity;

/**
 * The <kbd>Contact</kbd> entity class represents the Hatchbuck contact data.
 *
 * @author Alejandro Salazar (alphazygma@gmail.com)
 * @version 1.0
 * @package Hatchbuck.Entity
 * @subpackage Entity
 */
class Contact implements EntityInterface
{   
    /** @var string */
    private $_contactId;
    /** @var string */
    private $_firstName;
    /** @var string */
    private $_lastName;
    /** @var string */
    private $_timezone;
    /** @var string */
    private $_referredBy;
    /** @var boolean */
    private $_isSubscribed;
    /** @var \Hatchbuck\Entity\Status */
    private $_status;
    /** @var \Hatchbuck\Entity\SalesRep */
    private $_salesRep;
    /** @var \Hatchbuck\Entity\Temperature */
    private $_temperature;
    /** @var \Hatchbuck\Entity\Email[] */
    private $_emailList         = [];
    /** @var \Hatchbuck\Entity\Phone[] */
    private $_phoneList         = [];
    /** @var \Hatchbuck\Entity\Tag[] */
    private $_tagList           = [];
    /** @var \Hatchbuck\Entity\Address[] */
    private $_addressList          = [];
    /** @var \Hatchbuck\Entity\Website[] */
    private $_websiteList;
    /** @var \Hatchbuck\Entity\Campaign[] */
    private $_campaignList         = [];
    /** @var \Hatchbuck\Entity\SocialNetwork[] */
    private $_socialNetworkList    = [];
    /** @var \Hatchbuck\Entity\InstantMessaging[] */
    private $_instantMessagingList = [];
    
    // Pending as I couldn't get concise data on the format of this field and get any values on it yet.
    //private $_customFieldList      = [];

    /**
     * Parses an array map into a <kbd>Contact</kbd> object.
     * @param array $arrayMap
     * @return \Hatchbuck\Entity\Contact Entity object from the Array Map data.
     */
    public static function withMap(array $arrayMap)
    {
        $entity = new static();
        $entity->_contactId    = $arrayMap['contactId'];
        $entity->_firstName    = $arrayMap['firstName'];
        $entity->_lastName     = $arrayMap['lastName'];
        $entity->_title        = $arrayMap['title'];
        $entity->_company      = $arrayMap['company'];
        $entity->_timezone     = $arrayMap['timezone'];
        $entity->_referredBy   = $arrayMap['referredBy'];
        $entity->_isSubscribed = (boolean)$arrayMap['subscribed'];

        $entity->_status      = EntityParseHelper::parseMap($arrayMap['status'], Status::class);
        $entity->_salesRep    = EntityParseHelper::parseMap($arrayMap['salesRep'], SalesRep::class);
        $entity->_temperature = EntityParseHelper::parseMap($arrayMap['temperature'], Temperature::class);

        $entity->_emailList    = EntityParseHelper::parseMapList($arrayMap['emails'], Email::class);
        $entity->_phoneList    = EntityParseHelper::parseMapList($arrayMap['phones'], Phone::class);
        $entity->_tagList      = EntityParseHelper::parseMapList($arrayMap['tags'], Tag::class);
        $entity->_addressList  = EntityParseHelper::parseMapList($arrayMap['addresses'], Address::class);
        $entity->_websiteList  = EntityParseHelper::parseMapList($arrayMap['website'], Website::class);
        $entity->_campaignList = EntityParseHelper::parseMapList($arrayMap['campaigns'], Campaign::class);

        $entity->_socialNetworkList = EntityParseHelper::parseMapList(
            $arrayMap['socialNetworks'], SocialNetwork::class
        );
        $entity->_instantMessagingList = EntityParseHelper::parseMapList(
            $arrayMap['instantMessaging'], InstantMessaging::class
        );

        return $entity;
    }
 
    /** @return string */
    public function getContactId()
    {
        return $this->_contactId;
    }

    /** @return string */
    public function getFirstName()
    {
        return $this->_firstName;
    }

    /** @return string */
    public function getLastName()
    {
        return $this->_lastName;
    }

    /** @return string */
    public function getTimezone()
    {
        return $this->_timezone;
    }

    /** @return string */
    public function getReferredBy()
    {
        return $this->_referredBy;
    }

    /** @return boolean */
    public function isSubscribed()
    {
        return $this->_isSubscribed;
    }

    /** @return \Hatchbuck\Entity\Status */
    public function getStatus()
    {
        return $this->_status;
    }

    /** @return \Hatchbuck\Entity\SalesRep */
    public function getSalesRep()
    {
        return $this->_salesRep;
    }

    /** @return \Hatchbuck\Entity\Temperature */
    public function getTemperature()
    {
        return $this->_temperature;
    }

    /** @return \Hatchbuck\Entity\Email[] */
    public function getEmailList()
    {
        return $this->_emailList;
    }

    /** @return \Hatchbuck\Entity\Phone[] */
    public function getPhoneList()
    {
        return $this->_phoneList;
    }

    /** @return \Hatchbuck\Entity\Tag[] */
    public function getTagList()
    {
        return $this->_tagList;
    }

    /** @return \Hatchbuck\Entity\Address[] */
    public function getAddressList()
    {
        return $this->_addressList;
    }

    /** @return \Hatchbuck\Entity\Website[] */
    public function getWebsiteList()
    {
        return $this->_websiteList;
    }

    /** @return \Hatchbuck\Entity\Campaign[] */
    public function getCampaignList()
    {
        return $this->_campaignList;
    }

    /** @return \Hatchbuck\Entity\SocialNetwork[] */
    public function getSocialNetworkList()
    {
        return $this->_socialNetworkList;
    }

    /** @return \Hatchbuck\Entity\InstantMessaging[] */
    public function getInstantMessagingList()
    {
        return $this->_instantMessagingList;
    }

}
