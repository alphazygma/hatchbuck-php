<?php /** @copyright Alejandro Salazar (c) 2017 */
namespace Hatchbuck\Entity;

/**
 * The <kbd>Temperature</kbd> entity class represents the Hatchbuck temperature data.
 *
 * @author Alejandro Salazar (alphazygma@gmail.com)
 * @version 1.0
 * @package Hatchbuck.Entity
 * @subpackage Entity
 */
class Temperature implements EntityInterface
{
    /** @var string */
    protected $_id;
    /** @var string */
    protected $_name;
    
    /**
     * Parses an array map into a <kbd>Temperature</kbd> object.
     * @param array $arrayMap
     * @return \Hatchbuck\Entity\Temperature Entity object from the Array Map data.
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
}
