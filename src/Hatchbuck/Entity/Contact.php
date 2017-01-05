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
    private $_title;
    /** @var string */
    private $_company;
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
    private $_emailList;
    /** @var \Hatchbuck\Entity\Phone[] */
    private $_phoneList;
    /** @var \Hatchbuck\Entity\Tag[] */
    private $_tagList;
    /** @var \Hatchbuck\Entity\Address[] */
    private $_addressList;
    /** @var \Hatchbuck\Entity\Website[] */
    private $_websiteList;
    /** @var \Hatchbuck\Entity\Campaign[] */
    private $_campaignList;
    /** @var \Hatchbuck\Entity\SocialNetwork[] */
    private $_socialNetworkList;
    /** @var \Hatchbuck\Entity\InstantMessaging[] */
    private $_instantMessagingList;
    
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
        $entity->_contactId    = hb_array_get($arrayMap, 'contactId');
        $entity->_firstName    = hb_array_get($arrayMap, 'firstName');
        $entity->_lastName     = hb_array_get($arrayMap, 'lastName');
        $entity->_title        = hb_array_get($arrayMap, 'title');
        $entity->_company      = hb_array_get($arrayMap, 'company');
        $entity->_timezone     = hb_array_get($arrayMap, 'timezone');
        $entity->_referredBy   = hb_array_get($arrayMap, 'referredBy');
        $entity->_isSubscribed = (boolean)hb_array_get($arrayMap, 'subscribed');

        $entity->_status      = hb_to_entity(hb_array_get($arrayMap, 'status'), Status::class);
        $entity->_salesRep    = hb_to_entity(hb_array_get($arrayMap, 'salesRep'), SalesRep::class);
        $entity->_temperature = hb_to_entity(hb_array_get($arrayMap, 'temperature'), Temperature::class);

        $entity->_emailList    = hb_to_entity_list(hb_array_get($arrayMap, 'emails'), Email::class);
        $entity->_phoneList    = hb_to_entity_list(hb_array_get($arrayMap, 'phones'), Phone::class);
        $entity->_tagList      = hb_to_entity_list(hb_array_get($arrayMap, 'tags'), Tag::class);
        $entity->_addressList  = hb_to_entity_list(hb_array_get($arrayMap, 'addresses'), Address::class);
        $entity->_websiteList  = hb_to_entity_list(hb_array_get($arrayMap, 'website'), Website::class);
        $entity->_campaignList = hb_to_entity_list(hb_array_get($arrayMap, 'campaigns'), Campaign::class);

        $entity->_socialNetworkList = hb_to_entity_list(
            hb_array_get($arrayMap, 'socialNetworks'), SocialNetwork::class
        );
        $entity->_instantMessagingList = hb_to_entity_list(
            hb_array_get($arrayMap, 'instantMessaging'), InstantMessaging::class
        );

        return $entity;
    }
    
    /**
     * Transforms the Entity data into the respective hatchbuck representation.
     * @return array
     */
    public function toArray()
    {
        $array = [];
        hb_array_set($array, 'contacId', $this->_contactId);
        hb_array_set($array, 'firstName', $this->_firstName);
        hb_array_set($array, 'lastName', $this->_lastName);
        hb_array_set($array, 'title', $this->_title);
        hb_array_set($array, 'company', $this->_company);
        hb_array_set($array, 'timezone', $this->_timezone);
        hb_array_set($array, 'referredBy', $this->_referredBy);
        hb_array_set($array, 'subscribed', $this->_isSubscribed);
        
        hb_array_set($array, 'status', $this->_status);
        hb_array_set($array, 'salesRep', $this->_salesRep);
        hb_array_set($array, 'temperature', $this->_temperature);
        
        hb_array_set($array, 'emails', $this->_emailList);
        hb_array_set($array, 'phones', $this->_phoneList);
        hb_array_set($array, 'tags', $this->_tagList);
        hb_array_set($array, 'addresses', $this->_addressList);
        hb_array_set($array, 'website', $this->_websiteList);
        hb_array_set($array, 'campaigns', $this->_campaignList);
        hb_array_set($array, 'socialNetworks', $this->_socialNetworkList);
        hb_array_set($array, 'instantMessaging', $this->_instantMessagingList);
        
        return $array;
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

    // ---------------------------------------------------------------------------------------------
    // SETTERS -------------------------------------------------------------------------------------
    
    /**
     * @param string _contactId
     * @throws \Hatchbuck\Exception\ImmutableAttributeException If ID is already set
     */
    public function setContactId($contactId)
    {
        if (isset($this->_contactId)) {
            throw new \Hatchbuck\Exception\ImmutableAttributeException('_contactId');
        }
        
        $this->_contactId = $contactId;
    }
    
    /** @param string $firstName */
    public function setFirstName($firstName)
    {
        $this->_firstName = $firstName;
    }

    /** @param string $lastName */
    public function setLastName($lastName)
    {
        $this->_lastName = $lastName;
    }

    /** @param string $title */
    public function setTitle($title)
    {
        $this->_title = $title;
    }

    /** @param string $company */
    public function setCompany($company)
    {
        $this->_company = $company;
    }

    /** @param string $timezone */
    public function setTimezone($timezone)
    {
        $this->_timezone = $timezone;
    }

    /** @param string $referredBy */
    public function setReferredBy($referredBy)
    {
        $this->_referredBy = $referredBy;
    }

    /** @param boolean $isSubscribed */
    public function setIsSubscribed($isSubscribed)
    {
        $this->_isSubscribed = (boolean)$isSubscribed;
    }

    /** @param \Hatchbuck\Entity\Status $status */
    public function setStatus(\Hatchbuck\Entity\Status $status)
    {
        $this->_status = $status;
    }

    /**  @param \Hatchbuck\Entity\SalesRep $salesRep */
    public function setSalesRep(\Hatchbuck\Entity\SalesRep $salesRep)
    {
        $this->_salesRep = $salesRep;
    }

    /** @param \Hatchbuck\Entity\Temperature $temperature */
    public function setTemperature(\Hatchbuck\Entity\Temperature $temperature)
    {
        $this->_temperature = $temperature;
    }

    /** @param \Hatchbuck\Entity\Email[] $emailList */
    public function setEmailList($emailList)
    {
        if (!hb_array_is_a($emailList, \Hatchbuck\Entity\Email::class)) {
            throw new \InvalidArgumentException('Argument not of ' . \Hatchbuck\Entity\Email::class . ' list type.');
        }
        
        $this->_emailList = $emailList;
    }

    /** @param \Hatchbuck\Entity\Phone[] $phoneList */
    public function setPhoneList(array $phoneList)
    {
        if (!hb_array_is_a($phoneList, \Hatchbuck\Entity\Phone::class)) {
            throw new \InvalidArgumentException('Argument not of ' . \Hatchbuck\Entity\Phone::class . ' list type.');
        }
        
        $this->_phoneList = $phoneList;
    }

    /** @param \Hatchbuck\Entity\Tag[] $tagList */
    public function setTagList(array $tagList)
    {
        if (!hb_array_is_a($tagList, \Hatchbuck\Entity\Tag::class)) {
            throw new \InvalidArgumentException('Argument not of ' . \Hatchbuck\Entity\Tag::class . ' list type.');
        }
        
        $this->_tagList = $tagList;
    }

    /** @param \Hatchbuck\Entity\Address[] $addressList */
    public function setAddressList(array $addressList)
    {
        if (!hb_array_is_a($addressList, \Hatchbuck\Entity\Address::class)) {
            throw new \InvalidArgumentException('Argument not of ' . \Hatchbuck\Entity\Address::class . ' list type.');
        }
        
        $this->_addressList = $addressList;
    }

    /** @param \Hatchbuck\Entity\Website[] $websiteList */
    public function setWebsiteList(array $websiteList)
    {
        if (!hb_array_is_a($websiteList, \Hatchbuck\Entity\Website::class)) {
            throw new \InvalidArgumentException('Argument not of ' . \Hatchbuck\Entity\Website::class . ' list type.');
        }
        
        $this->_websiteList = $websiteList;
    }

    /** @param \Hatchbuck\Entity\Campaign[] $campaignList */
    public function setCampaignList(array $campaignList)
    {
        if (!hb_array_is_a($campaignList, \Hatchbuck\Entity\Campaign::class)) {
            throw new \InvalidArgumentException('Argument not of ' . \Hatchbuck\Entity\Campaign::class . ' list type.');
        }
        
        $this->_campaignList = $campaignList;
    }

    /** @param \Hatchbuck\Entity\SocialNetwork[] $socialNetworkList */
    public function setSocialNetworkList(array $socialNetworkList)
    {
        if (!hb_array_is_a($socialNetworkList, \Hatchbuck\Entity\SocialNetwork::class)) {
            throw new \InvalidArgumentException('Argument not of ' . \Hatchbuck\Entity\SocialNetwork::class . ' list type.');
        }
        
        $this->_socialNetworkList = $socialNetworkList;
    }

    /** @param \Hatchbuck\Entity\InstantMessaging[] $instantMessagingList */
    public function setInstantMessagingList(array $instantMessagingList)
    {
        if (!hb_array_is_a($instantMessagingList, \Hatchbuck\Entity\InstantMessaging::class)) {
            throw new \InvalidArgumentException('Argument not of ' . \Hatchbuck\Entity\InstantMessaging::class . ' list type.');
        }
        
        $this->_instantMessagingList = $instantMessagingList;
    }


    
}
