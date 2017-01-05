<?php /** @copyright Alejandro Salazar (c) 2017 */
namespace Hatchbuck\Entity;

/**
 * The <kbd>Email</kbd> entity class represents the Hatchbuck email data.
 *
 * @author Alejandro Salazar (alphazygma@gmail.com)
 * @version 1.0
 * @package Hatchbuck.Entity
 * @subpackage Entity
 */
class Email implements EntityInterface
{
    /** @var string */
    protected $_id;
    /** @var string */
    protected $_address;
    /** @var string */
    protected $_type;
    /** @var string */
    protected $_typeId;
    
    /**
     * Parses an array map into a <kbd>Email</kbd> object.
     * @param array $arrayMap
     * @return \Hatchbuck\Entity\Email Entity object from the Array Map data.
     */
    public static function withMap(array $arrayMap)
    {
        $entity = new static();
        $entity->_id      = hb_array_get($arrayMap, 'id');
        $entity->_address = hb_array_get($arrayMap, 'address');
        $entity->_type    = hb_array_get($arrayMap, 'type');
        $entity->_typeId  = hb_array_get($arrayMap, 'typeId');
        
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
        hb_array_set($array, 'address', $this->_address);
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
    public function getAddress()
    {
        return $this->_address;
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

    // ---------------------------------------------------------------------------------------------
    // SETTERS -------------------------------------------------------------------------------------
    
    /**
     * @param string $id
     * @throws \Hatchbuck\Exception\ImmutableAttributeException If ID is already set
     */
    public function setId($id)
    {
        if (isset($this->_id)) {
            throw new \Hatchbuck\Exception\ImmutableAttributeException('_id');
        }
        
        $this->_id = $id;
    }

    /** @param string $address */
    public function setAddress($address)
    {
        $this->_address = $address;
        
        if (!isset($this->_type)) {
            $this->_type = 'Other';
        }
    }

    /** @param string $type */
    public function setType($type)
    {
        $this->_type = $type;
    }

    /** @param string $typeId */
    public function setTypeId($typeId)
    {
        $this->_typeId = $typeId;
    }

}
