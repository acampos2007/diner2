<?php
/* diner/model/validation.php
 * validate user input from the diner app
 */

class Validation
{
    //food must have at least 2 characters
    static function validFood($food)
    {
        /*if(strlen(trim($food) >= 2))
        {
            return true;
        }
        else
        {
            return false;
        }*/
        //shortcut way to do the above
        return strlen(trim($food)) >= 2;
    }

    static function validMeal($meal)
    {
        return in_array($meal, DataLayer::getMeals());
    }

    static function validConds($userCondArray)
    {
        $validCondArray = DataLayer::getCondiments();

        //make sure each user selection is in the array of valid options
        foreach($userCondArray as $userCond){
            if (!in_array($userCond, $validCondArray)){
                return false;
            }
        }
        return true;
    }
}