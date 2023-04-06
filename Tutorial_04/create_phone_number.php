<?php
/**
 * Function Creating phone number
 *
 * @param $numberArray
 * @return void
 */

function createPhoneNumber($numberArray)
{
    //change array to string and put selected parts of array
    $areaCode = join(array_slice($numberArray, 0, 3));
    $nextThree = join(array_slice($numberArray, 3, 3));
    $lastFour = join(array_slice($numberArray, 6, 4));

    print_r("({$areaCode}) {$nextThree}-{$lastFour}");
}

createPhoneNumber([1, 2, 3, 4, 5, 6, 7, 8, 9, 0]);
