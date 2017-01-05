<?php /** @copyright Alejandro Salazar (c) 2017 */
namespace Hatchbuck\Entity;

/**
 * The <kbd>EntityInterface</kbd> class provides contract methods across Entities.
 *
 * @author Alejandro Salazar (alphazygma@gmail.com)
 * @version 1.0
 * @package Hatchbuck.Entity
 * @subpackage Entity
 */
interface EntityInterface
{
    /**
     * Parses an array map into the specific entity object representation.
     * @param array $arrayMap
     * @return object Entity object from the Array Map data.
     */
    public static function withMap(array $arrayMap);
    
    /**
     * Transforms the Entity data into the respective hatchbuck representation.
     * @return array
     */
    public function toArray();
}
