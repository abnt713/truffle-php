<?php

final class CaseParser{

    public static function decamelize($word) {
        $str = preg_replace('/([a-z])([A-Z])/', "\\1_\\2", $word);
        $underlines = strtolower($str);
        return $underlines;
    }

    public static function camelize($string, $capitalizeFirstCharacter = false){

        $str = str_replace(' ', '', ucwords(str_replace('_', ' ', $string)));

        if (!$capitalizeFirstCharacter) {
            $str[0] = strtolower($str[0]);
        }

        return $str;
    }

}