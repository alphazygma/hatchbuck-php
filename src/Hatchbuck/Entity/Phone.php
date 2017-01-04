<?php /** @copyright Alejandro Salazar (c) 2017 */
namespace Hatchbuck\Entity;

/**
 * The <kbd>Phone</kbd> entity class represents the Hatchbuck phone data.
 *
 * @author Alejandro Salazar (alphazygma@gmail.com)
 * @version 1.0
 * @package Hatchbuck.Entity
 * @subpackage Entity
 */
class Phone implements EntityInterface
{
    /** @var string */
    protected $_id;
    /** @var string */
    protected $_number;
    /** @var string */
    protected $_type;
    /** @var string */
    protected $_typeId;
    
    /**
     * Parses an array map into a <kbd>Phone</kbd> object.
     * @param array $arrayMap
     * @return \Hatchbuck\Entity\Phone Entity object from the Array Map data.
     */
    public static function withMap(array $arrayMap)
    {
        $entity = new static();
        $entity->_id      = $arrayMap['id'];
        $entity->_number = $arrayMap['number'];
        $entity->_type    = $arrayMap['type'];
        $entity->_typeId  = $arrayMap['typeId'];
        
        return $entity;
    }
    
    /** @return string */
    public function getId()
    {
        return $this->_id;
    }

    /** @return string */
    public function getNumber()
    {
        return $this->_number;
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
