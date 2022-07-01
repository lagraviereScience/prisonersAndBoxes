<?php

/**
 * Generate an array of size $size
 * The returned array will contain values from 0 to $size-1
 * The returned array will not contain duplicates
 * The returned array will not contain any index equal to the value it points to
 *
 * @param integer $size size of the array
 * @return array array of int
 */
function generateShuffledArrayWhereIndicesNeverEqualValue(int $size) : array
{
    $myArray = range(0,$size-1);
    shuffle($myArray);

    while(!noDuplicateInArray($myArray) && !allUnique($myArray))
    {
		//if the array contains duplicate(s)
		//or if any index equal the value it points to 
		//we reshuffle the array
        shuffle($myArray);
        /*foreach ($numbers as $key=>$value)
        {
            if($key==$value)
            {
                $switchValue = $numbers[($key%($size-1))+1];
                $numbers[$key] = $switchValue;
                $numbers[($key%($size-1))+1] = $value;
            }
        }*/
    }
    return $myArray;
}

/**
 * Checks whether an array contains any index equals to the value it points to
 * If any index equals to the value it points to, false is returned otherwise true is returned
 *
 * @param array $numbers array of int/numbers
 * @return boolean
 */
function allUnique(array $numbers) : bool
{
    foreach ($numbers as $key=>$value)
    {
        if($key==$value)
        {
            return false;
        }
    }
    return true;
}

/**
 * checks whether an array contains duplicates
 * 
 * Works with the following logic:
 * As array_flip, flips values and indices, if ANY value is a duplicate 
 * -> then indices will collide, as indices must be unique,
 * array_flip solves this by removing duplicated indices
 * Hence, the size of the flipped array will be smaller than count($input_array)
 *
 * @param array $input_array must be an array of int!
 * @return void
 */
function noDuplicateInArray(array $input_array)
{
    return count($input_array) === count(array_flip($input_array));
}


/**
 * Convenient function to display debug info
 *
 * @param array $boxes
 * @param integer $prisoner
 * @param integer $target
 * @return void
 */
function debugThatArray(array $boxes,
            int $prisoner,
            int $target) : void
{
    echo "\n****************************\n";
    if(!noDuplicateInArray($boxes))
    {
        echo "This array HAS duplicates \n";
    }
    displayPath($boxes, $prisoner);
    echo "\n****************************\n";
}

/**
 * Displays the path followed by a prisoner in the room full of boxes
 *
 * @param array $boxes
 * @param integer $prisoner
 * @return void
 */
function displayPath(array $boxes, int $prisoner)
{
    $length = 0;
    $amountOfBoxes = count($boxes);
    $target = $boxes[$prisoner];
    echo displayBox($prisoner, $target) . " ==> ";
    while($prisoner != $target)
    {

        if($length > $amountOfBoxes)
        {
            exit(0);
        }

        echo displayBox($target, $boxes[$target]) . " ==> ";
        $target = $boxes[$target];
        $length++;
    }
}

/**
 * Display the content of a box
 *
 * @param integer $boxNumber
 * @param integer $boxContent
 * @return string
 */
function displayBox(int $boxNumber, int $boxContent) : string
{
    return "[$boxNumber]->$boxContent";
}

/**
 * Compute the path followed by count($boxes) prisoners through a room full of $boxes
 * Each box contains a number, the prisoner then goes to that numbered box until it find its number
 *
 * @param array $boxes an array containing values from 0 to count($boxes)-1, guaranteed without duplicates and no index equals to the value it points to
 * @return boolean
 */
function prisonerPath(array $boxes) : bool
{
    $amountOfBoxes = count($boxes);
    $success = true;


    $stuck=0;
    for($prisoner = 0; $prisoner < $amountOfBoxes; $prisoner++)
    {
        $length = 0;
        $target = $boxes[$prisoner];
        while($target != $prisoner)
        {
            $length++;
            $target = $boxes[$target];
            /*if($length > $amountOfBoxes)
            {
                $stuck++;
                echo "stuck";
                debugThatArray($boxes, $prisoner, $target);
                return true;
            }*/
        }

        /*
        If the prisoner walked MORE than $amountOfBoxes/2 then this is considered a fail
        */
        if($length > $amountOfBoxes/2)
        {
            return false;
        }
    }

    return $success;
}


/********************************/
/*You can modify these values*/
/********************************/
//amoung of prisoners or boxes
$amountOfBoxes = 100;

//How many times do we run the program
$maxAttempt = 1000000;
/********************************/



$success = 0;
for ($attempt = 0; $attempt < $maxAttempt; $attempt++)
{
    $myArray = generateShuffledArrayWhereIndicesNeverEqualValue($amountOfBoxes);
    if(prisonerPath($myArray))
    {
        $success++;
    }
    //print_r($myArray);

    //echo "\nindices go from 0 to " . (count($myArray)-1) . "\n";
    //echo "\nmax value of prisoners is: " . max($myArray) . "\n";
}



echo "Success rate " . $success / $maxAttempt;
echo "\n";