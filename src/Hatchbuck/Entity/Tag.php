<?php /** @copyright Alejandro Salazar (c) 2017 */
namespace Hatchbuck\Entity;

/**
 * The <kbd>Tag</kbd> entity class represents the Hatchbuck tag data.
 *
 * @author Alejandro Salazar (alphazygma@gmail.com)
 * @version 1.0
 * @package Hatchbuck.Entity
 * @subpackage Entity
 */
class Tag implements EntityInterface
{
    /** @var string */
    protected $_id;
    /** @var string */
    protected $_name;
    /** @var int */
    protected $_score;
    
    /**
     * Parses an array map into a <kbd>Tag</kbd> object.
     * @param array $arrayMap
     * @return \Hatchbuck\Entity\Tag Entity object from the Array Map data.
     */
    public static function withMap(array $arrayMap)
    {
        $entity = new static();
        $entity->_id    = hb_array_get($arrayMap, 'id');
        $entity->_name  = hb_array_get($arrayMap, 'name');
        $entity->_score = (int)hb_array_get($arrayMap, 'score');

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
        hb_array_set($array, 'score', $this->_score);
        
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
    public function getScore()
    {
        return $this->_score;
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

    /** @param string $name */
    public function setName($name)
    {
        $this->_name = $name;
    }

    /** @param int $score */
    public function setScore($score)
    {
        $this->_score = $score;
    }


}
