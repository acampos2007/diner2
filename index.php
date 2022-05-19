<?php

//Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

//Require the necessary autoload file
require_once('vendor/autoload.php');
require_once ('model/data-layer.php');
require_once ('model/validation.php');
require_once ('classes/order.php');

//Start a session-has to come before any HTML OUTPUT
session_start();

//Test Order Class
/*$order = new Order();
$order->setFood("tacos");
$order->setMeal("lunch");
$order->setCondiments("salsa, guacamole");
var_dump($order);*/

//Create an instance of the Base Class
$f3 = Base::instance();
//echo gettype($f3);

//Define a default route
$f3->route('GET|POST /', function()
{
    $view = new Template();
    echo $view->render('views/home.html');
    //echo '<h1>My Diner 2</h1>';
}
);

//Define a breakfast route
$f3->route('GET|POST /breakfast', function()
{
    $view = new Template();
    echo $view->render('views/breakfast.html');
    //echo '<h1>Breakfast Page</h1>';

}
);

//Define a lunch route
$f3->route('GET|POST /lunch', function()
{
    $view = new Template();
    echo $view->render('views/lunch.html');
    //echo '<h1>Breakfast Page</h1>';

}
);

//Define a dinner route
$f3->route('GET|POST /dinner', function()
{
    $view = new Template();
    echo $view->render('views/dinner.html');
    //echo '<h1>Breakfast Page</h1>';

}
);

//Define a order route
$f3->route('GET|POST /order', function($f3)
{
    //if the form has been submitted
    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        //get food from POST array
        $food = $_POST['food'];
        $f3->set('userFood', $food);

        //get meal from POST array
        //option 1
        $meal = "";
        if(isset($_POST['meal']))
        {
            $meal = $_POST['meal'];
        }

        //option 2
        //$meal = isset($_POST['meal']) ? $_POST['meal'] : "";

        //add the users meal to the hive
        $f3->set('userMeal', $meal);

        //if data is valid
        if(validFood($food))
        {
            //create a bew Irder object
            $order = new Order();

            //Add the food to the order
            $order->setFood($food);

            //store the order in session array
            $_SESSION['order'] = $order;
            //$_SESSION['food'] = $food;
        }
        //if data is not valid -> store an error message
        else {
            $f3->set('errors["food"]', 'Please enter a food, at least 2 characters');
        }

        if (validMeal($meal)) {
            //store in session array
            $_SESSION['order']->setMeal($meal);
            //$_SESSION['meal'] = $meal;
            //$_SESSION['meal'] = $_POST['meal'];
        }
        //if data is not valid -> store an error message
        else {
            $f3->set('errors["meal"]', 'Please select a meal');
        }

        //redirect to order2 route if there are no errors
        if (empty($f3->get('errors'))) {
            header('location: order2');
        }
    }

    //add meal data to hive
    $f3->set('meals', getMeals());

    $view = new Template();
    echo $view->render('views/orderForm1.html');
    //echo '<h1>Order Page</h1>';
}
);

//Define a order2 route
$f3->route('GET|POST /order2', function($f3) {
    //var_dump ($_POST);

    //add condiment data to hive
    $f3->set('condiments', getCondiments());

    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $conds = "";
        if(empty($_POST['conds'])) {
            $conds = "none selected";
        }
        else {
            $conds = implode(", ", $_POST['conds']);
        }
        $_SESSION['order']->setCondiments($conds);
        //$_SESSION['conds'] = $conds;

        header("location: summary");
    }

    $view = new Template();
    echo $view->render('views/orderForm2.html');
    //echo '<h1>Order Page</h1>';
}
);

//Define a order2 route
$f3->route('POST|GET /summary', function() {
    //var_dump ($_POST);
    /*echo "<pre>";
    var_dump($_SESSION);
    echo "</pre>";*/

    //before changing to above if statement:
    //$_SESSION['conds'] = implode(", ", $_POST['conds']);

    $view = new Template();
    echo $view->render('views/orderSummary.html');
    //echo '<h1>Order Page</h1>';

    //end session
    //session_destroy();
}
);

//Run fat free
$f3->run();