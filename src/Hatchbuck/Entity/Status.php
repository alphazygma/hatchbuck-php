<?php /** @copyright Alejandro Salazar (c) 2017 */
namespace Hatchbuck\Entity;

/**
 * The <kbd>Status</kbd> entity class represents the Hatchbuck status data.
 *
 * @author Alejandro Salazar (alphazygma@gmail.com)
 * @version 1.0
 * @package Hatchbuck.Entity
 * @subpackage Entity
 */
class Status implements EntityInterface
{
    /** @var string */
    protected $_id;
    /** @var string */
    protected $_name;
    
    /**
     * Parses an array map into a <kbd>Status</kbd> object.
     * @param array $arrayMap
     * @return \Hatchbuck\Entity\Status Entity object from the Array Map data.
     */
    public static function withMap(array $arrayMap)
    {
        $entity = new static();
        $entity->_id   = hb_array_get($arrayMap, 'id');
        $entity->_name = hb_array_get($arrayMap, 'name');

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
        hb_array_set($array, 'name', $this->_name);
        
        return $array;
    }
    
    /** @return string */
    public function getId()
    {
        return $this->_id;
    }

    /** @return string */
    public function getName()
    {
        return $this->_name;
    }
    
    /** @param string $id */
    public function setId($id)
    {   
        $this->_id = $id;
    }

    /** @param string $name */
    public function setName($name)
    {
        $this->_name = $name;
    }

}
