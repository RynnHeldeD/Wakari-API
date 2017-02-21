<?php

namespace App\Http\Helpers;


class JsonHelper
{
    public static function collectionToArray($collection) {
        $objects = [];
        foreach ($collection as $key => $value) {
            $objects[] = self::getObjectAttributes($value);
        }

        return $objects;
    }

    public static function objectToArray($object) {       
        return self::getObjectAttributes($object);
    }

    public static function getObjectAttributes($object) {
        $objectAttributes = [];
        foreach ($object->getAttributes() as $key => $value) {
            $objectAttributes[$key] = $value;
        }
        
        return $objectAttributes;
    }
}
