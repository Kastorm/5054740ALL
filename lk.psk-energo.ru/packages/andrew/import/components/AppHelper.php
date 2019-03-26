<?php

namespace andrew\import\components;

class AppHelper
{
    public static function getErrorsList(array $errors)
    {
        $items = [];
        foreach ($errors as $field) {
            $items[] = implode('', $field);
        }

        return $items;
    }

    public static function ArrayToList(array $arrayItems, $delimiter = ' - ')
    {
        $items = [];
        foreach ($arrayItems as $k => $v) {
            $items[] = $k . $delimiter . $v;
        }

        return $items;
    }

    public static function arrayPrependEmpty($array)
    {
        return ['' => ''] + $array;
    }

    public static function arrayFillLetters($size = 32)
    {
        $result = [];
        $keys = range('A', 'Z');
        for ($i = 0; $i < count($keys) && $i < $size; $i++) {
            $result[] = $keys[$i];;
        }

        return $result;
    }
}
