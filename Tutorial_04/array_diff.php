<?php

/**
 * function array difference
 *
 * @param  $arr1
 * @param  $arr2
 * @return void
 */
function arrayDiff($arr1, $arr2)
{
    $diffArr = [];
    foreach ($arr1 as $value) {
        if (!in_array($value, $arr2)) { //check value in arr2
            $diffArr[$value] = $value;
        }
    }
    print_r($diffArr);
}
arrayDiff([1, 2, 3], [1, 2]);
