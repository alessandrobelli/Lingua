<?php

namespace alessandrobelli\Lingua;

class LinguaUtilities
{
    public static function array_multidimensional_search($array, $key, $value)
    {
        $results = [];
        if (is_array($array)) {
            if (isset($array[$key]) && $array[$key] == $value) {
                $results[] = $array;
            }
            foreach ($array as $subarray) {
                $results = array_merge($results, LinguaUtilities::array_multidimensional_search($subarray, $key, $value));
            }
        }

        return $results;
    }
}
