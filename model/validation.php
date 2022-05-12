<?php
/* diner/model/validation.php
 * validate user input from the diner app
 */

//food must have at least 2 characters
function validFood($food)
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

function validMeal($meal)
{
    return in_array($meal, getMeals());
}