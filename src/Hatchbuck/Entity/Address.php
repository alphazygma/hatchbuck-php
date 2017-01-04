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
        $entity->_id        = $arrayMap['id'];
        $entity->_street    = $arrayMap['street'];
        $entity->_city      = $arrayMap['city'];
        $entity->_state     = $arrayMap['state'];
        $entity->_zip       = $arrayMap['zip'];
        $entity->_countryId = $arrayMap['countryId'];
        $entity->_country   = $arrayMap['country'];
        $entity->_type      = $arrayMap['type'];
        $entity->_typeId    = $arrayMap['typeId'];

        return $entity;
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
