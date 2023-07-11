<?php

namespace app\common\services;


class ArrayService extends Service
{
    public static function getValue($entity, $path, $default = null)
    {
        $keys = explode('.', $path);

        while ($key = array_shift($keys)) {
            if (is_array($entity) && isset($entity[$key])) {
                $entity = $entity[$key];
            } elseif (is_object($entity) && property_exists($entity, $key)) {
                $entity = $entity->{$key};
            } else {
                return $default;
            }
        }

        return $entity;
    }
}