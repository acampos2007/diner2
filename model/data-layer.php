<?php

/* diner/model/data-layer.php
 * Returns data for the diner app
 */

//turned data-layer into a class DataLayer{}
class DataLayer
{
    //added static- static methods do not access instance data (fields)

    //define a function to get the meals for the order form
    static function getMeals()
    {
        return array("Breakfast", "Brunch", "Lunch", "Dinner");
    }

    //define a function to get the condiments for the order form
    static function getCondiments()
    {
        return array("Ketchup", "Mayo", "Mustard", "Sriracha", "Soy Sauce", "Salsa");
    }
}