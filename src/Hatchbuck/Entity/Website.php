<?php /** @copyright Alejandro Salazar (c) 2017 */
namespace Hatchbuck\Entity;

/**
 * The <kbd>Website</kbd> entity class represents the Hatchbuck website data.
 *
 * @author Alejandro Salazar (alphazygma@gmail.com)
 * @version 1.0
 * @package Hatchbuck.Entity
 * @subpackage Entity
 */
class Website implements EntityInterface
{
    /** @var string */
    protected $_id;
    /** @var string */
    protected $_url;
    
    /**
     * Parses an array map into a <kbd>Website</kbd> object.
     * @param array $arrayMap
     * @return \Hatchbuck\Entity\Website Entity object from the Array Map data.
     */
    public static function withMap(array $arrayMap)
    {
        $entity = new static();
        $entity->_id  = hb_array_get($arrayMap, 'id');
        $entity->_url = hb_array_get($arrayMap, 'websiteUrl');

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
        hb_array_set($array, 'websiteUrl', $this->_url);
        
        return $array;
    }
    
    /** @return string */
    public function getId()
    {
        return $this->_id;
    }

    /** @return string */
    public function getUrl()
    {
        return $this->_url;
    }
}
