<?php /** @copyright Alejandro Salazar (c) 2017 */
namespace Hatchbuck\Entity;

/**
 * The <kbd>SalesRep</kbd> entity class represents the Hatchbuck sales rep data.
 *
 * @author Alejandro Salazar (alphazygma@gmail.com)
 * @version 1.0
 * @package Hatchbuck.Entity
 * @subpackage Entity
 */
class SalesRep implements EntityInterface
{
    /** @var string */
    protected $_id;
    /** @var string */
    protected $_username;
    
    /**
     * Parses an array map into a <kbd>SalesRep</kbd> object.
     * @param array $arrayMap
     * @return \Hatchbuck\Entity\SalesRep Entity object from the Array Map data.
     */
    public static function withMap(array $arrayMap)
    {
        $entity = new static();
        $entity->_id       = $arrayMap['id'];
        $entity->_username = $arrayMap['username'];

        return $entity;
    }
    
    /** @return string */
    public function getId()
    {
        return $this->_id;
    }

    /** @return string */
    public function getUsername()
    {
        return $this->_username;
    }
}
