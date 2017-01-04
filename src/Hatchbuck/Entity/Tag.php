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
        $entity->_id    = $arrayMap['id'];
        $entity->_name  = $arrayMap['name'];
        $entity->_score = (int)$arrayMap['score'];

        return $entity;
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
}
