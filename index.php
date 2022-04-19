<?php

//Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

//Require the autoload file
require_once('vendor/autoload.php');

//Create an instance of the Base Class
$f3 = Base::instance();
//echo gettype($f3);

//Define a default route
$f3->route('GET /', function()
{
    $view = new Template();
    echo $view->render('views/home.html');
    //echo '<h1>My Diner 2</h1>';
}
);

//Define a breakfast route
$f3->route('GET /breakfast', function()
{
    $view = new Template();
    echo $view->render('views/breakfast.html');
    //echo '<h1>Breakfast Page</h1>';

}
);

//Define a lunch route
$f3->route('GET /lunch', function()
{
    $view = new Template();
    echo $view->render('views/lunch.html');
    //echo '<h1>Breakfast Page</h1>';

}
);

//Define a dinner route
$f3->route('GET /dinner', function()
{
    $view = new Template();
    echo $view->render('views/dinner.html');
    //echo '<h1>Breakfast Page</h1>';

}
);

//Run fat free
$f3->run();