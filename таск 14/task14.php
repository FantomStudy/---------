<?php
    function getCommonElements($arr1, $arr2){
        return array_intersect($arr1, $arr2);
    }

    $arr1 = [1, 2, 3, 4, 5, "apple", "banana", "cherry"];
    $arr2 = [3, 4, 5, 6, 7, "banana", "date", "fig"];
    $result = getCommonElements($arr1, $arr2);
    print_r($result);