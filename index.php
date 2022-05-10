<?php

//Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

//Start a session
session_start();

//Require the necessary autoload file
require_once('vendor/autoload.php');
require_once ('model/data-layer.php');

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
    //add meal data to hive
    $f3->set('meals', getMeals());

    $view = new Template();
    echo $view->render('views/orderForm1.html');
    //echo '<h1>Order Page</h1>';
}
);

//Define a order2 route
$f3->route('POST|GET /order2', function($f3)
{
    //var_dump ($_POST);
    //move orderForm1 data from POST to SESSION
    $_SESSION['food'] = $_POST['food'];
    $_SESSION['meal'] = $_POST['meal'];

    //add condiment data to hive
    $f3->set('condiments', getCondiments());

    $view = new Template();
    echo $view->render('views/orderForm2.html');
    //echo '<h1>Order Page</h1>';
}
);

//Define a order2 route
$f3->route('POST|GET /summary', function()
{
    //var_dump ($_POST);
    if(empty($_POST['conds']))
    {
        $conds = "none selected";
    }
    else
    {
        $conds = implode(", ", $_POST['conds']);
    }
    $_SESSION['conds'] = $conds;

    //before changing to above if statement:
    //$_SESSION['conds'] = implode(", ", $_POST['conds']);

    $view = new Template();
    echo $view->render('views/orderSummary.html');
    //echo '<h1>Order Page</h1>';
}
);

//Run fat free
$f3->run();