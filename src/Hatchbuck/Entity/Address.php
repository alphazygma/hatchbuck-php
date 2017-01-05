<?php /** @copyright Alejandro Salazar (c) 2017 */
namespace Hatchbuck\Entity;

/**
 * The <kbd>Address</kbd> entity class represents the Hatchbuck address data.
 *
 * @author Alejandro Salazar (alphazygma@gmail.com)
 * @version 1.0
 * @package Hatchbuck.Entity
 * @subpackage Entity
 */
class Address implements EntityInterface
{
    /** @var string */
    protected $_id;
    /** @var string */
    protected $_street;
    /** @var string */
    protected $_city;
    /** @var string */
    protected $_state;
    /** @var string */
    protected $_zip;
    /** @var string */
    protected $_countryId;
    /** @var string */
    protected $_country;
    /** @var string */
    protected $_type;
    /** @var string */
    protected $_typeId;
    
    /**
     * Parses an array map into a <kbd>Address</kbd> object.
     * @param array $arrayMap
     * @return \Hatchbuck\Entity\Address Entity object from the Array Map data.
     */
    public static function withMap(array $arrayMap)
    {
        $entity = new static();
        $entity->_id        = hb_array_get($arrayMap, 'id');
        $entity->_street    = hb_array_get($arrayMap, 'street');
        $entity->_city      = hb_array_get($arrayMap, 'city');
        $entity->_state     = hb_array_get($arrayMap, 'state');
        $entity->_zip       = hb_array_get($arrayMap, 'zip');
        $entity->_countryId = hb_array_get($arrayMap, 'countryId');
        $entity->_country   = hb_array_get($arrayMap, 'country');
        $entity->_type      = hb_array_get($arrayMap, 'type');
        $entity->_typeId    = hb_array_get($arrayMap, 'typeId');

        return $entity;
    }
    
    /**
     * Transforms the Entity data into the respective hatchbuck representation.
     * @return array
     */
    public function toArray()
    {
        $array = [];
        hb_array_set($array, 'id', $this->_id);
        hb_array_set($array, 'street', $this->_street);
        hb_array_set($array, 'city', $this->_city);
        hb_array_set($array, 'state', $this->_state);
        hb_array_set($array, 'zip', $this->_zip);
        hb_array_set($array, 'countryId', $this->_countryId);
        hb_array_set($array, 'country', $this->_country);
        hb_array_set($array, 'type', $this->_type);
        hb_array_set($array, 'typeId', $this->_typeId);
        
        return $array;
    }
    
    /** @return string */
    public function getId()
    {
        return $this->_id;
    }
    
    /** @return string */
    public function getStreet()
    {
        return $this->_street;
    }

    /** @return string */
    public function getCity()
    {
        return $this->_city;
    }

    /** @return string */
    public function getState()
    {
        return $this->_state;
    }

    /** @return string */
    public function getZip()
    {
        return $this->_zip;
    }

    /** @return string */
    public function getCountryId()
    {
        return $this->_countryId;
    }

    /** @return string */
    public function getCountry()
    {
        return $this->_country;
    }

    /** @return string */
    public function getType()
    {
        return $this->_type;
    }

    /** @return string */
    public function getTypeId()
    {
        return $this->_typeId;
    }

}
