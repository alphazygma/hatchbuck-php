<?php /** @copyright Alejandro Salazar (c) 2017 */
namespace Hatchbuck\Entity;

/**
 * The <kbd>Campaign</kbd> entity class represents the Hatchbuck campaign data.
 *
 * @author Alejandro Salazar (alphazygma@gmail.com)
 * @version 1.0
 * @package Hatchbuck.Entity
 * @subpackage Entity
 */
class Campaign implements EntityInterface
{
    /** @var string */
    protected $_id;
    /** @var string */
    protected $_name;
    /** @var int */
    protected $_step;
    
    /**
     * Parses an array map into a <kbd>Campaign</kbd> object.
     * @param array $arrayMap
     * @return \Hatchbuck\Entity\Campaign Entity object from the Array Map data.
     */
    public static function withMap(array $arrayMap)
    {
        $entity = new static();
        $entity->_id   = hb_array_get($arrayMap, 'id');
        $entity->_name = hb_array_get($arrayMap, 'name');
        $entity->_step = (int)hb_array_get($arrayMap, 'step');

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
        hb_array_set($array, 'step', $this->_step);
        
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

    /** @return int */
    public function getStep()
    {
        return $this->_step;
    }
}
