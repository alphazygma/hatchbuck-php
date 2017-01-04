<?php /** @copyright Alejandro Salazar (c) 2017 */
namespace Hatchbuck\Entity;

/**
 * The <kbd>ParseTrait</kbd> provides some common parsing functionality between the Hatchbuck
 * array data and our object representations.
 *
 * @author Alejandro Salazar (alphazygma@gmail.com)
 * @version 1.0
 * @package Hatchbuck.Entity
 * @subpackage Entity
 */
class EntityParseHelper
{
    /**
     * Parses a list of data arrays into a list of Entity objects.
     * @param array  $arrayList
     * @param string $parseClass
     * @return \Hatchbuck\Entity\EntityInterface
     */
    public static function parseMapList($arrayList, $parseClass)
    {
        $refClass = new \ReflectionClass($parseClass);
        
        $parsedList = [];
        for ($i = 0; $i < count($arrayList); $i++) {
            $entity = static::parseMap($arrayList[$i], $refClass);
            
            if (!empty($entity)) {
                $parsedList[] = $entity;
            }
        }
        
        return $parsedList;
    }
    
    /**
     * Parses an array of data into an Entity object.
     * @param array                   $arrayMap
     * @param string|\ReflectionClass $parseClass If a string, it woud be converted into its respective
     *      reflected class, otherwise the supplied reflected class will be used.
     * @return \Hatchbuck\Entity\EntityInterface The entity with the parsed data or <kbd>null</kbd>
     *      if the supplied array of data is empty.
     */
    public static function parseMap($arrayMap, $parseClass)
    {
        if (empty($arrayMap)) {
            return null;
        }
        
        $refClass = null;
        
        if ($parseClass instanceof \ReflectionClass) {
            $refClass = $parseClass;
        } else {
            $refClass = new \ReflectionClass($parseClass);
        }
        
        $refMethod = $refClass->getMethod('withMap');
        
        $resultObject = $refMethod->invoke(null, $arrayMap);
        
        return $resultObject;
    }
}
