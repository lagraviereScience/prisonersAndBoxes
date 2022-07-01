# prisonersAndBoxes
Mathematic/logic problem, solved with php 

The problem was inspired by this video:
https://www.youtube.com/watch?v=iSNsgj1OCLA

Here is the statement of the problem:
"Say there are 100 prisoners numbered 1 to 100. Slips of paper containing each of their numbers are randomly placed in 100 boxes in a sealed room. One at a time, each prisoner is allowed to enter the room and open any 50 of the 100 boxes, searching for their number. And afterwards, they must leave the room exactly as they found it, and they can't communicate in any way with the other prisoners. If all 100 prisoners find their own number during their turn in the room, they will all be freed. But if even one of them fails to find their number, they will all be executed. The prisoners are allowed to strategize before any of them goes into the room. So what is their best strategy?"


# How to run the code
Have a recent version of php on your computer (php 7.4 or php 8 are good).
```php
php main2.php
```

# How to modify the parameters of the program?
In the code you can modify these values without risk (except maybe extreme execution time, depending on the values you chose :) )
```php
/********************************/
/*You can modify these values*/
/********************************/
//amoung of prisoners or boxes
$amountOfBoxes = 100;

//How many times do we run the program
$maxAttempt = 1000000;
/********************************/
```
