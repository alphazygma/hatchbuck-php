<?php /** @copyright Alejandro Salazar (c) 2017 */

define('HB_ARRAY_SET_NULL', true);
define('HB_ARRAY_IGNORE_NULL', false);

if (!function_exists('hb_array_get')) {

    /**
     * Get an item from an array if it exists.
     *
     * @param  array   $array
     * @param  string  $key
     * @param  mixed   $default
     * @return mixed|null
     */
    function hb_array_get($array, $key, $default = null)
    {
        if (!isset($key)) {
            return $array;
        }
        
        if (isset($array[$key])) {
            return $array[$key];
            
        }
        
        return $default;
    }
}

if (!function_exists('hb_array_set')) {

    /**
     * Set an item into an array if the value is set.
     * <p>If the value is not set it will not be added to the array unless the optional parameter
     * is supplied to force the NULL value.</p>
     * 
     * @param array  $array Source array where to set the value given the key.
     * @param string $key   They key to set the value into the array
     * @param mixed  $value Either a primitive, a <kbd>\Hatchbuck\Entity\EntityInterface</kbd> object
     *      or a List of <kbd>\Hatchbuck\Entity\EntityInterface</kbd> objects.
     * @param boolean $setNull (Optional)<br/>Default: <kbd>HB_ARRAY_IGNORE_NULL</kbd><br/>Set to 
     *      <kbd>HB_ARRAY_IGNORE_NULL</kbd> if value is null and want to force the setting into the
     *      array.
     */
    function hb_array_set(&$array, $key, $value, $setNull = HB_ARRAY_IGNORE_NULL)
    {
        // If the value is not set then just check if we need to force the Null entry
        if (!isset($value)) {
            if ($setNull === HB_ARRAY_SET_NULL) {
                $array[$key] = null;
            }
            return;
        }
        
        // Now that the value is not NULL, check if it is an Entity to parse it respectively
        if ($value instanceof \Hatchbuck\Entity\EntityInterface) {
            $arrayValue  = $value->toArray();
            $array[$key] = $arrayValue;
            return;
        }
        
        // The value was an Entity alone, so check if it is a List
        if (is_array($value)) {
            
            $arrayList = [];
            
            foreach ($value as $unit) {
                if ($unit instanceof \Hatchbuck\Entity\EntityInterface) {
                    $arrayValue  = $unit->toArray();
                    $arrayList[] = $arrayValue;
                } else {
                    $arrayList[] = $unit;
                }
            }
            
            $array[$key] = $arrayList;
            return;
        }
        
        // At this point it is just a primitive or a non-known object type so just assign it
        $array[$key] = $value;
    }

}

if (!function_exists('hb_array_is_a')) {

    /**
     * Returns whether all the objects in a given list match the supplied class name or not.
     * @param object[] $array     The list of objects to compare
     * @param string   $className The class to which all objects in the list will be compared with
     * @return boolean
     */
    function hb_array_is_a($array, $className)
    {
        $result = true;
        
        if (empty($array)) {
            return $result;
        }
        
        foreach ($array as $object) {
            if (!is_object($object) || !is_a($object, $className)) {
                $result = false;
                break;
            }
        }
        
        return $result;
    }
}

if (!function_exists('hb_to_entity')) {
    
    /**
     * Parses an array of data into an Entity object.
     * 
     * @param array                   $arrayMap
     * @param string|\ReflectionClass $parseClass If a string, it woud be converted into its respective
     *      reflected class, otherwise the supplied reflected class will be used.
     * @return \Hatchbuck\Entity\EntityInterface The entity with the parsed data or <kbd>null</kbd>
     *      if the supplied array of data is empty.
     */
    function hb_to_entity($arrayMap, $parseClass)
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

if (!function_exists('hb_to_entity_list')) {
    
    /**
     * Parses a list of data arrays into a list of Entity objects.
     * 
     * @param array  $arrayList
     * @param string $parseClass
     * @return \Hatchbuck\Entity\EntityInterface[] The entity list with the parse data.
     */
    function hb_to_entity_list($arrayList, $parseClass)
    {
        $refClass = new \ReflectionClass($parseClass);
        
        $parsedList = [];
        for ($i = 0; $i < count($arrayList); $i++) {
            $entity = hb_to_entity($arrayList[$i], $refClass);
            
            if (!empty($entity)) {
                $parsedList[] = $entity;
            }
        }
        
        return $parsedList;
    }
}